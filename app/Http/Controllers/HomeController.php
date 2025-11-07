<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\GalleryImage;
use App\Models\Partner;
use App\Models\Registration;
use App\Models\SiteSetting;
use App\Models\EventSchedule;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $event = Event::where('is_active', true)->first();
        $galleryImages = GalleryImage::active()->ordered()->get();
        $partners = Partner::active()->ordered()->get();
        $whatsappGroups = \App\Models\WhatsAppGroup::active()->ordered()->get();
        $scheduleItems = EventSchedule::active()->ordered()->get();
        $heroVideo = SiteSetting::get('hero_video');
        $siteLogo = SiteSetting::get('site_logo');
        $registrationDeadline = SiteSetting::get('registration_deadline');
        $kitPhoto = SiteSetting::get('kit_photo');
        $kmlRouteFile = SiteSetting::get('kml_route_file');
        $kmlRouteCode = SiteSetting::get('kml_route_code');
        $registrationEnabledValue = SiteSetting::get('registration_enabled', 'true');
        // Converte string 'true'/'false' para boolean
        $registrationEnabled = filter_var($registrationEnabledValue, FILTER_VALIDATE_BOOLEAN);

        $globalKitLimitSetting = SiteSetting::get('global_kit_limit');
        $kitLimit = $event?->kit_limit;
        if ($globalKitLimitSetting !== null && $globalKitLimitSetting !== '') {
            $kitLimit = (int) $globalKitLimitSetting;
        }

        $remainingKits = null;
        if ($kitLimit !== null) {
            $totalKitsUsed = Registration::where('has_kit', true)->count();
            $remainingKits = max(0, $kitLimit - $totalKitsUsed);
        } else {
            $remainingKits = $event?->getRemainingKits() ?? 0;
        }

        $scheduleStart = $scheduleItems->first()?->time?->format('H:i') ?? $event?->start_time?->format('H:i');
        $scheduleEnd = $scheduleItems->last()?->time?->format('H:i') ?? $event?->end_time?->format('H:i');

        return view('home', compact('event', 'galleryImages', 'partners', 'scheduleItems', 'heroVideo', 'siteLogo', 'registrationDeadline', 'kitPhoto', 'kmlRouteFile', 'kmlRouteCode', 'registrationEnabled', 'whatsappGroups', 'kitLimit', 'remainingKits', 'scheduleStart', 'scheduleEnd'));
    }

    public function routeKml()
    {
        $kmlRouteCode = SiteSetting::get('kml_route_code');
        $kmlRouteFile = SiteSetting::get('kml_route_file');
        
        if (!empty($kmlRouteCode)) {
            return response($kmlRouteCode, 200)
                ->header('Content-Type', 'application/vnd.google-earth.kml+xml')
                ->header('Content-Disposition', 'inline; filename="route.kml"');
        } elseif (!empty($kmlRouteFile) && file_exists(storage_path('app/public/' . $kmlRouteFile))) {
            return response()->file(storage_path('app/public/' . $kmlRouteFile), [
                'Content-Type' => 'application/vnd.google-earth.kml+xml',
                'Content-Disposition' => 'inline; filename="route.kml"'
            ]);
        }
        
        abort(404);
    }
}
