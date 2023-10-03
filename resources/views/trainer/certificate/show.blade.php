
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
              <li class="breadcrumb-item"><a href="#">Certificate</a></li>
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
                <p>Certificate Information</p>

                <div class="row">
                  <div class="col-4 col-sm-4">
                    <div class="activity__info">
                      <p class="activity__heading">Nation ID</p>
                      <p class="activity__desp">{{$certificate->student->national_id}}</p>
                    </div>
                </div>

                <div class="col-4 col-sm-4">
                    <div class="activity__info">
                      <p class="activity__heading">User Name</p>
                      <p class="activity__desp">{{$certificate->student->first_name}} {{$certificate->student->third_name}} {{$certificate->student->family_name}}</p>
                    </div>
                </div>

                <div class="col-4 col-sm-4">
                    <div class="activity__info">
                      <p class="activity__heading">Total Questions</p>
                      <p class="activity__desp">{{$certificate->total_questions}}</p>
                    </div>
                </div>

                <div class="col-4 col-sm-4">
                    <div class="activity__info">
                      <p class="activity__heading">Right Answers</p>
                      <p class="activity__desp">{{$certificate->total_answers}}</p>
                    </div>
                </div>


                <div class="col-4 col-sm-4">
                    <div class="activity__info">
                      <p class="activity__heading">Percentage</p>
                      <p class="activity__desp">{{$certificate->percentage}}</p>
                    </div>
                </div>



                <div class="col-4 col-sm-4">
                  <div class="activity__info">
                    <p class="activity__heading">Result</p>
                    <p class="activity__desp">{{$certificate->percentage}}</p>
                  </div>
              </div>



              <div class="col-4 col-sm-4">
                <div class="activity__info">
                  <p class="activity__heading">Arabic Result</p>
                  <p class="activity__desp">{{$certificate->percentage}}</p>
                </div>
            </div>



            <div class="col-4 col-sm-4">
              <div class="activity__info">
                <p class="activity__heading">Urdu Result</p>
                <p class="activity__desp">{{$certificate->percentage}}</p>
              </div>
          </div>


          <div class="col-4 col-sm-4">
            <div class="activity__info">
              <p class="activity__heading">Issue Date</p>
              <p class="activity__desp">{{$certificate->issue_date}}</p>
            </div>
        </div>


        <div class="col-4 col-sm-4">
          <div class="activity__info">
            <p class="activity__heading">Crm Response Code</p>
            <p class="activity__desp">{{$certificate->crm_response_code}}</p>
          </div>
      </div>


      <div class="col-4 col-sm-4">
        <div class="activity__info">
          <p class="activity__heading">Crm Response Message</p>
          <p class="activity__desp">{{$certificate->crm_response_message}}</p>
        </div>
    </div>

    <div class="col-4 col-sm-4">
      <div class="activity__info">
        <p class="activity__heading">Status</p>
        <p class="activity__desp">@if($certificate->status == "pass")
          <button type="button" class="btn user__status active__status">Passed</button>
          @else
          <button type="button" class="btn user__status delete__status">Fail</button>
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
