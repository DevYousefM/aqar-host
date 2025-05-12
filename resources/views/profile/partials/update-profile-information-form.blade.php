<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('معلومات الملف الشخصي') }}
        </h2>

    </header>


    <form method="POST" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method("PATCH")
        <div class="mt-6 space-y-6">

            <div>
                <x-input-label for="name" :value="__('ألاسم')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)"
                    required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div>
                <x-input-label for="email" :value="__('البريد الالكتروني')" />
                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)"
                    required autocomplete="username" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />

            </div>

        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('حفظ') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600">{{ __('تم تغيير معلومات الملف الشخصي.') }}</p>
            @endif
        </div>
    </form>
</section>
