<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Section;
use App\Models\Lesson;
use App\Models\Quiz;
use App\Models\Answar;
use App\Models\Question;
class FrontendController extends Controller
{
    public function course($id)
    {    
        return view('student.lesson',[
            'sections'=>Section::with('lessons')->with('quizzes')->where('course_id',$id)->get(),
            'course_id'=>$id
        ]);

    }

    public function lesson_detail($course_id,$lesson_id)
    {  
        return view('student.lesson',[
            'lesson'=>Lesson::where('id',$lesson_id)->first(),
            'sections'=>Section::with('lessons')->with('quizzes')->where('course_id',$course_id)->get(),
            'course_id'=>$course_id
        ]);
    }

    public function quiz_detail($course_id,$quiz_id)
    {
        return view('student.lesson',[
            'quizzes'=>Quiz::where('id',$quiz_id)->with('questions')->first(),
            'sections'=>Section::with('lessons')->with('quizzes')->where('course_id',$course_id)->get(),
            'course_id'=>$course_id
        ]);
    }


    public function check_result(Request $request)
    {
        foreach($request->question as $question)
        {
            foreach($request->answar as $key=>$answar)
            {
                if($key==$question)
                {
                    $correct_answar = Answar::where('question_id',$question)
                    ->where('id',$answar)
                    ->where('correct',1)
                    ->count()>0;                   
                    if($correct_answar==1){
                        $text_answar = "Answar Is Correct";
                    }else{
                            $text_answar = "Answar Is Wrong";
                    }

                    $answars[] =[
                            'answar' =>$text_answar,
                            'questions'=> Question::with('options')->where('id',$question)->first(),
                            'your_answar'=>Answar::where('id',$answar)->first()
                        ];
                        
                 }                               
            }
        }    
        return view('student.lesson',[
        'quiz_datas'=>$answars,
        'quiz_result'=>'quiz',
        'sections'=>Section::with('lessons')->with('quizzes')->where('course_id',$request->course_id)->get(),
        'course_id'=>$request->course_id
        ]);
    }
}
