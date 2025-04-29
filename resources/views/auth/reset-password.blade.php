<x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Reset Password') }}
            </x-primary-button>
        </div>
    </form>
    <script>
                document.addEventListener('DOMContentLoaded', () => {
                    const toggleButton = document.getElementById('darkModeToggle');
                    const darkModeIcon = document.getElementById('darkModeIcon');

                    // Verifica se o usuário já tem uma preferência salva
                    if (localStorage.getItem('darkMode') === 'enabled') {
                        document.documentElement.classList.add('dark');
                        darkModeIcon.textContent = '☀️'; // Define o ícone do sol no modo escuro
                    } else {
                        darkModeIcon.textContent = '🌙'; // Define o ícone da lua no modo claro
                    }

                    // Evento de clique para alternar o modo escuro/claro
                    toggleButton.addEventListener('click', () => {
                        document.documentElement.classList.toggle('dark');

                        if (document.documentElement.classList.contains('dark')) {
                            localStorage.setItem('darkMode', 'enabled');
                            darkModeIcon.textContent = '☀️'; // Mostra o sol no modo escuro
                        } else {
                            localStorage.setItem('darkMode', 'disabled');
                            darkModeIcon.textContent = '🌙'; // Mostra a lua no modo claro
                        }
                    });
                });
            </script>

</x-guest-layout>
