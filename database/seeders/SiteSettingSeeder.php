<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SiteSetting;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        SiteSetting::create([
            'logo' => 'upload/site_logo/logo.png',
            'phone' => '+228 12345678',
            'email' => 'contact@edplatform.com',
            'address' => 'Lomé, Togo',
            'watch_preview' => 'https://youtube.com',
            'facebook' => 'https://facebook.com',
            'twitter' => 'https://twitter.com',
            'instagram' => 'https://instagram.com',
            'linkedin' => 'https://linkedin.com',
            'copyright' => '© 2024 EduPlatform. Tous droits réservés.',
            'currency' => 'FCFA'
        ]);
    }
} 