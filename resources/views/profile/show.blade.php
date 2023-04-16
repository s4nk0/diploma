<x-user.profile.layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>
    @if(session('warning'))
        <div class="alert alert-warning" role="alert">
            {{session('warning')}}
        </div>
    @endif
    <div>

        @if (Laravel\Fortify\Features::canUpdateProfileInformation())
            <div class="mb-4">
                @livewire('profile.update-profile-information-form')
            </div>
        @endif

        @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
            <div class="mb-4">
                @livewire('profile.update-password-form')
            </div>
        @endif

        @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
            <div class="mb-4">
                @livewire('profile.two-factor-authentication-form')
            </div>
        @endif

        <div class="mb-4">
            @livewire('profile.logout-other-browser-sessions-form')
        </div>

        @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
            @livewire('profile.delete-user-form')
        @endif
    </div>
</x-user.profile.layout>
