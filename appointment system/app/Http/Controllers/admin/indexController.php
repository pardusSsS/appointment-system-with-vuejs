<?php

namespace App\Http\Controllers\admin;

use App\Appointment;
use App\WorkingHours;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class indexController extends Controller
{
    public function index(){
        return view('admin.index');
    }

    public function working(){
        return view('admin.working');
    }

}
