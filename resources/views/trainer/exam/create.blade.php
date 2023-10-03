
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
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">add exam question</li>
              </ol>
            </nav>
            <!-- breadcrumbs -->

            <form action="{{route('admin.exam.store')}}" method="post" enctype="multipart/form-data">
                @csrf
            <div class="dropcoursehere wow animate__animated animate__fadeInUp">
              <div class="inner__dropfilebox">
                <img id="blah" src="{{asset('assets/images/course-banner.png')}}" />
                <div class="drop__here">
                  <div class="edit__button">
                    <button type="button" class="btn btn-primary"><i class="fa fa-pencil-alt"
                        aria-hidden="true"></i>
                      edit</button>
                  </div>
                </div>
                <input type='file' name="question_image" class="h-full w-full opacity-0"  onchange="readURL(this);" />
              </div>
            </div>
            <!-- course header -->
            <div class="course__header wow animate__animated animate__fadeInUp">
              <p class="course__title flex-fill">Add Exam Question</p>
            </div>
            <!-- course header -->
            <!-- course about -->


            <div class="course__about">
              <div class="mb-3 wow animate__animated animate__fadeInUp">
                <label for="course-title" class="form-label">Title</label>
                <input type="text" class="form-control" placeholder="Title" name="title" value="{{old('title')}}" id="course-title">

                @error('title')
                <span class="error_alert">{{$message}}</span>
                @enderror
              </div>


              <div class="mb-3 wow animate__animated animate__fadeInUp">
                <label for="course-title" class="form-label">Arabic Title</label>
                <input type="text" class="form-control"  placeholder="Arabic Title" name="ar_title" value="{{old('ar_title')}}" id="course-title">

                @error('ar_title')
                <span class="error_alert">{{$message}}</span>
                @enderror
              </div>


              <div class="mb-3 wow animate__animated animate__fadeInUp">
                <label for="course-title" class="form-label">Urdu Title</label>
                <input type="text" class="form-control" placeholder="Urdu Title" name="ur_title" value="{{old('ur_title')}}" id="course-title">

                @error('ur_title')
                <span class="error_alert">{{$message}}</span>
                @enderror
              </div>

              <div class="inner__add__question wow animate__animated animate__fadeInUp">

                <div class="add__question mt-5 d-flex justify-content-between align-items-center mx-4">
                  <div class="d-flex align-items-center">
                    <h3 class="mb-0">answers</h3>
                    <select id="answer_type" name="option_type" class="form-select ms-4 w-100">
                      <option selected value="">select menu</option>
                      <option value="file">File</option>
                      <option value="text">Input Text</option>
                    </select>
                  </div>
                  <a onclick="addanswer()"><i class="fa fa-plus-circle me-3" aria-hidden="true"></i> add answer</a>
                </div>
                <div class="my-5" id="getanswer">



              </div>
            </div>
            <!-- course about -->

            <!-- course lesson -->
            <div class="course__lesson d-flex justify-content-end wow animate__animated animate__fadeInUp">
              <div class="add__course__lesson">
                <button type="submit" class="btn add__course me-2 save_button">Save Question</button>
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

 var currentValue = 0;

    function addanswer()
    {
     var answer_type = $('#answer_type').val();
     currentValue++;
     if(answer_type == "text"){
        $('#answer_type').prop('disabled', true);
        var output='<div class="customradiocontainer">'+
                '<div class="radio">'+
                    '<input id="radio-'+currentValue+'" checked name="correct_answers[]" value="'+currentValue+'" type="radio">'+
                    '<label for="radio-'+currentValue+'" class="radio-label">'+
                    '<div class="inner__label">'+
                        '<input type="text" class="form-control border-0 w-100" placeholder="Answer '+currentValue+'" name="options[]" id="">'+
                        '</div>'+
                        '</label>'+
                        '<div class="others__inputs my-3">'+
                            '<input type="text" class="form-control mb-2" placeholder="Arabic Answer '+currentValue+'" name="ar_options[]" id="">'+
                            '<input type="text" class="form-control" placeholder="Urdu Answer '+currentValue+'" name="ur_options[]" id="">'+
                            '</div>'+
                            '</div>'+
                            '</div>'+
                            '</div>';

    }else if(answer_type == "file"){
        $('#answer_type').prop('disabled', true);
        var output='<div class="customradiocontainer">'+
                '<div class="radio">'+
                    '<input id="radio-'+currentValue+'" checked name="correct_answers[]" value="'+currentValue+'" type="radio">'+
                    '<label for="radio-'+currentValue+'" class="radio-label">'+
                    '<div class="inner__label">'+
                        '<input type="file" class="form-control border-0 w-100" value="Answer '+currentValue+'" name="file_options[]" id="">'+
                        '</div>'+
                        '</label>'+
                            '</div>'+
                            '</div>'+
                            '</div>';
    }else{
        alert("please Select type");
    }

    $("#getanswer").append(output);
    }

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


<script type="text/javascript">
    $(function () {
      $('.save_button').on('click', function (e) {

        $('#answer_type').prop('disabled', false);
      });
    });

    </script>

<script>
    $(document).ready(function () {
      $('#question__list').summernote({
        placeholder: 'Lorem ipsum dolor sit.',
        tabsize: 2,
        height: 100
      });
    });
  </script>

  @endsection

  @endsection
