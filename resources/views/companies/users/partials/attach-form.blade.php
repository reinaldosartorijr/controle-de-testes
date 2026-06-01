{{--
    Parcial: formulário de vínculo usuário ↔ empresa.

    Variáveis esperadas:
    - $company (App\Models\Company)
    - $users (iterável de App\Models\User — usuários disponíveis para vincular)
    - $roles (iterável de App\Models\Role)
--}}
<div>
    <x-input-label for="user_id" :value="__('Usuário')" />
    <select id="user_id" name="user_id" required
        class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
        <option value="">{{ __('Selecione um usuário') }}</option>
        @foreach ($users as $user)
            <option value="{{ $user->id }}" @selected(old('user_id') == $user->id)>
                {{ $user->name }} ({{ $user->email }})
            </option>
        @endforeach
    </select>
    <x-input-error class="mt-2" :messages="$errors->get('user_id')" />
</div>

<div>
    <x-input-label for="role_id" :value="__('Papel na empresa')" />
    <select id="role_id" name="role_id" required
        class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
        <option value="">{{ __('Selecione um papel') }}</option>
        @foreach ($roles as $role)
            <option value="{{ $role->id }}" @selected(old('role_id') == $role->id)>
                {{ $role->name }}
            </option>
        @endforeach
    </select>
    <x-input-error class="mt-2" :messages="$errors->get('role_id')" />
</div>

<x-text-input type="hidden" name="company_id" value="{{ $company->id }}" />
