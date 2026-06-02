<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Puppy;
use Illuminate\Http\Request;

class PuppyApiController extends Controller
{
    public function index(Request $request)
    {
        // Initialize the query builder for the Puppy model
        $query = Puppy::query();
        // Check if the 'status' parameter exists in the request URL
        if ($request->input('status')) {
            // Filter by the 'status' column matching the input value from the URL
            $query->where('status', $request->input('status'));
        }
        // Execute the query and fetch the filtered or unfiltered results from the database
        $puppies = $query->get();

        return response()->json(
            [
                "success" => true,
                "data" => $puppies
            ]
        );
    }

    public function show(Puppy $puppy)
    {

        $puppy->load(['litter.mother.titles', 'litter.father.titles']);

        return response()->json(
            [
                "success" => true,
                "data" => $puppy
            ]
        );
    }
}
