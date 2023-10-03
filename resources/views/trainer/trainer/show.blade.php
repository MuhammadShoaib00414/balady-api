
@extends('backend.includes.master')

@section('content')

<div class="col-10 offset-2" id="main__content">
    <div class="container">
      <div class="d-flex justify-content-end">
        <img src="../assets/images/Balady-logo.png" class="img-fluid header__logo" alt="balady-logo">
      </div>
      <!-- courses section -->
      <div class="course__template">
        <div class="course__search__field justify-content-between align-items-center mb-5">
          <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb wow animate__animated animate__fadeInUp">
              <li class="breadcrumb-item"><a href="#">users</a></li>
              <li class="breadcrumb-item active" aria-current="page">Sub Admin</li>
            </ol>
          </nav>
        </div>
        <!-- courses section -->
        <!-- activity details -->
        <div class="activity__details">
          <div class="row">
            <div class="col-12 col-sm-6">
              <div class="user__info__cards wow animate__animated animate__fadeInUp">
                <!-- <div class="print__btn">
                  <button type="button" class="btn"><i class="fa fa-print" aria-hidden="true"></i></button>
                </div> -->
                <p>User Information</p>
                <div class="user__profile__det">
                  <img src="{{asset($trainer->image)}}" class="img-fluid" alt="">
                  <p>{{$trainer->first_name}} {{$trainer->last_name}}</p>
                </div>
                <div class="row">
                  <div class="col-12 col-sm-7">
                    <div class="activity__info">
                      <p class="activity__heading">Email</p>
                      <p class="activity__desp">{{$trainer->email}}</p>
                    </div>
                    <div class="activity__info">
                      <p class="activity__heading">phone number</p>
                      <p class="activity__desp">{{$trainer->phone}}</p>
                    </div>

                  </div>
                  <div class="col-12 col-sm-5">
                    <div class="activity__info">
                      <p class="activity__heading">user type</p>
                      <p class="activity__desp">{{$trainer->roles[0]->name}}</p>
                    </div>
                  </div>
                </div>
                <br>
              </div>
            </div>
          </div>
        </div>
        <!-- activity details -->
      </div>
    </div>
  </div>

@endsection
