<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Mailer
    |--------------------------------------------------------------------------
    |
    | This option controls the default mailer that is used to send any email
    | messages sent by your application. Alternative mailers may be setup
    | and used as needed; however, this mailer will be used by default.
    |
    */

    // 'default' => env('MAIL_MAILER', 'smtp'),

    // 'default' => env('MAIL_MAILER', 'sendgrid'),

    /*
    |--------------------------------------------------------------------------
    | Mailer Configurations
    |--------------------------------------------------------------------------
    |
    | Here you may configure all of the mailers used by your application plus
    | their respective settings. Several examples have been configured for
    | you and you are free to add your own as your application requires.
    |
    | Laravel supports a variety of mail "transport" drivers to be used while
    | sending an e-mail. You will specify which one you are using for your
    | mailers below. You are free to add additional mailers as required.
    |
    | Supported: "smtp", "sendmail", "mailgun", "ses",
    |            "postmark", "log", "array", "failover"
    |
    */

    'default' => env('MAIL_MAILER', 'sendgrid'),

    'mailers' => [
        // Mailer SMTP mặc định (nếu bạn cần dùng đến)
        'smtp' => [
            'transport' => 'smtp',
            'host' => env('MAIL_HOST', 'smtp.mailgun.org'),
            'port' => env('MAIL_PORT', 587),
            'encryption' => env('MAIL_ENCRYPTION', 'tls'),
            'username' => env('MAIL_USERNAME'),
            'password' => env('MAIL_PASSWORD'),
            'timeout' => null,
            'local_domain' => env('MAIL_EHLO_DOMAIN'),
        ],

        // Mailer SendGrid
        'sendgrid' => [
            'transport'  => 'smtp',
            'host'       => 'smtp.sendgrid.net',
            'port'       => 587,
            'encryption' => 'tls',
            'username'   => 'apikey', // Luôn là 'apikey'
            'password'   => env('SENDGRID_API_KEY'), // Lấy API key từ .env
            'timeout'    => null,
            // Bạn có thể không cần local_domain nếu không cần
            'local_domain' => env('MAIL_EHLO_DOMAIN'),
        ],

        // Các mailer khác (nếu bạn không dùng chúng, vẫn giữ nguyên hoặc xoá nếu không cần)
        'ses' => [
            'transport' => 'ses',
        ],
        'mailgun' => [
            'transport' => 'mailgun',
        ],
        'postmark' => [
            'transport' => 'postmark',
        ],
        'sendmail' => [
            'transport' => 'sendmail',
            'path' => env('MAIL_SENDMAIL_PATH', '/usr/sbin/sendmail -bs -i'),
        ],
        'log' => [
            'transport' => 'log',
            'channel' => env('MAIL_LOG_CHANNEL'),
        ],
        'array' => [
            'transport' => 'array',
        ],
        'failover' => [
            'transport' => 'failover',
            'mailers' => [
                'smtp',
                'log',
            ],
        ],
    ],

    /*
    |---------------------------------------------------------------------------
    | Global "From" Address
    |---------------------------------------------------------------------------
    */
    'from' => [
        'address' => env('MAIL_FROM_ADDRESS', '22211tt2703@mail.tdc.edu.vn'),
        'name' => env('MAIL_FROM_NAME', 'Web Bán Hàng Điện Tử'),
    ],

    /*
    |---------------------------------------------------------------------------
    | Markdown Mail Settings
    |---------------------------------------------------------------------------
    */
    'markdown' => [
        'theme' => 'default',

        'paths' => [
            resource_path('views/vendor/mail'),
        ],
    ],
];
