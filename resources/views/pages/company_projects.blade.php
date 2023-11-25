<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-right">
            {{ __('أعلاناتك') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @include("components.includes_user.error")
                @include("components.includes_user.success")
                @include("components.includes_user.message")
                <div class="p-6 text-gray-900 " style="display: flex;gap: 10px;flex-direction: column">
                    <div>
                        <button type="button" class="bg-gray-500 px-4 py-2 text-white rounded">
                            <a href="{{route("add.project")}}">أضافة مشروع</a>
                        </button>
                    </div>
                    <div style="width: 100%;display: flex;gap: 10px">
                        <?php $count = 0 ?>

                        @foreach($projects as $project)
                            <div style="width: fit-content">
                                <div style="width: 20rem" class="rounded overflow-hidden shadow-lg border">

                                    <div style="height: 100%;">
                                        <img class="w-full" style="height: 10rem;"
                                             src="{{ asset("project_images/". $project->images[0]->image)}}">
                                    </div>

                                    <div class="px-6 py-4">
                                        <div class="font-bold text-xl mb-2 text-center">
                                            {{$project->title}}
                                        </div>
                                    </div>
                                    <div style="display: flex;justify-content: space-evenly;margin: 10px">
                                        <x-primary-button style="background-color: red">
                                            <a href="{{route("delete.project",$project->id)}}">
                                                {{ __('حذف المشروع') }}
                                            </a>
                                        </x-primary-button>
                                    </div>
                                    <div style="display: flex;justify-content: space-evenly;margin: 10px">
                                        <x-primary-button data-project="{{$project->id}}" style="background-color: red">
                                            {{ __('عرض صور المشروع') }}
                                        </x-primary-button>
                                    </div>
                                </div>
                                <div id="images-{{$project->id}}" class="min-h-screen space-x-4 w-full plans-container">
                                    <div class="bg-white rounded-lg shadow-md px-3 py-4"
                                         style="margin: 8px;width: 70%;display: flex; flex-direction: column; align-items: center;">
                                        @foreach($project->images as $img)
                                            <img class="img-thumbnail"
                                                 style="width: 80%;margin-bottom: 10px;border: solid 1px black"
                                                 src="{{asset("project_images/".$img->image)}}" alt="">
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                                <?php $count++ ?>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    window.onclick = (e) => {

        if (e.target.dataset.project) {
            let ele = document.getElementById("images-" + e.target.dataset.project);
            ele.style.display = "flex";
            console.log(ele);
        }
        e.target.classList.contains("plans-container") ? e.target.style.display = "none" : null;
    }
</script>
