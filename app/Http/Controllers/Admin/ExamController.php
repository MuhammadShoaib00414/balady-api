<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Answar;
use DB;

class ExamController extends Controller
{
    public function index()
    {
        return view("backend.{$this->redirectUrl()}exam.index");
    }



    public function getExam(Request $request)
    {
        $exams = Question::query()
                    ->where('type',($request->type == 'mumtathil') ? 'mumtathil' : 'balady')
                     ->where('title', 'Like', '%' . request('key') . '%')
                    ->with('options')
                    ->get();

        if (count($exams) > 0) {
            foreach ($exams as $key => $exam) {
                $output[] = ' <div class="inner_lesson_card align-items-baseline">
                <div class="">
                <div class="lesson__title">

                    <div class="ms-4">
                    <p class="lesson__title">' . ($key + 1) . ' : ' . $exam->{Langkeyword() . 'title'} . '</p>
                    </div>
                </div>
                <div class="mt-3">
                    <ol type="a">';
                if (count($exam->options) > 0) {
                    foreach ($exam->options as $key => $option) {
                        if (isset($option->answar)) {
                            if ($option->correct == 1) {
                                $output[] = '<li>' . $option->{Langkeyword() . 'answar'} . '<span><i class="fa fa-check ms-2" aria-hidden="true"></i></span></li>';
                            } else {
                                $output[] = '<li>' . $option->{Langkeyword() . 'answar'} . '</li>';
                            }
                        } else {
                            if ($option->correct == 1) {
                                $output[] = '<li><img src="' . asset($option->image) . '" width="200px" height="175px" alt=""><span><i class="fa fa-check ms-2" aria-hidden="true"></i></span></li>';
                            } else {
                                $output[] = '<li><img src="' . asset($option->image) . '" width="200px" height="175px" alt=""></li>';
                            }
                        }
                    }
                } else {
                    $output[] = "<span>Exam Option not Found</span><br>";
                }


                $output[] = '</ol>
                </div>
                </div>
                <div class="">
                <a href="' . route('admin.exam.delete', [$exam->id,'type' => ($request->type == "mumtathil") ? 'mumtathil' : '']) . '" style="color:red"><i class="fa fa-trash" aria-hidden="true"></i> ' . __('admin.Delete') . '</a>
                <a href="' . route('admin.exam.edit', [$exam->id,'type' => ($request->type == "mumtathil") ? 'mumtathil' : '']) . '" ><i class="fas fa-edit"></i> ' . __('admin.Edit') . '</a>
                </div>
            </div><br><br>';
            }
        } else {
            $output[] = "<span style='color:red'>Exam Not Found</span><br>";
        }
        return $output;
    }


    private function redirectUrl()
    {
        return  (request('type') == 'mumtathil') ? 'Mumtathil_' : '';
    }

    public function create()
    {
        return view("backend.{$this->redirectUrl()}exam.create");
    }


    public function edit($id)
    {
        try {
            $question = Question::where('id', $id)->with('options')->first();
            return view("backend.{$this->redirectUrl()}exam.edit", [
                'question' => $question,
            ]);
        } catch (\Exception $e) {
            return view('errors.404');
        }
    }



