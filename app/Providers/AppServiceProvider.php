<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //custumze the url of confirmation to be localized
        VerifyEmail::createUrlUsing(function ($notifiable) {
            return URL::temporarySignedRoute(
                'verification.verify',
                Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
                [
                    'id' => $notifiable->getKey(),
                    'hash' => sha1($notifiable->getEmailForVerification()),
                    'locale' => app()->getLocale(),
                ]
            );

        });

        //custumize email confirmation that send
        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            $locale = $notifiable->locale ?? app()->getLocale();
            return (new MailMessage)
                ->subject(__('verify_email.subject', [], $locale))
                ->view('pages.auth.email_verification', ['url' => $url, 'user_name' => $notifiable->name]);
        });
    }
}
