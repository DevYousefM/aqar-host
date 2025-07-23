<nav class="main-header navbar navbar-expand navbar-white navbar-light justify-content-between">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    
    <!-- Right navbar links -->
    <ul class="navbar-nav ">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <a class=" nav-link w-100 btn main-btn fw-bold" onclick="event.preventDefault();
                                        this.closest('form').submit();" href="{{route("admin.logout")}}"><i
                        class="fas fa-sign-out-alt"></i></a>
            </form>
        </li>
    </ul>
</nav>
