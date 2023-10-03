<!DOCTYPE html>
<html lang="en">

@include('backend.includes.head')

@if(session('locale')=="ar")
<style>
    body{
        direction: rtl;
    }

    #main__content{
        margin-right: 16.66666667%;
    }

</style>
@endif

<style>
    .rtl{
        direction: rtl;
    }

    .ltr{
        direction: ltr;
    }
</style>
<body>

  <div class="container-fluid">
    <div class="illustration__leaf">
      <img src="{{asset('assets/images/balady-illustration.png')}}" alt="">
    </div>
    <div class="row">
      <!-- Balady sidebar -->
      @include('backend.includes.sidebar')
        <!-- Balady sidebar -->

        <div class="col-10 offset-2" id="main__content">
            <div class="container">
              <div class="d-flex justify-content-end">
                <img src="{{asset('assets/images/Balady-logo.png')}}" class="img-fluid header__logo" alt="balady-logo">
              </div>
        @yield('content')
            </div>
        </div>
    </div>
</div>


  <!-- js -->
  @include('backend.includes.script')
  @yield('js')
  <script>

  </script>
</body>
</html>
