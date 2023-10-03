<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Rules\isValidPassword;
use Hash;
class SubAdminController extends Controller
{

    public function index()
    {
        return view('backend.subadmin.index',[
            'subadmins' =>User::whereHas(
                'roles', function($q){
                    $q->where('name', 'Admin');
                }
            )->get()
        ]);
    }

    public function create()
    {
        return view('backend.subadmin.create');
    }

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
            $dir = 'uploads/';
            $file = $request->file('image');
            $name = sha1(microtime()) . "." . $file->extension();
            $file->move($dir,$name);
            $user->update(['image' => $dir.$name]);
           }

           $user->assignRole('Admin');

           return redirect()->route('admin.subadmin.index')->with('message','Sub Admin Save Succussfully');


    }



    public function edit(User $user)
    {
        try{
          $subadmin =  User::findOrFail($user->id);
        return view('backend.subadmin.edit',[
            'subadmin' =>$subadmin,
        ]);

    } catch (\Exception $e) {
        return view('errors.404');
    }
    }

    public function show(User $user)
    {
        try{
            $subadmin = User::with('roles')->where('id', $user->id)->first();
            return view('backend.subadmin.show',[
                'subadmin' =>$subadmin,
            ]);

        } catch (\Exception $e) {
            return view('errors.404');
        }
    }




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

        try{

        $table = User::findOrFail($id);
        $table->first_name =$request['first_name'];
        $table->last_name =$request['last_name'];
        $table->email =$request['email'];
        $table->phone =$request['phone'];
        $table->biography =$request['biography'];

        if(isset($request->password)){
            $table->password =Hash::make($request['password']);
        }

        $table->update();

        if($request->file('image')){
            $dir = 'uploads/';
            $file = $request->file('image');
            $name = sha1(microtime()) . "." . $file->extension();
            $file->move($dir,$name);

            $table->update(['image' => $dir.$name]);
           }

        return redirect()->route('admin.subadmin.index')->with('message','Sub Admin Update Succussfully');
    } catch (\Exception $e) {
        return view('errors.404');
    }

    }






    public function destroy($id)
    {
        try{
        $table = User::findOrFail($id)->delete();
        if ($table) {
            return redirect()->route('admin.subadmin.index')->with('message','Sub Admin Remove Succussfully');
        }

    } catch (\Exception $e) {
        return view('errors.404');
    }
    }

}
