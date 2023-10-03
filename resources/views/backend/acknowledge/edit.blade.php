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
                        <li class="breadcrumb-item"><a href="#">{{ __('admin.Course') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('admin.Knowledge') }}</li>
                    </ol>
                </nav>
                <!-- breadcrumbs -->
                <form action="{{ route('admin.course.question.update', $acknowledge->id) }}" method="post">
                    @method('put')
                    @csrf
                    <input class="form-control" type="hidden" name="course_id" value="{{ $acknowledge->course_id }}"
                        required="">
                    <div class="course__about">
                        <div class="mb-3 wow animate__animated animate__fadeInUp">
                            <label for="course-title" class="form-label">{{ __('admin.Title') }}</label>
                            <input type="text" class="form-control ltr" placeholder="Title" name="title"
                                value="{{ $acknowledge->title }}" id="course-title">

                            @error('title')
                                <span class="error_alert">{{ $message }}</span>
                            @enderror

                        </div>


                        <div class="mb-3 wow animate__animated animate__fadeInUp">
                            <label for="course-title" class="form-label">{{ __('admin.Arabic Title') }}</label>
                            <input type="text" class="form-control rtl" placeholder="Arabic Title" name="ar_title"
                                value="{{ $acknowledge->ar_title }}" id="course-title">

                            @error('ar_title')
                                <span class="error_alert">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="mb-3 wow animate__animated animate__fadeInUp">
                            <label for="course-title" class="form-label">{{ __('admin.Urdu Title') }}</label>
                            <input type="text" class="form-control rtl" placeholder="Urdu Title" name="ur_title"
                                value="{{ $acknowledge->ur_title }}" id="course-title">

                            @error('ur_title')
                                <span class="error_alert">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="inner__add__question wow animate__animated animate__fadeInUp">

                            @error('options')
                                <span class="error_alert">{{ $message }}</span>
                            @enderror

                            <br>

                            @error('ar_options')
                                <span class="error_alert">{{ $message }}</span>
                            @enderror

                            <br>

                            @error('ur_options')
                                <span class="error_alert">{{ $message }}</span>
                            @enderror

                            <div class="add__question d-flex justify-content-between align-items-right mx-4">
                                <!-- <button type="button" onclick="addanswer()"><i class="fa fa-plus-circle me-3" aria-hidden="true"></i> add answer</button> -->
                                <div class="d-flex align-items-center"> </div>
                                <a onclick="addanswer()"><i class="fa fa-plus-circle me-3" aria-hidden="true"></i>
                                    {{ __('admin.Add Answer') }}</a>
                            </div>

                            <div class="my-5" id="getanswer">
                                @if ($acknowledge->CourseOptions)
                                    @foreach ($acknowledge->CourseOptions as $key => $option)
                                        <div class="customradiocontainer">
                                            <div class="radio">

                                                @if ($loop->last)
                                                    <input type="hidden" id="radio-value" value="{{ $key + 1 }}">
                                                @endif

                                                <input name="option_id[]" value="{{ $option->id }}" type="hidden">
                                                <input id="radio-{{ $key + 1 }}" name="correct_answers[]"
                                                    @if ($option->correct == 1) checked @endif
                                                    value="{{ $key + 1 }}" type="radio">
                                                <label for="radio-{{ $key + 1 }}" class="radio-label">
                                                    <div class="inner__label">
                                                        <input type="text" required="required"
                                                            class="form-control ltr border-0 w-100"
                                                            value="{{ $option->answar }}"
                                                            placeholder="{{ __('admin.Answer') }} '{{ $key + 1 }}'" name="options[]"
                                                            id="">
                                                    </div>
                                                </label>
                                                <div class="others__inputs my-3">
                                                    <input type="text" required="required" class="form-control rtl mb-2"
                                                        value="{{ $option->ar_answar }}"
                                                        placeholder="{{ __('admin.Arabic Answer') }} '{{ $key + 1 }}'"
                                                        name="ar_options[]" id="">
                                                    <input type="text" required="required" class="form-control rtl"
                                                        value="{{ $option->ur_answar }}"
                                                        placeholder="{{ __('admin.Urdu Answer') }} '{{ $key + 1 }}'" name="ur_options[]"
                                                        id="">
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- course about -->

                    <!-- course lesson -->
                    <div class="course__lesson d-flex justify-content-end wow animate__animated animate__fadeInUp">
                        <div class="add__course__lesson">
                            <button type="submit" class="btn add__course me-2">{{ __('admin.Update') }}</button>
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

@section('js')
    <script>
        var currentValue = $('#radio-value').val();

        function addanswer() {
            console.log(currentValue);
            currentValue++;

            $('#answer_type').prop('disabled', 'disabled');
            var output =
                '<div class="customradiocontainer">' +
                '<div class="radio">' +
                '<input id="radio-' + currentValue + '" name="correct_answers[]" checked value="' + currentValue +
                '" type="radio">' +
                '<label for="radio-' + currentValue + '" class="radio-label">' +
                '<div class="inner__label">' +
                '<input type="text" required="required" class="form-control ltr border-0 w-100" placeholder="{{ __('admin.Answer') }}' +
                currentValue + '" name="options[]" id="">' +
                '</div>' +
                '</label>' +
                '<div class="others__inputs my-3">' +
                '<input type="text" required="required" class="form-control rtl mb-2" placeholder="{{ __('admin.Arabic Answer') }} ' +
                currentValue + '" name="ar_options[]" id="">' +
                '<input type="text" required="required" class="form-control rtl" placeholder="{{ __('admin.Urdu Answer') }} ' + currentValue +
                '" name="ur_options[]" id="">' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>';

            $("#getanswer").append(output);
        }

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#blah')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>


    <script>
        $(document).ready(function() {
            $('#question__list').summernote({
                placeholder: 'Lorem ipsum dolor sit.',
                tabsize: 2,
                height: 100
            });
        });
    </script>
@endsection

@endsection
