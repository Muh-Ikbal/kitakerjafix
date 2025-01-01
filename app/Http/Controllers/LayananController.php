<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Services;

class LayananController extends Controller
{
    public function index(){
        $services = Services::all();
        return view('layanan',compact('services'));
    }
}
