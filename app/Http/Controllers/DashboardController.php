<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected function authenticated(Request $request, $user)
    {
        if ($user->role === 'lectures' || $user->role === 'students') {
            return redirect('/mentora');
        } 
        return redirect('/'); 
    }
}
