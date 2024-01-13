<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class ChildController extends Controller
{
    public function dashboard(): View
    {
        return view('child.dashboard');
    }
}
