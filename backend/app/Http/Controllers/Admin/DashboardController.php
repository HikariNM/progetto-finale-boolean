<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Adult;
use App\Models\GeneticTest;
use App\Models\Litter;
use App\Models\Puppy;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalAdult = Adult::count();
        $totalLitters = Litter::count();
        $totalPuppies = Puppy::count();
        $genticTests = GeneticTest::count();
        $availablePuppies = Puppy::where('status', 'Disponibile')->count();
        return view('admin.dashboard', compact('totalAdult', 'totalLitters', 'totalPuppies', 'availablePuppies', 'genticTests'));
    }
}
