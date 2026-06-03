<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detalhes do Item') }}
            </h2>
            <div class="space-x-2">
                <a href="{{-- route('items.bugs.create', $item) --}}">
                    <x-primary-button>{{ __('Novo Bug') }}</x-primary-button>
                </a>
                <a href="{{ route('items.edit', $item) }}">
                    <x-secondary-button>{{ __('Editar') }}</x-secondary-button>
                </a>
                <a href="{{ route('items.index', ['system_id' => $item->system_id]) }}">
                    <x-secondary-button>{{ __('Voltar') }}</x-secondary-button>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <dl class="max-w-4xl space-y-6">
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">{{ __('Número') }}</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $item->number }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">{{ __('Ticket') }}</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $item->ticket ?? '—' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">{{ __('Cliente') }}</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $item->client ?? '—' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">{{ __('Versão') }}</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $item->version }}</dd>
                        </div>
                        <div class="sm:col-span-2">
                            <dt class="text-sm font-medium text-gray-500">{{ __('Título') }}</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $item->title }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">{{ __('Sistema') }}</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $item->system->name }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">{{ __('Tipo') }}</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $item->type->name }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">{{ __('Status') }}</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $item->status->name }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">{{ __('Testador') }}</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $item->tester->name }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">{{ __('Desenvolvedor') }}</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $item->developer->name }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">{{ __('Criado por') }}</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $item->createdBy->name }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">{{ __('Data de início') }}</dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                {{ $item->start_date ? \Illuminate\Support\Carbon::parse($item->start_date)->format('d/m/Y') : '—' }}
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">{{ __('Data de término') }}</dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                {{ $item->end_date ? \Illuminate\Support\Carbon::parse($item->end_date)->format('d/m/Y') : '—' }}
                            </dd>
                        </div>
                    </div>

                    <div>
                        <dt class="text-sm font-medium text-gray-500">{{ __('Descrição') }}</dt>
                        <dd class="mt-1 text-sm text-gray-900 whitespace-pre-wrap">{{ $item->description ?? '—' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">{{ __('Pré-condições') }}</dt>
                        <dd class="mt-1 text-sm text-gray-900 whitespace-pre-wrap">{{ $item->preconditions ?? '—' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">{{ __('Passos') }}</dt>
                        <dd class="mt-1 text-sm text-gray-900 whitespace-pre-wrap">{{ $item->steps ?? '—' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">{{ __('Resultado esperado') }}</dt>
                        <dd class="mt-1 text-sm text-gray-900 whitespace-pre-wrap">{{ $item->expected_result ?? '—' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">{{ __('Resultado obtido') }}</dt>
                        <dd class="mt-1 text-sm text-gray-900 whitespace-pre-wrap">{{ $item->actual_result ?? '—' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">{{ __('Observações') }}</dt>
                        <dd class="mt-1 text-sm text-gray-900 whitespace-pre-wrap">{{ $item->observations ?? '—' }}</dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
</x-app-layout>
