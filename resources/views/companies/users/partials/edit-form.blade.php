{{--
    Parcial: formulário de edição do papel de um vínculo existente.

    Variáveis esperadas:
    - $company (App\Models\Company)
    - $companyUser (App\Models\CompanyUser, com user carregado)
    - $roles (iterável de App\Models\Role)
--}}
<div class="rounded-lg border border-gray-200 bg-gray-50 p-4">
    <p class="text-sm font-medium text-gray-700">{{ __('Usuário') }}</p>
    <p class="mt-1 text-sm text-gray-900">{{ $companyUser->user->name }}</p>
    <p class="text-sm text-gray-500">{{ $companyUser->user->email }}</p>
</div>

<div>
    <x-input-label for="role_id" :value="__('Papel na empresa')" />
    <select id="role_id" name="role_id" required
        class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
        <option value="">{{ __('Selecione um papel') }}</option>
        @foreach ($roles as $role)
            <option value="{{ $role->id }}" @selected(old('role_id', $companyUser->role_id) == $role->id)>
                {{ $role->name }}
            </option>
        @endforeach
    </select>
    <x-input-error class="mt-2" :messages="$errors->get('role_id')" />
</div>
