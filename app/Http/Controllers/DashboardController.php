<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kegiatan;

class DashboardController extends Controller
{
    public function index()
    {
        $totalKegiatan = Kegiatan::where('user_id', auth()->id())->count();
        return view('dashboard', compact('totalKegiatan'));
    }
}
