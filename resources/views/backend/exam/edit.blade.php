
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

      <!-- single course details -->
      <div class="course__single__template">
        <div class="row">
          <div class="col-12 col-sm-9">
            <!-- breadcrumbs -->
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb wow animate__animated animate__fadeInUp">
                    <li class="breadcrumb-item"><a href="#">{{ __('admin.Home') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('admin.Update Exam') }}</li>
                </ol>
            </nav>
            <!-- breadcrumbs -->

            <form action="{{route('admin.exam.update',$question->id)}}" method="post" enctype="multipart/form-data">
                @method('put')
                @csrf
            <div class="dropcoursehere wow animate__animated animate__fadeInUp">
              <div class="inner__dropfilebox">
                <img id="blah" src="{{asset($question->question_image)}}" />
                <div class="drop__here">
                  <div class="edit__button">
                    <button type="button" class="btn btn-primary"><i class="fa fa-pencil-alt"
                        aria-hidden="true"></i>
                        {{ __('admin.Upload Image') }}</button>
                  </div>
                </div>
                <input type='file' name="question_image" class="h-full w-full opacity-0"  onchange="readURL(this);" />
              </div>
            </div>
            <!-- course header -->
            <div class="course__header wow animate__animated animate__fadeInUp">
              <p class="course__title flex-fill">{{ __('admin.Update Exam') }}</p>
            </div>
            <!-- course header -->
            <!-- course about -->


            <div class="course__about">
              <div class="mb-3 wow animate__animated animate__fadeInUp">
                <label for="course-title" class="form-label">{{ __('admin.Title') }}</label>
                <input type="text" class="form-control ltr" placeholder="Title" name="title" value="{{$question->title}}" id="course-title">

                @error('title')
                <span class="error_alert">{{$message}}</span>
                @enderror
              </div>


              <div class="mb-3 wow animate__animated animate__fadeInUp">
                <label for="course-title" class="form-label">{{ __('admin.Arabic Title') }}</label>
                <input type="text" class="form-control rtl"  placeholder="Arabic Title" name="ar_title" value="{{$question->ar_title}}" id="course-title">

                @error('ar_title')
                <span class="error_alert">{{$message}}</span>
                @enderror
              </div>


              <div class="mb-3 wow animate__animated animate__fadeInUp">
                <label for="course-title" class="form-label">{{ __('admin.Urdu Title') }}</label>
                <input type="text" class="form-control rtl" placeholder="Urdu Title" name="ur_title" value="{{$question->ur_title}}" id="course-title">

                @error('ur_title')
                <span class="error_alert">{{$message}}</span>
                @enderror
              </div>

              <div class="inner__add__question wow animate__animated animate__fadeInUp">

                <div class="add__question mt-5 d-flex justify-content-between align-items-center mx-4">
                  <div class="d-flex align-items-center">
                    <h3 class="mb-0">{{ __('admin.Answer Type') }}</h3>
                    <select id="answer_type" disabled name="option_type" class="form-select ms-4 w-100">
                      <option selected value="">{{ __('admin.Select Menu') }}</option>
                      <option @if($question->options[0]->type == "file") selected @endif value="file" > {{ __('admin.File') }}</option>
                      <option  @if($question->options[0]->type == "text") selected @endif value="text">{{ __('admin.Input Text') }}</option>
                    </select>
                  </div>
                  <a onclick="addanswer()"><i class="fa fa-plus-circle me-3" aria-hidden="true"></i> {{ __('admin.Add Answer') }}</a>
                </div>
                <div class="my-5" id="getanswer">

                    @if($question->options[0]->type == "text")
                    @foreach ($question->options as $key => $option)
                    <div class="customradiocontainer">
                        <div class="radio">
                            <input id="radio-{{$key+1}}" value="{{$key+1}}" @if($option->correct == 1) checked  @endif name="correct_answers[]" type="radio">
                            <label for="radio-{{$key+1}}" class="radio-label">
                            <div class="inner__label">
                                <input type="text" class="form-control ltr border-0 w-100" value="{{$option->answar}}" name="options[]" id="">
                            </div>

                            </label>

                            <div class="others__inputs my-3">
                                <input type="text" class="form-control rtl mb-2" value="{{$option->ar_answar}}" name="ar_options[]" id="">
                                <input type="text" class="form-control rtl" name="ur_options[]" value="{{$option->ur_answar}}" id="">
                            </div>
                        </div>
                    </div>
                                    @endforeach
                                    @endif

              </div>
            </div>
            <!-- course about -->

            <!-- course lesson -->
            <div class="course__lesson d-flex justify-content-end wow animate__animated animate__fadeInUp">
              <div class="add__course__lesson">
                <button type="submit" class="btn add__course me-2 save_button">{{ __('admin.Update') }}</button>
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
  @section('js')
  <script>

 var currentValue = {{count($question->options)}};

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
                        '<input type="text" class="form-control ltr border-0 w-100" placeholder="{{ __('admin.Answer') }} '+currentValue+'" name="options[]" id="">'+
                        '</div>'+
                        '</label>'+
                        '<div class="others__inputs my-3">'+
                            '<input type="text" class="form-control rtl mb-2" placeholder="{{ __('admin.Arabic Answer') }} '+currentValue+'" name="ar_options[]" id="">'+
                            '<input type="text" class="form-control rtl" placeholder="{{ __('admin.Urdu Answer') }} '+currentValue+'" name="ur_options[]" id="">'+
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
