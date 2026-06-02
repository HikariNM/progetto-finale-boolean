<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Litter;
use Illuminate\Http\Request;

class LitterApiController extends Controller
{
    public function index(Request $request)
    {

        // $litters = Litter::with('mother', 'father')->get();

        // Initialize the query builder for the Puppy model
        $query = Litter::with('mother', 'father');
        if ($request->input('status')) {
            $status = $request->input('status');
            if ($status === 'upcoming') {
                // Filter by the 'status' column matching the input value from the URL
                $query->where('status', 'in programma');
            } elseif ($status === 'past') {
                $query->whereIn('status', ['nata', 'svezzata']);
            } else {
                $query->where('status', $status);
            }
        }

        $litters = $query->get();

        return response()->json(
            [
                "success" => true,
                "data" => $litters
            ]
        );
    }

    public function show(Litter $litter)
    {

        $litter->load(['mother.titles', 'father.titles', 'puppies']);

        return response()->json(
            [
                "success" => true,
                "data" => $litter
            ]
        );
    }
}
