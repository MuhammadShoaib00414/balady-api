
@extends('backend.includes.master')

@section('content')

    <!-- courses section -->
    <div class="course__template">
      <div class="course__search__field justify-content-between align-items-center mb-5 wow animate__animated animate__fadeInUp">
        <p class="course__title">{{ __('admin.Audit Trail') }}</p>
        <div class="search__field">
        </div>
      </div>
      <!-- courses section -->
      <div class="balady__table wow animate__animated animate__fadeInUp">
        <table id="example" class="table" style="width:100%">
          <thead>
            <tr>
              <th>#</th>
              <th>{{ __('admin.User') }}</th>
              <th>{{ __('admin.User Type') }}</th>
              <th>{{ __('admin.Date and Time') }}</th>
              <th>{{ __('admin.User Status') }}</th>
              <th>{{ __('admin.Subject Type') }}</th>
              <th>{{ __('admin.Subject Name') }}</th>
              <th>{{ __('admin.Activity') }}</th>
              {{-- <th>option</th> --}}
            </tr>
          </thead>
          <tbody>
            @foreach($activites as $activity)
            <tr>
              <td>{{$activity->id}}</td>
              <td>
                <div class="user__profile">
                  <img src="{{asset($activity->causer->image)}}" alt="">
                  <p>{{$activity->causer->first_name}} {{$activity->causer->last_name}}</p>
                </div>
              </td>
              <td>{{$activity->causer->roles[0]['name']}}</td>
              <td><div class="user__profile"><p>{{$activity->created_at}}</p></div></td>
              <td>
                <button type="button" class="btn user__status active__status">active</button>
              </td>

              <td>{{class_basename($activity->subject_type)}}</td>

              <td>{{class_basename($activity->subject->name ?? $activity->subject->title ?? "")}}</td>

              <td>{{$activity->description}}</td>
              {{-- <td>
                <div class="btn-group dropstart option__dropdown">
                  <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <svg id="Component_24_13" data-name="Component 24 – 13" xmlns="http://www.w3.org/2000/svg" width="59" height="32" viewBox="0 0 59 32">
                      <g id="Rectangle_422" data-name="Rectangle 422" fill="none" stroke="#aaa" stroke-width="2">
                        <rect width="59" height="32" rx="9" stroke="none"/>
                        <rect x="1" y="1" width="57" height="30" rx="8" fill="none"/>
                      </g>
                      <circle id="Ellipse_103" data-name="Ellipse 103" cx="3.431" cy="3.431" r="3.431" transform="translate(44.693 19.5) rotate(180)" fill="#aaa"/>
                      <circle id="Ellipse_104" data-name="Ellipse 104" cx="3.431" cy="3.431" r="3.431" transform="translate(33.714 19.5) rotate(180)" fill="#aaa"/>
                      <circle id="Ellipse_105" data-name="Ellipse 105" cx="3.431" cy="3.431" r="3.431" transform="translate(21.362 19.5) rotate(180)" fill="#aaa"/>
                    </svg>

                  </button>
                  <ul class="dropdown-menu">
                    <li><a href="activity-details.html" class="dropdown-item" type="button">more details</a></li>
                  </ul>
                </div>
              </td> --}}
            </tr>
            @endforeach
          </tbody>
        </table>
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
