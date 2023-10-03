
@extends('backend.includes.master')

@section('content')

      <!-- single course details -->
      <div class="course__single__template">
        <div class="row">
          <div class="col-12 col-sm-9">
            <!-- breadcrumbs -->
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
              <ol class="breadcrumb wow animate__animated animate__fadeInUp">
                <li class="breadcrumb-item"><a href="#">{{ __('admin.Course') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('admin.Add Section') }}</li>
              </ol>
            </nav>
            <!-- breadcrumbs -->
            <!-- course header -->
            <div class="course__header wow animate__animated animate__fadeInUp">
              <p class="course__title flex-fill">{{ __('admin.Add Section') }}</p>
            </div>
            <!-- course header -->
            <!-- course about -->
            <form action="{{route('admin.section.store')}}" method="POST">
              @csrf
            <input type="hidden" class="form-control rtl" name="course_id" value="{{$course_id}}" id="course-title">
            <div class="">
              <div class="mb-3">
                <label for="course-title" class="form-label">{{ __('admin.Title') }}</label>
                <input type="text" class="form-control ltr" name="name" value="{{old('name')}}" >
                @error('name')
                <span class="error_alert">{{$message}}</span>
                @enderror
              </div>

              <div class="mb-3">
                <label for="course-title" class="form-label">{{ __('admin.Arabic Title') }}</label>
                <input type="text" class="form-control ltr" name="ar_name" value="{{old('ar_name')}}" id="course-title">
                @error('ar_name')
                <span class="error_alert">{{$message}}</span>
                @enderror
              </div>

              <div class="mb-3">
                <label for="course-title" class="form-label">{{ __('admin.Urdu Title') }}</label>
                <input type="text" name="ur_name" value="{{old('ur_name')}}" class="form-control" id="course-title">
                @error('ur_name')
                <span class="error_alert">{{$message}}</span>
                @enderror
              </div>

            </div>
            <!-- course about -->

            <!-- course lesson -->
            <div class="course__lesson d-flex justify-content-end wow animate__animated animate__fadeInUp">
              <div class="add__course__lesson">
                <button type="submit" class="btn add__course me-2">
                    {{ __('admin.Submit') }}
                </button>
              </div>

            </div>
          </form>
            <!-- course lesson -->
            <!-- exams lesson -->
            <div class="course__lesson">

            </div>
            <!-- exams lesson -->
          </div>
        </div>
      </div>
      <!-- single course details -->
      <!-- courses section -->

@section('js')
<script>
    function editlessonBanner(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
          $('#editlessonBanner')
            .attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
      }
    }
    function uploadVideoone(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
          $('#uploadVideoone')
            .attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
      }
    }

    function uploadVideotwo(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
          $('#uploadVideotwo')
            .attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
      }
    }

    function uploadImagetwo(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
          $('#uploadImagetwo')
            .attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
      }
    }

    function uploadImagetwo(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
          $('#uploadImagetwo')
            .attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
      }
    }


    $('#what-i-learn').summernote({
        placeholder: 'Lorem ipsum dolor sit.',
        tabsize: 2,
        height: 100
      });


  </script>
@endsection
@endsection
