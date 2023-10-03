<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\User;
use App\Models\Category;
use App\Models\Student;
use App\Models\Question;
use App\Models\Certificate;
use Auth;
use Hash;
use DB;
use App\Rules\isValidPassword;

class AdminController extends Controller
{
    public function index(){
        return view('backend.index',[
            'courses' => Course::count(),
            'chart_courses' => Course::withCount('CourseComplete')->take(7)->get(),
            'total_user' => (Certificate::where('status','pass')->count() / Student::count()) * 100,
            'categories' => Category::count(),
            'trainers' => User::role('Trainer')->count(),
            'questions' => Question::count(),
            'student' => Student::count(),
            'countPassStudent' => Certificate::where('status','pass')->count(),
            'countFailStudent' => Certificate::where('status','fail')->count(),
            'municipalities' => Student::with('studentMunicipality')
                                    ->select('municipality',DB::raw('count(municipality) as countmunicipality'))
                                    ->groupby('municipality','municipality')
                                    ->get(),
            'sub_municipalities' => Student::with('subMunicipality')
                        ->select('sub_municipality',DB::raw('count(sub_municipality) as countsubmunicipality'))
                        ->groupby('sub_municipality')
                        ->get(),
            'passAverage' => Certificate::where('status','pass')->sum('percentage') == 0 
                                ? 0 
                                : Certificate::where('status','pass')->sum('percentage') 
                                / Certificate::where('status','pass')->count(),
        ]);
    }


    public function profle()
    {
        return view('backend.profile',[
            'profile' => User::where('id',Auth::user()->id)->with('roles')->first(),
        ]);
    }



    public function profileUpdate(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name'  => 'required',
            'email'      => 'required',
            'image'      => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $table = User::findOrFail($request->id);
        $table->first_name=$request->first_name;
        $table->last_name=$request->last_name;
        $table->email=$request->email;
        $table->biography=$request->biography;
        $table->phone=$request->phone;

        if($request->file('image')){
            $dir = 'uploads/';
            $file = $request->file('image');
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
            'password' => ['required',
                            'same:confirm_password',
                            new isValidPassword()
                            ],
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
