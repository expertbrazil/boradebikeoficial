<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:assign-roles');
    }

    public function index()
    {
        $roles = Role::orderBy('name')->get();

        return view('admin.roles.index', compact('roles'));
    }

    public function edit(Role $role)
    {
        $modulePermissions = $this->modulePermissions();
        $assignedPermissions = $role->permissions->pluck('name')->toArray();
        $selectedModules = collect($modulePermissions)
            ->filter(function ($module) use ($assignedPermissions) {
                return collect($module['permissions'])->intersect($assignedPermissions)->isNotEmpty();
            })
            ->keys()
            ->toArray();

        return view('admin.roles.edit', [
            'role' => $role,
            'modulePermissions' => $modulePermissions,
            'assignedPermissions' => $assignedPermissions,
            'selectedModules' => $selectedModules,
        ]);
    }

    public function update(Request $request, Role $role)
    {
        $modulePermissions = $this->modulePermissions();
        $moduleKeys = array_keys($modulePermissions);

        $validated = $request->validate([
            'modules' => ['nullable', 'array'],
            'modules.*' => ['string', Rule::in($moduleKeys)],
        ]);

        $selectedModules = collect($validated['modules'] ?? [])
            ->unique()
            ->values();

        $viewPermissions = collect($modulePermissions)
            ->flatMap(fn ($module) => $module['permissions'])
            ->unique()
            ->values();

        $currentPermissions = $role->permissions->pluck('name');

        $permissionsToKeep = $currentPermissions->reject(function ($permission) use ($viewPermissions) {
            return $viewPermissions->contains($permission);
        });

        $selectedPermissions = $selectedModules
            ->flatMap(fn ($module) => $modulePermissions[$module]['permissions'])
            ->unique()
            ->values();

        $role->syncPermissions($permissionsToKeep->merge($selectedPermissions));

        return redirect()
            ->route('admin.roles.index')
            ->with('success', 'Permissões do papel atualizadas com sucesso!');
    }

    /**
     * Definição dos módulos e respectivas permissões "view" utilizadas no sidebar.
     */
    protected function modulePermissions(): array
    {
        return [
            'registrations' => [
                'label' => 'Inscrições e Entrega de Kits',
                'description' => 'Permite visualizar as inscrições e o módulo de entrega de kits.',
                'permissions' => ['view-registrations'],
            ],
            'gallery' => [
                'label' => 'Galeria',
                'description' => 'Gerencia o módulo de galeria de imagens.',
                'permissions' => ['view-gallery'],
            ],
            'partners' => [
                'label' => 'Parceiros',
                'description' => 'Controla o acesso ao módulo de parceiros.',
                'permissions' => ['view-partners'],
            ],
            'schedule' => [
                'label' => 'Programação',
                'description' => 'Define se o papel pode acessar a programação do evento.',
                'permissions' => ['view-events'],
            ],
            'whatsapp' => [
                'label' => 'Grupos WhatsApp',
                'description' => 'Permite visualizar o módulo de grupos do WhatsApp.',
                'permissions' => ['view-whatsapp'],
            ],
            'users' => [
                'label' => 'Usuários',
                'description' => 'Acesso ao gerenciamento de usuários.',
                'permissions' => ['view-users'],
            ],
            'roles' => [
                'label' => 'Papéis (Roles)',
                'description' => 'Permite gerenciar os papéis e permissões.',
                'permissions' => ['assign-roles'],
            ],
            'settings' => [
                'label' => 'Configurações',
                'description' => 'Permite acessar as configurações gerais do site.',
                'permissions' => ['view-settings'],
            ],
            'parameters' => [
                'label' => 'Parâmetros',
                'description' => 'Permite acessar os parâmetros SMTP e gerais.',
                'permissions' => ['view-parameters'],
            ],
        ];
    }
}
