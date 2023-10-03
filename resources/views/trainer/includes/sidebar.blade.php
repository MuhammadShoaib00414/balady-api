<div class="col-2 px-0 position-fixed" id="sticky-sidebar">
  <!-- Sidebar header -->
  <div class="m-sm-3">
    <div class="d-flex justify-content-end">
      <p class="arabic__lang">العربية</p>
    </div>

    {{-- <div class="d-flex justify-content-end">
        <p class="arabic__lang">Logout</p>
      </div> --}}
    <div class="user__profile">
      <img src="{{asset(Auth::user()->image)}}" class="user__profile" alt="user profile">
      <p>welcome, <span class="active__user">{{Auth::user()->first_name}}</span></p>
    </div>
  </div>
  <!-- Sidebar header -->
  <div class="nav__items text-white">
    <a href="index.html" class="nav-link active-menu">dashboard</a>
    <a href="{{route('admin.category.index')}}" class="nav-link">Categories</a>
    <a href="{{route('admin.course.index')}}" class="nav-link">courses</a>
    <a href="{{route('admin.activity.index')}}" class="nav-link">audit trail</a>
    <a href="{{route('admin.exam.index')}}" class="nav-link">Exam</a>
    <a href="{{route('admin.subadmin.index')}}" class="nav-link">Sub Admin</a>
    <a href="{{route('admin.trainer.index')}}" class="nav-link">Trainer</a>
    <a href="{{route('admin.student.index')}}" class="nav-link">Students</a>
    <a href="{{route('admin.certificate.index')}}" class="nav-link">Certificate</a>
    <a href="{{route('admin.profile')}}" class="nav-link">profile</a>
  </div>
</div>
