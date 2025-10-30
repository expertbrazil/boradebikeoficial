<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Event;
use App\Models\GalleryImage;
use App\Models\Partner;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create main event
        $event = Event::create([
            'title' => 'Bora Bike Luzes de Natal',
            'description' => 'O maior evento de ciclismo da região dos lagos',
            'event_date' => '2025-12-14',
            'start_time' => '07:30',
            'end_time' => '12:00',
            'location' => 'Cabo Frio - RJ',
            'city' => 'Cabo Frio',
            'state' => 'RJ',
            'about_text' => 'BORA BIKE é mais que um evento de ciclismo. É uma celebração do esporte, saúde e de comunidade. Junte-se a nós para uma experiência única que une pessoas através da paixão pelo ciclismo.',
            'kit_description' => 'Os primeiros inscritos garantem um kit exclusivo com camiseta, mochila e garrafa!',
            'kit_limit' => 2000,
            'schedule' => json_encode([
                ['time' => '07h00', 'activity' => 'Concentração e Credenciamento'],
                ['time' => '08h00', 'activity' => 'Largada Oficial'],
                ['time' => '09h00', 'activity' => 'Início do percurso de ciclismo'],
                ['time' => '11h00', 'activity' => 'Premiação'],
                ['time' => '12h00', 'activity' => 'Encerramento'],
            ]),
            'safety_info' => json_encode([
                ['title' => 'Rota Sinalizada', 'description' => 'Percurso totalmente sinalizado'],
                ['title' => 'Equipe de Apoio', 'description' => 'Equipe especializada em apoio'],
                ['title' => 'Hidratação', 'description' => 'Pontos de hidratação ao longo do percurso'],
                ['title' => 'Seguro Atleta', 'description' => 'Seguro para todos os participantes'],
            ]),
            'is_active' => true,
        ]);

        // Gallery images will be added manually through admin panel

        // Partners will be added manually through admin panel
    }
}

        $event = Event::create([
            'title' => 'Bora Bike Luzes de Natal',
            'description' => 'O maior evento de ciclismo da região dos lagos',
            'event_date' => '2025-12-14',
            'start_time' => '07:30',
            'end_time' => '12:00',
            'location' => 'Cabo Frio - RJ',
            'city' => 'Cabo Frio',
            'state' => 'RJ',
            'about_text' => 'BORA BIKE é mais que um evento de ciclismo. É uma celebração do esporte, saúde e de comunidade. Junte-se a nós para uma experiência única que une pessoas através da paixão pelo ciclismo.',
            'kit_description' => 'Os primeiros inscritos garantem um kit exclusivo com camiseta, mochila e garrafa!',
            'kit_limit' => 2000,
            'schedule' => json_encode([
                ['time' => '07h00', 'activity' => 'Concentração e Credenciamento'],
                ['time' => '08h00', 'activity' => 'Largada Oficial'],
                ['time' => '09h00', 'activity' => 'Início do percurso de ciclismo'],
                ['time' => '11h00', 'activity' => 'Premiação'],
                ['time' => '12h00', 'activity' => 'Encerramento'],
            ]),
            'safety_info' => json_encode([
                ['title' => 'Rota Sinalizada', 'description' => 'Percurso totalmente sinalizado'],
                ['title' => 'Equipe de Apoio', 'description' => 'Equipe especializada em apoio'],
                ['title' => 'Hidratação', 'description' => 'Pontos de hidratação ao longo do percurso'],
                ['title' => 'Seguro Atleta', 'description' => 'Seguro para todos os participantes'],
            ]),
            'is_active' => true,
        ]);

        // Gallery images will be added manually through admin panel

        // Partners will be added manually through admin panel
    }
}
