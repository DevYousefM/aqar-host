<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('معلومات الملف الشخصي') }}
        </h2>

    </header>


    <div class="mt-6 space-y-6">

        <div>
            <x-input-label for="name" :value="__('ألاسم')"/>
            <x-text-input id="name" name="name" disabled type="text" class="mt-1 block w-full"
                          :value="old('name', $user->name)"
                          required autofocus autocomplete="name"/>
            <x-input-error class="mt-2" :messages="$errors->get('name')"/>
        </div>

        <div>
            <x-input-label for="email" :value="__('البريد الالكتروني')"/>
            <x-text-input id="email" disabled name="email" type="email" class="mt-1 block w-full"
                          :value="old('email', $user->email)" required autocomplete="username"/>
            <x-input-error class="mt-2" :messages="$errors->get('email')"/>

        </div>

    </div>
</section>
