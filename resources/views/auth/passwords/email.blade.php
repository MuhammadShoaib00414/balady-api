@extends('layouts.app')

@section('content')
<section class="category-course-list-area">
    <div class="container-xl">
        <div class="row justify-content-center">
              <div class="col-lg-8 loginNew">
                <div class=" mt-3">
                  <div class="row">
                    <div class="col-lg-6">                       
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <div class="user-dashboard-content w-100 forgot-password-form " id="forget">
                            <div class="content-title-box">
                              <div class="logo">
                                <img src="{{asset('uploads/system/new-logo.png')}}" alt="" height="50">
                               </div>
                                <div class="title" style="font-size: 30px;letter-spacing: 0;">Forgot password</div>
                                <div class="subtitle for">Provide your email address.</div>
                            </div>
                            <form  method="post"  action="{{ route('password.email') }}">
                                @csrf
                                <div class="content-box">
                                    <div class="basic-group">
                                        <div class="form-group for">
                                            <label for="forgot-email"><span class="input-field-icon "><i class="fas fa-envelope"></i></span> </label>
                                            <input type="email" class="form-control" name = "email" id="forgot-email" placeholder="Email" value="" required>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="content-update-box">
                                    <button type="submit" class="btn">Reset password</button>
                                </div>
                                <div class="forgot-pass text-center">
                                    Go back to? <a href="{{route('login')}}">Login</a>
                                </div>
                            </form>
                        </div>
                      </div>
                   <div class="col-lg-6">
                      <div class="textother" >
                                <div class="title">Hello, Friend!</div>
                                <div class="subtitle">Welcome Back <br/>to <span>Balady</span></div>
                               
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
