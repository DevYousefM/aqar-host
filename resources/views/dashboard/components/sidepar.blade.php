<aside class="main-sidebar sidebar-light-primary elevation-4" style="height: 100vh;">
    <a href="{{route("dashboard.admin")}}" class="brand-link">
        <img src="{{asset("img/logo.svg")}}" alt="AdminLTE Logo" class="brand-image "
             style="opacity: .8">
        <span class="brand-text font-weight-bold">عقار مصر</span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <a href="#" class="d-block">{{auth("admin")->user()->name}}</a>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                @if(auth("admin")->user()->hasPermission("admins_read") )
                    <li class="nav-item">
                        <a href="{{ route('admins.show') }}" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                المسئولين
                            </p>
                        </a>
                    </li>
                @endif
                @if(auth("admin")->user()->hasPermission("slides_read") )
                    <li class="nav-item">
                        <a href="{{ route('show.slide') }}" class="nav-link">
                            <i class="nav-icon fas fa-bullhorn"></i>
                            <p>
                                الاعلانات
                            </p>
                        </a>
                    </li>
                @endif
                @if(auth("admin")->user()->hasPermission("sliders_read") )
                    <li class="nav-item">
                        <a href="{{ route('show.slider') }}" class="nav-link">
                            <i class="nav-icon fas fa-bullhorn"></i>
                            <p>
                                اعلانات السلايدر
                            </p>
                        </a>
                    </li>
                @endif
                @if(auth("admin")->user()->hasPermission("banners_read") )
                    <li class="nav-item">
                        <a href="{{ route('show.banner') }}" class="nav-link">
                            <i class="nav-icon fas fa-bullhorn"></i>
                            <p>
                                اعلانات البانر
                            </p>
                        </a>
                    </li>
                @endif
                @if(auth("admin")->user()->hasPermission("properties_read") )
                    <li class="nav-item">
                        <a href="{{ route('admin.properties') }}" class="nav-link">
                            <i class="nav-icon fas fa-building"></i>
                            <p>
                                العقارات
                            </p>
                        </a>
                    </li>
                @endif
                <li class="nav-item">
                    <a href="{{ route('add.properties.admin') }}" class="nav-link">
                        <i class="nav-icon fas fa-building"></i>
                        <p>
                            أضافة عقارات
                        </p>
                    </a>
                </li>
                @if(auth("admin")->user()->hasPermission("companies_read") )
                    <li class="nav-item">
                        <a href="{{ route('admin.companies') }}" class="nav-link">
                            <i class="nav-icon fas fa-building"></i>
                            <p>
                                الشركات
                            </p>
                        </a>
                    </li>
                @endif
                @if(auth("admin")->user()->hasPermission("users_read") )
                    <li class="nav-item">
                        <a href="{{ route('show.users') }}" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                المستخدمين
                            </p>
                        </a>
                    </li>
                @endif
                @if(auth("admin")->user()->hasPermission("articles_read") )
                    <li class="nav-item">
                        <a href="{{ route('all.articles') }}" class="nav-link">
                            <i class="nav-icon fas fa-newspaper"></i>
                            <p>
                                اخبار العقارات
                            </p>
                        </a>
                    </li>
                @endif
                @if(auth("admin")->user()->hasPermission("messages_read") )
                    <li class="nav-item">
                        <a href="{{ route('all.messages') }}" class="nav-link">
                            <i class="nav-icon fas fa-inbox"></i>
                            <p>
                                الرسائل
                            </p>
                        </a>
                    </li>
                @endif
                <li class="nav-item">
                    <a href="{{ route('all.search_request') }}" class="nav-link">
                        <i class="nav-icon fas fa-inbox"></i>
                        <p>
                            طلبات (مش لاقي شقتك؟)
                        </p>
                    </a>
                </li>
                @if(auth("admin")->user()->hasPermission("user_plans_read") )
                    <li class="nav-item">
                        <a href="{{ route('show.user.plans') }}" class="nav-link">
                            <i class="nav-icon fas fa-coins"></i>
                            <p>
                                باقات المستخدمين
                            </p>
                        </a>
                    </li>
                @endif
                @if(auth("admin")->user()->hasPermission("company_plans_read") )
                    <li class="nav-item">
                        <a href="{{ route('show.company.plans') }}" class="nav-link">
                            <i class="nav-icon fas fa-coins"></i>
                            <p>
                                باقات الشركات
                            </p>
                        </a>
                    </li>
                @endif
                <?php
                $user_plans_requests_read = auth("admin")->user()->hasPermission("user_plans_requests_read");
                ?>

                <li class="nav-item has-treeview">
                    @if($user_plans_requests_read)
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-mail-bulk"></i>
                            <p>
                                الطلبات
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                    @endif
                    <ul class="nav nav-treeview" style="display: none;">
                        @if($user_plans_requests_read)
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <p>
                                        طلبات ترويج المستخدمين
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview" style="display: none;">
                                    <li class="nav-item">
                                        <a href="{{route("all.user.plans.requests")}}" class="nav-link">
                                            <p>الطلبات الجديدة</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route("current.user.plans.requests")}}" class="nav-link">
                                            <p>الطلبات الجارية</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route("expired.subscriptions.user.plans")}}" class="nav-link">
                                            <p>الطلبات المنتهية</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                        <?php
                        $company_plans_requests_read = auth("admin")->user()->hasPermission("company_plans_requests_read");
                        ?>
                        @if($company_plans_requests_read)
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <p>
                                        طلبات اشتراك الشركات
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview" style="display: none;">
                                    <li class="nav-item">
                                        <a href="{{route("all.company.plans.requests")}}" class="nav-link">
                                            <p>الطلبات الجديدة</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route("active.company.plans")}}" class="nav-link">
                                            <p>الباقات المفعلة</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route("must.stop.company.plans")}}" class="nav-link">
                                            <p>الباقات ينبغي ايقافها</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route("expired.stop.company.plans")}}" class="nav-link">
                                            <p>الباقات المنتهية</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif

                        <?php
                        $single_services_requests_read = auth("admin")->user()->hasPermission("single_services_requests_read");
                        ?>
                        @if($single_services_requests_read)
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <p>
                                        طلبات الخدمات المنفصلة
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview" style="display: none;">
                                    <li class="nav-item">
                                        <a href="{{route("all.single.service.requests")}}" class="nav-link">
                                            <p>الطلبات الجديدة</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route("completed.single.service.requests")}}" class="nav-link">
                                            <p>الطلبات المنتهية</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
