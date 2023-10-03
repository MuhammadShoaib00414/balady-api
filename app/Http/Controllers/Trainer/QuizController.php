<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Answar;
use App\Models\CourseQuestion;
use App\Models\CourseAnswar;
use DB;
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
    public function create()
    {
        //
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

    public function question(Request $request)
    {  

        $this->validate($request, [
            'title' => 'required|string|max:255',
            'ar_title' => 'required|string|max:255',
            'ur_title' => 'required|string|max:255',
            'number_of_options' => 'required',
        ]);
//        return $request;
        try {
        DB::transaction(function () use ($request) {
        $question = new Question();
        $question->quiz_id = 1;       
        $question->title = $request->title;
        $question->ar_title = $request->ar_title;
        $question->ur_title = $request->ur_title;

        if($request->file('question_image')){
            $dir = 'uploads/';
            $file = $request->file('question_image');
            $name = sha1(microtime()) . "." . $file->extension();
            $file->move($dir,$name);
            $question->question_image = $dir.$name;
           }

        $question->number_of_option=$request->number_of_options;
        $question->save();

        if ($question) {
            if($request->options > 0){
            foreach ($request->options as $key=>$value) {  
                $answars = new Answar();
                $answars->question_id = $question->id;
                $answars->answar=$value;
                $answars->type=$request->option_type;
                $answars->ar_answar=$request['ar_options'][$key];
                $answars->ur_answar=$request['ur_options'][$key];
            

                foreach ($request->correct_answers as $values) {
                    if($key==$values){
                        $answars->correct=true;
                    }
                }

                $answars->save();
            }
            }else{

                foreach ($request->total_options as $key=>$value) {  
                    $answars = new Answar();
                    $answars->question_id = $question->id;
                    $answars->type=$request->option_type;
                    
                    if($request->file('file_options')[$key]){
                        $dir = 'uploads/';
                        $file = $request->file('file_options')[$key];
                        $name = sha1(microtime()) . "." . $file->extension();
                        $file->move($dir,$name);
                        $answars->image = $dir.$name;
                       }
    
                    foreach ($request->correct_answers as $values) {
                        if($key==$values){
                            $answars->correct=true;
                        }
                    }
    
                    $answars->save();
                }


            }

        }
        });
        return redirect()->back()->with('message','Question Save Succussfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error',"SomeThing Wrong Please Fill All Input");
        }        
    }



    public function course_test(Request $request)
    {  
    
        $this->validate($request, [
            'title' => 'required|string|max:255',
            'ar_title' => 'required|string|max:255',
            'ur_title' => 'required|string|max:255',
            'number_of_options' => 'required',
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

        if ($question) {
            foreach ($request->options as $key=>$value) {  
                $answars = new CourseAnswar();
                $answars->course_question_id = $question->id;
                $answars->answar=$value;
                $answars->ar_answar=$request['ar_options'][$key];
                $answars->ur_answar=$request['ur_options'][$key];

                foreach ($request->correct_answers as $values) {
                    if($key==$values){

                        $answars->correct=true;
                    }
                }
                $answars->save();
            }
        }
        });
        return redirect()->back()->with('message','Add Test Save Succussfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error',"SomeThing Wrong Please Fill All Input");
        }        
    }

    public function delete_course_test($id){
        $table=CourseQuestion::find($id);
        $table->delete();
        return redirect()->back()->with('message','Acknowledge Test Delete Succussfully');
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
        ]);

        try {
        DB::transaction(function () use ($request,$id) {
        $question =CourseQuestion::find($id);
        $question->course_id = $request->course_id;       
        $question->title = $request->title;
        $question->ar_title = $request->ar_title;
        $question->ur_title = $request->ur_title;

        if(isset($request->number_of_options)){
            $question->number_of_option=$request->number_of_options;
        }

        $question->update();

        if (isset($request->number_of_options)) {
            CourseAnswar::where('course_question_id',$id)->delete();
            foreach ($request->options as $key=>$value) {  
                $answars = new CourseAnswar();
                $answars->course_question_id = $question->id;
                $answars->answar=$value;
                $answars->ar_answar=$request['ar_options'][$key];
                $answars->ur_answar=$request['ur_options'][$key];

                foreach ($request->correct_answers as $values) {
                    if($key==$values){

                        $answars->correct=true;
                    }
                }
                $answars->save();
            }
        }
        });
        return redirect()->back()->with('message','Update Succussfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error',"SomeThing Wrong Please Fill All Input");
        }        
    }


    
}
