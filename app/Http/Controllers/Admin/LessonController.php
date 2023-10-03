<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lesson;
use App\Models\LessonImage;
use App\Models\Section;
use App\Helper\AssetHelper;
use Illuminate\Support\Facades\Storage;
use Auth;

class LessonController extends Controller
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
        try {
            return view('backend.lesson.create', [
                'course_id' => $id,
                'sections' => Section::where('course_id', $id)->get(),
            ]);
        } catch (\Exception $e) {
            return view('errors.404');
        }
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
            'section_id' => 'required',
            'course_id' => 'required|string|max:255',
            'summary' => 'required|string',
            'ar_summary' => 'required|string',
            'ur_summary' => 'required|string',
            'type' => 'required|string',
            "attachments"    =>  'required_if:type,==,other-img|array',
            'attachments.*'     => 'required_if:type,==,other-img|image|mimes:jpeg,png,jpg|max:2048',
            'file'     => 'required_if:type,==,other-pdf|mimes:pdf',
            'thumbnail'     => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $table = new Lesson();
        $table->title = $request->title;
        $table->ar_title = $request->ar_title;
        $table->ur_title = $request->ur_title;
        $table->course_id = $request->course_id;
        $table->section_id = $request->section_id;
        $table->type = $request->type;
        $table->vedio_type = $request->vedio_type;
        $table->vedio_url = $request->video_url;
        $table->duration = $request->duration;

        if ($request->file('thumbnail')) {
            $dir = 'uploads/';
            $file = $request->file('thumbnail');
            $name = sha1(microtime()) . "." . $file->extension();
            $file->move($dir, $name);
            $table->thumbnail = $dir . $name;
        }
        if ($request->file('file')) {
            $dir = 'uploads/';
            $file = $request->file('file');
            $name = sha1(microtime()) . "." . $file->extension();
            $file->move($dir, $name);
            $table->file = $dir . $name;
        }




        $table->summary = $request->summary;
        $table->ar_summary = $request->ar_summary;
        $table->ur_summary = $request->ur_summary;
        $table->save();


        if (is_countable($request->attachments) && count($request->attachments) > 0) {
            if (count($request->attachments) > 0) {
                foreach ($request->attachments as $attachment) {

                    $table->images()->create([
                        'image' => AssetHelper::FileSave($attachment, 'lesson')
                    ]);
                }
            }
        }

        activity()
            ->performedOn($table)
            ->causedBy(Auth::user())
            ->log('Lesson Add');

        return redirect(route('admin.course.edit', $request->course_id))->with('message', 'Section Save Succussfully');
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
        try {
            $lesson = Lesson::with('images')->where('id', $id)->first();
            return view('backend.lesson.edit', [
                'lesson'   => $lesson,
                'sections' => Section::where('course_id', $lesson->course_id)->get(),
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
        // return $request;
        // dd($request);
        $this->validate($request, [
            'title' => 'required|string|max:255',
            'ar_title' => 'required|string|max:255',
            'ur_title' => 'required|string|max:255',
            'section_id' => 'required',
            'summary' => 'required|string',
            'ar_summary' => 'required|string',
            'ur_summary' => 'required|string',
            'type' => 'required|string',
        ]);


        try {

            $table = Lesson::findOrFail($id);
            $table->title = $request->title;
            $table->ar_title = $request->ar_title;
            $table->ur_title = $request->ur_title;
            $table->type = $request->type;
            $table->vedio_type = $request->vedio_type;
            $table->vedio_url = $request->video_url;
            $table->duration = $request->duration;

            if ($request->file('thumbnail')) {
                $dir = 'public/uploads/';
                $file = $request->file('thumbnail');
                $name = sha1(microtime()) . "." . $file->extension();
                $file->move($dir, $name);
                $table->thumbnail = $dir . $name;
            }

            if ($request->file('file')) {
                $dir = 'uploads/';
                $file = $request->file('file');
                $name = sha1(microtime()) . "." . $file->extension();
                $file->move($dir, $name);
                $table->file = $dir . $name;
            }


            $table->summary = $request->summary;
            $table->ar_summary = $request->ar_summary;
            $table->ur_summary = $request->ur_summary;
            $table->update();

            if (is_countable($request->attachments) && count($request->attachments) > 0) {
                if (count($request->attachments) > 0) {
                    foreach ($request->attachments as $key => $attachment) {
                        if(isset($request['image_id'][$key])){
                            $lessonImage = LessonImage::findOrFail($request['image_id'][$key]);
                            $lessonImage->image = AssetHelper::FileSave($attachment, 'lesson');
                            $lessonImage->update();
                        }else{
                            LessonImage::create([
                                'lesson_id' => $id,
                                'image'     => AssetHelper::FileSave($attachment, 'lesson'),
                            ]);
                        }
                    }
                }
            }


            activity()
                ->performedOn($table)
                ->causedBy(Auth::user())
                ->log('Lesson Update');

            return redirect(route('admin.course.edit', $table->course_id))->with('message', 'Lesson Update Succussfully');
        } catch (\Exception $e) {
            return $e->getMessage();
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
    }


    public function delete($id)
    {
        try {
            $table = Lesson::findOrFail($id);
            $table->delete();


            activity()
                ->performedOn($table)
                ->causedBy(Auth::user())
                ->log('Lesson Delete');
            return redirect()->back()->with('message', 'Lesson Delete Succussfully');
        } catch (\Exception $e) {
            return view('errors.404');
        }
    }
}
