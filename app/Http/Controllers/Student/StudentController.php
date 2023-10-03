<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;

class StudentController extends Controller
{

    public function index()
    {
        return view('student.index',[
            'courses'=>Course::with('media','outcomes','requirements')->get(),
        ]);
    }
}
