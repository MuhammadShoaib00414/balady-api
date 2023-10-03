<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Answar;
use App\Models\CourseQuestion;
use App\Models\CourseAnswar;
use DB;
use Auth;
class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return view('backend.acknowledge.create',[
            'course_id' => $id
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
            'title' => 'required|string|max:255',
            'ar_title' => 'required|string|max:255',
            'ur_title' => 'required|string|max:255',
            'course_id' => 'required',
            'section_id' => 'required',
            'instruction' => 'required|string',
            'ar_instruction' => 'required|string',
            'ur_instruction' => 'required|string',
        ]);

        $table=new Quiz();
        $table->title = $request->title;
        $table->ar_title = $request->ar_title;
        $table->ur_title = $request->ur_title;
        $table->course_id = $request->course_id;
        $table->section_id = $request->section_id;
        $table->instruction = $request->instruction;
        $table->ar_instruction = $request->ar_instruction;
        $table->ur_instruction = $request->ur_instruction;
        $table->save();

        return redirect()->back()->with('message','Quiz Save Succussfully');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }



    public function edit_course_test($id)
    {
        return view('backend.acknowledge.edit',[
            'acknowledge' =>CourseQuestion::with('CourseOptions')->find($id),
        ]);
    }


    public function course_test(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|max:255',
            'ar_title' => 'required|string|max:255',
            'ur_title' => 'required|string|max:255',
            "options"    => "required|array",
            "options.*"  => "required|string",
            "ar_options"    => "required|array",
            "ar_options.*"  => "required|string",
            "ur_options"    => "required|array",
            "ur_options.*"  => "required|string",
        ]);


        try {
        DB::transaction(function () use ($request) {
        $question = new CourseQuestion();
        $question->course_id = $request->course_id;
        $question->title = $request->title;
        $question->ar_title = $request->ar_title;
        $question->ur_title = $request->ur_title;
        $question->number_of_option=$request->number_of_options;
        $question->save();

        activity()
        ->performedOn($question)
        ->causedBy(Auth::user())
        ->log('Add Course Acknowledge Test');

        if ($question) {
            foreach ($request->options as $key=>$value) {
                $answars = new CourseAnswar();
                $answars->course_question_id = $question->id;
                $answars->answar=$value;
                $answars->ar_answar=$request['ar_options'][$key];
                $answars->ur_answar=$request['ur_options'][$key];

                foreach ($request->correct_answers as $values) {
                    if($key==$values - 1){

                        $answars->correct=true;
                    }
                }
                $answars->save();

            }
        }
        });


        return redirect(route('admin.course.edit',$request->course_id))->with('message','Acknowledge Save Succussfully');

        } catch (\Exception $e) {
            return view('errors.404');
        }
    }

    public function delete_course_test($id){

        try{
        $table=CourseQuestion::findOrFail($id);
        $table->delete();

        activity()
        ->performedOn($table)
        ->causedBy(Auth::user())
        ->log('Delete Course Acknowledge Test');
        return redirect()->back()->with('message','Acknowledge Test Delete Succussfully');


    } catch (\Exception $e) {
        return view('errors.404');
    }
    }

    public function get_course_test($id){
        return response()->json(CourseQuestion::find($id));
    }




    public function update_course_test(Request $request,$id)
    {
        $this->validate($request, [
            'title' => 'required|string|max:255',
            'ar_title' => 'required|string|max:255',
            'ur_title' => 'required|string|max:255',
            "options"    => "required|array",
            "options.*"  => "required|string",
            "ar_options"    => "required|array",
            "ar_options.*"  => "required|string",
            "ur_options"    => "required|array",
            "ur_options.*"  => "required|string",
        ]);

        try {
        DB::transaction(function () use ($request,$id) {
        $question =CourseQuestion::findOrFail($id);
        $question->title = $request->title;
        $question->ar_title = $request->ar_title;
        $question->ur_title = $request->ur_title;
        $question->update();

        activity()
        ->performedOn($question)
        ->causedBy(Auth::user())
        ->log('Update Course Acknowledge Test');
        

            CourseAnswar::where('course_question_id',$id)->delete();
            foreach ($request->options as $key=>$value) {
                $answars = new CourseAnswar();
                $answars->course_question_id = $question->id;
                $answars->answar=$value;
                $answars->ar_answar=$request['ar_options'][$key];
                $answars->ur_answar=$request['ur_options'][$key];

                foreach ($request->correct_answers as $values) {
                    if($key==$values - 1){

                        $answars->correct=true;
                    }
                }
                $answars->save();
            }
        });

        return redirect(route('admin.course.edit',$request->course_id))->with('message','Acknowledge Update Succussfully');
        } catch (\Exception $e) {
            return view('errors.404');
        }
    }



}
