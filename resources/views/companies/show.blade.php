<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detalhes da Empresa') }}
            </h2>
            <div class="space-x-2">
                <a href="{{ route('companies.edit', $company) }}">
                    <x-secondary-button>{{ __('Editar') }}</x-secondary-button>
                </a>
                <a href="{{ route('companies.index') }}">
                    <x-secondary-button>{{ __('Voltar') }}</x-secondary-button>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <dl class="max-w-xl space-y-4">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Nome</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $company->name }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Documento</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $company->document }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">E-mail</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $company->email }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Telefone</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $company->phone }}</dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
</x-app-layout>