<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="navigation-header font-medium-1">
                <i class="fa fa-minus" style="margin-left:5px;"></i>
                <span>@lang('lang.adminpanel')</span>
            </li>
            <li @if(Request::route()->getName()=='adminpanel') class="active" @endif>
                <a href="{{route('adminpanel')}}">
                    <i class="feather icon-home"></i><span class="menu-title" data-i18n="@lang('lang.home')">@lang('lang.home')</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#">
                    <i class="fa fa-list"></i>
                    <span class="menu-title" data-i18n="@lang('lang.categories')">@lang('lang.categories')</span>
                </a>
                <ul class="menu-content">
                    <li @if(Request::route()->getName()=='category.create') class="active" @endif>
                        <a class="menu-item" href="{{route('category.create')}}" data-i18n="@lang('lang.createCategory')">
                            <i class="fa fa-plus icon-menu" style="margin-top: 5px;"></i> @lang('lang.createCategory')
                        </a>
                    </li>
                    <li @if(Request::route()->getName()=='category.index' || Request::route()->getName()=='category.edit' || Request::route()->getName()=='category.show' ||
                            Request::route()->getName()=='score.index' || Request::route()->getName()=='score.edit' || Request::route()->getName()=='score.show' ||
                            Request::route()->getName()=='score.trash' )
                        class="active"
                        @endif>
                        <a class="menu-item" href="{{route('category.index')}}" data-i18n="@lang('lang.categories')">
                            <i class="fa fa-table icon-menu" style="margin-top: 3.5px;"></i> @lang('lang.categories')
                        </a>
                    </li>
                    @if(auth()->user()->is_admin)
                        <li @if(Request::route()->getName()=='category.trash') class="active" @endif>
                            <a class="menu-item" href="{{route('category.trash')}}" data-i18n="@lang('lang.trash')">
                                <i class="fa fa-trash icon-menu" style="margin-top: 2px;"></i> @lang('lang.trash')
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
            <li class="nav-item">
                <a href="#">
                    <i class="fa fa-question-circle"></i>
                    <span class="menu-title" data-i18n="@lang('lang.questions')">@lang('lang.questions')</span>
                </a>
                <ul class="menu-content">
                    <li @if(Request::route()->getName()=='question.create') class="active" @endif>
                        <a class="menu-item" href="{{route('question.create')}}" data-i18n="@lang('lang.createQuestion')">
                            <i class="fa fa-plus icon-menu" style="margin-top: 5px;"></i> @lang('lang.createQuestion')
                        </a>
                    </li>
                    <li @if(Request::route()->getName()=='question.index' || Request::route()->getName()=='question.edit' || Request::route()->getName()=='question.show')
                        class="active"
                        @endif>
                        <a class="menu-item" href="{{route('question.index')}}" data-i18n="@lang('lang.questions')">
                            <i class="fa fa-table icon-menu" style="margin-top: 3.5px;"></i> @lang('lang.questions')
                        </a>
                    </li>
                    <li @if(Request::route()->getName()=='question.inactive') class="active" @endif>
                        <a class="menu-item" href="{{route('question.inactive')}}" data-i18n="@lang('lang.questionsInactive')">
                            <i class="fa fa-minus-circle icon-menu" style="margin-top: 3.5px;"></i> @lang('lang.questionsInactive')
                        </a>
                    </li>
                    @if(auth()->user()->is_admin)
                        <li @if(Request::route()->getName()=='question.trash') class="active" @endif>
                            <a class="menu-item" href="{{route('question.trash')}}" data-i18n="@lang('lang.trash')">
                                <i class="fa fa-trash icon-menu" style="margin-top: 2px;"></i> @lang('lang.trash')
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
            <li class="nav-item">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span class="menu-title" data-i18n="@lang('lang.users')">@lang('lang.users')</span>
                </a>
                <ul class="menu-content">
                    <li @if(Request::route()->getName()=='user.create') class="active" @endif>
                        <a class="menu-item" href="{{route('user.create')}}" data-i18n="@lang('lang.createUser')">
                            <i class="fa fa-plus icon-menu" style="margin-top: 5px;"></i> @lang('lang.createUser')
                        </a>
                    </li>
                    <li @if(Request::route()->getName()=='user.index' || Request::route()->getName()=='user.edit' || Request::route()->getName()=='user.show')
                        class="active"
                        @endif>
                        <a class="menu-item" href="{{route('user.index')}}" data-i18n="@lang('lang.users')">
                            <i class="fa fa-table icon-menu" style="margin-top: 3.5px;"></i> @lang('lang.users')
                        </a>
                    </li>
                    @if(auth()->user()->is_admin)
                        <li @if(Request::route()->getName()=='user.trash') class="active" @endif>
                            <a class="menu-item" href="{{route('user.trash')}}" data-i18n="@lang('lang.trash')">
                                <i class="fa fa-trash icon-menu" style="margin-top: 2px;"></i> @lang('lang.trash')
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
            <li class="nav-item">
                <a href="#">
                    <i class="fa fa-ad"></i>
                    <span class="menu-title" data-i18n="@lang('lang.ads')">@lang('lang.ads')</span>
                </a>
                <ul class="menu-content">
                    <li @if(Request::route()->getName()=='ad.create') class="active" @endif>
                        <a class="menu-item" href="{{route('ad.create')}}" data-i18n="@lang('lang.createAd')">
                            <i class="fa fa-plus icon-menu" style="margin-top: 5px;"></i> @lang('lang.createAd')
                        </a>
                    </li>
                    <li @if(Request::route()->getName()=='ad.index' || Request::route()->getName()=='ad.edit' || Request::route()->getName()=='ad.show')
                        class="active"
                        @endif>
                        <a class="menu-item" href="{{route('ad.index')}}" data-i18n="@lang('lang.ads')">
                            <i class="fa fa-table icon-menu" style="margin-top: 3.5px;"></i> @lang('lang.ads')
                        </a>
                    </li>
                    @if(auth()->user()->is_admin)
                        <li @if(Request::route()->getName()=='ad.trash') class="active" @endif>
                            <a class="menu-item" href="{{route('ad.trash')}}" data-i18n="@lang('lang.trash')">
                                <i class="fa fa-trash icon-menu" style="margin-top: 2px;"></i> @lang('lang.trash')
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
        </ul>
    </div>
</div>
<!-- END: Main Menu-->
