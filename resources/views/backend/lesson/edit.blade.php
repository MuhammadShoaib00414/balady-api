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
                        <li class="breadcrumb-item active" aria-current="page">{{ __('admin.Update Lesson') }}</li>
                    </ol>
                </nav>
                <!-- breadcrumbs -->
                <form action="{{ route('admin.lesson.update', $lesson->id) }}" method="POST" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="dropcoursehere wow animate__animated animate__fadeInUp">
                        <div class="inner__dropfilebox">
                            <img id="blah" src="{{ asset($lesson->thumbnail) }}" />
                            <div class="drop__here">
                                <div class="edit__button">
                                    <button type="button" class="btn btn-primary"><i class="fa fa-pencil-alt"
                                            aria-hidden="true"></i>
                                        {{ __('admin.Upload Image') }}</button>
                                </div>
                            </div>
                            <input type='file' class="h-full w-full opacity-0" name="thumbnail"
                                onchange="readURL(this);" />

                            @error('thumbnail')
                                <span class="error_alert">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- course header -->
                    <div class="course__header wow animate__animated animate__fadeInUp">
                        <p class="course__title flex-fill">{{ __('admin.Update Lesson') }}</p>
                    </div>
                    <!-- course header -->
                    <!-- course about -->
                    <div class="course__about wow animate__animated animate__fadeInUp">

                        <div class="mb-3">
                            <label for="course-title" class="form-label">{{ __('admin.Select Section') }}</label>
                            <select type="text" class="form-select" name="section_id">
                                <option value="" selected>{{ __('admin.Select Section') }}</option>
                                @foreach ($sections as $section)
                                    @if (old('section_id') == $section->id || $lesson->section_id == $section->id)
                                        <option selected value="{{ $section->id }}">
                                            {{ $section->{Langkeyword() . 'name'} }}</option>
                                    @else
                                        <option value="{{ $section->id }}">{{ $section->{Langkeyword() . 'name'} }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>

                            @error('section_id')
                                <span class="error_alert">{{ $message }}</span>
                            @enderror

                        </div>

                        <div class="mb-3">
                            <label for="course-title" class="form-label">{{ __('admin.Title') }}</label>
                            <input type="text" name="title" value="{{ $lesson->title }}" class="form-control ltr"
                                id="course-title">
                            @error('title')
                                <span class="error_alert">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="course-title" class="form-label">{{ __('admin.Arabic Title') }}</label>
                            <input type="text" name="ar_title" value="{{ $lesson->ar_title }}" class="form-control rtl"
                                id="course-title">
                            @error('ar_title')
                                <span class="error_alert">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="course-title" class="form-label">{{ __('admin.Urdu Title') }}</label>
                            <input type="text" name="ur_title" value="{{ $lesson->ur_title }}" class="form-control rtl"
                                id="course-title">
                            @error('ur_title')
                                <span class="error_alert">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">{{ __('admin.Summary') }}</label>
                            <textarea id="summary" name="summary"> {{ $lesson->summary }}</textarea>
                        </div>

                        @error('summary')
                            <span class="error_alert">{{ $message }}</span>
                        @enderror

                        <div class="mb-3">
                            <label for="" class="form-label">{{ __('admin.Arabic Summary') }}</label>
                            <textarea id="ar_summary" name="ar_summary">{{ $lesson->ar_summary }}</textarea>
                        </div>

                        @error('ar_summary')
                            <span class="error_alert">{{ $message }}</span>
                        @enderror

                        <div class="mb-3">
                            <label for="" class="form-label">{{ __('admin.Urdu Summary') }}</label>
                            <textarea id="ur_summary" name="ur_summary">{{ $lesson->ur_summary }}</textarea>
                        </div>

                        @error('ur_summary')
                            <span class="error_alert">{{ $message }}</span>
                        @enderror

                        <div class="mb-3">
                            <label for="course-title" class="form-label">{{ __('admin.File Type') }}</label>
                            <select type="text" class="form-select" onchange="fileType(this.value)" name="type">
                                <option value="" selected>{{ __('admin.Select Type') }}</option>
                                <option @if ($lesson->type == 'other-img') selected @else @endif value="other-img">
                                    {{ __('admin.Image') }}
                                </option>
                                <option @if ($lesson->type == 'other-pdf') selected @else @endif value="other-pdf">
                                    {{ __('admin.Pdf') }}
                                </option>
                            </select>

                            @error('type')
                                <span class="error_alert">{{ $message }}</span>
                            @enderror

                        </div>
                        <div class="my-5 video__droper"
                            @if ($lesson->type == 'other-img') @else style="display: none;" @endif id="imageFile">
                            <h3 class="my-4">{{ __('admin.Image') }}</h3>
                            <div class="row">
                                <div class="col-12 col-sm-4">
                                    <div class="dropcoursehere">
                                        <div class="inner__dropfilebox">
                                            <img id="ImageShowOne"
                                                src="{{ asset(@$lesson['images'][0]['image'] ?? 'assets/images/image_upload.png') }}" />
                                            <input type="hidden" name="image_id[]"
                                                value="{{ @$lesson['images'][0]['id'] }}">
                                            <div class="drop__here">
                                                <div class="edit__button">
                                                    <button type="button" class="btn btn-primary"><i
                                                            class="fa fa-pencil-alt" aria-hidden="true"></i>
                                                        upload</button>
                                                </div>
                                            </div>
                                            <input type='file' class="h-full w-full opacity-0" name="attachments[]"
                                                onchange="ImageUploadOne(this);" />
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <div class="dropcoursehere">
                                        <div class="inner__dropfilebox">
                                            <img id="ImageShowTwo"
                                                src="{{ asset(@$lesson['images'][1]['image'] ?? 'assets/images/image_upload.png') }}" />
                                            <input type="hidden" name="image_id[]"
                                                value="{{ @$lesson['images'][1]['id'] }}">
                                            <div class="drop__here">
                                                <div class="edit__button">
                                                    <button type="button" class="btn btn-primary"><i
                                                            class="fa fa-pencil-alt" aria-hidden="true"></i>
                                                        upload</button>
                                                </div>
                                            </div>
                                            <input type='file' name="attachments[]" class="h-full w-full opacity-0"
                                                onchange="ImageUploadTwo(this);" />

                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <div class="dropcoursehere">
                                        <div class="inner__dropfilebox">
                                            <img id="ImageShowThree"
                                                src="{{ asset(@$lesson['images'][2]['image'] ?? 'assets/images/image_upload.png') }}" />
                                            <input type="hidden" name="image_id[]"
                                                value="{{ @$lesson['images'][2]['id'] }}">
                                            <div class="drop__here">
                                                <div class="edit__button">
                                                    <button type="button" class="btn btn-primary"><i
                                                            class="fa fa-pencil-alt" aria-hidden="true"></i>
                                                        upload</button>
                                                </div>
                                            </div>
                                            <input type='file' name="attachments[]" class="h-full w-full opacity-0"
                                                onchange="ImageUploadThree(this);" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="" @if ($lesson->type == 'other-pdf') @else style="display: none;" @endif
                            id="pdfFile">
                            <h3 class="my-4">{{ __('admin.Pdf') }}</h3>
                            <div class="row">
                                <input type='file' name="file" />
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        <!-- course about -->

        <!-- course lesson -->
        <div class="course__lesson d-flex justify-content-end wow animate__animated animate__fadeInUp">
            <div class="add__course__lesson">
                <button type="submit" class="btn add__course me-2">{{ __('admin.Update Lesson') }}</button>
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


        function ImageUploadOne(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#ImageShowOne')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }



        function ImageUploadTwo(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#ImageShowTwo')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        function ImageUploadThree(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#ImageShowThree')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }



        function fileType(fileType) {
            if (fileType == "other-img") {
                $('#pdfFile').css('display', 'none');
                $('#imageFile').css('display', 'block');
            } else if (fileType == "other-pdf") {
                $('#imageFile').css('display', 'none');
                $('#pdfFile').css('display', 'block');
            } else {
                $('#pdfFile').css('display', 'none');
                $('#imageFile').css('display', 'none');
            }
        }
    </script>

    <script>
        $(document).ready(function() {


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
