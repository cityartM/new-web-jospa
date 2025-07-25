<x-auth-layout>
    <x-slot name="title">
        @lang('signup')
    </x-slot>

    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 " />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <!-- Social login -->
        <x-auth-social-login />

        <form method="POST" action="{{ route('signup.store') }}">
            @csrf

            <!-- First Name -->
            <div class="mt-4">
                <x-label for="first_name" :value="__('First Name')" />

                <x-input id="first_name" type="text" name="first_name" :value="old('first_name')" required autofocus />
            </div>

            <!-- Last Name -->
            <div class="mt-4">
                <x-label for="last_name" :value="__('Last Name')" />

                <x-input id="last_name" type="text" name="last_name" :value="old('last_name')" required autofocus />
            </div>
            <!-- Mobilem -->
            <div class="mt-4">
                <x-label for="mobile" :value="__('Contact No')" />

                <x-input id="mobile" type="number" name="mobile" required />
            </div>
            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" type="password" name="password" required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" type="password" name="password_confirmation" required />
            </div>



            <div class="flex items-center justify-end mt-4">

                <x-button class="ml-4 w-100">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>

        <x-slot name="extra">
            <span>
                {{ __('Already registered?') }} <a href="{{ route('signin') }}">signin</a>.
            </span>
        </x-slot>

    </x-auth-card>
</x-auth-layout>
