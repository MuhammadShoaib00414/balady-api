<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        \Debugbar::error('Error!');

         if(\Auth::user()->hasRole('SuperAdmin')){
            return redirect(route('admin.index'));
        }elseif(\Auth::user()->hasRole('Admin')){
            return redirect(route('admin.index'));
        }elseif(\Auth::user()->hasRole('Trainer')){
            return redirect(route('trainer.index'));
        }elseif(\Auth::user()->hasRole('Student')){
            return redirect(route('student.index'));
        }else{
            return redirect(route('login'));
        }
    }
}
