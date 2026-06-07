<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GeneticTest;
use Illuminate\Http\Request;

class GeneticTestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $geneticTests = GeneticTest::all();

        return view('admin.geneticTests.index', compact('geneticTests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $geneticTests = GeneticTest::all();

        return view('admin.geneticTests.create', compact('geneticTests'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:genetic_tests,name']
        ]);

        $data = $request->all();
        // dd($data);
        // INSTANTIATING THE OBJECT
        $newTest = new GeneticTest();

        $newTest->name = $data['name'];
        $newTest->description = $data['description'];

        $newTest->save();
        return redirect()->route('admin.genetic-test.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GeneticTest $geneticTest)
    {
        return view('admin.geneticTests.edit', compact('geneticTest'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GeneticTest $geneticTest)
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:genetic_tests,name,' . $geneticTest->id]
        ]);

        $data = $request->all();
        $geneticTest->name = $data['name'];
        $geneticTest->description = $data['description'];

        $geneticTest->update();

        return redirect()->route('admin.genetic-test.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GeneticTest $geneticTest)
    {
        $geneticTest->delete();
        return redirect()->route('admin.genetic-test.index');
    }
}
