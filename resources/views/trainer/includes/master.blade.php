<!DOCTYPE html>
<html lang="en">

@include('backend.includes.head')

{{-- <style>
    body{
        direction: rtl;
    }

    #main__content{
        margin-right: 16.66666667%;

    }
</style> --}}
<body>

  <div class="container-fluid">
    <div class="illustration__leaf">
      <img src="{{asset('assets/images/balady-illustration.png')}}" alt="">
    </div>
    <div class="row">
      <!-- Balady sidebar -->
      @include('backend.includes.sidebar')
        <!-- Balady sidebar -->
        @yield('content')
    </div>
</div>


  <!-- js -->
  @include('backend.includes.script')

  @yield('js')
</body>
</html>
