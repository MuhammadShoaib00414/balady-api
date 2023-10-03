<?php

namespace App\Http\Controllers\Trainer;


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
    public function index()
    {
        return view('trainer.course.index',[
        'courses'=>Course::with('user')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('trainer.course.create',[
            'categories'=>Category::all(),
        ]);
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
            'outcomes'          => 'required',
            'course_thumbnail'  => 'required',
            'course_overview_url'             => 'required',
            'course_overview_url_ar'             => 'required',
            'course_overview_url_ur'             => 'required',
        ]);

    try {
        $course = new Course();
        $course->user_id = Auth::user()->id;
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

        if ($course) {
            
            foreach($request->outcomes as $key=>$outcome)
            {
                if($outcome){
                    $Courseoutcome =new CourseOutcome();
                    $Courseoutcome->course_id = $course->id;
                    $Courseoutcome->name = $outcome;
                    $Courseoutcome->ar_name = $request['ar_outcomes'][$key];
                    $Courseoutcome->ur_name = $request['ur_outcomes'][$key];
                    $Courseoutcome->save();
                }
            }

            $Coursemedia = new CourseMedia();
            $Coursemedia->course_id = $course->id;
            $Coursemedia->vedio_url = $request->course_overview_url;
            $Coursemedia->ar_vedio_url = $request->course_overview_url_ar;
            $Coursemedia->ur_vedio_url = $request->course_overview_url_ur;

            if($request->file('course_thumbnail')){
                $dir = 'uploads/';
                $file = $request->file('course_thumbnail');
                $name = sha1(microtime()) . "." . $file->extension();
                $file->move($dir,$name);
                $Coursemedia->thumbnail = $dir.$name;
               
            }
                $Coursemedia->save();
            Course::where("id", $course->id)->update(["is_completed" => true]);
            return redirect()->route('trainer.course.index')->with('message','Courses Save Succussfully');

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
    public function edit($id)
    {  
         return view('trainer.course.edit',[
            'course'=>Course::find($id),
            'course_test'=>CourseQuestion::with('CourseOptions')->where('course_id',$id)->get(),
            'sections'=>Section::with('lessons')->where('course_id',$id)->get(),
            'categories'=>Category::all(),
        ]);
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
            'title'                => 'required',
            'ar_title'             => 'required',
            'ur_title'             => 'required',
            'short_description'    => 'required',
            'ar_short_description' => 'required',
            'ur_short_description' => 'required',
            'description'          => 'required',
            'ar_description'          => 'required',
            'ur_description'          => 'required',
            'category_id'                     => 'required',
            'outcomes'                        => 'required',
            'course_overview_url'             => 'required',
            'course_overview_url_ar'             => 'required',
            'course_overview_url_ur'             => 'required',
        ]);

        



        $course=Course::find($id);
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


        $Coursemedia =CourseMedia::where('course_id',$id)->first();
        $Coursemedia->course_id = $course->id;
        $Coursemedia->vedio_url = $request->course_overview_url;
        $Coursemedia->ar_vedio_url = $request->course_overview_url_ar;
        $Coursemedia->ur_vedio_url = $request->course_overview_url_ur;

        if($request->file('course_thumbnail')){
            $dir = 'uploads/';
            $file = $request->file('course_thumbnail');
            $name = sha1(microtime()) . "." . $file->extension();
            $file->move($dir,$name);
            $Coursemedia->thumbnail = $dir.$name;
           
        }

        $Coursemedia->update();
       

        
        $Courseoutcome = CourseOutcome::where('course_id',$id)->delete();

        if ($Courseoutcome) {
            foreach($request->outcomes as $key=>$outcome)
            {
                if($outcome){
                    $Courseoutcome =new CourseOutcome();
                    $Courseoutcome->course_id = $course->id;
                    $Courseoutcome->name = $outcome;
                    $Courseoutcome->ar_name = $request['ar_outcomes'][$key];
                    $Courseoutcome->ur_name = $request['ur_outcomes'][$key];
                    $Courseoutcome->save();
                }
            }
        }


        return redirect()->back()->with('message','Coourse Updated Succussfully');

    }
    

    public function requirment_row_delete($id)
    {

        $Courserequirement = CourseRequirement::find($id);
        $Courserequirement->delete();
        return redirect()->back()->with('message','Requiremnt Row Remove Succussfully');
    }


    public function outcome_row_delete($id)
    {
        $Courseoutcome = CourseOutcome::find($id);
        $Courseoutcome->delete();
        return redirect()->back()->with('message','Outcome Row  Remove Succussfully');
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
        return redirect()->route('trainer.course.index')->with('message','Course Remove Succussfully');
    }

    public function status($status,$id)
    {
        if($status==0){
            Course::where("id", $id)->update(["status" => "active"]);
        }else{
            Course::where("id", $id)->update(["status" => "deactive"]);
        }
        return redirect()->route('trainer.course.index')->with('message','Course Status Change Succussfully');
    }

    public function delete($id)
    {
        $table = Course::find($id);
        $table->delete();
        return redirect()->back()->with('message','Course Delete Succussfully');
    }
}

