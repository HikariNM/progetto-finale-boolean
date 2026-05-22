<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Litter;
use App\Models\Puppy;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalLitters = Litter::count();
        $totalPuppies = Puppy::count();
        $availablePuppies = Puppy::where('status', 'Disponibile')->count();
        return view('admin.dashboard', compact('totalLitters', 'totalPuppies', 'availablePuppies'));
    }
}
