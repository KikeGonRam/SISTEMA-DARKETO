<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $appointments = Appointment::where('user_id', Auth::id())->get();
        return view('dashboard', compact('appointments'));
    }
}