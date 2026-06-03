<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Detalhes do Bug') }}
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    {{ __('Item') }}: {{ $item->number }} — {{ $item->title }}
                </p>
            </div>
            <div class="space-x-2">
                <a href="{{ route('items.bugs.edit', [$item, $bug]) }}">
                    <x-secondary-button>{{ __('Editar') }}</x-secondary-button>
                </a>
                <a href="{{ route('items.bugs.index', $item) }}">
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
                        <div class="sm:col-span-2">
                            <dt class="text-sm font-medium text-gray-500">{{ __('Título') }}</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $bug->title }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">{{ __('Status') }}</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $bug->status->name }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">{{ __('Criado por') }}</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $bug->createdBy->name }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">{{ __('Criado em') }}</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $bug->created_at->format('d/m/Y H:i') }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">{{ __('Atualizado em') }}</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $bug->updated_at->format('d/m/Y H:i') }}</dd>
                        </div>
                    </div>

                    <div>
                        <dt class="text-sm font-medium text-gray-500">{{ __('Descrição') }}</dt>
                        <dd class="mt-1 text-sm text-gray-900 whitespace-pre-wrap">{{ $bug->description }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">{{ __('Passos') }}</dt>
                        <dd class="mt-1 text-sm text-gray-900 whitespace-pre-wrap">{{ $bug->steps }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">{{ __('Resultado esperado') }}</dt>
                        <dd class="mt-1 text-sm text-gray-900 whitespace-pre-wrap">{{ $bug->expected_result }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">{{ __('Resultado obtido') }}</dt>
                        <dd class="mt-1 text-sm text-gray-900 whitespace-pre-wrap">{{ $bug->actual_result }}</dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
</x-app-layout>
