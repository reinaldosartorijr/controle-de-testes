<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detalhes do Sistema') }}
            </h2>
            <div class="space-x-2">
                @can('system_items_analyst', $system)
                    <a href="{{ route('items.create', ['system_id' => $system->id]) }}">
                        <x-primary-button>{{ __('Novo item') }}</x-primary-button>
                    </a>
                @endcan
                <a href="{{ route('systems.edit', $system) }}">
                    <x-secondary-button>{{ __('Editar') }}</x-secondary-button>
                </a>
                <a href="{{ route('systems.index') }}">
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
                        <dd class="mt-1 text-sm text-gray-900">{{ $system->name }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Código</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $system->code ?? '—' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Descrição</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $system->description }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Empresa</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $system->company->name }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Status</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $system->systemStatus->name }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Ativo</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $system->active ? __('Sim') : __('Não') }}</dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
</x-app-layout>
