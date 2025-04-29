<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Cadastrar Projeto') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form method="POST" action="{{ route('projects.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-200">Titulo do Projeto</label>
                        <input type="text" name="title" class="w-full mt-2 p-2 border rounded dark:bg-gray-700 dark:text-white" required>

                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-200">Descrição</label>
                        <textarea name="description"class="w-full mt-2 p-2 border rounded dark:bg-gray-700 dark:text-white" required></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-200">Imagem</label>
                        <input type="file" name="imagem" class="mt-2">
                    </div>
                    <div class="mt-6">
                        <button
                            type="submit"
                            class="bg-red-600 text-white hover:bg-red-700 dark:bg-green-400 dark:text-black dark:hover:bg-blue-500 px-4 py-2 rounded shadow font-bold transition duration-200">
                            Salvar Projeto
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>