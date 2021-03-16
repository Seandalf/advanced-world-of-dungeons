<x-guest-layout>
    <x-auth-card>
        <p class="text-sm text-center">As this is your first time logging in, you'll need to set a new password below</p>
        <form method="POST" action="{{ route('pass.reset') }}">
            @csrf

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-3">
                    {{ __('Reset Password') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
