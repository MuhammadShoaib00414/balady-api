<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

            return view('backend.category.index');

    }

    public function getCategory(Request $request){

        $categories =  Category::where('name','Like','%'.request('key').'%')->get();

             if(count($categories) > 0){
                 foreach($categories as $category){
                     $output[] = '<div class="col-12 col-sm-4">
                     <a href="#">
                       <div class="course__card">
                         <div class="course__img">
                           <img src="'.asset($category->thumbnail).'" class="img-fluid" alt="course--image">
                         </div>
                         <div class="course__content">
                           <div class="course__title">
                             <p>'.$category->{Langkeyword().'name'}.'</p>
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
                               <li><a class="dropdown-item" href="'.route('admin.category.edit',$category->id).'">'.__('admin.Edit').'</a></li>
                               <li><a class="dropdown-item" href="'.route('admin.category.delete',$category->id).'">'.__('admin.Delete').'</a></li>
                             </ul>
                           </div>
                           </div>
                         </div>
                       </div>
                     </a>
                   </div>';
                 }

             }else{
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
     *
     *
     *
     */

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }


    public function create()
    {

        return view('backend.category.create');
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
            'name' => 'required',
            'ar_name' => 'required',
            'ur_name' => 'required',
            'category_thumbnail'     => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $table = new Category();
        $table->name = $request->name;
        $table->ar_name = $request->ar_name;
        $table->ur_name = $request->ur_name;

        if($request->file('category_thumbnail')){
            $dir = 'uploads/';
            $file = $request->file('category_thumbnail');
            $name = sha1(microtime()) . "." . $file->extension();
            $file->move($dir,$name);
            $table->thumbnail = $dir.$name;
           }

           $table->save();

        if($table){

          activity()
          ->performedOn($table)
          ->causedBy(Auth::user())
          ->log('Category Add');

            return redirect()->route('admin.category.index')->with('message','Category Save Succussfully');
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
        try {
            return view('backend.category.edit',[
                'category'=>Category::findOrFail($id),
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
            'name'               => 'required',
            'ar_name'            => 'required',
            'ur_name'            => 'required',
            'category_thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        try {
        $table =Category::findOrFail($id);
        $table->name = $request->name;
        $table->ar_name = $request->ar_name;
        $table->ur_name = $request->ur_name;

        if($request->file('category_thumbnail')){
            $dir = 'uploads/';
            $file = $request->file('category_thumbnail');
            $name = sha1(microtime()) . "." . $file->extension();
            $file->move($dir,$name);
            $table->thumbnail = $dir.$name;
           }

           $table->update();

        if($table){

          activity()
          ->performedOn($table)
          ->causedBy(Auth::user())
          ->log('Category Update');

            return redirect()->route('admin.category.index')->with('message','Category Update Succussfully');
        }

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


    }

    public function delete($id)
    {
        try {
        $table =Category::findOrFail($id);
        $table->delete();

        activity()
        ->performedOn($table)
        ->causedBy(Auth::user())
        ->log('Category Delete');
        } catch (\Exception $e) {
            return view('errors.404');
        }

        return redirect()->route('admin.category.index')->with('message','Category Delete Succussfully');
    }
}
