<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Section;

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
    public function create()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
      */
      public function store(Request $request)
      {
          $this->validate($request, [
              'name' => 'required',
              'ar_name' => 'required',
              'ur_name' => 'required'
          ]);
          
          $table =new Section();
          $table->course_id = $request->course_id;
          $table->name = $request->name;
          $table->ur_name = $request->ur_name;
          $table->ar_name = $request->ar_name;
          $table->save();
          return redirect()->back()->with('message','Section Save Succussfully');
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
          $table = Section::find($id);
          $table->delete();
          return redirect()->back()->with('message','Section Delete Succussfully');
      }
  
  
      public function delete($id)
      {  
          $table = Section::find($id);
          $table->delete();
          return redirect()->back()->with('message','Section Delete Succussfully');
      }
  }
  
  