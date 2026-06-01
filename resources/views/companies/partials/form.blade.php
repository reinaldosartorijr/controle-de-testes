<div>
    <x-input-label for="name" :value="__('Nome')" />
    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
        :value="old('name', $company->name ?? '')" required autofocus />
    <x-input-error class="mt-2" :messages="$errors->get('name')" />
</div>

<div>
    <x-input-label for="document" :value="__('Documento')" />
    <x-text-input id="document" name="document" type="text" class="mt-1 block w-full"
        :value="old('document', $company->document ?? '')" required />
    <x-input-error class="mt-2" :messages="$errors->get('document')" />
</div>

<div>
    <x-input-label for="email" :value="__('E-mail')" />
    <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
        :value="old('email', $company->email ?? '')" />
    <x-input-error class="mt-2" :messages="$errors->get('email')" />
</div>

<div>
    <x-input-label for="phone" :value="__('Telefone')" />
    <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full"
        :value="old('phone', $company->phone ?? '')" />
    <x-input-error class="mt-2" :messages="$errors->get('phone')" />
</div>

<x-text-input type="hidden" id="user_id" name="user_id" value="{{ auth()->user()->id }}"/>