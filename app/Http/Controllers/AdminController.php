<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Registration;
use App\Models\GalleryImage;
use App\Models\Partner;
use App\Models\User;
use App\Models\SiteSetting;
use App\Models\EventSchedule;
use App\Models\WhatsAppGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function __construct()
    {
        // Middleware já aplicado nas rotas
    }

    public function dashboard()
    {
        $stats = [
            'total_registrations' => Registration::count(),
            'total_kits_used' => Registration::where('has_kit', true)->count(),
            'remaining_kits' => Event::where('is_active', true)->first()?->getRemainingKits() ?? 0,
            'total_gallery_images' => GalleryImage::where('is_active', true)->count(),
            'total_partners' => Partner::where('is_active', true)->count(),
        ];

        // Aniversariantes do mês (com base em registrations.birth_date)
        $birthdays = Registration::select('full_name', 'birth_date')
            ->whereMonth('birth_date', now()->month)
            ->orderByRaw('DAY(birth_date) asc')
            ->take(15)
            ->get();

        return view('admin.dashboard', compact('stats', 'birthdays'));
    }


    public function registrations()
    {
        $registrations = Registration::with('event')->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.registrations.index', compact('registrations'));
    }

    public function registrationShow(Registration $registration)
    {
        $registration->load('event');
        return view('admin.registrations.show', compact('registration'));
    }

    public function registrationPdf(Registration $registration)
    {
        $registration->load('event');
        $siteLogo = SiteSetting::get('site_logo');
        
        // Obter caminho completo da logo se existir
        $logoPath = null;
        if ($siteLogo && file_exists(storage_path('app/public/' . $siteLogo))) {
            $logoPath = storage_path('app/public/' . $siteLogo);
        }
        
        // Usando a biblioteca barryvdh/laravel-dompdf
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.registrations.pdf', compact('registration', 'siteLogo', 'logoPath'));
        
        $pdf->setPaper('a4', 'portrait');
        $pdf->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
        
        return $pdf->download('inscricao-' . $registration->id . '-' . Str::slug($registration->full_name) . '.pdf');
    }

    public function gallery()
    {
        $images = GalleryImage::orderBy('sort_order')->paginate(12);
        return view('admin.gallery.index', compact('images'));
    }

    // WhatsApp Groups
    public function whatsappGroups()
    {
        $groups = WhatsAppGroup::ordered()->paginate(20);
        return view('admin.whatsapp.index', compact('groups'));
    }

    public function whatsappCreate()
    {
        return view('admin.whatsapp.create');
    }

    public function whatsappStore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|url|max:2048',
            'description' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        WhatsAppGroup::create($validated);
        return redirect()->route('admin.whatsapp.index')->with('success', 'Grupo cadastrado com sucesso.');
    }

    public function whatsappEdit(WhatsAppGroup $group)
    {
        return view('admin.whatsapp.edit', compact('group'));
    }

    public function whatsappUpdate(Request $request, WhatsAppGroup $group)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|url|max:2048',
            'description' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        $group->update($validated);
        return redirect()->route('admin.whatsapp.index')->with('success', 'Grupo atualizado com sucesso.');
    }

    public function whatsappDestroy(WhatsAppGroup $group)
    {
        $group->delete();
        return redirect()->route('admin.whatsapp.index')->with('success', 'Grupo excluído com sucesso.');
    }

    public function galleryCreate()
    {
        return view('admin.gallery.create');
    }

    public function galleryStore(Request $request)
    {
        $request->validate([
            'images' => 'required|array|min:1',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:51200', // 50MB max
            'default_alt_text' => 'nullable|string|max:255',
            'start_sort_order' => 'required|integer|min:0',
            'is_active' => 'boolean',
            'titles' => 'nullable|array',
            'titles.*' => 'nullable|string|max:255',
            'descriptions' => 'nullable|array',
            'descriptions.*' => 'nullable|string',
            'alt_texts' => 'nullable|array',
            'alt_texts.*' => 'nullable|string|max:255',
            'sort_orders' => 'nullable|array',
            'sort_orders.*' => 'nullable|integer|min:0',
        ]);

        $images = $request->file('images');
        $startSortOrder = $request->input('start_sort_order', 0);
        $defaultAltText = $request->input('default_alt_text');
        $isActive = $request->has('is_active');
        
        $titles = $request->input('titles', []);
        $descriptions = $request->input('descriptions', []);
        $altTexts = $request->input('alt_texts', []);
        $sortOrders = $request->input('sort_orders', []);

        foreach ($images as $index => $image) {
            $imagePath = $image->store('gallery', 'public');
            
            $title = $titles[$index] ?? pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $description = $descriptions[$index] ?? null;
            $altText = $altTexts[$index] ?? $defaultAltText ?? $title;
            $sortOrder = $sortOrders[$index] ?? ($startSortOrder + $index);

            GalleryImage::create([
                'title' => $title,
                'description' => $description,
                'image_path' => $imagePath,
                'alt_text' => $altText,
                'sort_order' => $sortOrder,
                'is_active' => $isActive,
            ]);
        }

        $count = count($images);
        return redirect()->route('admin.gallery')->with('success', "{$count} imagem(ns) adicionada(s) com sucesso!");
    }

    public function galleryEdit(GalleryImage $image)
    {
        return view('admin.gallery.edit', compact('image'));
    }

    public function galleryUpdate(Request $request, GalleryImage $image)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:51200', // 50MB max
            'alt_text' => 'nullable|string|max:255',
            'sort_order' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'alt_text' => $request->alt_text,
            'sort_order' => $request->sort_order,
            'is_active' => $request->has('is_active'),
        ];

        if ($request->hasFile('image')) {
            // Deletar imagem antiga
            if ($image->image_path && Storage::disk('public')->exists($image->image_path)) {
                Storage::disk('public')->delete($image->image_path);
            }
            $data['image_path'] = $request->file('image')->store('gallery', 'public');
        }

        $image->update($data);

        return redirect()->route('admin.gallery')->with('success', 'Imagem atualizada com sucesso!');
    }

    public function galleryDestroy(GalleryImage $image)
    {
        // Deletar imagem do storage
        if ($image->image_path && Storage::disk('public')->exists($image->image_path)) {
            Storage::disk('public')->delete($image->image_path);
        }
        
        $image->delete();
        return redirect()->route('admin.gallery')->with('success', 'Imagem excluída com sucesso!');
    }

    public function partners()
    {
        $partners = Partner::orderBy('sort_order')->paginate(10);
        return view('admin.partners.index', compact('partners'));
    }

    public function partnersCreate()
    {
        return view('admin.partners.create');
    }

    public function partnersStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:51200', // 50MB max
            'website' => 'nullable|url',
            'description' => 'nullable|string',
            'sort_order' => 'required|integer|min:0',
        ]);

        $logoPath = $request->file('logo')->store('partners', 'public');

        Partner::create([
            'name' => $request->name,
            'logo_path' => $logoPath,
            'website' => $request->website,
            'description' => $request->description,
            'sort_order' => $request->sort_order,
        ]);

        return redirect()->route('admin.partners')->with('success', 'Parceiro adicionado com sucesso!');
    }

    public function partnersEdit(Partner $partner)
    {
        return view('admin.partners.edit', compact('partner'));
    }

    public function partnersUpdate(Request $request, Partner $partner)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:51200', // 50MB max
            'website' => 'nullable|url',
            'description' => 'nullable|string',
            'sort_order' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $data = [
            'name' => $request->name,
            'website' => $request->website,
            'description' => $request->description,
            'sort_order' => $request->sort_order,
            'is_active' => $request->has('is_active'),
        ];

        if ($request->hasFile('logo')) {
            // Deletar logo antigo
            if ($partner->logo_path && file_exists(storage_path('app/public/' . $partner->logo_path))) {
                unlink(storage_path('app/public/' . $partner->logo_path));
            }
            $data['logo_path'] = $request->file('logo')->store('partners', 'public');
        }

        $partner->update($data);

        return redirect()->route('admin.partners')->with('success', 'Parceiro atualizado com sucesso!');
    }

    public function partnersDestroy(Partner $partner)
    {
        // Deletar logo do storage
        if ($partner->logo_path && file_exists(storage_path('app/public/' . $partner->logo_path))) {
            unlink(storage_path('app/public/' . $partner->logo_path));
        }
        
        $partner->delete();
        return redirect()->route('admin.partners')->with('success', 'Parceiro excluído com sucesso!');
    }

    public function users()
    {
        $users = User::with('roles')->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function settings()
    {
        $settings = SiteSetting::orderBy('key')->get();
        return view('admin.settings.index', compact('settings'));
    }

    public function settingsUpdate(Request $request)
    {
        $request->validate([
            'hero_video' => 'nullable|file|mimes:mp4,webm,ogg|max:102400', // 100MB max
            'select_existing_video' => 'nullable|string',
            'delete_video' => 'nullable|string',
            'site_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:51200', // 50MB max
            'kit_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:51200', // 50MB max
            'registration_deadline' => 'nullable|date|after:today',
            'registration_enabled' => 'nullable|boolean',
        ]);

        $action = '';
        $message = '';
        $hasChanges = false;

        // Se foi solicitada a exclusão de um vídeo
        if ($request->filled('delete_video')) {
            $videoToDelete = $request->input('delete_video');
            $videoPath = storage_path('app/public/videos/' . $videoToDelete);
            
            if (file_exists($videoPath)) {
                unlink($videoPath);
                $hasChanges = true;
                $action = 'video_deleted';
                $message = 'Vídeo excluído com sucesso!';
            }
        }
        // Se foi selecionado um vídeo existente
        if ($request->filled('select_existing_video')) {
            $selectedVideo = $request->input('select_existing_video');
            SiteSetting::set('hero_video', 'videos/' . $selectedVideo, 'file', 'Vídeo de fundo do hero section');
            $hasChanges = true;
            $action = 'video_selected';
            $message = 'Vídeo selecionado com sucesso!';
        }
        // Se foi feito upload de um novo vídeo
        if ($request->hasFile('hero_video')) {
            $videoPath = $request->file('hero_video')->store('videos', 'public');
            SiteSetting::set('hero_video', $videoPath, 'file', 'Vídeo de fundo do hero section');
            $hasChanges = true;
            $action = 'video_uploaded';
            $message = 'Vídeo enviado com sucesso!';
        }
        // Upload da logo do site
        if ($request->hasFile('site_logo')) {
            $logoPath = $request->file('site_logo')->store('logos', 'public');
            SiteSetting::set('site_logo', $logoPath, 'file', 'Logo do site público');
            $hasChanges = true;
            $action = 'logo_uploaded';
            $message = 'Logo do site atualizada com sucesso!';
        }
        // Upload da foto do kit
        if ($request->hasFile('kit_photo')) {
            $kitPhotoPath = $request->file('kit_photo')->store('kit', 'public');
            SiteSetting::set('kit_photo', $kitPhotoPath, 'file', 'Foto do kit do participante');
            $hasChanges = true;
            $action = 'kit_photo_uploaded';
            $message = 'Foto do kit atualizada com sucesso!';
        }
        // Configuração da data de encerramento das inscrições
        if ($request->filled('registration_deadline')) {
            $deadline = $request->input('registration_deadline');
            SiteSetting::set('registration_deadline', $deadline, 'date', 'Data de encerramento das inscrições');
            $hasChanges = true;
            $action = 'deadline_updated';
            $message = 'Data de encerramento das inscrições atualizada com sucesso!';
        }
        // Toggle de habilitação das inscrições
        // O campo hidden envia 'true' ou 'false'; garantir conversão correta e robusta
        if ($request->has('registration_enabled')) {
            $enabledValue = $request->input('registration_enabled');

            // Converte strings 'true'/'false', '1'/'0', 'on'/'off' corretamente
            $enabled = filter_var($enabledValue, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
            // Se não conseguiu inferir (null), cair para checagem legacy de '0'/'1'
            if ($enabled === null) {
                $enabled = !($enabledValue === '0' || $enabledValue === 0 || $enabledValue === false || $enabledValue === null);
            }

            SiteSetting::set('registration_enabled', $enabled ? 'true' : 'false', 'boolean', 'Habilitar/desabilitar formulário de inscrições');
            $hasChanges = true;
            $action = 'registration_toggle';
            $message = $enabled ? 'Inscrições habilitadas com sucesso!' : 'Inscrições desabilitadas com sucesso!';
        }

        if ($hasChanges) {
            return redirect()->route('admin.settings')->with('success', $message);
        }

        return redirect()->route('admin.settings')->with('error', 'Nenhuma ação foi realizada.');
    }

    // Event Schedule Methods
    public function schedule()
    {
        $scheduleItems = EventSchedule::ordered()->paginate(15);
        return view('admin.schedule.index', compact('scheduleItems'));
    }

    public function scheduleCreate()
    {
        return view('admin.schedule.create');
    }

    public function scheduleStore(Request $request)
    {
        $request->validate([
            'time' => 'required|date_format:H:i',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        EventSchedule::create([
            'time' => $request->input('time'),
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'sort_order' => $request->input('sort_order', 0),
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.schedule')->with('success', 'Item da programação adicionado com sucesso!');
    }

    public function scheduleEdit(EventSchedule $scheduleItem)
    {
        return view('admin.schedule.edit', compact('scheduleItem'));
    }

    public function scheduleUpdate(Request $request, EventSchedule $scheduleItem)
    {
        $request->validate([
            'time' => 'required|date_format:H:i',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $scheduleItem->update([
            'time' => $request->input('time'),
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'sort_order' => $request->input('sort_order', 0),
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.schedule')->with('success', 'Item da programação atualizado com sucesso!');
    }

    public function scheduleDestroy(EventSchedule $scheduleItem)
    {
        $scheduleItem->delete();
        return redirect()->route('admin.schedule')->with('success', 'Item da programação excluído com sucesso!');
    }
}