    public function store(Request $request)
    {
        $this->validate($request, [
            'title'         => 'required|string|max:255',
            'ar_title'      => 'required|string|max:255',
            'ur_title'      => 'required|string|max:255',
            'option_type'   => 'required|string|max:255',
            'question_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            "options"       =>  'required_if:option_type,==,text|array',
            "options.*"     => "required|string",
            "ar_options"    => 'required_if:option_type,==,text|array',
            "ar_options.*"  => "required|string",
            "ur_options"    => 'required_if:option_type,==,text|array',
            "ur_options.*"  => "required|string",
            "file_options"  =>  'required_if:option_type,==,file|array',
            'file_options.*' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        try {
            DB::transaction(function () use ($request) {

                $question = new Question();
                $question->quiz_id = 1;
                $question->title = $request->title;
                $question->type = ($request->type == "mumtathil") ? 'mumtathil' : 'balady';
                $question->ar_title = $request->ar_title;
                $question->ur_title = $request->ur_title;

                if ($request->file('question_image')) {
                    $dir = 'uploads/';
                    $file = $request->file('question_image');
                    $name = sha1(microtime()) . "." . $file->extension();
                    $file->move($dir, $name);
                    $question->question_image = $dir . $name;
                }

                $question->number_of_option = (count($request->options ?? $request->file_options));
                $question->save();

                if ($question) {
                    if ($request->options > 0) {
                        foreach ($request->options as $key => $value) {
                            $answars = new Answar();
                            $answars->question_id = $question->id;
                            $answars->answar = $value;
                            $answars->type = $request->option_type;
                            $answars->ar_answar = $request['ar_options'][$key];
                            $answars->ur_answar = $request['ur_options'][$key];

                            foreach ($request->correct_answers as $values) {
                                if ($key ==  $values - 1) {
                                    $answars->correct = true;
                                }
                            }

                            $answars->save();
                        }
                    } else {

                        if ($request->file('file_options')) {
                            $arr = [];
                            foreach ($request->file('file_options') as $key => $file) {

                                $answars = new Answar();
                                $answars->question_id = $question->id;
                                $answars->type = $request->option_type;

                                if ($request->file('file_options')[$key]) {
                                    $dir = 'uploads/';
                                    $file = $request->file('file_options')[$key];
                                    $name = sha1(microtime()) . "." . $file->extension();
                                    $file->move($dir, $name);
                                    $answars->image = $dir . $name;
                                }

                                foreach ($request->correct_answers as $values) {
                                    if ($key == $values - 1) {
                                        $answars->correct = true;
                                    }
                                }

                                $answars->save();
                            }
                        }
                    }
                }
            });


            return redirect()
                    ->route('admin.exam.index',($request->type == "mumtathil") ? ['type' => 'mumtathil'] : '')
                    ->with('message', 'Question Save Succussfully');
        } catch (\Exception $e) {
            return $e->getMessage();
            return redirect()->back()->with('error', "SomeThing Wrong Please Fill All Input");
        }
    }



    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|string|max:255',
            'ar_title' => 'required|string|max:255',
            'ur_title' => 'required|string|max:255',
            'question_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'option_type' => 'nullable|string|max:255',
            "options"    =>  'required_if:option_type,==,text|array',
            "options.*"  => "required|string",
            "ar_options"    => 'required_if:option_type,==,text|array',
            "ar_options.*"  => "required|string",
            "ur_options"    => 'required_if:option_type,==,text|array',
            "ur_options.*"  => "required|string",
            "file_options"    =>  'required_if:option_type,==,file|array',
            'file_options.*'     => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        try {
            DB::transaction(function () use ($request, $id) {

                $question = Question::findOrFail($id);
                $question->quiz_id = 1;
                $question->title = $request->title;
                $question->ar_title = $request->ar_title;
                $question->ur_title = $request->ur_title;

                if ($request->file('question_image')) {
                    $dir = 'uploads/';
                    $file = $request->file('question_image');
                    $name = sha1(microtime()) . "." . $file->extension();
                    $file->move($dir, $name);
                    $question->question_image = $dir . $name;
                }

                $question->number_of_option = (count($request->options ?? $request->file_options));
                $question->update();


                if ($question) {

                    Answar::where('question_id', $id)->delete();

                    if ($request->options > 0) {
                        foreach ($request->options as $key => $value) {
                            $answars = new Answar();
                            $answars->question_id = $question->id;
                            $answars->answar = $value;
                            $answars->type = $request->option_type;
                            $answars->ar_answar = $request['ar_options'][$key];
                            $answars->ur_answar = $request['ur_options'][$key];

                            foreach ($request->correct_answers as $values) {
                                if ($key ==  $values - 1) {
                                    $answars->correct = true;
                                }
                            }

                            $answars->save();
                        }
                    } else {

                        if ($request->file('file_options')) {
                            $arr = [];
                            foreach ($request->file('file_options') as $key => $file) {

                                $answars = new Answar();
                                $answars->question_id = $question->id;
                                $answars->type = $request->option_type;

                                if ($request->file('file_options')[$key]) {
                                    $dir = 'uploads/';
                                    $file = $request->file('file_options')[$key];
                                    $name = sha1(microtime()) . "." . $file->extension();
                                    $file->move($dir, $name);
                                    $answars->image = $dir . $name;
                                }

                                foreach ($request->correct_answers as $values) {
                                    if ($key == $values - 1) {
                                        $answars->correct = true;
                                    }
                                }

                                $answars->save();
                            }
                        }
                    }
                }
            });
            return redirect()
                    ->route('admin.exam.index',($request->type == "mumtathil") ? ['type' => 'mumtathil'] : '')
                    ->with('message', 'Question Save Succussfully');

        } catch (\Exception $e) {
            return $e->getMessage();
            return redirect()->back()->with('error', "Error SomeThing Wrong!!");
        }
    }



    public function delete($id)
    {
        try {
            $table = Question::findOrFail($id);
            $table->delete();
            return redirect()->back()->with('message', 'Question Delete Succussfully');
        } catch (\Exception $e) {
            return view('errors.404');
        }
    }
}
