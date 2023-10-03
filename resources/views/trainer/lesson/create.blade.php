
@extends('backend.includes.master')

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

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
                <li class="breadcrumb-item active" aria-current="page">add lesson</li>
              </ol>
            </nav>
            <!-- breadcrumbs -->
            <form action="{{route('admin.lesson.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="dropcoursehere wow animate__animated animate__fadeInUp">
              <div class="inner__dropfilebox">
                <img id="blah" src="{{asset('assets/images/upload_image.png')}}" />
                <div class="drop__here">
                  <div class="edit__button">
                    <button type="button" class="btn btn-primary"><i class="fa fa-pencil-alt"
                        aria-hidden="true"></i>
                      Upload Image</button>
                  </div>
                </div>
                <input type='file' required="required" class="h-full w-full opacity-0" name="thumbnail" onchange="readURL(this);" />

                @error('thumbnail')
                <span class="error_alert">{{$message}}</span>
                @enderror
              </div>
            </div>

            <input type="hidden" class="form-control" name="course_id" value="{{$course_id}}" id="course-title">
            <!-- course header -->
            <div class="course__header wow animate__animated animate__fadeInUp">
              <p class="course__title flex-fill">add lesson</p>
            </div>
            <!-- course header -->
            <!-- course about -->
            <div class="course__about wow animate__animated animate__fadeInUp">

              <div class="mb-3">
                <label for="course-title" class="form-label">Select Section</label>
                <select type="text" class="form-select" name="section_id" >
                  <option value="" selected>Select Section</option>
                  @foreach($sections as $section)
                  @if (old('section_id') == $section->id)
                    <option selected value="{{$section->id}}">{{$section->name}}</option>
                  @else
                  <option value="{{$section->id}}">{{$section->name}}</option>
                  @endif
                  @endforeach
                </select>

                @error('section_id')
                <span class="error_alert">{{$message}}</span>
                @enderror

              </div>

              <div class="mb-3">
                <label for="course-title" class="form-label">lesson title</label>
                <input type="text" name="title" value="{{old('title')}}" class="form-control" id="course-title">
                @error('title')
                <span class="error_alert">{{$message}}</span>
                @enderror
              </div>

              <div class="mb-3">
                <label for="course-title" class="form-label">Arabic lesson title</label>
                <input type="text" name="ar_title" value="{{old('ar_title')}}" class="form-control" id="course-title">
                @error('ar_title')
                <span class="error_alert">{{$message}}</span>
                @enderror
              </div>

              <div class="mb-3">
                <label for="course-title" class="form-label">Urdu lesson title</label>
                <input type="text" name="ur_title" value="{{old('ur_title')}}" class="form-control" id="course-title">
                @error('ur_title')
                <span class="error_alert">{{$message}}</span>
                @enderror
              </div>

              <div class="mb-3">
                <label for="" class="form-label">Summary</label>
                <textarea id="summary" name="summary">{{old('summary')}}</textarea>
              </div>

              @error('summary')
              <span class="error_alert">{{$message}}</span>
              @enderror

              <div class="mb-3">
                <label for="" class="form-label">Arabic Summary</label>
                <textarea id="ar_summary" name="ar_summary">{{old('ar_summary')}}</textarea>
              </div>

              @error('ar_summary')
              <span class="error_alert">{{$message}}</span>
              @enderror

              <div class="mb-3">
                <label for="" class="form-label">Urdu Summary</label>
                <textarea id="ur_summary" name="ur_summary">{{old('ur_summary')}}</textarea>
              </div>

              @error('ur_summary')
              <span class="error_alert">{{$message}}</span>
              @enderror

              <div class="mb-3">
                <label for="course-title" class="form-label">Flle Type</label>
                <select type="text" class="form-select" onchange="fileType(this.value)" name="type" >
                  <option value="" selected>Select Type</option>
                    <option value="other-img">Image</option>
                    <option value="other-pdf">Pdf</option>
                </select>

                @error('type')
                <span class="error_alert">{{$message}}</span>
                @enderror

              </div>

              <div class="my-5 video__droper" style="display: none;" id="imageFile">
                <h3 class="my-4">Images</h3>
                <div class="row">
                  <div class="col-12 col-sm-4">
                    <div class="dropcoursehere">
                      <div class="inner__dropfilebox">
                        <img id="ImageShowOne" src="{{asset('assets/images/image_upload.png')}}" />
                        <div class="drop__here">
                          <div class="edit__button">
                            <button type="button" class="btn btn-primary"><i class="fa fa-pencil-alt"
                                aria-hidden="true"></i>
                                upload</button>
                          </div>
                        </div>
                        <input type='file' class="h-full w-full opacity-0" name="attachments[]" onchange="ImageUploadOne(this);" />
                      </div>
                    </div>
                  </div>

                  <div class="col-12 col-sm-4">
                    <div class="dropcoursehere">
                      <div class="inner__dropfilebox">
                        <img id="ImageShowTwo" src="{{asset('assets/images/image_upload.png')}}" />
                        <div class="drop__here">
                          <div class="edit__button">
                            <button type="button" class="btn btn-primary"><i class="fa fa-pencil-alt"
                                aria-hidden="true"></i>
                              upload</button>
                          </div>
                        </div>
                        <input type='file' name="attachments[]" class="h-full w-full opacity-0" onchange="ImageUploadTwo(this);" />

                      </div>
                    </div>
                  </div>

                  <div class="col-12 col-sm-4">
                    <div class="dropcoursehere">
                      <div class="inner__dropfilebox">
                        <img id="ImageShowThree" src="{{asset('assets/images/image_upload.png')}}" />
                        <div class="drop__here">
                          <div class="edit__button">
                            <button type="button" class="btn btn-primary"><i class="fa fa-pencil-alt"
                                aria-hidden="true"></i>
                                upload</button>
                          </div>
                        </div>
                        <input type='file' name="attachments[]" class="h-full w-full opacity-0" onchange="ImageUploadThree(this);" />
                      </div>
                    </div>
                  </div>
                </div>
              </div>


              <div class="" style="display: none;" id="pdfFile">
                <h3 class="my-4">Pdf</h3>
                <div class="row">
                             <input type='file' name="attachments[]" />
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- course about -->

            <!-- course lesson -->
            <div class="course__lesson d-flex justify-content-end wow animate__animated animate__fadeInUp">
              <div class="add__course__lesson">
                <button type="submit" class="btn add__course me-2">Add Lesson</button>
              </div>
            </div>

          </form>
            <!-- course lesson -->
            <!-- exams lesson -->
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


    function ImageUploadOne(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
          $('#ImageShowOne')
            .attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
      }
    }



    function ImageUploadTwo(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
          $('#ImageShowTwo')
            .attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
      }
    }

    function ImageUploadThree(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
          $('#ImageShowThree')
            .attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
      }
    }



    function fileType(fileType)
    {
      if(fileType == "other-img"){
        $('#pdfFile').css('display','none');
        $('#imageFile').css('display','block');
      }else if(fileType == "other-pdf"){
        $('#imageFile').css('display','none');
        $('#pdfFile').css('display','block');
      }else{
        $('#pdfFile').css('display','none');
        $('#imageFile').css('display','none');
      }
    }


  </script>

  <script>
    $(document).ready(function(){


    $('#summary').summernote({
        tabsize: 2,
        height: 100
      });

      $('#ar_summary').summernote({
        tabsize: 2,
        height: 100
      });


      $('#ur_summary').summernote({
        tabsize: 2,
        height: 100
      });

    });
  </script>
@endsection
@endsection
