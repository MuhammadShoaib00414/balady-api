<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
use Auth;
use Hash;

class TrainerController extends Controller
{

    public function index()
    {
        return view('trainer.index',[
            'course' =>Course::where('user_id',Auth::user()->id)->count(),
        ]);
    }

    public function profile()
    {
        return view('trainer.profile.profile');
    }
    public function profileUpdate(Request $request)
    {
        $this->validate($request, [
            'first_name'              => 'required',
            'last_name'              => 'required',
            'email'              => 'required',
        ]);

        $table = User::find($request->id);
        $table->first_name=$request->first_name;
        $table->last_name=$request->last_name;
        $table->email=$request->email;
       
        if($request->file('user_image')){
            $dir = 'uploads/';
            $file = $request->file('user_image');
            $name = sha1(microtime()) . "." . $file->extension();
            $file->move($dir,$name);
            $table->image = $dir.$name;
        }
           $table->update();
           return redirect()->back()->with('message','Profile Update Succussfully');

    }


     /**
     * Change the current password
     * @param Request $request
     * @return Renderable
     */
    public function changePassword(Request $request)
    {       
        $user = Auth::user();
    
        $userPassword = $user->password;
        
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|same:confirm_password|min:6',
            'confirm_password' => 'required',
        ]);

        if (!Hash::check($request->current_password, $userPassword)) {
            return back()->with(['error'=>'Current password not match']);
        }

        $user->password = Hash::make($request->password);

        $user->save();

        return redirect()->back()->with('message','password successfully updated');
    }
    
}
