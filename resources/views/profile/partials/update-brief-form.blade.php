<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('نبذة عن الشركة') }}

        </h2>
    </header>

    <form method="post" action="{{ route('update.brief') }}" class="mt-6 space-y-6">
        @csrf
        @method('post')

        <div>
            <x-input-label for="company_brief" :value="__('النبذة')"/>
            <x-textarea-input id="company_brief" rows="5" cols="30" name="company_brief"
                              class="mt-1 block w-full">
                {{auth()->user()->company_brief }}
            </x-textarea-input>
            <x-input-error :messages="$errors->get('company_brief')" class="mt-2"/>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('حفظ') }}</x-primary-button>

            @if (session('status') === 'update-brief')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 3000)"
                    class="text-sm text-gray-600"
                >{{ __('تم تغيير نبذة الشركة.') }}</p>
            @endif
        </div>
    </form>
</section>
