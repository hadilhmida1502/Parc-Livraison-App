<x-guest-layout>
    <x-auth-card>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Entrez votre adresse e-mail ci-dessous pour réinitialiser votre mot de passe.') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('E-mail')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('Envoyer') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
