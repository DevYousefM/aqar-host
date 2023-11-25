@extends("layouts.main")

@section("content")
    <main role="main" class="mt-3">

        <section class="jumbotron text-center">
            <div class="container">
                <h1 class="jumbotron-heading" style="color: #FF0000">أخبار العقارات</h1>
                <p class="lead text-muted" style="font-weight: 500;">هنا يمكنك الأطلاع علي احدث الاخبار عن العقارات</p>
            </div>
        </section>

        <div class="album py-5 bg-light">
            <div class="container-fluid d-flex flex-nowrap adpage justify-content-between flex-nowrap">
                @include("advertisements.right")

                <div class="row d-flex justify-content-center" style="width:100%">
                    <?php $count = 0 ?>
                    @foreach($articles as $article)
                        <div class="col-md-4">
                            <div class="card mb-4 box-shadow">
                                <img class="card-img-top"
                                     alt="{{$article->image_alt}}" style="height: 160px; width: 100%; display: block;"
                                     src="{{asset('public/'.$article->image)}}"
                                     data-holder-rendered="true">
                                <div class="card-body">
                                    <p class="card-text">{{$article->title}}</p>
                                    <p class="card-text">{{$article->brief}}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <a href="{{route("show.single.article",$article->id)}}"
                                               class="btn btn-sm btn-secondary">
                                                قراءة
                                                المزيد
                                            </a>
                                        </div>
                                        <small class="text-muted" id="timeSince-{{$count}}"
                                        >

                                            <script>
                                                function calculateTime(time) {
                                                    console.log(time);
                                                    let creationDate = new Date(time);

                                                    let timeDifference = Date.now() - creationDate.getTime();

                                                    document.getElementById("timeSince-{{$count}}").textContent = calculateTimeSince(timeDifference);

                                                    function calculateTimeSince(milliseconds) {
                                                        let seconds = Math.floor(milliseconds / 1000);
                                                        let minutes = Math.floor(seconds / 60);
                                                        let hours = Math.floor(minutes / 60);
                                                        let days = Math.floor(hours / 24);
                                                        console.log(seconds, " sec")
                                                        console.log(minutes, " min")
                                                        console.log(hours, " hour")
                                                        console.log(days, " day")
                                                        if (days > 0) {
                                                            return `منذ ${days} أيام `;
                                                        } else if (hours > 0) {
                                                            return `منذ ${hours} ساعات `;
                                                        } else if (minutes > 0) {
                                                            return `منذ ${minutes} دقائق `;
                                                        } else {
                                                            return "الان";
                                                        }
                                                    }
                                                }

                                                calculateTime("{{$article->created_at}}")
                                            </script>
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <?php $count += 5 ?>
                    @endforeach
                </div>
                @include("advertisements.left")

            </div>
        </div>

    </main>
@endsection
