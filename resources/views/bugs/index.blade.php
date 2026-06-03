<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Bugs') }}
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    {{ __('Item') }}: {{ $item->number }} — {{ $item->title }}
                </p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('items.bugs.create', $item) }}">
                    <x-primary-button>{{ __('Novo Bug') }}</x-primary-button>
                </a>
                <a href="{{ route('items.index') }}">
                    <x-secondary-button>{{ __('Voltar') }}</x-secondary-button>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('Título') }}</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('Status') }}</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('Criado por') }}</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ __('Criado em') }}</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">{{ __('Ações') }}</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($bugs as $bug)
                                    <tr>
                                        <td class="px-6 py-4 text-sm text-gray-900">{{ $bug->title }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $bug->status->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $bug->createdBy->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $bug->created_at->format('d/m/Y H:i') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm space-x-2">
                                            <a href="{{ route('items.bugs.show', [$item, $bug]) }}" class="text-indigo-600 hover:text-indigo-900">{{ __('Ver') }}</a>
                                            <a href="{{ route('items.bugs.edit', [$item, $bug]) }}" class="text-indigo-600 hover:text-indigo-900">{{ __('Editar') }}</a>
                                            <form action="{{ route('items.bugs.destroy', [$item, $bug]) }}" method="POST" class="inline"
                                                onsubmit="return confirm('Deseja excluir este bug?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900">{{ __('Excluir') }}</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">
                                            {{ __('Nenhum bug cadastrado.') }}
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if ($bugs instanceof \Illuminate\Contracts\Pagination\Paginator)
                        <div class="mt-4">
                            {{ $bugs->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
