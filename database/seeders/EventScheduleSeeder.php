<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\EventSchedule;

class EventScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $scheduleItems = [
            [
                'time' => '07:00:00',
                'title' => 'Concentração e Credenciamento',
                'description' => 'Recepção dos participantes e entrega dos kits',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'time' => '08:00:00',
                'title' => 'Cerimônia de Abertura',
                'description' => 'Apresentação do evento e autoridades',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'time' => '09:00:00',
                'title' => 'Largada Oficial',
                'description' => 'Início do percurso de ciclismo',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'time' => '11:00:00',
                'title' => 'Premiação',
                'description' => 'Entrega de troféus e medalhas',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'time' => '12:00:00',
                'title' => 'Encerramento',
                'description' => 'Encerramento oficial do evento',
                'sort_order' => 5,
                'is_active' => true,
            ],
        ];

        foreach ($scheduleItems as $item) {
            EventSchedule::create($item);
        }
    }
}
