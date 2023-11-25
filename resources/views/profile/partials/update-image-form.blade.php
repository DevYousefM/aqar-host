<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('تغيير صورة الحساب') }}
        </h2>
        <div style="margin-top: 20px">
            <img src="{{asset(auth()->user()->image)}}" style="width: 200px" alt="">
        </div>
    </header>

    <form method="post" action="{{ route('image.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('post')

        <div>
            <x-input-label for="image" :value="__('اضافة صورة جديدة')"/>
            <x-text-input id="image" name="image" type="file" class="mt-2 block w-full"/>
            <x-input-error :messages="$errors->get('image')" class="mt-2"/>
        </div>
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('حفظ') }}</x-primary-button>

            @if (session('status') === 'image-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('تم تغيير صورة الحساب.') }}</p>
            @endif
        </div>
    </form>
</section>
