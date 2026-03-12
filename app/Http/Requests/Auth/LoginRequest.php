<?php

namespace App\Http\Requests\Auth;

use Carbon\CarbonInterval;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'lowercase', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     */
    public function authenticate(): void
    {
        $this->notRateLimited();

        if (!Auth::attempt($this->only('email', 'password'), $this->boolean('remember'))) {
            RateLimiter::hit(
                $this->throttleKey(),
                decaySeconds: config('auth.login_throttle.decay_minutes', 1) * 60
            );

            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        //Clear the attempts so the user isn't penalized next time.
        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the login request is not rate limited.
     */
    protected function notRateLimited(): void
    {

        $maxAttempts = config('auth.login_throttle.max_attempts', 5);
        if (!RateLimiter::tooManyAttempts($this->throttleKey(), $maxAttempts)) {
            return;
        }

        //Use availableIn to calculate remaining wait time
        $seconds = RateLimiter::availableIn($this->throttleKey());

        // Create an interval from seconds and cascade it (convert 60s to 1m, etc.)
        // 'join' adds the "and" or "و" automatically based on the app locale
        $timeString = CarbonInterval::seconds($seconds)
            ->cascade()
            ->forHumans(['join' => true]);

        throw ValidationException::withMessages([
            'email' => __('auth.throttle', ['time' => $timeString]),
        ]);
    }

    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->string('email')) . '|' . $this->ip());
    }
}
