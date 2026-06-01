{{--
    Edição do papel de um vínculo empresa ↔ usuário.

    Variáveis esperadas:
    - $company (App\Models\Company)
    - $companyUser (App\Models\CompanyUser, com user carregado)
    - $roles (iterável de App\Models\Role)
--}}
<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:justify-between sm:items-center">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Editar papel do usuário') }}
                </h2>
                <p class="mt-1 text-sm text-gray-600">{{ $company->name }}</p>
            </div>
            <a href="{{ route('companyUsers.index', ['company_id' => $company->id]) }}">
                <x-secondary-button>{{ __('Voltar') }}</x-secondary-button>
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <form method="POST"
                        action="{{ route('companyUsers.update', ['company_id' => $company->id, 'company_user_id' => $companyUser->id]) }}"
                        class="space-y-6">
                        @csrf
                        @method('PUT')
                        @include('companies.users.partials.edit-form')
                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Salvar') }}</x-primary-button>
                            <a href="{{ route('companyUsers.index', ['company_id' => $company->id]) }}"
                                class="text-sm text-gray-600 hover:text-gray-900">
                                {{ __('Cancelar') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
