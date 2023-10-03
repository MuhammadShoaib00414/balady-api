

<!DOCTYPE html>
<html lang="en">
<head>

			<title>Login | Balady</title>


	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="keywords" content="LMS,Learning Management System"/>
	<meta name="description" content="Nice application" />

<link name="favicon" type="image/x-icon" href="{{asset('global/favicon.ico')}}" rel="shortcut icon" />
<link rel="favicon" href="{{asset('frontend/default/img/icons/favicon.ico')}}">
<link rel="apple-touch-icon" href="{{asset('frontend/default/img/icons/icon.png')}}">
<link rel="stylesheet" href="{{asset('frontend/default/css/jquery.webui-popover.min.css')}}">
<link rel="stylesheet" href="{{asset('frontend/default/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('frontend/default/css/slick.css')}}">
<link rel="stylesheet" href="{{asset('frontend/default/css/slick-theme.css')}}">
<!-- font awesome 5 -->
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
<link href="{{asset('backend/css/newstyle.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{asset('frontend/default/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('frontend/default/css/bootstrap-tagsinput.css')}}">
<link rel="stylesheet" href="{{asset('frontend/default/css/main.css')}}">
<link rel="stylesheet" href="{{asset('frontend/default/css/responsive.css')}}">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,400i,600,700" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{asset('global/toastr/toastr.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nestable2/1.6.0/jquery.nestable.min.css" />
<script src="{{asset('backend/js/jquery-3.3.1.min.js')}}"></script>
<style>

.rtl_localize{
      direction: rtl;
    }
</style>
</head>
<body class="gray-bg " id="signUp">
	<section class="menu-area">
  <div class="container-xl">
    <div class="row">
      <div class="col">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">

          <ul class="mobile-header-buttons">
            <li><a class="mobile-nav-trigger" href="#mobile-primary-nav">Menu<span></span></a></li>
            <li><a class="mobile-search-trigger" href="#mobile-search">Search<span></span></a></li>
          </ul>




          <a href="http://balady.cyberelm.com/" class="navbar-brand" href="#"><img src="http://balady.cyberelm.com/uploads/system/logo-dark.png" alt="" height="35"></a>

          <div class="main-nav-wrap">
  <div class="mobile-overlay"></div>

  <ul class="mobile-main-nav">
    <div class="mobile-menu-helper-top"></div>

    <li class="has-children">
      <a href="">
        <!-- <i class="fas fa-th d-inline"></i>
        <span>Courses</span>
        <span class="has-sub-category"><i class="fas fa-angle-right"></i></span> -->
      </a>

      <ul class="category corner-triangle top-left is-hidden">
        <li class="go-back"><a href=""><i class="fas fa-angle-left"></i>Menu</a></li>

            <li class="has-children">
        <a href="#">
          <span class="icon"><i class="fas fa-university"></i></span>
          <span>University of Cambridge </span>
          <span class="has-sub-category"><i class="fas fa-angle-right"></i></span>
        </a>
        <ul class="sub-category is-hidden">
          <li class="go-back-menu"><a href=""><i class="fas fa-angle-left"></i>Menu</a></li>
          <li class="go-back"><a href="">
            <i class="fas fa-angle-left"></i>
            <span class="icon"><i class="fas fa-university"></i></span>
            University of Cambridge           </a></li>
                    <li><a href="http://balady.cyberelm.com/home/courses?category=business-sustainability-management-online-short-course">Business Sustainability Management online short course</a></li>
              </ul>
    </li>
        <li class="has-children">
        <a href="#">
          <span class="icon"><i class="fas fa-chess"></i></span>
          <span>Business Sustainability Management online short course</span>
          <span class="has-sub-category"><i class="fas fa-angle-right"></i></span>
        </a>
        <ul class="sub-category is-hidden">
          <li class="go-back-menu"><a href=""><i class="fas fa-angle-left"></i>Menu</a></li>
          <li class="go-back"><a href="">
            <i class="fas fa-angle-left"></i>
            <span class="icon"><i class="fas fa-chess"></i></span>
            Business Sustainability Management online short course          </a></li>
                </ul>
    </li>
        <li class="has-children">
        <a href="#">
          <span class="icon"><i class="fas fa-chess"></i></span>
          <span>Inspection of Safety Crash Barriers</span>
          <span class="has-sub-category"><i class="fas fa-angle-right"></i></span>
        </a>
        <ul class="sub-category is-hidden">
          <li class="go-back-menu"><a href=""><i class="fas fa-angle-left"></i>Menu</a></li>
          <li class="go-back"><a href="">
            <i class="fas fa-angle-left"></i>
            <span class="icon"><i class="fas fa-chess"></i></span>
            Inspection of Safety Crash Barriers          </a></li>
                </ul>
    </li>
    <li class="all-category-devided">
    <a href="http://balady.cyberelm.com/home/courses">
      <span class="icon"><i class="fa fa-align-justify"></i></span>
      <span>All courses</span>
    </a>
  </li>
</ul>
</li>

<div class="mobile-menu-helper-bottom"></div>
</ul>
</div>

          <form class="inline-form" action="http://balady.cyberelm.com/home/search" method="get" style="width: 100%;">
            <div class="input-group search-box mobile-search">
              <!-- <input type="text" name = 'query' class="form-control" placeholder="Search for courses"> -->
              <!-- <div class="input-group-append">
                <button class="btn" type="submit"><i class="fas fa-search"></i></button>
              </div> -->
            </div>
          </form>


          <div class="cart-box menu-icon-box" id = "cart_items">
                      </div>

          <span class="signin-box-move-desktop-helper"></span>
          <div class="sign-in-box btn-group">

            <a href="{{route('login')}}" class="btn btn-sign-in">Log in</a>

            <a href="{{route('register')}}" class="btn btn-sign-up">Sign up</a>

          </div> <!--  sign-in-box end -->
        </nav>
      </div>
    </div>
  </div>
