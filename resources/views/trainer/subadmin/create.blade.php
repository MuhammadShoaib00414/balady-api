
@extends('backend.includes.master')

@section('content')

{{-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif --}}
<div class="col-10 offset-2" id="main__content">
    <div class="container">
      <div class="d-flex justify-content-end">
        <img src="../assets/images/Balady-logo.png" class="img-fluid header__logo" alt="balady-logo">
      </div>
      <!-- courses section -->
      <div class="course__template">
        <div class="course__search__field justify-content-between align-items-center mb-5">
          <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb wow animate__ animate__fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
              <li class="breadcrumb-item"><a href="#">user</a></li>
              <li class="breadcrumb-item active" aria-current="page">Add user</li>
            </ol>
          </nav>
        </div>
        <!-- courses section -->
        <!-- activity details -->
        <div class="profile__info__details wow animate__ animate__fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
            <div class="profile__information h-auto">
              <div class="row">

                <form  method="POST" action="{{route('admin.subadmin.store')}}" enctype="multipart/form-data">
                    @csrf
                <div class="col-12 col-sm-7">
                  <div class="profile__fields">

                    <div class="mb-3">
                        <div class="dropcoursehere" >
                          <div class="inner__dropfilebox">
                            <img id="blah" style="border-radius: 50%; width:50%;" src="{{asset('assets/images/profile_image.jpg')}}" />
                            <div class="drop__here">
                              <div class="edit__button">
                                <button type="button" class="btn btn-primary"><i class="fa fa-pencil-alt"
                                    aria-hidden="true"></i>
                                    upload</button>
                              </div>
                            </div>
                            <input type='file' class="h-full w-full opacity-0" required="required" name="image" onchange="readURL(this);" />
                          </div>
                        </div>
                      </div>


                      @error('ar_summary')
                      <span class="error_alert">{{$message}}</span>
                      @enderror


                    <div class="mb-3">
                      <label for="your-name" class="form-label">First Name</label>
                      <input type="text" class="form-control" id="your-name" name="first_name" value="{{old('first_name')}}">
                    </div>

                    @error('first_name')
                    <span class="error_alert">{{$message}}</span>
                    @enderror

                    <div class="mb-3">
                        <label for="your-name" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="your-name" name="last_name" value="{{old('last_name')}}">
                    </div>
                    @error('last_name')
                    <span class="error_alert">{{$message}}</span>
                    @enderror

                    <div class="mb-3">
                      <label for="your-email" class="form-label">Email</label>
                      <input type="email" class="form-control" id="your-email" name="email" value="{{old('email')}}">
                    </div>

                    @error('email')
                    <span class="error_alert">{{$message}}</span>
                    @enderror

                    <div class="mb-3">
                      <label for="your-phonenumber" class="form-label">Phone Number</label>
                      <input type="text" class="form-control" id="your-phonenumber" name="phone" value="{{old('phone')}}">
                    </div>

                    @error('phone')
                    <span class="error_alert">{{$message}}</span>
                    @enderror

                    <div class="mb-3">
                        <label for="" class="form-label">Biography</label>
                        <textarea id="biography" name="biography">{{old('biography')}}</textarea>
                        @error('biography')
                        <span class="error_alert">{{$message}}</span>
                        @enderror
                      </div>



                  </div>
                </div>


                <div class="col-12 col-sm-5" style="margin-top: 64px;">
                  <div class="profile__fields">
                    <div class="mb-3">
                      <label for="new-pass" class="form-label">new password</label>
                      <input type="password" class="form-control" name="password" id="new-pass">
                    </div>

                    <div class="mb-3">
                      <label for="confirm-new-pass" class="form-label">confirm new
                        password</label>
                      <input type="password" class="form-control" name="password_confirmation" id="confirm-new-pass">
                    </div>

                    @error('password')
                        <span class="error_alert">{{$message}}</span>
                        @enderror
                  </div>
                </div>

                <button type="submit" class="btn btn-success">Add User</button>

            </form>


              </div>

            </div>
        </div>
      </div>
    </div>
  </div>


@section('js')
<script>
  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function (e) {
        $('#blah')
          .attr('src', e.target.result);
      };

      reader.readAsDataURL(input.files[0]);
    }
  }


  $(document).ready(function () {

    $('#biography').summernote({
        placeholder: 'Enter Your BioGraphy',
        tabsize: 2,
        height: 100
      });



    });
  </script>

@endsection
@endsection
