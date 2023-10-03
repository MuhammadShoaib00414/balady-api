<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use Auth;

class StudentController extends Controller
{
    public function index()
    {
        return view('backend.student.index',[
            'students' => Student::all(),
        ]);
    }


    public function show($id)
    {
        try{
        $student = Student::findOrFail($id);
        return view('backend.student.show',[
            'student' => $student,
        ]);

    } catch (\Exception $e) {
        return view('errors.404');
    }
    }
}
