<?php

namespace App\Http\Controllers;

class KasirDashboardController extends Controller
{
    public function index()
    {
        return view('kasir.dashboard');
    }
}
