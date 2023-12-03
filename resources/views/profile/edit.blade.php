<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('حسابك الشخصي') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg" style="width: 100%">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg sm:w-1/5">
                @if (auth()->user()->account_type === 'company')
                    <div class="max-w-xl mt-1">
                        @include('profile.partials.update-company-form')
                    </div>
                @endif
            </div>
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg sm:w-1/5">
                <div class="max-w-xl ">
                    @include('profile.partials.update-image-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg sm:w-full">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg" style="width: 100%">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
