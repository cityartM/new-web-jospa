<x-auth-layout>
    <x-slot name="title">
        @lang('Login')
    </x-slot>

    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo />
            </a>
        </x-slot>

        <!-- Social Login -->
        <x-auth-social-login />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('signin.verify') }}">
            @csrf

            <!-- Email Address -->
            <div>
            <x-label for="email" :value="__('Email')" />

<x-input id="email"
         type="email"
         name="email"
         :value="old('email')"
         placeholder="Enter Email"
         required
         autofocus
         pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
         title="Please enter a valid email address." />

            </div>
            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password"
                         type="password"
                         name="password"
                         placeholder="Enter  password"
                         required
                         minlength="8"
                         maxlength="12"
                         autocomplete="current-password"
                         title="Password must be between 8 and 12 characters." />

            </div>

              

            <!-- Remember Me -->
            <div class="mt-4">
                <label for="remember_me" class="d-inline-flex">
                    <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                    <span class="ms-2">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="d-flex align-items-center justify-content-between mt-4">
                {{-- @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900"
                        href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif --}}

                <x-button>
                    {{ __('Log in') }}
                </x-button>
            </div>

        </form>

        <x-slot name="extra">
                <p class="text-center text-gray-600 mt-4">
                    Do not have an account? <a href="{{ route('signup') }}"
                        class="underline hover:text-gray-900">Signup</a>.
                </p>
        </x-slot>
    </x-auth-card>
</x-auth-layout>
