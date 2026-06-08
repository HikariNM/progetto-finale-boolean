<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Puppy;
use Illuminate\Http\Request;

class PuppyApiController extends Controller
{
    public function index(Request $request)
    {

        $puppies = Puppy::where('status', 'Disponibile')->with(['litter', 'litter.mother', 'litter.father'])->get();

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
