<?php

namespace App\Filament\Widgets;

use App\Models\Event;
use App\Models\Registration;
use App\Models\GalleryImage;
use App\Models\Partner;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $totalRegistrations = Registration::count();
        $totalKitsUsed = Registration::where('has_kit', true)->count();
        $remainingKits = Event::where('is_active', true)->first()?->getRemainingKits() ?? 0;
        $totalGalleryImages = GalleryImage::where('is_active', true)->count();
        $totalPartners = Partner::where('is_active', true)->count();

        return [
            Stat::make('Total de Inscrições', $totalRegistrations)
                ->description('Participantes registrados')
                ->descriptionIcon('heroicon-m-users')
                ->color('success'),

            Stat::make('Kits Utilizados', $totalKitsUsed)
                ->description('Kits distribuídos')
                ->descriptionIcon('heroicon-m-gift')
                ->color('info'),

            Stat::make('Kits Disponíveis', $remainingKits)
                ->description('Kits restantes')
                ->descriptionIcon('heroicon-m-shopping-bag')
                ->color('warning'),

            Stat::make('Imagens na Galeria', $totalGalleryImages)
                ->description('Fotos ativas')
                ->descriptionIcon('heroicon-m-photo')
                ->color('primary'),

            Stat::make('Parceiros', $totalPartners)
                ->description('Parceiros ativos')
                ->descriptionIcon('heroicon-m-handshake')
                ->color('secondary'),
        ];
    }
}


namespace App\Filament\Widgets;

use App\Models\Event;
use App\Models\Registration;
use App\Models\GalleryImage;
use App\Models\Partner;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $totalRegistrations = Registration::count();
        $totalKitsUsed = Registration::where('has_kit', true)->count();
        $remainingKits = Event::where('is_active', true)->first()?->getRemainingKits() ?? 0;
        $totalGalleryImages = GalleryImage::where('is_active', true)->count();
        $totalPartners = Partner::where('is_active', true)->count();

        return [
            Stat::make('Total de Inscrições', $totalRegistrations)
                ->description('Participantes registrados')
                ->descriptionIcon('heroicon-m-users')
                ->color('success'),

            Stat::make('Kits Utilizados', $totalKitsUsed)
                ->description('Kits distribuídos')
                ->descriptionIcon('heroicon-m-gift')
                ->color('info'),

            Stat::make('Kits Disponíveis', $remainingKits)
                ->description('Kits restantes')
                ->descriptionIcon('heroicon-m-shopping-bag')
                ->color('warning'),

            Stat::make('Imagens na Galeria', $totalGalleryImages)
                ->description('Fotos ativas')
                ->descriptionIcon('heroicon-m-photo')
                ->color('primary'),

            Stat::make('Parceiros', $totalPartners)
                ->description('Parceiros ativos')
                ->descriptionIcon('heroicon-m-handshake')
                ->color('secondary'),
        ];
    }
}

