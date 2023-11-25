<link rel="stylesheet" href="{{asset("css/owl.carousel.min.css")}}">
<link rel="stylesheet" href="{{asset("css/owl.theme.default.min.css")}}">
<div class="front-ad">
    <div class="owl-carousel owl-theme" style="display: flex" id="right_ad">
        @foreach($right_sliders as $item)
            <div class="item">
                <img src="{{asset($item->path)}}" style="height: unset;" alt="{{$item->name}}">
            </div>
        @endforeach
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
        integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{asset("js/owl.carousel.min.js")}}"></script>
<script>
    $(document).ready(function () {
            $('#right_ad').owlCarousel({
                nav: false,
                dots: false,
                rtl: true,
                margin: 100,
                items: 1,
                loop: true,
                autoplay: true,
                autoplayTimeout: 4000,
                autoplayHoverPause: true
            })
        }
    )
</script>
