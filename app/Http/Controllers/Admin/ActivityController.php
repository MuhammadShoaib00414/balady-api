<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Spatie\Activitylog\Models\Activity;
use Auth;

class ActivityController extends Controller
{
    public function index()
    {
        return view('backend.activity.index',[
            'activites' => Activity::with('subject','causer.roles')->get(),
        ]);
    }
}
