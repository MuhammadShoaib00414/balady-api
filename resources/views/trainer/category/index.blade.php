
@extends('backend.includes.master')

@section('content')

<div class="col-10 offset-2" id="main__content">
    <div class="container">
      <div class="d-flex justify-content-end">
        <img src="../assets/images/Balady-logo.png" class="img-fluid header__logo" alt="balady-logo">
      </div>
      <!-- courses section -->

      @if(session()->has('message'))
        <div class="content">
          <div class="alert alert-success alert-white rounded">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <div class="icon"><i class="fa fa-check"></i></div>
            <strong>Success!</strong>  {{ session()->get('message') }}
        </div>
      </div>
      @endif

      <div class="course__template">
        <div class="course__search__field mb-5 wow animate__animated animate__fadeInUp">
          <div class="search__field">
            <div class="input-group">
              <div class="form-outline">
                <input id="search-input" type="search" id="form1" placeholder="Search" class="form-control" />
              </div>
              <button id="search-button" type="button" class="btn">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </div>
          <a type="button" href="{{route('admin.category.create')}}" class="btn add__course"><i class="fa fa-plus" aria-hidden="true"></i>add course</a>
        </div>
        <!-- courses section -->
        <!-- courses cards -->
      <div class="row gy-4 wow animate__animated animate__fadeInUp" id="get_category">

      </div>
      <!-- courses cards -->
      </div>
      
    </div>
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
               url:"{{ route('admin.getCategory') }}",
               data:{
                   key:query,
                },
    
              }).done(function(data){
                 console.log(data);
                  $('#get_category').html(data);
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