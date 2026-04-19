<?php

namespace App\Providers;
// use Config;
use App\Models\Smtp;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Config;

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
        // Set default string length for database schema
        Schema::defaultStringLength(125);

        if (Schema::hasTable('smtps')) {
            $smtp = Smtp::first();

            if ($smtp) {
                $data = [
                    'driver' => $smtp->mailer, // Ensure this matches your column name
                    'host' => $smtp->host,
                    'port' => $smtp->port,
                    'username' => $smtp->username,
                    'password' => $smtp->password,
                    'encryption' => $smtp->encryption,
                    'from' => [
                        'address' => $smtp->from_address,
                        'name' => 'Easy LMS',
                    ]
                ];

                Config::set('mail', $data);
            }
        }
    }
}