</section>
<link rel="stylesheet" type="text/css" href="{{asset('frontend/eu-cookie/purecookie.css')}}" async />

<div class="cookieConsentContainer" id="cookieConsentContainer" style="opacity: .9; display: block; display: none;">
  <!-- <div class="cookieTitle">
    <a>Cookies.</a>
  </div> -->
  <div class="cookieDesc">
    <p>
      This website uses cookies to personalize content and analyse traffic in order to offer you a better experience.      <a class="link-cookie-policy" href="http://balady.cyberelm.com/home/cookie_policy">Cookie policy</a>
    </p>
  </div>
  <div class="cookieButton">
    <a onclick="cookieAccept();">Accept</a>
  </div>
</div>
<script>
  $(document).ready(function () {
    if (localStorage.getItem("accept_cookie_academy")) {
      //localStorage.removeItem("accept_cookie_academy");
    }else{
      $('#cookieConsentContainer').fadeIn(1000);
    }
  });

  function cookieAccept() {
    if (typeof(Storage) !== "undefined") {
      localStorage.setItem("accept_cookie_academy", true);
      localStorage.setItem("accept_cookie_time", "01/07/2022");
      $('#cookieConsentContainer').fadeOut(1200);
    }
  }
</script>
<!-- <section class="category-header-area">
    <div class="container-lg">
        <div class="row">
            <div class="col">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href=""><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item">
                            <a href="#">
                                                            </a>
                        </li>
                    </ol>
                </nav>
                <h1 class="category-name">
                                    </h1>
            </div>
        </div>
    </div>
</section> -->
<style type="text/css">
    section.menu-area{
        display: none;
    }

    body.gray-bg {
    background: url(../assets/backend/images/logbg.png) no-repeat;
    background-position: -257px 0px;
}

.dropdown{
  padding:20px 50px;
  float: right;
}




</style>

<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    {{session('locale')}}
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
    <a class="dropdown-item" href="{{url('language-chang/en')}}" @if(session('locale')=="en") hidden @endif type="button">English</a>
    <a class="dropdown-item" href="{{url('language-chang/ar')}}" @if(session('locale')=="ar") hidden @endif type="button">Arabic</a>
    <a class="dropdown-item" href="{{url('language-chang/ur')}}" @if(session('locale')=="ur") hidden @endif type="button">Urdu</a>
  </div>
</div>


@yield('content')

<script type="text/javascript">
  function toggoleForm(form_type) {
    if (form_type === 'login') {
      $('.login-form').show();
      $('.forgot-password-form').hide();
      $('.register-form').hide();
    }else if (form_type === 'registration') {
      $('.login-form').hide();
      $('.forgot-password-form').hide();
      $('.register-form').show();
    }else if (form_type === 'forgot_password') {
      $('.login-form').hide();
      $('.forgot-password-form').show();
      $('.register-form').hide();
    }
  }
</script>
<footer class="footer-area d-print-none">
  <div class="container-xl">
    <div class="row">
      <div class="col-md-6">
        <p class="copyright-text">
          <a href=""><img src="http://balady.cyberelm.com/uploads/system/logo-dark.png" alt="" class="d-inline-block" width="110"></a>
          <a href="/home/" target="_blank"></a>
        </p>
      </div>
      <div class="col-md-6">
        <ul class="nav justify-content-md-end footer-menu">
          <li class="nav-item">
            <a class="nav-link" href="http://balady.cyberelm.com/home/about_us">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="http://balady.cyberelm.com/home/privacy_policy">Privacy policy</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="http://balady.cyberelm.com/home/terms_and_condition">Terms and condition</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="http://balady.cyberelm.com/home/login">
              Login            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</footer>

<!-- PAYMENT MODAL -->
<!-- Modal -->



<script src="{{asset('frontend/default/js/vendor/modernizr-3.5.0.min.js')}}"></script>
<script src="{{asset('frontend/default/js/vendor/jquery-3.2.1.min.js')}}"></script>
<script src="{{asset('frontend/default/js/popper.min.js')}}"></script>
<script src="{{asset('frontend/default/js/bootstrap.min.js')}}"></script>
<script src="{{asset('frontend/default/js/slick.min.js')}}"></script>
<script src="{{asset('frontend/default/js/select2.min.js')}}"></script>
<script src="{{asset('frontend/default/js/tinymce.min.js')}}"></script>
<script src="{{asset('frontend/default/js/multi-step-modal.js')}}"></script>
<script src="{{asset('frontend/default/js/jquery.webui-popover.min.js')}}"></script>
<script src="https://content.jwplatform.com/libraries/O7BMTay5.js"></script>
<script src="{{asset('frontend/default/js/main.js')}}"></script>
<script src="{{asset('global/toastr/toastr.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/nestable2/1.6.0/jquery.nestable.min.js" charset="utf-8"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js" integrity="sha384-FzT3vTVGXqf7wRfy8k4BiyzvbNfeYjK+frTVqZeNDFl8woCbF0CYG6g2fMEFFo/i" crossorigin="anonymous"></script>
<script src="{{asset('frontend/default/js/bootstrap-tagsinput.min.js')}}"></script>
<script src="{{asset('frontend/default/js/custom.js')}}"></script>

<!-- SHOW TOASTR NOTIFIVATION -->





</body>
</html>
