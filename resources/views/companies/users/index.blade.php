{{--
    Listagem e vínculo de usuários de uma empresa.

    Variáveis esperadas:
    - $company (App\Models\Company)
    - $companyUsers (iterável de App\Models\CompanyUser com user e role carregados)
    - $users (usuários disponíveis para novo vínculo)
    - $roles (App\Models\Role)

    Rotas sugeridas (ajuste no controller):
    - companyUsers.index   GET  — esta página
    - companyUsers.store   POST — vincular
    - companyUsers.edit    GET  — editar papel
    - companyUsers.update  PUT/PATCH — salvar papel
    - companyUsers.destroy DELETE — remover vínculo
--}}
<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:justify-between sm:items-center">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Usuários da empresa') }}
                </h2>
                <p class="mt-1 text-sm text-gray-600">{{ $company->name }}</p>
            </div>
            <a href="{{ route('companies.index') }}">
                <x-secondary-button>{{ __('Voltar às empresas') }}</x-secondary-button>
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if (session('success'))
                <div class="p-4 bg-green-100 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="p-4 bg-red-100 text-red-700 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900">{{ __('Vincular usuário') }}</h3>
                    <p class="mt-1 text-sm text-gray-600">
                        {{ __('Associe um usuário existente a esta empresa e defina o papel dele.') }}
                    </p>

                    <form method="POST"
                        action="{{ route('companyUsers.store') }}"
                        class="mt-6 max-w-xl space-y-6">
                        @csrf
                        @include('companies.users.partials.attach-form')
                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Vincular') }}</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900">{{ __('Usuários vinculados') }}</h3>

                    <div class="mt-4 overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                        {{ __('Nome') }}
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                        {{ __('E-mail') }}
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                        {{ __('Papel') }}
                                    </th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">
                                        {{ __('Ações') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($companyUsers as $companyUser)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $companyUser->user->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $companyUser->user->email }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $companyUser->role->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm space-x-2">
                                            <a href="{{ route('companyUsers.edit', ['company_id' => $company->id, 'company_user_id' => $companyUser->id]) }}"
                                                class="text-indigo-600 hover:text-indigo-900">
                                                {{ __('Editar papel') }}
                                            </a>
                                            <form
                                                action="{{ route('companyUsers.destroy', ['company_id' => $company->id, 'company_user_id' => $companyUser->id]) }}"
                                                method="POST" class="inline"
                                                onsubmit="return confirm(@js(__('Deseja remover este usuário da empresa?')))">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900">
                                                    {{ __('Remover') }}
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">
                                            {{ __('Nenhum usuário vinculado a esta empresa.') }}
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if (method_exists($companyUsers, 'links'))
                        <div class="mt-4">
                            {{ $companyUsers->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
