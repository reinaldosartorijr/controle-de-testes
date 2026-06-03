@php
    $textareaClass = 'mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm';
    $selectClass = 'mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm';
@endphp

<x-text-input type="hidden" name="item_id" value="{{ old('item_id', $bug->item_id ?? $item->id) }}" />

<div class="grid grid-cols-1 gap-6">
    <div>
        <x-input-label for="title" :value="__('Título')" />
        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" maxlength="100"
            :value="old('title', $bug->title ?? '')" required autofocus />
        <x-input-error class="mt-2" :messages="$errors->get('title')" />
    </div>

    <div>
        <x-input-label for="status_id" :value="__('Status')" />
        <select id="status_id" name="status_id" required class="{{ $selectClass }}">
            <option value="">{{ __('Selecione um status') }}</option>
            @foreach ($statuses as $status)
                <option value="{{ $status->id }}" @selected(old('status_id', $bug->status_id ?? '') == $status->id)>
                    {{ $status->name }}
                </option>
            @endforeach
        </select>
        <x-input-error class="mt-2" :messages="$errors->get('status_id')" />
    </div>

    <div>
        <x-input-label for="description" :value="__('Descrição')" />
        <textarea id="description" name="description" rows="3" class="{{ $textareaClass }}" required>{{ old('description', $bug->description ?? '') }}</textarea>
        <x-input-error class="mt-2" :messages="$errors->get('description')" />
    </div>

    <div>
        <x-input-label for="steps" :value="__('Passos')" />
        <textarea id="steps" name="steps" rows="4" class="{{ $textareaClass }}" required>{{ old('steps', $bug->steps ?? '') }}</textarea>
        <x-input-error class="mt-2" :messages="$errors->get('steps')" />
    </div>

    <div>
        <x-input-label for="expected_result" :value="__('Resultado esperado')" />
        <textarea id="expected_result" name="expected_result" rows="3" class="{{ $textareaClass }}" required>{{ old('expected_result', $bug->expected_result ?? '') }}</textarea>
        <x-input-error class="mt-2" :messages="$errors->get('expected_result')" />
    </div>

    <div>
        <x-input-label for="actual_result" :value="__('Resultado obtido')" />
        <textarea id="actual_result" name="actual_result" rows="3" class="{{ $textareaClass }}" required>{{ old('actual_result', $bug->actual_result ?? '') }}</textarea>
        <x-input-error class="mt-2" :messages="$errors->get('actual_result')" />
    </div>

    <x-text-input type="hidden" name="created_by" value="{{ old('created_by', $bug->created_by ?? auth()->id()) }}" />
</div>
