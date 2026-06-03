<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Editar Item') }}
            </h2>
            <a href="{{-- route('items.bugs.create', $item) --}}">
                <x-primary-button>{{ __('Novo Bug') }}</x-primary-button>
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-4xl">
                    <form method="POST" action="{{ route('items.update', $item) }}" class="space-y-6">
                        @csrf
                        @method('PUT')
                        @include('items.partials.form', ['item' => $item])
                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Atualizar') }}</x-primary-button>
                            <a href="{{ route('items.index', ['system_id' => $item->system_id]) }}" class="text-sm text-gray-600 hover:text-gray-900">{{ __('Cancelar') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
