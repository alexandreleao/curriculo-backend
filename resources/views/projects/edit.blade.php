<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-gray-800 dark:bg-gray-700 p-8 rounded-lg shadow-md">

                <h2 class="text-2xl font-bold text-white mb-8">Editar Projeto</h2>

                <form action="{{ route('projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Título -->
                    <div class="mb-6">
                        <label for="title" class="block text-sm font-medium text-gray-300 mb-2">Título:</label>
                        <input type="text" id="title" name="title" value="{{ old('title', $project->title) }}"
                            class="block w-full rounded-lg bg-gray-600 border border-gray-500 text-white p-3 focus:ring-2 focus:ring-indigo-400 focus:outline-none" required>
                    </div>

                    <!-- Descrição -->
                    <div class="mb-6">
                        <label for="description" class="block text-sm font-medium text-gray-300 mb-2">Descrição:</label>
                        <textarea id="description" name="description" rows="4"
                            class="block w-full rounded-lg bg-gray-600 border border-gray-500 text-white p-3 focus:ring-2 focus:ring-indigo-400 focus:outline-none" required>{{ old('description', $project->description) }}</textarea>
                    </div>

                    <!-- Imagem -->
                    <div class="mb-6">
                        <label for="imagem" class="block text-sm font-medium text-gray-300 mb-2">Imagem:</label>
                        <input type="file" id="imagem" name="imagem"
                            class="block w-full rounded-lg bg-gray-600 border border-gray-500 text-white p-3 focus:ring-2 focus:ring-indigo-400 focus:outline-none">
                        @if ($project->imagem)
                            <div class="mt-4">
                                <img src="{{ asset('storage/' . $project->imagem) }}" alt="Imagem Atual"
                                    class="h-32 rounded-lg object-cover">
                            </div>
                        @endif
                    </div>

                    <!-- Botão Salvar -->
                    <div class="flex justify-end">
                        <button type="submit"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-6 rounded-lg transition duration-200">
                            Salvar Alterações
                        </button>
                    </div>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>
