
@extends('backend.includes.master')

@section('content')


    <!-- single course details -->
    <div class="course__single__template">
      <div class="row">
        <div class="col-12 col-sm-9">
          <!-- breadcrumbs -->
          <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb wow animate__animated animate__fadeInUp">
              <li class="breadcrumb-item"><a href="#">{{ __('admin.Home') }}</a></li>
              <li class="breadcrumb-item active" aria-current="page">{{ __('admin.Course') }}</li>
            </ol>
          </nav>
          <!-- breadcrumbs -->
            <!-- courses section -->
      @if(session()->has('message'))
      @include('backend.includes.succuss_meesage');
    @endif




  <form action="{{route('admin.course.update',$course->id)}}" method="POST" enctype="multipart/form-data">
            @method('put')
            @csrf
          <div class="dropcoursehere wow animate__animated animate__fadeInUp">
            <div class="inner__dropfilebox">
              <img id="blah" src="{{asset($course->media->thumbnail)}}" />
              <div class="drop__here">
                <div class="edit__button">
                  <button type="button" class="btn btn-primary"><i class="fa fa-pencil-alt"
                      aria-hidden="true"></i>
                    Upload Image</button>
                </div>
              </div>
              <input type='file' class="h-full w-full opacity-0" name="course_thumbnail" onchange="readURL(this);" />

              @error('course_thumbnail')
              <span class="error_alert">{{$message}}</span>
              @enderror
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
            <p class="course__title flex-fill">{{ __('admin.Update Course') }}</p>
          </div>
          <!-- course header -->
          <!-- course about -->


        <div class="course__about wow animate__animated animate__fadeInUp">

            <div class="mb-2">
                <label for="course-title" class="form-label">{{ __('admin.Select Category') }}</label>
                <select type="text" class="form-control" name="category_id" >
                    <option value="" selected>{{ __('admin.Select Category') }}</option>                @foreach($categories as $category)
                @if ($course->category_id == $category->id)
                <option value="{{$category->id}}">{{$category->{Langkeyword().'name'} }}</option>
                @else
                <option value="{{$category->id}}">{{$category->{Langkeyword().'name'} }}</option>
                  @endif
                @endforeach

              </select>

              @error('category_id')
              <span class="error_alert">{{$message}}</span>
              @enderror
            </div>
            <br>

            <div class="mb-3">
                <label for="course-title" class="form-label">{{ __('admin.Title') }}</label>
              <input type="text" class="form-control ltr" name="title" value="{{$course->title}}" id="course-title">
              @error('title')
              <span class="error_alert">{{$message}}</span>
              @enderror
            </div>

            <div class="mb-3">
                <label for="course-title" class="form-label">{{ __('admin.Arabic Title') }}</label>
              <input type="text" class="form-control rtl" name="ar_title" value="{{$course->ar_title}}" id="course-title">
              @error('ar_title')
              <span class="error_alert">{{$message}}</span>
              @enderror
            </div>

            <div class="mb-3">
                <label for="course-title" class="form-label">{{ __('admin.Urdu Title') }}</label>
              <input type="text" class="form-control rtl" name="ur_title" value="{{$course->ur_title}}" id="course-title">
              @error('ur_title')
              <span class="error_alert">{{$message}}</span>
              @enderror
            </div>


        </div>
          <!-- course about -->
          <!-- course about -->
        <div class="course__about wow animate__animated animate__fadeInUp">

            <div class="course__plan my-4">
                <h5>{{ __('admin.Short Description') }}</h5>
              </div>

            <div class="mb-3">
              <textarea id="short_description" name="short_description">{{$course->short_description}}</textarea>
            </div>

            @error('short_description')
              <span class="error_alert">{{$message}}</span>
            @enderror

            <div class="course__plan my-4">
                <h5>{{ __('admin.Arabic Short Description') }}</h5>
              </div>


            <div class="mb-3">
              <textarea id="ar_short_description" name="ar_short_description">{{$course->ar_short_description}}</textarea>
            </div>

            @error('ar_short_description')
              <span class="error_alert">{{$message}}</span>
            @enderror


            <div class="course__plan my-4">
                <h5>{{ __('admin.Urdu Short Description') }}</h5>
              </div>

            <div class="mb-3">
              <textarea id="ur_short_description" name="ur_short_description">{{$course->ur_short_description}}</textarea>
            </div>

            @error('ur_short_description')
              <span class="error_alert">{{$message}}</span>
            @enderror


            <div class="course__plan my-4">
                <h5>{{ __('admin.Description') }}</h5>
              </div>

            <div class="mb-3">
              <textarea id="description" name="description">{{$course->description}}</textarea>
            </div>

            @error('description')
              <span class="error_alert">{{$message}}</span>
            @enderror

            <div class="course__plan my-4">
                <h5>{{ __('admin.Arabic Description') }}</h5>
              </div>

            <div class="mb-3">
              <textarea id="ar_description" name="ar_description">{{$course->ar_description}}</textarea>
            </div>

            @error('ar_description')
              <span class="error_alert">{{$message}}</span>
            @enderror


            <div class="course__plan my-4">
                <h5>{{ __('admin.Urdu Description') }}</h5>
              </div>


            <div class="mb-3">
              <textarea id="ur_description" name="ur_description">{{$course->ur_description}}</textarea>
            </div>

            @error('ur_description')
              <span class="error_alert">{{$message}}</span>
            @enderror


            <div class="mb-3">
                <label for="course-title" class="form-label">{{ __('admin.Outcome') }}</label>
              <input type="text" class="form-control ltr" name="outcome" value="{{$course->outcome->name}}" id="course-title">
              @error('outcome')
              <span class="error_alert">{{$message}}</span>
              @enderror
            </div>

            <div class="mb-3">
                <label for="course-title" class="form-label">{{ __('admin.Arabic Outcome') }}</label>
              <input type="text" class="form-control rtl" name="ar_outcome" value="{{$course->outcome->ar_name}}" id="course-title">
              @error('ar_outcome')
              <span class="error_alert">{{$message}}</span>
              @enderror
            </div>

            <div class="mb-3">
                <label for="course-title" class="form-label">{{ __('admin.Urdu Outcome') }}</label>
              <input type="text" class="form-control rtl" name="ur_outcome" value="{{$course->outcome->ur_name}}" id="course-title">
              @error('ur_outcome')
              <span class="error_alert">{{$message}}</span>
              @enderror
            </div>


            <div class="mb-3">
                <label for="course-title" class="form-label">{{ __('admin.Indroduction Video') }}</label>
              <input type="text" class="form-control" name="vedio_url" value="{{$course->media->vedio_url}}" id="course-title">
              @error('vedio_url')
              <span class="error_alert">{{$message}}</span>
              @enderror
            </div>

            <div class="mb-3">
                <label for="course-title" class="form-label">{{ __('admin.Indroduction Video Arabic') }}</label>
              <input type="text" class="form-control" name="ar_vedio_url" value="{{$course->media->ar_vedio_url}}" id="course-title">
              @error('ar_vedio_url')
              <span class="error_alert">{{$message}}</span>
              @enderror
            </div>

            <div class="mb-3">
                <label for="course-title" class="form-label">{{ __('admin.Indroduction Video Urdu') }}</label>              <input type="text" class="form-control" name="ur_vedio_url" value="{{$course->media->ur_vedio_url}}" id="course-title">
              @error('ur_vedio_url')
              <span class="error_alert">{{$message}}</span>
              @enderror
            </div>


          <!-- course about -->
          <!-- course lesson -->

          <!-- course lesson -->
          <!-- exams lesson -->



            <!-- lesson-list -->
        </div>



        <div class="course__lesson wow animate__ animate__fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
            <div class="add__course__lesson">
              <h2>{{ __('admin.Section') }}</h2>
              <a type="button" href="{{route('admin.section.create',$course->id)}}" class="btn add__course"><i class="fa fa-plus me-2" aria-hidden="true"></i>{{ __('admin.Add Section') }}</a>
            </div>
            <!-- lesson-list -->
            <div class="course__lesson__list">
              @foreach($course->sections as $key=>$section)
              <div class="inner__card">
                <div class="inner__lesson__card">
                  <div class="lesson__title">
                    <h5>{{$key+1}}</h5>
                    <div class="ms-3">
                      <p class="lesson__title"> {{$section->{Langkeyword().'name'} }}</p>
                    </div>
                  </div>
                  <a href="{{route('admin.section.edit',$section->id)}}"><i class="fa fa-pencil-alt" aria-hidden="true"></i> {{ __('admin.Edit') }}</a>
                  <a href="{{route('admin.section.delete',$section->id)}}" style="color:red"><i class="fa fa-trash" aria-hidden="true"></i> {{ __('admin.Delete') }}</a>
                </div>
                <br>

              </div>
              @endforeach
            </div>
            </div>


        <div class="course__lesson wow animate__ animate__fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
            <div class="add__course__lesson">
              <h2>{{ __('admin.Lesson') }}</h2>
              <a type="button" href="{{route('admin.lesson.create',$course->id)}}" class="btn add__course"><i class="fa fa-plus me-2" aria-hidden="true"></i>{{ __('admin.Add Lesson') }}</a>
            </div>
            <!-- lesson-list -->
            <div class="course__lesson__list">
              @foreach($course->lessons as $key=>$lesson)
              <div class="inner__card">
                <div class="inner__lesson__card">
                  <div class="lesson__title">
                    <h5>{{$key+1}}</h5>
                    <div class="ms-3">
                      <p class="lesson__title">{{$lesson->{Langkeyword().'title'} }}</p>
                    </div>
                  </div>
                  <a href="{{route('admin.lesson.edit',$lesson->id)}}"><i class="fa fa-pencil-alt" aria-hidden="true"></i> {{ __('admin.Edit') }}</a>
                  <a href="{{route('admin.lesson.delete',$lesson->id)}}" style="color:red"><i class="fa fa-trash" aria-hidden="true"></i> {{ __('admin.Delete') }}</a>
                </div>
                <br>
              </div>
              @endforeach
            </div>
            </div>



        <div class="course__lesson wow animate__ animate__fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
            <div class="add__course__lesson">
              <h2>{{ __('admin.Knowledge Test') }}</h2>
              <a type="button" href="{{route('admin.quiz.create',$course->id)}}" class="btn add__course"><i class="fa fa-plus me-2" aria-hidden="true"></i>{{ __('admin.Add question') }}</a>
            </div>
            <!-- lesson-list -->
            <div class="course__lesson__list">
              @foreach($course->courseQuestion as $key=>$acknowlegde)
              <div class="inner__card">
                <div class="inner__lesson__card">
                  <div class="lesson__title">
                    <h5>{{$key+1}}</h5>
                    <div class="ms-3">
                      <p class="lesson__title">{{$acknowlegde->{Langkeyword().'title'} }}</p>
                    </div>
                  </div>
                  <a href="{{route('admin.course.question.edit',$acknowlegde->id)}}"><i class="fa fa-pencil-alt" aria-hidden="true"></i> Edit</a>
                  <a href="{{route('admin.course.question.delete',$acknowlegde->id)}}" style="color:red"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
                </div>
                <br>
                @foreach($acknowlegde->CourseOptions as $key=>$CourseOption)
                <span>({{$key+1}}) {{$CourseOption->{Langkeyword().'answar'} }} @if($CourseOption->correct == 1)<i class="fa fa-check" aria-hidden="true"></i>@endif</span>
                <br>
                @endforeach
              </div>
              @endforeach
            </div>
            </div>

          <!-- exams lesson -->
          <div class="course__lesson wow animate__animated animate__fadeInUp">
            <div class="add__course__lesson">
              <button type="submit" class="btn add__course">
                <!-- <i class="fa fa-plus me-2" aria-hidden="true"></i> -->
              {{ __('admin.Update Course') }}
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

@section('js')
<script>
  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function (e) {
        $('#blah').attr('src', e.target.result);
      };

      reader.readAsDataURL(input.files[0]);
    }
  }


  $(document).ready(function () {

    $('#short_description').summernote({
        placeholder: 'Short Description',
        tabsize: 2,
        height: 100
      });



    $('#ar_short_description').summernote({
        placeholder: 'Arabic Short Description',
        tabsize: 2,
        height: 100
      });



    $('#ur_short_description').summernote({
        placeholder: 'urdu Short Description',
        tabsize: 2,
        height: 100
      });


      $('#description').summernote({
        placeholder: 'Description',
        tabsize: 2,
        height: 100
      });

      $('#ar_description').summernote({
        placeholder: 'Arabic Description',
        tabsize: 2,
        height: 100
      });

      $('#ur_description').summernote({
        placeholder: 'Urdu Description',
        tabsize: 2,
        height: 100
      });

    });
  </script>

@endsection
@endsection
