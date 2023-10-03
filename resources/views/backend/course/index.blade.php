
@extends('backend.includes.master')

@section('content')

      <!-- courses section -->
      @if(session()->has('message'))
      @include('backend.includes.succuss_meesage');
    @endif

      <div class="course__template">
        <div class="course__search__field mb-5 wow animate__animated animate__fadeInUp">
          <div class="search__field">
            <div class="input-group">
              <div class="form-outline">
                <input id="search-input" type="search" id="form1" placeholder="Search" class="form-control form-input-ltr" />
              </div>
              <button id="search-button" type="button" class="btn">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </div>
          <a type="button" href="{{route('admin.course.create')}}" class="btn add__course"><i class="fa fa-plus" aria-hidden="true"></i>{{ __('admin.Add Course') }}</a>
        </div>
        <!-- courses section -->
        <!-- courses cards -->
      <div class="row gy-4 wow animate__animated animate__fadeInUp" id="get_course">

      </div>
      <!-- courses cards -->
      </div>

  @section('js')
  <script>
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $(document).ready(function(){

      get_result();

      function get_result(query =''){
        $.ajax({
               type:'GET',
               url:"{{ route('admin.getCourse') }}",
               data:{
                   key:query,
                },

              }).done(function(data){
                 console.log(data);
                  $('#get_course').html(data);
                });
      }

    $("#search-input").off().on('keyup',function(){
      var name = $(this).val();
      get_result(name);
      });


    });
    </script>
  @endsection

@endsection
