<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(Auth::user()->roles[0]['name']=='SuperAdmin'){
            return redirect(route('admin.index'));
        }elseif(Auth::user()->roles[0]['name']=='Admin'){
            return redirect(route('admin.index'));
        }elseif(Auth::user()->roles[0]['name']=='Student'){
            return redirect(route('student.index'));
        }elseif(Auth::user()->roles[0]['name']=='Trainer'){
            return redirect(route('trainer.index'));
        }else{
            return redirect(route('login'));
        }
    }
}
