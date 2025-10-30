<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SiteSetting;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Configuração inicial do vídeo de fundo
        SiteSetting::set('hero_video', null, 'file', 'Vídeo de fundo do hero section');
        
        // Configuração inicial da logo do site
        SiteSetting::set('site_logo', null, 'file', 'Logo do site público');
        
        // Configuração inicial da data de encerramento das inscrições
        SiteSetting::set('registration_deadline', null, 'date', 'Data de encerramento das inscrições');
    }
}
        // Configuração inicial da logo do site
        SiteSetting::set('site_logo', null, 'file', 'Logo do site público');
        
        // Configuração inicial da data de encerramento das inscrições
        SiteSetting::set('registration_deadline', null, 'date', 'Data de encerramento das inscrições');
    }
}