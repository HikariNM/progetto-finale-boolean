<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Adult;
use Illuminate\Http\Request;

class AdultApiController extends Controller
{
    public function index(Request $request)
    {

        // $adults = Adult::with('titles')->get();

        $query = Adult::with('titles');
        if ($request->input('gender')) {
            $gender = $request->input('gender');

            if ($gender === 'male') {
                $query->where('gender', 'Maschio');
            } elseif ($gender === 'female') {
                $query->where('gender', 'Femmina');
            } else {
                $query->where('gender', $gender);
            }
        }

        $adults = $query->get();

        return response()->json(
            [
                "success" => true,
                "data" => $adults
            ]
        );
    }
    public function show(Adult $adult)
    {
        /**
         * Display the specified adult dog with its deep relations.
         * * Note on 'load()': We use Lazy Eager Loading here because the Adult model 
         * instance is already retrieved by Laravel's Route Model Binding. 
         * 'load()' runs efficient subqueries to fetch related data (titles and litters) 
         * all at once, preventing the N+1 query problem when React processes the JSON.
         */
        $adult->load(['titles', 'littersAsMother', 'littersAsFather', 'geneticTests']);

        return response()->json(
            [
                "success" => true,
                "data" => $adult
            ]
        );
    }
}
