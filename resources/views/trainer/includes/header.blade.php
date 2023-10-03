<div class="navbar-custom topnav-navbar topnav-navbar-dark">
    <div class="container-xl">
      <a href="{{route('admin.index')}}" class="topnav-logo" style="min-width: unset;">
        <span class="topnav-logo-lg">

          @if(session('locale') =="ar") 
          <img src="{{asset('backend/images/arabic-logo.png')}}" alt="" height="50">
          @elseif(session('locale') =="ur") 
          <img src="{{asset('backend/images/urdu-logo.png')}}" alt="" height="50">
          @else 
          <img src="{{asset('backend/images/english-logo.png')}}" alt="" height="50">
          @endif
          
        </span>
      </a>

      <div class="dropdown float-right mb-0">
        <button class="localication_btn btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          {{session('locale')}}
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
          <a class="dropdown-item" href="{{url('language-chang/en')}}" @if(session('locale')=="en") hidden @endif type="button">English</a>
          <a class="dropdown-item" href="{{url('language-chang/ar')}}" @if(session('locale')=="ar") hidden @endif type="button">Arabic</a>
          <a class="dropdown-item" href="{{url('language-chang/ur')}}" @if(session('locale')=="ur") hidden @endif type="button">Urdu</a>
        </div>
      </div>

      <ul class="list-unstyled topbar-right-menu float-right mb-0">
        <li class="dropdown notification-list">
          <a class="nav-link dropdown-toggle nav-user arrow-none mr-0" data-toggle="dropdown" id="topbar-userdrop" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            <span class="account-user-avatar">
              <img src="{{asset(Auth::user()->image)}}" alt="user-image" class="rounded-circle">
            </span>
            <span class="d-none" style="color: #5E5E5E;float: left;margin-top: 16px; ">
              <span class="account-user-name">{{Auth::user()->first_name}}</span>
              <span class="account-position">{{Auth::user()->roles[0]['name']}}</span>
            </span>
          </a>
    
           
          <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated topbar-dropdown-menu profile-dropdown" aria-labelledby="topbar-userdrop">
            <!-- item-->
            <!-- Account -->
            <a class="nav-link dropdown-toggle nav-user arrow-none mr-0" data-toggle="dropdown" id="topbar-userdrop" href="#" role="button" aria-haspopup="true" aria-expanded="false">
              <div class="row">
                <div class="col-md-3">
                  <span class="account-user-avatar" style="position: relative;top: 0;left: 9px;">
                    <img src="{{asset(Auth::user()->image)}}" alt="user-image" class="rounded-circle">
                  </span>
                </div>
                <div class="col-md-6 ">
                  <span style="color: #5E5E5E;    font-size: 18px; ">
                    <span class="account-user-name" style="margin-left: 10px;">{{Auth::user()->first_name}}</span>
                    <span class="account-position" style="margin-left: 10px;">{{Auth::user()->roles[0]['name']}}</span>
                  </span>
                </div>
              </div>
            </a>
            <a href="{{route('admin.profile')}}" class="dropdown-item notify-item" style="font-weight: bold">
              <i class="far fa-user" style="color: #fdb833;font-size: 16px;"></i>
              <span style="margin-left: 7px;">{{__('admin.My account')}}</span>
            </a>

            <a href="{{route('admin.sso.index')}}" class="dropdown-item notify-item" style="font-weight: bold">
              <i class="fas fa-cog"></i>
              <span style="margin-left: 7px;">{{__('admin.SSo configuration')}}</span>
            </a>


            <a href="{{route('admin.dashboard.index')}}" class="dropdown-item notify-item" style="font-weight: bold">
              <i class="fas fa-cog"></i>
              <span style="margin-left: 7px;">{{__('admin.Update Dashboard')}}</span>
            </a>
            <!-- settings-->
            <!-- Logout-->
            <a href="{{ route('logout') }}" onclick="event.preventDefault();
          document.getElementById('logout-form').submit();" class="dropdown-item notify-item">
              <i class="mdi mdi-logout mr-1" style="font-size: 16px;"></i>
              <span>{{__('admin.Logout')}}</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none"> @csrf </form>
          </div>
        </li>
      </ul>  


     
    </div>

    
  

    <style>

      .localication_btn{
        margin-top: 20px;
    background-color: seagreen;
      }
    </style>

  </div>