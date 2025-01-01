<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Services;

class HomeController extends Controller
{
    public function index()
    {
        $services = Services::take(5)->get(); // Ambil semua data layanan
        return view('welcome', compact('services')); // Kirim data ke view
    }
}
