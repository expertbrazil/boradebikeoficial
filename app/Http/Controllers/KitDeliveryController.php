<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Registration;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class KitDeliveryController extends Controller
{
    public function index(Request $request)
    {
        $kitLimit = $this->getKitLimit();
        $search = trim((string) $request->input('search'));
        $status = $request->input('status', 'all');

        $query = Registration::with('event')
            ->where('has_kit', true)
            ->orderBy('created_at', 'asc');

        $eligibleIds = null;
        if ($kitLimit) {
            $eligibleIds = Registration::where('has_kit', true)
                ->orderBy('created_at', 'asc')
                ->limit($kitLimit)
                ->pluck('id');
            $query->whereIn('id', $eligibleIds);
        }

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $code = strtoupper($search);
                if (str_starts_with($code, 'BB-')) {
                    $numericId = (int) preg_replace('/[^0-9]/', '', $code);
                    if ($numericId > 0) {
                        $q->where('id', $numericId);
                        return;
                    }
                }

                $cpf = preg_replace('/[^0-9]/', '', $search);
                if ($cpf !== '') {
                    $q->where('cpf', 'like', $cpf . '%');
                } else {
                    $q->where('full_name', 'like', '%' . $search . '%');
                }
            });
        }

        if ($status === 'delivered') {
            $query->whereNotNull('kit_delivered_at');
        } elseif ($status === 'pending') {
            $query->whereNull('kit_delivered_at');
        }

        $registrations = $query->paginate(25)->appends($request->query());

        $statsQuery = $eligibleIds
            ? Registration::whereIn('id', $eligibleIds)
            : Registration::where('has_kit', true);

        $totalDelivered = (clone $statsQuery)->whereNotNull('kit_delivered_at')->count();
        $pendingCount = (clone $statsQuery)->whereNull('kit_delivered_at')->count();
        $totalFoodKg = (clone $statsQuery)->sum('food_kg');
        $totalFoodLiters = (clone $statsQuery)->sum('food_liters');

        return view('admin.kits.index', [
            'registrations' => $registrations,
            'search' => $search,
            'kitLimit' => $kitLimit,
            'totalDelivered' => $totalDelivered,
            'pendingCount' => $pendingCount,
            'totalFoodKg' => $totalFoodKg,
            'totalFoodLiters' => $totalFoodLiters,
            'status' => $status,
        ]);
    }

    public function deliver(Request $request, Registration $registration)
    {
        if (!$registration->has_kit) {
            return redirect()->route('admin.kits.index')->with('error', 'Participante não possui kit reservado.');
        }

        if ($registration->kit_delivered_at) {
            return redirect()->route('admin.kits.index', [
                'search' => $request->input('search'),
                'status' => $request->input('status', 'all'),
            ])->with('error', 'Este kit já foi entregue e não pode ser editado.');
        }

        $validated = $request->validate([
            'food_kg' => 'nullable|numeric|min:0|max:1000',
            'food_liters' => 'nullable|numeric|min:0|max:1000',
        ]);

        $registration->update([
            'food_kg' => $validated['food_kg'] ?? null,
            'food_liters' => $validated['food_liters'] ?? null,
            'kit_delivered_at' => now(),
        ]);

        return redirect()->route('admin.kits.index', [
            'search' => $request->input('search'),
            'status' => $request->input('status', 'all'),
        ])
            ->with('success', 'Entrega registrada com sucesso!');
    }

    protected function getKitLimit(): ?int
    {
        $globalKitLimit = SiteSetting::get('global_kit_limit');
        if ($globalKitLimit !== null && $globalKitLimit !== '') {
            return (int) $globalKitLimit;
        }

        return Event::where('is_active', true)->value('kit_limit');
    }
}

