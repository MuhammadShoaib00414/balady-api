@extends('backend.includes.master')

@section('content')

<div class="col-10 offset-2" id="main__content">
  <div class="container">
    <div class="d-flex justify-content-end">
      <img src="{{asset('assets/images/Balady-logo.png')}}" class="img-fluid header__logo" alt="balady-logo">
    </div>
    <!-- single course details -->
    <div class="course__single__template">
      <div class="row">
        <div class="col-12 col-sm-9">
          <!-- breadcrumbs -->
          <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb wow animate__animated animate__fadeInUp">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Category</li>
            </ol>
          </nav>
          <!-- breadcrumbs -->
          <form action="{{route('admin.category.update',$category->id)}}" method="POST" enctype="multipart/form-data">
            @method('put')
            @csrf
          <div class="dropcoursehere wow animate__animated animate__fadeInUp">
            <div class="inner__dropfilebox">
              <img id="blah" src="{{asset($category->thumbnail)}}" />
              <div class="drop__here">
                <div class="edit__button">
                  <button type="button" class="btn btn-primary"><i class="fa fa-pencil-alt"
                      aria-hidden="true"></i>
                    Upload Image</button>
                </div>
              </div>
              <input type='file' name="category_thumbnail" class="h-full w-full opacity-0" onchange="readURL(this);" />
            </div>
          </div>
          <!-- banner -->
          <!-- <div class="banner__section">
            <div class="edit__button">
              <button type="button" class="btn btn-primary"><i class="fa fa-pencil-alt" aria-hidden="true"></i>
                edit</button>
            </div>
            <img src="../assets/images/course-banner.png" class="img-fluid " alt="">
          </div> -->
          <!-- banner -->
          <!-- course header -->
          <div class="course__header wow animate__animated animate__fadeInUp">
            <p class="course__title flex-fill">Update Category</p>
          </div>
          <!-- course header -->
          <!-- course about -->
       
          <div class="course__about wow animate__animated animate__fadeInUp">
            <div class="mb-3">
              <label for="course-title" class="form-label">Category</label>

              <input type="text" class="form-control" name="name" value="{{$category->name}}" placeholder="Category Title" id="course-title">
              @error('name')
              <span class="error_alert">{{$message}}</span>
              @enderror
            </div>
        
          </div>

          <div class="course__about wow animate__animated animate__fadeInUp">
            <div class="mb-3">
              <label for="course-title" class="form-label">Arabic Category</label>
              <input type="text" class="form-control" name="ar_name" value="{{$category->ar_name}}" placeholder="Category Arabic Title" id="course-title">
              @error('ar_name')
              <span class="error_alert">{{$message}}</span>
              @enderror
            </div>
        
          </div>

          <div class="course__about wow animate__animated animate__fadeInUp">
            <div class="mb-3">
              <label for="course-title" class="form-label">Urdu Category</label>
              <input type="text" class="form-control" name="ur_name" value="{{$category->ur_name}}"  placeholder="Category Urdu Title" id="course-title">
              @error('ur_name')
              <span class="error_alert">{{$message}}</span>
              @enderror
            </div>
        
          </div>
          <!-- course about -->
      
          <!-- course lesson -->
          <!-- exams lesson -->
          <div class="course__lesson wow animate__animated animate__fadeInUp">
            <div class="add__course__lesson">
              <button type="submit" class="btn add__course">
                <!-- <i class="fa fa-plus me-2" aria-hidden="true"></i> -->
              Update Category
              </button>
            </div>
          </div>
        </form>
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


  </script>
@endsection
@endsection