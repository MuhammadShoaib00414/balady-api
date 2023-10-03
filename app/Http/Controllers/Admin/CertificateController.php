<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Certificate;
class CertificateController extends Controller
{
    public function index()
    {
     return view('backend.certificate.index',[
        'certificates' => Certificate::with('student')->get(),
     ]);
    }


    public function show(Certificate $certificate)
    {
     return view('backend.certificate.show',[
        'certificate' => $certificate->load('student'),
     ]);
    }
}
