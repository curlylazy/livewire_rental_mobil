<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application, which will be used when the
    | framework needs to place the application's name in a notification or
    | other UI elements where an application name needs to be displayed.
    |
    */

    'name' => env('APP_NAME', 'Laravel'),

    /*
    |--------------------------------------------------------------------------
    | Application Environment
    |--------------------------------------------------------------------------
    |
    | This value determines the "environment" your application is currently
    | running in. This may determine how you prefer to configure various
    | services the application utilizes. Set this in your ".env" file.
    |
    */

    'env' => env('APP_ENV', 'production'),

    /*
    |--------------------------------------------------------------------------
    | Application Debug Mode
    |--------------------------------------------------------------------------
    |
    | When your application is in debug mode, detailed error messages with
    | stack traces will be shown on every error that occurs within your
    | application. If disabled, a simple generic error page is shown.
    |
    */

    'debug' => (bool) env('APP_DEBUG', false),

    /*
    |--------------------------------------------------------------------------
    | Application URL
    |--------------------------------------------------------------------------
    |
    | This URL is used by the console to properly generate URLs when using
    | the Artisan command line tool. You should set this to the root of
    | the application so that it's available within Artisan commands.
    |
    */

    'url' => env('APP_URL', 'http://localhost'),

    /*
    |--------------------------------------------------------------------------
    | Application Timezone
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default timezone for your application, which
    | will be used by the PHP date and date-time functions. The timezone
    | is set to "UTC" by default as it is suitable for most use cases.
    |
    */

    'timezone' => 'UTC',

    /*
    |--------------------------------------------------------------------------
    | Application Locale Configuration
    |--------------------------------------------------------------------------
    |
    | The application locale determines the default locale that will be used
    | by Laravel's translation / localization methods. This option can be
    | set to any locale for which you plan to have translation strings.
    |
    */

    'locale' => env('APP_LOCALE', 'en'),

    'fallback_locale' => env('APP_FALLBACK_LOCALE', 'en'),

    'faker_locale' => env('APP_FAKER_LOCALE', 'en_US'),

    /*
    |--------------------------------------------------------------------------
    | Encryption Key
    |--------------------------------------------------------------------------
    |
    | This key is utilized by Laravel's encryption services and should be set
    | to a random, 32 character string to ensure that all encrypted values
    | are secure. You should do this prior to deploying the application.
    |
    */

    'cipher' => 'AES-256-CBC',

    'key' => env('APP_KEY'),

    'previous_keys' => [
        ...array_filter(
            explode(',', (string) env('APP_PREVIOUS_KEYS', ''))
        ),
    ],

    /*
    |--------------------------------------------------------------------------
    | Maintenance Mode Driver
    |--------------------------------------------------------------------------
    |
    | These configuration options determine the driver used to determine and
    | manage Laravel's "maintenance mode" status. The "cache" driver will
    | allow maintenance mode to be controlled across multiple machines.
    |
    | Supported drivers: "file", "cache"
    |
    */

    'maintenance' => [
        'driver' => env('APP_MAINTENANCE_DRIVER', 'file'),
        'store' => env('APP_MAINTENANCE_STORE', 'database'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Data Perusahaan / Instansi
    |--------------------------------------------------------------------------
    |
    |
    */

    'alamat' => 'Jalan Campuan Asri Blok BB No 67, Dalung, Kuta Utara',
    'alamat_1' => 'Kuta, Kuta Utara, Bali',
    'alamat_2' => 'Jalan Campuan Asri Blok BB No 67, Dalung',
    'url_google_maps' => 'https://goo.gl/maps/jan4kk7tke7ZtUDs8',
    'notelepon' => '(0361) 8945642',
    'wa' => '+628563735581',
    'youtube' => 'https://www.youtube.com/@desagubug6407',
    'fb' => 'https://www.facebook.com/dewatautamauniform',
    'ig' => 'https://www.instagram.com/dewatautamauniform/?hl=en',
    'email' => 'info@balicoding.com',
    'kodepos' => '80115',
    'title' => 'Balicoding | Balicoding.com',
    'owner' => 'Styawan Saputra',
    'webname' => 'Balicoding',
    'webdomain' => 'https://balicoding.com',
    'desc' => 'kami mengerjakan projek aplikasi mobile dan web untuk kebutuhan anda, website company, website ecommerce, aplikasi mobile custom, pengerjaan menggunakan bahasa pemrograman PHP, yang bisa dicustom sesuai dengan kebutuhan anda.',
    'desc2' => 'Apakah Anda siap untuk mengubah pengalaman online Anda? <b>Bali Coding</b> hadir untuk memenuhi kebutuhan digital Anda dengan. Pembuatan <b>Web Aplikasi</b>, <b>E-Commerce</b>, <b>Katalog Produk</b>, <b>Company Profile</b>, dan <b>Mobile Apps</b>',
    'wa_sales_1' => '+628563735581',
    'wa_sales_2' => '+628563735581',
];
