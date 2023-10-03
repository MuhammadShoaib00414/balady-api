<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Section;
use Auth;
class SectionController extends Controller
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
        return view('backend.section.create',[
            'course_id' => $id,
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
            'course_id' => 'required',
            'name' => 'required|max:255',
            'ar_name' => 'required|max:255',
            'ur_name' => 'required|max:255'
        ]);

        $table =new Section();
        $table->course_id = $request->course_id;
        $table->name = $request->name;
        $table->ur_name = $request->ur_name;
        $table->ar_name = $request->ar_name;
        $table->save();


        activity()
        ->performedOn($table)
        ->causedBy(Auth::user())
        ->log('Section Add');

        return redirect(route('admin.course.edit',$request->course_id))->with('message','Section Save Succussfully');

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
    try{
        return view('backend.section.edit',[
            'section' => Section::findOrFail($id)
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
            'name' => 'required|max:255',
            'ar_name' => 'required|max:255',
            'ur_name' => 'required|max:255'
        ]);

        try{

        $table =Section::findOrFail($id);
        $table->name = $request->name;
        $table->ur_name = $request->ur_name;
        $table->ar_name = $request->ar_name;
        $table->update();

        activity()
        ->performedOn($table)
        ->causedBy(Auth::user())
        ->log('Section Update');

        return redirect(route('admin.course.edit',$table->course_id))->with('message','Section Update Succussfully');


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

    public function delete($id)
    {
        try{
        $table = Section::findOrFail($id);
        $table->delete();

        activity()
        ->performedOn($table)
        ->causedBy(Auth::user())
        ->log('Section Delete');
        return redirect()->back()->with('message','Section Delete Succussfully');

    } catch (\Exception $e) {
        return view('errors.404');
    }
    }
}

