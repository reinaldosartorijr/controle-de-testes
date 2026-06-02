@php
    $textareaClass = 'mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm';
    $selectClass = 'mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm';
@endphp

<h3 class="text-sm font-semibold text-gray-700">{{ __('Identificação') }}</h3>

<div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
    <div>
        <x-input-label for="number" :value="__('Número')" />
        <x-text-input id="number" name="number" type="text" class="mt-1 block w-full" maxlength="5"
            :value="old('number', $item->number ?? '')" required autofocus />
        <x-input-error class="mt-2" :messages="$errors->get('number')" />
    </div>

    <div>
        <x-input-label for="ticket" :value="__('Ticket')" />
        <x-text-input id="ticket" name="ticket" type="text" class="mt-1 block w-full" maxlength="10"
            :value="old('ticket', $item->ticket ?? '')" />
        <x-input-error class="mt-2" :messages="$errors->get('ticket')" />
    </div>

    <div>
        <x-input-label for="client" :value="__('Cliente')" />
        <x-text-input id="client" name="client" type="text" class="mt-1 block w-full" maxlength="100"
            :value="old('client', $item->client ?? '')" />
        <x-input-error class="mt-2" :messages="$errors->get('client')" />
    </div>

    <div>
        <x-input-label for="version" :value="__('Versão')" />
        <x-text-input id="version" name="version" type="text" class="mt-1 block w-full" maxlength="10"
            :value="old('version', $item->version ?? '')" required />
        <x-input-error class="mt-2" :messages="$errors->get('version')" />
    </div>

    <div class="sm:col-span-2">
        <x-input-label for="title" :value="__('Título')" />
        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" maxlength="100"
            :value="old('title', $item->title ?? '')" required />
        <x-input-error class="mt-2" :messages="$errors->get('title')" />
    </div>
</div>

<h3 class="text-sm font-semibold text-gray-700 mt-6">{{ __('Classificação') }}</h3>

<div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
    <div>
        <x-input-label for="system_id" :value="__('Sistema')" />
        <select id="system_id" name="system_id" required class="{{ $selectClass }}" disabled>
            <option value="">{{ __('Selecione um sistema') }}</option>
            @foreach ($systems as $system)
                <option value="{{ $system->id }}" @selected(old('system_id', $item->system_id ?? request('system_id')) == $system->id)>
                    {{ $system->name }}
                </option>
            @endforeach
        </select>
        <x-input-error class="mt-2" :messages="$errors->get('system_id')" />
    </div>

    <div>
        <x-input-label for="type_id" :value="__('Tipo')" />
        <select id="type_id" name="type_id" required class="{{ $selectClass }}">
            <option value="">{{ __('Selecione um tipo') }}</option>
            @foreach ($types as $type)
                <option value="{{ $type->id }}" @selected(old('type_id', $item->type_id ?? '') == $type->id)>
                    {{ $type->name }}
                </option>
            @endforeach
        </select>
        <x-input-error class="mt-2" :messages="$errors->get('type_id')" />
    </div>

    <div>
        <x-input-label for="status_id" :value="__('Status')" />
        <select id="status_id" name="status_id" required class="{{ $selectClass }}">
            <option value="">{{ __('Selecione um status') }}</option>
            @foreach ($statuses as $status)
                <option value="{{ $status->id }}" @selected(old('status_id', $item->status_id ?? '') == $status->id)>
                    {{ $status->name }}
                </option>
            @endforeach
        </select>
        <x-input-error class="mt-2" :messages="$errors->get('status_id')" />
    </div>
</div>

<h3 class="text-sm font-semibold text-gray-700 mt-6">{{ __('Responsáveis') }}</h3>

