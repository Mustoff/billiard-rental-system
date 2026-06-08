<?php

namespace App\Http\Controllers;

use App\Models\Meja;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalMeja = Meja::count();
        $mejaKosong = Meja::where('status', 'kosong')->count();
        $mejaDipakai = Meja::where('status', 'dipakai')->count();

        return view('dashboard', compact('totalMeja', 'mejaKosong', 'mejaDipakai'));
    }
}
