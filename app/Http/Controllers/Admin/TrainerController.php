<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Rules\isValidPassword;
use Hash;

class TrainerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.trainer.index',[
            'trainers' =>User::whereHas(
                'roles', function($q){
                    $q->where('name', 'Trainer');
                }
            )->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.trainer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function store(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|string|max:255|unique:users,email,'.$request->email,
            'phone' => 'required|string|max:255|unique:users,phone,'.$request->phone,
            'password' => [
                'required',
                'confirmed',
                new isValidPassword()
            ],
            'biography' => 'required|string',
            'image'     => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = User::create([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'biography' => $request['biography'],
            'password' => Hash::make($request['password']),
        ]);

        if($request->file('image')){
            $dir = 'public/uploads/';
            $file = $request->file('image');
            $name = sha1(microtime()) . "." . $file->extension();
            $file->move($dir,$name);
            $user->update(['image' => $dir.$name]);
           }

           $user->assignRole('Trainer');

           return redirect()->route('admin.trainer.index')->with('message','Trainer Save Succussfully');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */



    public function edit(User $user)
    {
    try{
          $trainer =  User::findOrFail($user->id);
        return view('backend.trainer.edit',[
            'trainer' =>$trainer,
        ]);

    } catch (\Exception $e) {
        return $e->getMessage();
        return view('errors.404');
    }
    }

    public function show(User $user)
    {
        try{
            $trainer = User::with('roles')->where('id', $user->id)->first();
            return view('backend.trainer.show',[
                'trainer' =>$trainer,
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
    protected function update(Request $request,$id)
    {
        $this->validate($request, [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'biography' => 'required|string',
            'image'     => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if(isset($request->password)){
            $this->validate($request, [
                'password' => [
                    'sometimes',
                    'required',
                    new isValidPassword()
                ],
            ]);
        }


        $table = User::findOrFail($id);
        $table->first_name =$request['first_name'];
        $table->last_name =$request['last_name'];
        $table->email =$request['email'];
        $table->phone =$request['phone'];
        $table->biography =$request['biography'];
        $table->password =Hash::make($request['password']);
        $table->update();

        if($request->file('image')){
            $dir = 'public/uploads/';
            $file = $request->file('image');
            $name = sha1(microtime()) . "." . $file->extension();
            $file->move($dir,$name);
            $table->update(['image' => $dir.$name]);
           }

        return redirect()->route('admin.trainer.index')->with('message','Trainer Update Succussfully');


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
        $table = User::findOrFail($id)->delete();

        if ($table) {
            return redirect()->route('admin.trainer.index')->with('message','Trainer Remove Succussfully');
        }
    } catch (\Exception $e) {
        return view('errors.404');
    }
    }

}
