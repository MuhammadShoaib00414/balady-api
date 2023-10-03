<section class="page-header-area my-course-area rtl_localize">
    <div class="container-xl">
      <div class="row">
        <div class="d-none d-sm-block" id="admin">
            <!--- Sidemenu -->
            <ul class="metismenu side-nav side-nav-light">
                
                
                <li class="side-nav-item active">
                    <a href="{{route('admin.index')}}" class="side-nav-link">
                        
                        <span><i class="fas fa-home"></i></span>
                    </a>
                </li>

               

                <li class="side-nav-item">
                    <a href="{{route('admin.category.index')}}" class="side-nav-link ">
                        
                        <span>{{__('admin.Course categories')}}</span>
                    </a>
                </li>

                <li class="side-nav-item">
                    <a href="{{route('admin.course.index')}}" class="side-nav-link">
                        
                        <span>{{__('admin.Courses')}}</span>
                    </a>
                </li>


                <li class="side-nav-item">
                    <a href="{{route('admin.exam.index')}}" class="side-nav-link">
                        
                        <span>{{__('admin.Final Exam')}}</span>

                    </a>
                </li>

                <li class="side-nav-item">
                    <a href="{{route('admin.subadmin.index')}}" class="side-nav-link">                        

                        <span>{{__('admin.BA Admin')}}</span>
                    </a>
                </li>
                

                <li class="side-nav-item">
                    <a href="{{route('admin.trainer.index')}}" class="side-nav-link">
                        
                        <span>{{__('admin.Trainer')}}</span>
                    </a>
                </li>


                 <li class="side-nav-item">
                        <a href="{{route('admin.certificate.index')}}" class="side-nav-link ">
                            
                            <span>{{__('admin.Certificate')}}</span>
                        </a>
                </li>

            </ul>

        </div>
      </div>
    </div>
  </section>