@extends('backend.includes.master')

@section('content')

{{-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif --}}

<!-- courses section -->
<div class="course__template">
    <div class="course__search__field justify-content-between align-items-center mb-5">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb wow animate__ animate__fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
                <li class="breadcrumb-item"><a href="#">{{ __('admin.Setting') }}</a></li>
            </ol>
        </nav>
    </div>
    <!-- courses section -->
    <!-- activity details -->
    <div class="profile__info__details wow animate__ animate__fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
        <div class="profile__information h-auto">
            <div class="row">

                <form method="POST" action="{{ route('admin.setting.update',['sso_config' => $sso->id,'crm_configuration' => $crm->id]) }}" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="row col-md-12">
                        <div class="col-6">
                            <div class="profile__fields">
                                <h2>SSO Configuration</h2>

                                <div class="mb-3 col-md-12">
                                    <label for="client_id" class="form-label">{{ __('admin.Client ID') }}</label>
                                    <input type="text" class="form-control ltr" id="client_id" maxlength="255" name="client_id" value="{{ $sso->client_id }}">
                                </div>

                                <div class="mb-3 col-md-12">
                                    <label for="client_secret" class="form-label">{{ __('admin.Client Secret') }}</label>
                                    <input type="text" class="form-control ltr" id="client_secret" maxlength="255" name="client_secret" value="{{ $sso->client_secret }}">
                                </div>

                                <div class="mb-3 col-md-12">
                                    <label for="redirect_url" class="form-label">{{ __('admin.Redirect Url') }}</label>
                                    <input type="text" class="form-control ltr" id="redirect_url" maxlength="255" name="redirect_url" value="{{ $sso->redirect_url }}">
                                </div>

                                <div class="mb-3 col-md-12">
                                    <label for="sso_url" class="form-label">{{ __('admin.Url') }}</label>
                                    <input type="text" class="form-control ltr" id="sso_url" maxlength="255" name="sso_url" value="{{ $sso->url }}">
                                </div>
                            </div>
                        </div>


                        <div class="col-6">
                            <div class="profile__fields">
                                <h2>Crm Configuration</h2>
                                <div class="mb-3 col-md-12">
                                    <label for="url" class="form-label">{{ __('admin.Url') }}</label>
                                    <input type="text" class="form-control ltr" id="url" maxlength="255" name="url" value="{{ $crm->url }}">
                                </div>

                                <div class="mb-3">
                                    <label for="user_name" class="form-label">{{ __('admin.User Name') }}</label>
                                    <input type="text" class="form-control ltr" maxlength="255" id="user_name" name="user_name" value="{{ $crm->user_name }}">
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">{{ __('admin.Password') }}</label>
                                    <input type="text" class="form-control ltr" maxlength="255" id="password" name="password" value="{{ $crm->password }}">
                                </div>

                                <div class="mb-3">
                                    <label for="grant_type" class="form-label">{{ __('admin.Grant Type') }}</label>
                                    <input type="text" class="form-control ltr" maxlength="255" id="grant_type" name="grant_type" value="{{ $crm->grant_type }}">
                                </div>

                                <div class="mb-3">
                                    <label for="pdf_url" class="form-label">{{ __('admin.Pdf Url') }}</label>
                                    <input type="text" class="form-control ltr" maxlength="255" id="pdf_url" name="pdf_url" value="{{ $crm->pdf_url }}">
                                </div>

                            </div>
                        </div>

                    </div>

                    <button type="submit" class="mt-4 btn btn-success">{{ __('admin.Submit') }}</button>

                </form>


            </div>

        </div>
    </div>
</div>



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


    $(document).ready(function() {

        $('#biography').summernote({
            placeholder: 'Enter Your BioGraphy',
            tabsize: 2,
            height: 100
        });



    });
</script>
@endsection
@endsection