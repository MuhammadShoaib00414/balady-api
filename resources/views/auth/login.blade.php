@extends('layouts.app')

@section('content')
<section class="category-course-list-area">
    <div class="container-xl">
        <div class="row justify-content-center">
              <div class="col-lg-8 loginNew">
                <div class=" mt-3">
                  <div class="row">
                    <div class="col-lg-6">
                        <div class="user-dashboard-content w-100 login-form">
                            <div class="content-title-box">
                              <div class="logo">
                                <img src="{{asset('uploads/system/new-logo.png')}}" alt="" height="50">
                               </div>
                               <div class="clearfix"></div>
                                <div class="title">{{__('auth.Login')}}</div>
                                <div class="subtitle">{{ __('auth.Provide your valid login credentials.') }} </div>
                            </div>
                            <form action="{{route('login')}}" method="post">
                                @csrf
                                <div class="content-box">
                                    <div class="basic-group">
                                        <div class="form-group">
                                            <label for="login-email"><span class="input-field-icon"><i class="fas fa-envelope"></i></span></label>
                                            <input
                                            type="text"
                                            class="form-control @error('email') is-invalid @enderror"
                                            name = "email"
                                            id="login-email"
                                            value="{{ old('email') }}"
                                            placeholder="{{__('auth.Email')}}"
                                            required
                                            >
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        </div>
                                            <div class="form-group">
                                            <label for="login-password"><span class="input-field-icon"><i class="fas fa-lock"></i></span></label>
                                            <input
                                            type="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            id="login-pass"
                                            name = "password"
                                            placeholder="{{__('auth.Password')}}"
                                            required
                                            >
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                                <div class="content-update-box">
                                    <button type="submit" class="btn">{{__('auth.Login')}}</button>
                                </div>
                                <div class="forgot-pass text-center">

                                    <a href="javascript::">{{__('auth.ForgetPassword')}}</a>
                                </div>

                            </form>
                        </div>
                      </div>
                   <div class="col-lg-6">
                      <div class="textother" >
                                <div class="title">{{__('auth.Hello, Friend!')}}</div>
                                <div class="subtitle">{{__('auth.Welcome Back')}} <br/> {{__('auth.to')}} <span>{{__('auth.Balady')}} </span></div>

                        </div>
                     </div>
                   </div>
                 </div>
               </div>
            </div>

        </div>
    </div>
</section>
@endsection
