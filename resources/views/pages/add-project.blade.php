<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @include("components.includes_user.error")
            @include("components.includes_user.success")
            @include("components.includes_user.message")
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('أضافة مشروع') }}
                            </h2>
                        </header>

                        <form method="post" action="{{route("store.project")}}" class="mt-6 space-y-6"
                              enctype="multipart/form-data">
                            @csrf
                            @method('post')

                            <div>
                                <x-input-label for="title" :value="__('عنوان المشروع')"/>
                                <x-text-input id="title" name="title" type="text" class="mt-1 block w-full"/>
                                <x-input-error class="mt-2" :messages="$errors->get('title')"/>
                            </div>
                            <div>
                                <x-input-label for="images" :value="__('صور المشروع')"/>
                                <input
                                    class="mt-1 block w-full border-gray-500 rounded-md shadow-sm"
                                    style="border: 1px solid rgba(209,213,219,1); padding: 6px;"
                                    id="images" name="images[]" type="file" multiple/>
                                <x-input-error class="mt-2" :messages="$errors->get('images')"/>
                                @error('images.*')
                                <div style="color:red">{{$message}}</div>
                                @enderror
                                @error('images.*.*')
                                <div style="color:red">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('أضافة') }}</x-primary-button>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
