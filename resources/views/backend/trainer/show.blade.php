@extends('backend.includes.master')

@section('content')
    <!-- courses section -->
    <div class="course__template">
        <div class="course__search__field justify-content-between align-items-center mb-5">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb wow animate__ animate__fadeInUp animated"
                    style="visibility: visible; animation-name: fadeInUp;">
                    <li class="breadcrumb-item"><a href="#">{{ __('admin.Trainer') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('admin.Show Trainer') }}</li>
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
                        <p>{{ __('admin.Trainer Information') }}</p>
                        <div class="user__profile__det">
                            <img src="{{ asset($trainer->image) }}" class="img-fluid" alt="">
                            <p>{{ $trainer->first_name }} {{ $trainer->last_name }}</p>
                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-7">
                                <div class="activity__info">
                                    <p class="activity__heading">{{ __('admin.Email') }}</p>
                                    <p class="activity__desp">{{ $trainer->email }}</p>
                                </div>
                                <div class="activity__info">
                                    <p class="activity__heading">{{ __('admin.Phone Number') }}</p>
                                    <p class="activity__desp">{{ $trainer->phone }}</p>
                                </div>

                            </div>
                            <div class="col-12 col-sm-5">
                                <div class="activity__info">
                                    <p class="activity__heading">{{ __('admin.User Type') }}</p>
                                    <p class="activity__desp">{{ $trainer->roles[0]->name }}</p>
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
@endsection
