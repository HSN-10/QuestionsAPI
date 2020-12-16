<!-- BEGIN: Header-->
<nav class="header-navbar navbar-expand-lg navbar navbar-with-menu fixed-top navbar-dark navbar-brand-center">
    <div class="navbar-wrapper">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mobile-menu d-lg-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="feather icon-menu font-large-1"></i></a></li>
                <li class="nav-item mr-auto">
                    <a class="navbar-brand" href="{{route('adminpanel')}}">
                        <i class="fa fa-question-circle fa-lg" style="font-size: 30px;"></i>
                        <h2 class="brand-text">{{config('app.name')}}</h2>

                    </a>
                </li>
                <li class="nav-item d-lg-none">
                    <a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="fa fa-ellipsis-v"></i></a>
                </li>
            </ul>
        </div>
        <div class="navbar-container content">
            <div class="collapse navbar-collapse" id="navbar-mobile">
                <ul class="nav navbar-nav mr-auto float-left">
                    <li class="nav-item d-none d-lg-block nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="toggle-icon feather icon-toggle-right font-medium-3 white" data-ticon="feather.icon-toggle-right"></i></a></li>
                    <li class="nav-item d-none d-md-block"><a class="nav-link nav-link-expand" href="#"><i class="ficon feather icon-maximize"></i></a></li>
                </ul>
                <ul class="nav navbar-nav float-right">
                    <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                            <div class="avatar"><img src="{{asset('assets/image/profile.png')}}" alt="avatar"><i></i></div><span class="user-name">{{auth()->user()->name}}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="{{route('user.profileEdit')}}"><i class="feather icon-user"></i> @lang('lang.editProfile')</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();"
                                        ><i class="feather icon-power"></i> @lang('lang.logout')</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
<!-- END: Header-->
@include('dashboard.components.menu')