<div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
    <div>
        <x-input-label for="tester_id" :value="__('Testador')" />
        <select id="tester_id" name="tester_id" required class="{{ $selectClass }}">
            <option value="">{{ __('Selecione um testador') }}</option>
            @foreach ($testers as $user)
                <option value="{{ $user->id }}" @selected(old('tester_id', $item->tester_id ?? '') == $user->id)>
                    {{ $user->name }}
                </option>
            @endforeach
        </select>
        <x-input-error class="mt-2" :messages="$errors->get('tester_id')" />
    </div>

    <div>
        <x-input-label for="developer_id" :value="__('Desenvolvedor')" />
        <select id="developer_id" name="developer_id" required class="{{ $selectClass }}">
            <option value="">{{ __('Selecione um desenvolvedor') }}</option>
            @foreach ($developers as $user)
                <option value="{{ $user->id }}" @selected(old('developer_id', $item->developer_id ?? '') == $user->id)>
                    {{ $user->name }}
                </option>
            @endforeach
        </select>
        <x-input-error class="mt-2" :messages="$errors->get('developer_id')" />
    </div>
</div>

<x-text-input type="hidden" name="created_by" value="{{ old('created_by', $item->created_by ?? auth()->id()) }}" />

<h3 class="text-sm font-semibold text-gray-700 mt-6">{{ __('Período') }}</h3>

<div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
    <div>
        <x-input-label for="start_date" :value="__('Data de início')" />
        <x-text-input id="start_date" name="start_date" type="date" class="mt-1 block w-full"
            :value="old('start_date', isset($item) && $item->start_date ? \Illuminate\Support\Carbon::parse($item->start_date)->format('Y-m-d') : '')" />
        <x-input-error class="mt-2" :messages="$errors->get('start_date')" />
    </div>

    <div>
        <x-input-label for="end_date" :value="__('Data de término')" />
        <x-text-input id="end_date" name="end_date" type="date" class="mt-1 block w-full"
            :value="old('end_date', isset($item) && $item->end_date ? \Illuminate\Support\Carbon::parse($item->end_date)->format('Y-m-d') : '')" />
        <x-input-error class="mt-2" :messages="$errors->get('end_date')" />
    </div>
</div>

<h3 class="text-sm font-semibold text-gray-700 mt-6">{{ __('Cenário de teste') }}</h3>

<div class="space-y-6">
    <div>
        <x-input-label for="description" :value="__('Descrição')" />
        <textarea id="description" name="description" rows="3" class="{{ $textareaClass }}">{{ old('description', $item->description ?? '') }}</textarea>
        <x-input-error class="mt-2" :messages="$errors->get('description')" />
    </div>

    <div>
        <x-input-label for="preconditions" :value="__('Pré-condições')" />
        <textarea id="preconditions" name="preconditions" rows="3" class="{{ $textareaClass }}">{{ old('preconditions', $item->preconditions ?? '') }}</textarea>
        <x-input-error class="mt-2" :messages="$errors->get('preconditions')" />
    </div>

    <div>
        <x-input-label for="steps" :value="__('Passos')" />
        <textarea id="steps" name="steps" rows="4" class="{{ $textareaClass }}">{{ old('steps', $item->steps ?? '') }}</textarea>
        <x-input-error class="mt-2" :messages="$errors->get('steps')" />
    </div>

    <div>
        <x-input-label for="expected_result" :value="__('Resultado esperado')" />
        <textarea id="expected_result" name="expected_result" rows="3" class="{{ $textareaClass }}">{{ old('expected_result', $item->expected_result ?? '') }}</textarea>
        <x-input-error class="mt-2" :messages="$errors->get('expected_result')" />
    </div>

    <div>
        <x-input-label for="actual_result" :value="__('Resultado obtido')" />
        <textarea id="actual_result" name="actual_result" rows="3" class="{{ $textareaClass }}">{{ old('actual_result', $item->actual_result ?? '') }}</textarea>
        <x-input-error class="mt-2" :messages="$errors->get('actual_result')" />
    </div>

    <div>
        <x-input-label for="observations" :value="__('Observações')" />
        <textarea id="observations" name="observations" rows="3" class="{{ $textareaClass }}">{{ old('observations', $item->observations ?? '') }}</textarea>
        <x-input-error class="mt-2" :messages="$errors->get('observations')" />
    </div>
</div>
