
@extends('backend.includes.master')

@section('content')

<div class="col-10 offset-2" id="main__content">
    <div class="container">
      <div class="d-flex justify-content-end">
        <img src="../assets/images/Balady-logo.png" class="img-fluid header__logo" alt="balady-logo">
      </div>
      <!-- single course details -->
      <div class="course__single__template">
        <div class="row">
          <div class="col-12 col-sm-9">
            <!-- breadcrumbs -->
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
              <ol class="breadcrumb wow animate__animated animate__fadeInUp">
                <li class="breadcrumb-item"><a href="#">course</a></li>
                <li class="breadcrumb-item active" aria-current="page">Update Section</li>
              </ol>
            </nav>
            <!-- breadcrumbs -->
            <!-- course header -->
            <div class="course__header wow animate__animated animate__fadeInUp">
              <p class="course__title flex-fill">Update Section</p>
            </div>
            <!-- course header -->
            <!-- course about -->
            <form action="{{route('admin.section.update',$section->id)}}" method="POST">
                @method('put')
              @csrf
            {{-- <input type="hidden" class="form-control" name="course_id" value="{{$course_id}}" id="course-title"> --}}
            <div class="course__about wow animate__animated animate__fadeInUp">
              <div class="mb-3">
                <label for="course-title" class="form-label">Section titles</label>
                <input type="text" class="form-control" name="name" value="{{$section->name}}" id="course-title">
                @error('name')
                <span class="error_alert">{{$message}}</span>
                @enderror
              </div>

              <div class="mb-3">
                <label for="course-title" class="form-label">Arabic Section titles</label>
                <input type="text" class="form-control" name="ar_name" value="{{$section->ar_name}}" id="course-title">
                @error('ar_name')
                <span class="error_alert">{{$message}}</span>
                @enderror
              </div>

              <div class="mb-3">
                <label for="course-title" class="form-label">Urdu Section titles</label>
                <input type="text" name="ur_name" value="{{$section->ur_name}}" class="form-control" id="course-title">
                @error('ur_name')
                <span class="error_alert">{{$message}}</span>
                @enderror
              </div>
            
            </div>
            <!-- course about -->
            
            <!-- course lesson -->
            <div class="course__lesson d-flex justify-content-end wow animate__animated animate__fadeInUp">
              <div class="add__course__lesson">
                <button type="submit" class="btn add__course me-2">Update Section</button>
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

    </div>
  </div>

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