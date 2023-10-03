
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
              <li class="breadcrumb-item"><a href="#">Student</a></li>
              <li class="breadcrumb-item active" aria-current="page">Show</li>
            </ol>
          </nav>
        </div>
        <!-- courses section -->
        <!-- activity details -->
        <div class="activity__details">
          <div class="row">
            <div class="col-12 col-sm-12">
              <div class="user__info__cards wow animate__animated animate__fadeInUp">
                <!-- <div class="print__btn">
                  <button type="button" class="btn"><i class="fa fa-print" aria-hidden="true"></i></button>
                </div> -->
                <p>User Information</p>

                <div class="row">
                  <div class="col-4 col-sm-4">
                    <div class="activity__info">
                      <p class="activity__heading">First Name</p>
                      <p class="activity__desp">{{$student->first_name}}</p>
                    </div>
                </div>
                <div class="col-4 col-sm-4">
                    <div class="activity__info">
                      <p class="activity__heading">Third Name</p>
                      <p class="activity__desp">{{$student->third_name}}</p>
                    </div>
                </div>

                <div class="col-4 col-sm-4">
                    <div class="activity__info">
                      <p class="activity__heading">Family Name</p>
                      <p class="activity__desp">{{$student->family_name}}</p>
                    </div>
                </div>


                <div class="col-4 col-sm-4">
                    <div class="activity__info">
                      <p class="activity__heading">Father Name</p>
                      <p class="activity__desp">{{$student->father_name}}</p>
                    </div>
                </div>


                <div class="col-4 col-sm-4">
                    <div class="activity__info">
                      <p class="activity__heading">phone number</p>
                      <p class="activity__desp">{{$student->mobile_number}}</p>
                    </div>
                </div>


                <div class="col-4 col-sm-4">
                    <div class="activity__info">
                      <p class="activity__heading">Gender</p>
                      <p class="activity__desp">@if($student->gender == 1) Male @else Female @endif</p>
                    </div>
                </div>


                <div class="col-4 col-sm-4">
                    <div class="activity__info">
                      <p class="activity__heading">Municipality</p>
                      <p class="activity__desp">{{$student->municipality}}</p>
                    </div>
                </div>


                <div class="col-4 col-sm-4">
                    <div class="activity__info">
                      <p class="activity__heading">Sub Municipality</p>
                      <p class="activity__desp">{{$student->sub_municipality}}</p>
                    </div>
                </div>

                <div class="col-4 col-sm-4">
                    <div class="activity__info">
                      <p class="activity__heading">Observation Type</p>
                      <p class="activity__desp">{{$student->observation_type}}</p>
                    </div>
                </div>

                <div class="col-4 col-sm-4">
                    <div class="activity__info">
                      <p class="activity__heading">Bank Name</p>
                      <p class="activity__desp">{{$student->bank_name}}</p>
                    </div>
                </div>

                <div class="col-4 col-sm-4">
                    <div class="activity__info">
                      <p class="activity__heading">Iban</p>
                      <p class="activity__desp">{{$student->iban}}</p>
                    </div>
                </div>

                <div class="col-4 col-sm-4">
                    <div class="activity__info">
                      <p class="activity__heading">Status</p>
                      <p class="activity__desp">@if($student->is_lock == 0)
                        <button type="button" class="btn user__status active__status">Active</button>
                        @else
                        <button type="button" class="btn user__status delete__status">Profile Lock</button>
                        @endif</p>
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
