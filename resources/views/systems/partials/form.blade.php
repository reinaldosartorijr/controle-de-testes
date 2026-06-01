<div>
    <x-input-label for="name" :value="__('Nome')" />
    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
        :value="old('name', $system->name ?? '')" required autofocus />
    <x-input-error class="mt-2" :messages="$errors->get('name')" />
</div>

<div>
    <x-input-label for="code" :value="__('Código')" />
    <x-text-input id="code" name="code" type="text" class="mt-1 block w-full"
        :value="old('code', $system->code ?? '')" />
    <x-input-error class="mt-2" :messages="$errors->get('code')" />
</div>

<div>
    <x-input-label for="description" :value="__('Descrição')" />
    <textarea id="description" name="description" rows="3" required
        class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('description', $system->description ?? '') }}</textarea>
    <x-input-error class="mt-2" :messages="$errors->get('description')" />
</div>

<div>
    <x-input-label for="company_id" :value="__('Empresa')" />
    <select id="company_id" name="company_id" required
        class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
        <option value="">{{ __('Selecione uma empresa') }}</option>
        @foreach ($companies as $company)
            <option value="{{ $company->id }}" @selected(old('company_id', $system->company_id ?? '') == $company->id)>
                {{ $company->name }}
            </option>
        @endforeach
    </select>
    <x-input-error class="mt-2" :messages="$errors->get('company_id')" />
</div>

<div>
    <x-input-label for="system_status_id" :value="__('Status do sistema')" />
    <select id="system_status_id" name="system_status_id" required
        class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
        <option value="">{{ __('Selecione um status') }}</option>
        @foreach ($systemStatuses as $systemStatus)
            <option value="{{ $systemStatus->id }}" @selected(old('system_status_id', $system->system_status_id ?? '') == $systemStatus->id)>
                {{ $systemStatus->name }}
            </option>
        @endforeach
    </select>
    <x-input-error class="mt-2" :messages="$errors->get('system_status_id')" />
</div>

@php
    $isActive = filter_var(old('active', $system->active ?? true), FILTER_VALIDATE_BOOLEAN);
@endphp

<div>
    <x-input-label for="active" :value="__('Ativo')" />
    <select id="active" name="active" required
        class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
        <option value="1" @selected($isActive)>{{ __('Sim') }}</option>
        <option value="0" @selected(! $isActive)>{{ __('Não') }}</option>
    </select>
    <x-input-error class="mt-2" :messages="$errors->get('active')" />
</div>
