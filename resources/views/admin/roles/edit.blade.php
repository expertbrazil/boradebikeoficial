@extends('layouts.admin')

@section('title', 'Editar Papel - Admin')
@section('page-title', 'Editar Papel: ' . $role->name)

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white shadow rounded-lg">
        <div class="px-6 py-4 border-b">
            <h3 class="text-lg font-medium text-gray-900">Definir acesso aos módulos</h3>
            <p class="text-sm text-gray-600">Selecione quais módulos do painel este papel pode visualizar.</p>
        </div>

        <form method="POST" action="{{ route('admin.roles.update', $role) }}" class="p-6 space-y-6">
            @csrf
            @method('PUT')

            <div class="space-y-4">
                @foreach($modulePermissions as $key => $module)
                    @php
                        $isChecked = collect(old('modules', $selectedModules))->contains($key);
                    @endphp
                    <div class="border rounded-lg p-4 flex items-start gap-3">
                        <div class="pt-1">
                            <input type="checkbox" id="module_{{ $key }}" name="modules[]" value="{{ $key }}"
                                   class="h-5 w-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                                   {{ $isChecked ? 'checked' : '' }}>
                        </div>
                        <div>
                            <label for="module_{{ $key }}" class="text-sm font-semibold text-gray-900">{{ $module['label'] }}</label>
                            <p class="text-xs text-gray-500">{{ $module['description'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="flex items-center justify-end gap-2">
                <a href="{{ route('admin.roles.index') }}" class="px-4 py-2 bg-gray-100 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300">Cancelar</a>
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <i class="fas fa-save mr-2"></i>
                    Salvar alterações
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
