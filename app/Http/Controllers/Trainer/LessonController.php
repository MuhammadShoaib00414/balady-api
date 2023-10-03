<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lesson;
use Illuminate\Support\Facades\Storage;

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
    public function create()
    {
       
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
        ]);

        $table=new Lesson();
        $table->title = $request->title;
        $table->ar_title = $request->ar_title;
        $table->ur_title = $request->ur_title;
        $table->course_id = $request->course_id;
        $table->section_id = $request->section_id;
        $table->type = $request->type;
        $table->vedio_type = $request->vedio_type;
        $table->vedio_url = $request->video_url;
        $table->duration = $request->duration;

        if($request->file('thumbnail')){
            $dir = 'public/uploads/';
            $file = $request->file('thumbnail');
            $name = sha1(microtime()) . "." . $file->extension();
            $file->move($dir,$name);
            $table->thumbnail = $dir.$name;
           }
        if($request->file('file')){
            $dir = 'uploads/';
            $file = $request->file('file');
            $name = sha1(microtime()) . "." . $file->extension();
            $file->move($dir,$name);
            $table->file = $dir.$name;
           }

           if($request->file('attachments')){
            $arr = [];
          foreach($request->file('attachments') as $file){
            $dir = 'uploads/';
           $name = sha1(microtime()) . "." . $file->extension();
           $file->move($dir,$name);
           array_push($arr,$dir.$name);
          }
          $table->file = json_encode($arr);
       }


        $table->summary = $request->summary;
        $table->ar_summary = $request->ar_summary;
        $table->ur_summary = $request->ur_summary;
        $table->save();

        return redirect()->back()->with('message','Lesson Save Succussfully');
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
        return response()->json(Lesson::find($id));
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
            'title' => 'required|string|max:255',
            'ar_title' => 'required|string|max:255',
            'ur_title' => 'required|string|max:255',
            'course_id' => 'required|string|max:255',
            'summary' => 'required|string',
            'ar_summary' => 'required|string',
            'ur_summary' => 'required|string',
        ]);

        $table=Lesson::find($id);
        $table->title = $request->title;
        $table->ar_title = $request->ar_title;
        $table->ur_title = $request->ur_title;
        $table->course_id = $request->course_id;
        $table->type = $request->type;
        $table->vedio_type = $request->vedio_type;
        $table->vedio_url = $request->video_url;
        $table->duration = $request->duration;

        if($request->file('thumbnail')){
            $dir = 'public/uploads/';
            $file = $request->file('thumbnail');
            $name = sha1(microtime()) . "." . $file->extension();
            $file->move($dir,$name);
            $table->thumbnail = $dir.$name;
           }

        if($request->file('file')){
            $dir = 'uploads/';
            $file = $request->file('file');
            $name = sha1(microtime()) . "." . $file->extension();
            $file->move($dir,$name);
            $table->file = $dir.$name;
           }

           if($request->file('attachments')){
            $arr = [];
          foreach($request->file('attachments') as $file){
            $dir = 'uploads/';
           $name = sha1(microtime()) . "." . $file->extension();
           $file->move($dir,$name);
           array_push($arr,$dir.$name);
          }
          $table->file = json_encode($arr);
       }


        $table->summary = $request->summary;
        $table->ar_summary = $request->ar_summary;
        $table->ur_summary = $request->ur_summary;
        $table->save();

        return redirect()->back()->with('message','Lesson Save Succussfully');
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
        $table = Lesson::find($id);
        $table->delete();
        return redirect()->back()->with('message','Lesson Delete Succussfully');
    }
}