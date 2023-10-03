
@extends('backend.includes.master')

@section('content')
<div class="col-10 offset-2" id="main__content">
    <div class="container">
        <div class="d-flex justify-content-end">
            <img src="../assets/images/Balady-logo.png" class="img-fluid header__logo" alt="balady-logo">
        </div>
        <!-- courses section -->
        <!-- profile section -->
        <div class="profile__main">
            <div class="profile__image__card wow animate__animated animate__fadeInUp">
                <div class="profile__illusta">
                    <img src="../assets/images/profile-illusta.png" class="img-fluid" alt="">
                </div>
                <div class="profile__personal">
                    <img src="{{asset($profile->image)}}" style="border-radius: 50%;" alt="">

                    <div class="profile__name" style="margin-left: 10px;">
                        <p>{{$profile->first_name}} {{$profile->last_name}}</p>
                        <span>{{$profile->roles[0]->name}}</span>
                    </div>
                </div>
            </div>
            <div class="profile__info__details">
                {{-- <form action="#"> --}}
                    <div class="row">
                        <div class="col-12 col-sm-7">
                            <div class="profile__information wow animate__animated animate__fadeInUp" style="height: auto">
                                <h3 class="profile__title">
                                    profile information
                                </h3>
                                <form  method="POST" action="{{route('admin.profile.update',$profile->id)}}" enctype="multipart/form-data">
                                    @method('put')
                                    @csrf
                                <div class="profile__fields">

                                    <div class="mb-3">
                                        <div class="dropcoursehere" >
                                          <div class="inner__dropfilebox">
                                            <img id="blah" style="border-radius: 50%; width:50%;" src="{{asset($profile->image)}}" />
                                            <div class="drop__here">
                                              <div class="edit__button">
                                                <button type="button" class="btn btn-primary"><i class="fa fa-pencil-alt"
                                                    aria-hidden="true"></i>
                                                    upload</button>
                                              </div>
                                            </div>
                                            <input type='file' class="h-full w-full opacity-0" name="image" onchange="readURL(this);" />
                                          </div>
                                        </div>
                                      </div>

                                    <div class="mb-3">
                                        <label for="your-name" class="form-label">First Name</label>
                                        <input type="text" class="form-control" id="your-name" name="first_name" value="{{$profile->first_name}}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="your-name" class="form-label">Last Name</label>
                                        <input type="text" class="form-control" id="your-name" name="last_name" value="{{$profile->last_name}}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="your-email" class="form-label">Email</label>
                                        <input type="email" class="form-control" name="email" id="your-email" value="{{$profile->email}}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="your-phonenumber" class="form-label">Phone Number</label>
                                        <input type="text" class="form-control" name="phone" id="your-phonenumber" value="{{$profile->phone}}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="" class="form-label">Biography</label>
                                        <textarea id="biography" name="biography">{{$profile->biography}}</textarea>
                                        @error('biography')
                                        <span class="error_alert">{{$message}}</span>
                                        @enderror
                                      </div>
                                    <div class="save__changes wow animate__animated animate__fadeInUp">
                                        <button type="submit" class="btn">Edit Profile</button>
                                    </div>
                                </div>
                            </form>
                            </div>
                        </div>
                        <div class="col-12 col-sm-5">
                            <div class="profile__information wow animate__animated animate__fadeInUp" style="height: auto">
                                <h3 class="profile__title">
                                    change password
                                </h3>
                            <form action="{{route('admin.password.change')}}" method="post">
                                @csrf
                                <div class="profile__fields">
                                    <div class="mb-3">
                                        <label for="current-pass" class="form-label">current
                                            password</label>
                                        <input type="password" class="form-control" id="current-pass" name="current_password">
                                        @error('current_password')
                                        <span class="error_alert">{{$message}}</span>
                                        @enderror

                                        @if(session()->has('error'))
                                        <span class="error_alert">{!! \Session::get('error') !!}</span>
                                        @endif

                                    </div>

                                    <div class="mb-3">
                                        <label for="new-pass" class="form-label">new password</label>
                                        <input type="password" class="form-control" name="password" id="new-pass" >
                                        @error('password')
                                        <span class="error_alert">{{$message}}</span>
                                        @enderror


                                    </div>
                                    <div class="mb-3">
                                        <label for="confirm-new-pass" class="form-label">confirm new
                                            password</label>
                                        <input type="password" class="form-control" name="confirm_password" id="confirm-new-pass">
                                        @error('confirm_password')
                                        <span class="error_alert">{{$message}}</span>
                                        @enderror
                                    </div>



                                    <div class="save__changes wow animate__animated animate__fadeInUp">
                                        <button type="submit" class="btn">Update Password</button>
                                    </div>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>

                {{-- </form> --}}
            </div>
        </div>
        <!-- profile section -->
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
