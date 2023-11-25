
@extends("dashboard.layouts.main")
@section('css')
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <style>
        .filter-option-inner {
            text-align: right;
            color: black;
        }

        .dropdown-menu.show {
            width: 100%
        }
    </style>
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>تعديل عقار</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.admin') }}">الرئيسية</a></li>
                        <li class="breadcrumb-item"><a
                                href="#">العقارات</a></li>
                        <li class="breadcrumb-item active">تعديل عقار</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title float-none mb-0">اضافة عقار</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                @include("dashboard.components.includes.error")
                @include("dashboard.components.includes.success")
                @include("dashboard.components.includes.message")
                <form role="form" action="{{route("store.properties.admin")}}"
                      method="post"
                      enctype="multipart/form-data">
                    @method("post")
                    @csrf
                    <div class="card-body pb-0">
                        <div class="form-group">
                            <label for="exampleInputFName">العنوان</label>
                            <input type="text" class="form-control"
                                   id="exampleInputFName" placeholder="العنوان" name="title"
                                   value="{{ old("title") }}">
                            @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="card-body pb-0" style="padding-top: 0 !important;">
                        <div class="form-group">
                            <label for="exampleInputFName">النبذة</label>
                            <textarea class="form-control"
                                      placeholder="النبذة" name="brief"
                            >{{old("brief")}}</textarea>
                            @error('brief')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="card-body pb-0" style="padding-top: 0 !important;">
                        <div class="form-group">
                            <label>نوع العقار</label>
                            <select class="form-control" name="type" style="height: 40px;">
                                <option selected disabled>اختر نوع العقار</option>
                                <option value='شقق'>شقق</option>
                                <option value='محلات'>محلات</option>
                                <option value='اراضى'>اراضى</option>
                                <option value='فيلا'>فيلا</option>
                                <option value='روف'>روف</option>
                                <option value='ارضي بجنينة'>ارضى بجنينة</option>
                                <option value='ارضى'>ارضى</option>
                                <option value='ادارى'>ادارى</option>
                                <option value='مبانى'>مبانى</option>
                                <option value='سكن الطلبة'>سكن الطلبة</option>
                            </select>
                            @error('type')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="card-body pb-0" style="padding-top: 0 !important;">
                        <div class="form-group">
                            <label>الغرض</label>
                            <select class="form-control" name="purpose" style="height: 40px;">
                                <option selected disabled>اختر الغرض</option>
                                <option value='بيع'>بيع</option>
                                <option value='شراء'>شراء</option>
                                <option value='ايجار'>ايجار</option>
                            </select>
                            @error('purpose')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="card-body pb-0" style="padding-top: 0 !important;">
                        <div class="form-group">
                            <label>المحافظة</label>
                            <select class="form-control" id="govs" name="gov" style="height: 40px;">
                                <option selected disabled>اختر المحافظة</option>
                            </select>
                            @error('gov')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="card-body pb-0" style="padding-top: 0 !important;">
                        <div class="form-group">
                            <label>المنطقة</label>
                            <select class="form-control" id="areas" name="area" style="height: 40px;">
                                <option selected disabled>اختر المنطقة</option>
                            </select>
                            @error('area')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="card-body pb-0" style="padding-top: 0 !important;">
                        <div class="form-group">
                            <label>الدور</label>
                            <select class="form-control" id="level" name="level" style="height: 40px;">
                                <option selected disabled>اختر الدور</option>
                            </select>
                            @error('level')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="card-body pb-0" style="padding-top: 0 !important;">
                        <div class="form-group">
                            <label for="exampleInputFName">عدد الغرف</label>
                            <input type="number" class="form-control"
                                   id="exampleInputFName" placeholder="عدد الغرف" name="rooms"
                                   value="{{ old("rooms") }}">
                            @error('rooms')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="card-body pb-0" style="padding-top: 0 !important;">
                        <div class="form-group">
                            <label for="exampleInputFName">المساحة بالمتر</label>
                            <input type="number" class="form-control"
                                   id="exampleInputFName" placeholder="المساحة بالمتر" name="meters"
                                   value="{{ old("meters") }}">
                            @error('meters')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="card-body pb-0" style="padding-top: 0 !important;">
                        <div class="form-group">
                            <label>اسلوب الدفع</label>
                            <select class="form-control" id="payment" name="payment" style="height: 40px;">
                                <option selected disabled>
                                    اختر اسلوب الدفع
                                </option>
                                <option value="كاش" {{old("payment") ===  "كاش" ? "selected" : ""}} >
                                    كاش
                                </option>
                                <option value="قسط" {{old("payment") ===  "قسط" ? "selected" : ""}}>
                                    قسط
                                </option>
                            </select>
                            @error('payment')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="card-body pb-0 d-none " style="padding-top: 0 !important; " id="presenter">
                        <div class="form-group">
                            <label for="exampleInputFName">قيمة المقدم</label>
                            <input type="number" class="form-control"
                                   id="exampleInputFName" placeholder="قيمة المقدم" name="presenter"
                                   value="{{ old("presenter") }}">
                            @error('presenter')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="card-body pb-0 d-none" style=" padding-top: 0 !important;" id="price">
                        <div class="form-group">
                            <label for="exampleInputFName">السعر</label>
                            <input type="number" class="form-control"
                                   id="exampleInputFName" placeholder="السعر" name="price"
                                   value="{{ old("price") }}">
                            @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="card-body pb-0" style="padding-top: 0 !important;">
                        <div class="form-group">
                            <label for="images">صور العقار</label>
                            <input value="{{old("images")}}" id="propertyImages" class="w-100 p-1 border" type="file"
                                   name="images[]" multiple>
                        </div>
                    </div>
                    @error('images')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <div class="card-body pb-0" style="padding-top: 0 !important;">
                        <div id="imageFilenames" class="d-flex justify-content-center flex-wrap"
                             style="gap: 25px"></div>
                    </div>
                    <div class="card-body pb-0" style="padding-top: 0 !important;">
                        <div class="form-group">
                            <label>المستخدم</label>
                            <select name="user_ulid" style="height: 40px;" class="border w-100 selectpicker"
                                    data-live-search="true">
                                <option selected disabled>المستخدم</option>
                                @foreach($users as $user)
                                    <option
                                        value="{{$user->id}}">{{$user->name}} {{!empty($user->company_name) ? "($user->company_name)" : null }}</option>
                                @endforeach
                            </select>
                            @error('user_ulid')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>


                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">اضافة<i class="fa fa-plus"></i></button>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
    </section>

