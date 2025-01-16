<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>
    <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Profile') }}
    </h2>
    <a href="{{ route('user.index') }} " class="btn btn-primary" style="float: right; padding: 5px 15px; margin-top: -30px;">
        Return Back
    </a>
</x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                @livewire('profile.update-profile-information-form')

                <x-section-border />
            @endif

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.update-password-form')
                </div>

                <x-section-border />
            @endif

            @if (Auth::check())
    @php
        $user = Auth::user();
    @endphp

    {{-- Only display to admin users --}}
    @if ($user->utype === 'ADM')
        {{-- Two-Factor Authentication Section --}}
        @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
            <div class="mt-10 sm:mt-0">
                @livewire('profile.two-factor-authentication-form')
            </div>

            <x-section-border />
        @endif

        {{-- Logout Other Browser Sessions Section --}}
        <div class="mt-10 sm:mt-0">
            @livewire('profile.logout-other-browser-sessions-form')
        </div>

        {{-- Account Deletion Section --}}
        @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
            <x-section-border />

            <div class="mt-10 sm:mt-0">
                @livewire('profile.delete-user-form')
            </div>
        @endif
    @else
        {{-- Non-admin users can be redirected or shown a message --}}
        <p>PLDS</p>
    @endif
@else
    {{-- If the user is not authenticated --}}
    <p>You are not logged in. Please log in to access this page.</p>
@endif

        </div>
    </div>
</x-app-layout>
