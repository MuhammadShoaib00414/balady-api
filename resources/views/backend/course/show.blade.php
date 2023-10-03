
@extends('backend.includes.master')

@section('content')

    <div class="dashboard__cards wow animate__animated animate__fadeInUp">
      <div class="row">
        <div class="col-12 col-sm-4 col-lg-3">
          <div class="dash__card">
            <div class="card__content">
              <p>Number of students</p>
              <h2>3520</h2>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-4 col-lg-3">
          <div class="dash__card">
            <div class="card__content">
              <p>Students who passed</p>
              <h2>3400</h2>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-4 col-lg-3">
          <div class="dash__card">
            <div class="card__content">
              <p>Students who failed</p>
              <h2>120</h2>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-4 col-lg-3">
          <div class="dash__card">
            <div class="card__content">
              <p>The average pass score</p>
              <h2>6.7/10</h2>
            </div>
          </div>
        </div>
      </div>
      <div class="dashboard__charts">
        <div class="row gy-4 justify-content-between">
          <div class="col-12 col-sm-5">
            <div class="bars__chart">
              <p>Average student per speciality</p>
              <p class="numbers">35</p>
              <img src="../assets/images/bars-chart.png" class="img-fluid" alt="bars">
            </div>
          </div>
          <div class="col-12 col-sm-5">
            <div class="bars__chart">
              <p>Total inspector</p>
              <p class="numbers">426</p>
              <img src="../assets/images/candidate-chart.png" class="img-fluid" style="margin-top: 6rem;" alt="bars">
            </div>
          </div>
          <div class="col-12 col-sm-5">
            <div class="bars__chart mt-5">
              <p>Enrolled vs Licensed</p>
              <img src="../assets/images/enrolled-chart.png" class="img-fluid" alt="bars">
            </div>
          </div>
        </div>
      </div>
    </div>


@endsection