@endsection
@section("script")
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-*.min.js"></script>
    <script>
        async function getData(url) {
            const response = await fetch(url, {
                method: "GET", // *GET, POST, PUT, DELETE, etc.
                mode: "cors", // no-cors, *cors, same-origin
                cache: "no-cache", // *default, no-cache, reload, force-cache, only-if-cached
                credentials: "same-origin", // include, *same-origin, omit
                headers: {
                    "Content-Type": "application/json",
                },
                redirect: "follow", // manual, *follow, error
                referrerPolicy: "no-referrer", // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
            });
            return response.json(); // parses JSON response into native JavaScript objects
        }

        let areas = [];
        let areaEle = document.getElementById("areas");
        if (areaEle) {
            getData("/api/areas").then((data) => {
                areas = data;
            });
        }

        let govs = [];
        let govEle = document.getElementById("govs"),
            levelEle = document.getElementById("level");
        if (govEle) {
            let levels = [
                "الأول",
                "الثاني",
                "الثالث",
                "الرابع",
                "الخامس",
                "السادس",
                "السابع",
                "الثامن",
                "التاسع",
                "العاشر",
                "الحادي عشر",
                "الثاني عشر",
            ];
            let selected = false
            let selectedArea = false;
            getData("/api/govs").then((data) => {
                govEle.innerHTML =
                    `
                    <option value="" disabled selected>اختر المحافظة</option>
        `;

                data.forEach(ele => {
                    if (!govEle.classList.contains('no-local')) {


                        govEle.innerHTML += `
            <option value='${ele.id}'>${ele.gov}</option>
        `;
                    } else {

                        govEle.innerHTML += `
            <option value='${ele.id}'>${ele.gov}</option>
        `;
                    }
                });
            }).then(() => {
                setTimeout(() => {
                    if (selected) {
                        const filteredItems = areas.filter(item => item.government_id == selected);
                        filteredItems.forEach(item => {
                            if (!areaEle.classList.contains('no-local')) {
                                areaEle.innerHTML += `
            <option value='${item.area}' class="dropdown-item" >${item.area}</option>`
                            } else {
                                areaEle.innerHTML += `
            <option value='${item.area}' class="dropdown-item" >${item.area}</option>`

                            }
                        });
                    }
                }, 1000);
            });


            govEle.addEventListener("change", (e) => {
                localStorage.setItem("select_gov", e.target.value);
                areaEle.innerHTML = "";
                if (areas.length > 0) {
                    const filteredItems = areas.filter(item => item.government_id == e.target.value);
                    filteredItems.forEach(item => {
                        areaEle.innerHTML += `
            <option value='${item.area}' class="dropdown-item">${item.area}</option>`
                    });
                }
            })

            areaEle.addEventListener("change", (e) => {
                localStorage.setItem("select_area", e.target.value);
            })

            let level = localStorage.getItem("select_level")
            levels.forEach(ele => {
                levelEle ? levelEle.innerHTML += `
            <option value='${ele}'>${ele}</option>
        ` : null;
            });
            levelEle?.addEventListener("change", (e) => {
                localStorage.setItem("select_level", e.target.value);
            })
        }

        let presenter = document.getElementById("presenter"),
            payment = document.getElementById("payment"),
            price = document.getElementById("price");
        const showPresenter = () => {
            var selectedOption = payment?.options[payment.selectedIndex];

            var selectedValue = selectedOption?.value;
            if (selectedValue === "قسط") {
                presenter?.classList.add("d-block");
                presenter?.classList.remove("d-none");

                price?.classList.remove("d-block");
                price?.classList.add("d-none");
            } else if (selectedValue === "كاش") {
                presenter?.classList.remove("d-block");
                presenter?.classList.add("d-none");

                price?.classList.add("d-block");
                price?.classList.remove("d-none");
            } else {
                presenter?.classList.remove("d-block");
                presenter?.classList.add("d-none");
                price?.classList.remove("d-block");
                price?.classList.add("d-none");
            }
        }
        payment?.addEventListener("change", (e) => {
            showPresenter()
        })
        showPresenter()

        let fileInput = document.getElementById("propertyImages");
        let filenamesContainer = document.getElementById("imageFilenames");

        fileInput?.addEventListener("change", function (event) {
            filenamesContainer.innerHTML = "";

            let selectedFiles = event.target.files;

            for (let i = 0; i < selectedFiles.length; i++) {
                let card = document.createElement("div");
                card.classList.add("d-flex");
                card.classList.add("flex-column");
                card.classList.add("gap-2");
                let file = selectedFiles[i];
                let imageElement = document.createElement("img");
                imageElement.src = URL.createObjectURL(file);
                imageElement.width = 100;

                let filename = selectedFiles[i].name;
                let filenameElement = document.createElement("div");
                filenameElement.textContent = filename;


                card.appendChild(imageElement);
                card.appendChild(filenameElement);
                filenamesContainer.appendChild(card);
            }
        });

    </script>
@endsection
