
@extends('backend.includes.master')

@section('content')

<div class="col-10 offset-2" id="main__content">
	<div class="container">
		<div class="d-flex justify-content-end"> <img src="../assets/images/Balady-logo.png" class="img-fluid header__logo" alt="balady-logo"> </div>
		<!-- courses section -->
        @if(session()->has('message'))
        <div class="content">
          <div class="alert alert-success alert-white rounded">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <div class="icon"><i class="fa fa-check"></i></div>
            <strong>Success!</strong>  {{ session()->get('message') }}
        </div>
      </div>
      @endif

    <div class="course__template">
      <div class="course__search__field justify-content-between align-items-center mb-5 wow animate__animated animate__fadeInUp">
        <p class="course__title">Trainer</p>
        <div class="course__search__field mb-5">
            <div class="search__field">
                <div class="input-group"> </div>
            </div>
            <a type="button" href="{{route('admin.trainer.create')}}" class="btn add__course w-100"><i class="fa fa-plus" aria-hidden="true"></i>Add Trainer</a> </div>
    </div>

      </div>
      <!-- courses section -->
      <div class="balady__table wow animate__animated animate__fadeInUp">
        <table id="example" class="table" style="width:100%">
          <thead>
            <tr>
                <th>#</th>
                <th>User Name</th>
                <th>Email</th>
                <th >Phone Number</th>
                <th>Biography</th>
                <th>option</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($trainers as $key => $trainer)

            <tr class="odd">
                <td class="sorting_1">{{$key+1}}</td>
                <td>
                    <div class="user__profile"> <img src="../assets/images/user-profile.png" alt="">
                        <p>{{$trainer->first_name}} {{$trainer->last_name}}</p>
                    </div>
                </td>
                <td> {{$trainer->email}} </td>
                <td> {{$trainer->phone}} </td>
                <td> {!! $trainer->biography !!} </td>
                <td>
                    <div class="btn-group dropstart option__dropdown">
                        <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <svg id="Component_24_13" data-name="Component 24 – 13" xmlns="http://www.w3.org/2000/svg" width="59" height="32" viewBox="0 0 59 32">
                                <g id="Rectangle_422" data-name="Rectangle 422" fill="none" stroke="#aaa" stroke-width="2">
                                    <rect width="59" height="32" rx="9" stroke="none"></rect>
                                    <rect x="1" y="1" width="57" height="30" rx="8" fill="none"></rect>
                                </g>
                                <circle id="Ellipse_103" data-name="Ellipse 103" cx="3.431" cy="3.431" r="3.431" transform="translate(44.693 19.5) rotate(180)" fill="#aaa"></circle>
                                <circle id="Ellipse_104" data-name="Ellipse 104" cx="3.431" cy="3.431" r="3.431" transform="translate(33.714 19.5) rotate(180)" fill="#aaa"></circle>
                                <circle id="Ellipse_105" data-name="Ellipse 105" cx="3.431" cy="3.431" r="3.431" transform="translate(21.362 19.5) rotate(180)" fill="#aaa"></circle>
                            </svg>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="{{route('admin.trainer.show',$trainer->id)}}" class="dropdown-item" type="button">view</a></li>
                            <li><a  href="{{route('admin.trainer.edit',$trainer->id)}}" class="dropdown-item" type="button">Edit</a></li>
                            <li><a  href="{{route('admin.trainer.delete',$trainer->id)}}" class="dropdown-item data-delete" type="button">Delete</a></li>
                        </ul>
                    </div>
                </td>
            </tr>

        @endforeach
          </tbody>
        </table>
      </div>
    </div>
	</div>
</div>

  @section('js')

  <script>
    $(document).ready(function () {
      $('#example').DataTable();
    });
  </script>
  @endsection

@endsection
