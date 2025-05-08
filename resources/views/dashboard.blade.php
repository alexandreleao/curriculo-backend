<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


            {{-- Formulário de busca --}}
            <form action="{{ route('projects.search') }}" method="GET" class="mb-6">
                <div class="flex">
                    <input type="text"
                        name="search"
                        placeholder="Buscar projetos..."
                        class="w-full px-4 py-2 rounded-l-md bg-gray-800 text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-r-md hover:bg-blue-700">
                        Buscar
                    </button>
                </div>
            </form>

            {{-- Botão para novo projeto --}}
            <div class="mb-6">
                <a href="{{ route('projects.create') }}"
                    class="inline-block bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
                    + Novo Projeto
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($projects as $project)
                <div class="bg-gray-800 dark:bg-gray-700 rounded-lg shadow-md overflow-hidden">
                    @if ($project->imagem)
                    <img src="{{ asset('storage/' . $project->imagem) }}"
                        alt="{{ $project->title }}"
                        class="w-full h-48 object-cover rounded-t-lg">
                    @else
                    <div class="w-full h-48 bg-gray-600 flex items-center justify-center text-white">
                        Sem imagem
                    </div>
                    @endif

                    <div class="p-4">
                        <h2 class="text-lg font-bold text-white">{{ $project->title }}</h2>
                        <p class="text-gray-300">{{ $project->description }}</p>

                        {{-- Botões Editar e Excluir --}}
                        <div class="flex justify-between mt-4">
                            <!-- Botão Editar -->
                            <a href="{{ route('projects.edit', $project->id) }}"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded text-sm">
                                Editar
                            </a>

                            <!-- Botão Excluir -->
                            <form action="{{ route('projects.destroy', $project->id) }}" method="POST"
                                onsubmit="return confirm('Tem certeza que deseja excluir este projeto?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded text-sm">
                                    Excluir
                                </button>
                            </form>
                        </div>

                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>