<div class="col-2 px-0 position-fixed" id="sticky-sidebar">
  <!-- Sidebar header -->
  <div class="m-sm-3">
  <div class="px-4 d-flex justify-content-start">
    <a href="{{ route('admin.setting.index') }}">
  <i style="font-size: 30px;" class="fa fa-cog" aria-hidden="true"></i>
  </a>
  </div>


    <div class="d-flex justify-content-end">
      <p class="arabic__lang" > <a style="color: red" class="dropdown-item" href="{{ route('logout') }}"
        onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">
         {{ __('admin.Logout') }}
     </a>

     <form id="logout-form" action="{{ route('logout')}}" method="POST" class="d-none">
         @csrf
     </form></p>
    </div>

    <div class="d-flex justify-content-end">
        @if(session('locale')=="en")
        <p class="arabic__lang"><a href="{{ route('change.lang','ar') }}">العربية</a></p>
        @else
        <p class="arabic__lang"><a href="{{ route('change.lang','en') }}">English</a></p>
        @endif
      </div>

    {{-- <div class="d-flex justify-content-end">
        <p class="arabic__lang">Logout</p>
      </div> --}}
    <div class="user__profile">
      <img src="{{asset(Auth::user()->image)}}" class="user__profile" alt="user profile">
      <p>{{ __('admin.Welcome') }}, <span class="active__user">{{Auth::user()->first_name}}</span></p>
    </div>
  </div>
  <!-- Sidebar header -->
  <div class="nav__items text-white">
    <a href="{{route('admin.index')}}"             class="nav-link {{request()->routeIs('admin.index') ? 'active-menu' : '' }}">{{ __('admin.Dashboard') }}</a>
    <a href="{{route('admin.category.index')}}"    class="nav-link {{request()->routeIs('admin.category*') ? 'active-menu' : '' }}">{{ __('admin.Categories') }}</a>
    <a href="{{route('admin.course.index')}}"      class="nav-link {{request()->routeIs('admin.course*') && !Request()->get('type') ? 'active-menu' : '' }}">{{ __('admin.Courses') }}</a>
    <a href="{{route('admin.course.index',['type' => 'mumtathil'])}}" class="nav-link {{request()->routeIs('admin.course*') && Request()->get('type') ? 'active-menu' : '' }}">{{ __('admin.mumtathil Courses') }}</a>
    <a href="{{route('admin.activity.index')}}"    class="nav-link {{request()->routeIs('admin.activity*') ? 'active-menu' : '' }}">{{ __('admin.Audit Trail') }}</a>
    <a href="{{route('admin.exam.index')}}"        class="nav-link {{request()->routeIs('admin.exam*') && !Request()->get('type') ? 'active-menu' : '' }}">{{ __('admin.Final Exam') }}</a>
    <a href="{{route('admin.exam.index',['type' => 'mumtathil'])}}" class="nav-link {{request()->routeIs('admin.exam*') && Request()->get('type') ? 'active-menu' : '' }}">{{ __('admin.mumtathil Final Exam') }}</a>
    <a href="{{route('admin.subadmin.index')}}"    class="nav-link {{request()->routeIs('admin.subadmin*') ? 'active-menu' : '' }}">{{ __('admin.Sub Admin list') }}</a>
    <a href="{{route('admin.trainer.index')}}"     class="nav-link {{request()->routeIs('admin.trainer*') ? 'active-menu' : '' }}">Trainer</a>
    <a href="{{route('admin.student.index')}}"     class="nav-link {{request()->routeIs('admin.student*') ? 'active-menu' : '' }}">Students</a>
    <a href="{{route('admin.certificate.index')}}" class="nav-link {{request()->routeIs('admin.certificate*') ? 'active-menu' : '' }}">Certificate</a>
    <a href="{{route('admin.profile')}}"           class="nav-link {{request()->routeIs('admin.profile') ? 'active-menu' : '' }}">profile</a>
  </div>
</div>
