<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Novo Bug') }}
            </h2>
            <p class="mt-1 text-sm text-gray-600">
                {{ __('Item') }}: {{ $item->number }} — {{ $item->title }}
            </p>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-4xl">
                    <form method="POST" action="{{ route('items.bugs.store', $item) }}" class="space-y-6">
                        @csrf
                        @include('bugs.partials.form', ['item' => $item])
                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Salvar') }}</x-primary-button>
                            <a href="{{ route('items.bugs.index', $item) }}" class="text-sm text-gray-600 hover:text-gray-900">{{ __('Cancelar') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
