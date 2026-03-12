<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            background-color: #f6f7fb;
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            margin: 0;
            padding: 20px;
            text-align: {{ app()->getLocale() === 'ar' ? 'right' : 'left' }};
        }

        .container {
            max-width: 500px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 5px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .header {
            background-color: #727cf5;
            /* bg-primary in Hyper */
            padding: 30px;
            text-align: center;
        }

        .body {
            padding: 40px;
            color: #6c757d;
        }

        .title {
            color: #313a46;
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .btn-primary {
            background-color: #727cf5;
            color: #ffffff !important;
            padding: 12px 25px;
            text-decoration: none;
            border-radius: 4px;
            display: inline-block;
            font-weight: 600;
            margin-top: 20px;
        }

        .footer {
            text-align: center;
            padding: 20px;
            font-size: 12px;
            color: #98a6ad;
        }

        hr {
            border: 0;
            border-top: 1px solid #eef2f7;
            margin: 30px 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <div style="font-size: 22px; font-weight: bold; color: #ffffff; letter-spacing: 1px;">
                Team Workflow Managment
            </div>
        </div>

        <div class="body">

            <h4 class="title" style="text-align: center;">{{ __('verify_email.greeting', ['name' => $user_name]) }}</h4>

            <p style="text-align: center;">{{ __('verify_email.intro') }}</p>

            <div style="text-align: center;">
                <a href="{{ $url }}" class="btn-primary">
                    {{ __('verify_email.button') }}
                </a>
            </div>

            <p style="margin-top: 25px; text-align: center;">{{ __('verify_email.outro') }}</p>

            <hr>

            <p style="font-size: 12px;">
                {{ __('verify_email.link_help') }}:<br>
                <a href="{{ $url }}" style="color: #727cf5; word-break: break-all;">{{ $url }}</a>
            </p>
        </div>
    </div>

    <div class="footer">
        &copy; {{ date('Y') }} Team Workflow Managment
    </div>
</body>

</html>
