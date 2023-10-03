<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\CourseRequirement;
use App\Models\CourseOutcome;
use App\Models\CourseMedia;
use App\Models\Section;
use App\Models\Category;
use App\Models\CourseQuestion;
use App\Models\CourseAnswar;
use Illuminate\Support\Facades\Storage;
use Auth;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view("backend.{$this->redirectUrl()}course.index", [
            'courses' => Course::query()
                ->with('user')
                ->get(),
        ]);
    }


    public function getCourse(Request $request)
    {

        $courses =  Course::query()
            ->where('type',($request->type == 'mumtathil') ? 'mumtathil' : 'balady')
            ->with('user', 'media')
            ->when(request('key'), function ($q) {
                $q->where('title', 'Like', '%' . request('key') . '%');
                $q->orwhere('short_description', 'Like', '%' . request('key') . '%');
            })->get();

        if (count($courses) > 0) {
            foreach ($courses as $course) {
                $output[] = '<div class="col-12 col-sm-4">
                    <a href="#">
                      <div class="course__card">
                        <div class="course__img">
                          <img src="' . asset($course->media->thumbnail) . '" class="img-fluid" alt="course--image">
                        </div>
                        <div class="course__content">
                          <div class="course__title">
                            <p>' . $course->{Langkeyword() . 'title'} . '</p>
                            <div class="nav-item dropdown dropstart option__dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                              <svg xmlns="http://www.w3.org/2000/svg" width="32.411" height="7.366" viewBox="0 0 32.411 7.366">
                                <g id="Component_24_49" data-name="Component 24 – 49" transform="translate(0)">
                                  <circle id="Ellipse_103" data-name="Ellipse 103" cx="3.683" cy="3.683" r="3.683" transform="translate(32.411 7.366) rotate(180)" fill="#84bc47"/>
                                  <circle id="Ellipse_104" data-name="Ellipse 104" cx="3.683" cy="3.683" r="3.683" transform="translate(20.625 7.366) rotate(180)" fill="#84bc47"/>
                                  <circle id="Ellipse_105" data-name="Ellipse 105" cx="3.683" cy="3.683" r="3.683" transform="translate(7.366 7.366) rotate(180)" fill="#84bc47"/>
                                </g>
                              </svg>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                              <li><a class="dropdown-item" href="' . route('admin.course.edit',[$course->id,'type' => ($request->type == "mumtathil") ? 'mumtathil' : '']) . '">Edit</a></li>
                              <li><a class="dropdown-item" href="' . route('admin.course.status', ['status' => $course->status, 'id' => $course->id,'type' => ($request->type == "mumtathil") ? 'mumtathil' : '']) . '">' . $course->status . '</a></li>
                              <li><a class="dropdown-item" href="' . route('admin.course.delete', [$course->id,'type' => ($request->type == "mumtathil") ? 'mumtathil' : '']) . '">Delete</a></li>
                            </ul>
                          </div>
                          </div>
                          <p>' . $course->{Langkeyword() . 'short_description'} . ' </p>
                        </div>
                      </div>
                    </a>
                  </div>';
            }
        } else {
            $output =  '<div class="content" style="width:50%">
                <div class="alert alert-danger alert-white rounded">
                    <div class="icon"><i class="fa fa-times-circle"></i></div>
                    <strong>Error!</strong>
                    Data Not Found.
                </div>
                </div>
            ';
        }

        return $output;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("backend.{$this->redirectUrl()}course.create", [
            'categories' => Category::all(),
        ]);
    }

    private function redirectUrl()
    {
        return  (request('type') == 'mumtathil') ? 'Mumtathil_' : '';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'              => 'required',
            'ar_title'              => 'required',
            'ur_title'              => 'required',
            'short_description' => 'required',
            'ar_short_description' => 'required',
            'ur_short_description' => 'required',
            'description' => 'required',
            'ar_description' => 'required',
            'ur_description' => 'required',
            'category_id'       => 'required',
            'outcome'          => 'required',
            'ar_outcome'          => 'required',
            'ur_outcome'          => 'required',
            'course_thumbnail'     => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'vedio_url'             => 'required',
            'ar_vedio_url'             => 'required',
            'ur_vedio_url'             => 'required',
        ]);

        try {
            $course = new Course();
            $course->user_id = Auth::user()->id;
            $course->title = $request->title;
            $course->ar_title = $request->ar_title;
            $course->ur_title = $request->ur_title;
            $course->type = ($request->type == "mumtathil") ? 'mumtathil' : 'balady';
            $course->category_id = $request->category_id;
            $course->ar_short_description = $request->ar_short_description;
            $course->ur_short_description = $request->ur_short_description;
            $course->short_description = $request->short_description;
            $course->description = $request->description;
            $course->ar_description = $request->ar_description;
            $course->ur_description = $request->ur_description;
            $course->save();

            if ($course) {
                $Courseoutcome = new CourseOutcome();
                $Courseoutcome->course_id = $course->id;
                $Courseoutcome->name = $request['outcome'];;
                $Courseoutcome->ar_name = $request['ar_outcome'];
                $Courseoutcome->ur_name = $request['ur_outcome'];
                $Courseoutcome->save();

                $Coursemedia = new CourseMedia();
                $Coursemedia->course_id = $course->id;
                $Coursemedia->vedio_url = $request->vedio_url;
                $Coursemedia->ar_vedio_url = $request->ar_vedio_url;
                $Coursemedia->ur_vedio_url = $request->ur_vedio_url;

                if ($request->file('course_thumbnail')) {
                    $dir = 'uploads/';
                    $file = $request->file('course_thumbnail');
                    $name = sha1(microtime()) . "." . $file->extension();
                    $file->move($dir, $name);
                    $Coursemedia->thumbnail = $dir . $name;
                }
                $Coursemedia->save();
                Course::where("id", $course->id)->update(["is_completed" => true]);

                activity()
                    ->performedOn($course)
                    ->causedBy(Auth::user())
                    ->log('Course Add');

        return redirect()
                ->route('admin.course.index',($request->type == "mumtathil") ? ['type' => 'mumtathil'] : '')
                ->with('message', 'Courses Save Succussfully');
            }
        } catch (\Throwable $th) {
            return $th;
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {

        try {
            $course = Course::with('user', 'media', 'outcome', 'sections', 'lessons', 'courseQuestion.CourseOptions')
                ->where('id', $course->id)
                ->first();
            $course_test =  CourseQuestion::with('CourseOptions')->where('course_id', $course->id)->get();
            $sections    =  Section::with('lessons')->where('course_id', $course->id)->get();
            $categories  =  Category::all();
            return view("backend.{$this->redirectUrl()}course.edit", [
                'course' => $course,
                'course_test' => $course_test,
                'sections' => $sections,
                'categories' => $categories,
            ]);
        } catch (\Exception $e) {
            return view('errors.404');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title'                   => 'required',
            'ar_title'                => 'required',
            'ur_title'                => 'required',
            'short_description'       => 'required',
            'ar_short_description'    => 'required',
            'ur_short_description'    => 'required',
            'description'             => 'required',
            'ar_description'          => 'required',
            'ur_description'          => 'required',
            'category_id'             => 'required',
            'outcome'          => 'required',
            'ar_outcome'          => 'required',
            'ur_outcome'          => 'required',
            'vedio_url'               => 'required',
            'ar_vedio_url'            => 'required',
            'ur_vedio_url'            => 'required',
            'course_thumbnail'     => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        try {

            $course = Course::findOrFail($id);
            $course->title = $request->title;
            $course->ar_title = $request->ar_title;
            $course->ur_title = $request->ur_title;
            $course->category_id = $request->category_id;
            $course->ar_short_description = $request->ar_short_description;
            $course->ur_short_description = $request->ur_short_description;
            $course->short_description = $request->short_description;
            $course->description = $request->description;
            $course->ar_description = $request->ar_description;
            $course->ur_description = $request->ur_description;
            $course->save();


            $Coursemedia = CourseMedia::where('course_id', $id)->first();
            $Coursemedia->course_id = $course->id;
            $Coursemedia->vedio_url = $request->vedio_url;
            $Coursemedia->ar_vedio_url = $request->ar_vedio_url;
            $Coursemedia->ur_vedio_url = $request->ur_vedio_url;

            if ($request->file('course_thumbnail')) {
                $dir = 'uploads/';
                $file = $request->file('course_thumbnail');
                $name = sha1(microtime()) . "." . $file->extension();
                $file->move($dir, $name);
                $Coursemedia->thumbnail = $dir . $name;
            }

            $Coursemedia->update();

            $Courseoutcome = CourseOutcome::where('course_id', $id)->first();
            $Courseoutcome->course_id = $course->id;
            $Courseoutcome->name = $request['outcome'];;
            $Courseoutcome->ar_name = $request['ar_outcome'];
            $Courseoutcome->ur_name = $request['ur_outcome'];
            $Courseoutcome->save();

            activity()
                ->performedOn($course)
                ->causedBy(Auth::user())
                ->log('Course Update');

            return redirect()->back()->with('message', 'Coourse Updated Succussfully');
        } catch (\Exception $e) {
            return view('errors.404');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $table = Course::find($id);
        $table->delete();
        return redirect()->route('admin.course.index',(request('type') == "mumtathil") ? ['type' => 'mumtathil'] : '')->with('message', 'Course Remove Succussfully');
    }

    public function status($status, $id)
    {
        if ($status == "deactive") {
            $table = Course::where("id", $id)->update(["status" => "active"]);
        } else {
            $table = Course::where("id", $id)->update(["status" => "deactive"]);
        }

        activity()
            ->performedOn(Course::findOrFail($id))
            ->causedBy(Auth::user())
            ->log('Course Status Update');

        return redirect()
        ->route('admin.course.index',(request('type') == "mumtathil") ? ['type' => 'mumtathil'] : '')
        ->with('message', 'Course Status Change Succussfully');
    }

    public function delete($id)
    {
        try {
            $table = Course::findOrFail($id);

            activity()
                ->performedOn($table)
                ->causedBy(Auth::user())
                ->log('Course Delete');

            $table->delete();
        } catch (\Exception $e) {
            return view('errors.404');
        }

        return redirect()->back()->with('message', 'Course Delete Succussfully');
    }

}
