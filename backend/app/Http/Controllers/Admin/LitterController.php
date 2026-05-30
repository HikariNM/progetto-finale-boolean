<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Adult;
use App\Models\Litter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LitterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $litters = Litter::with(['mother', 'father'])->orderBy('birth_date', 'desc')->get();

        return view('admin.litters.index', compact('litters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mothers = Adult::where('gender', 'Femmina')->where('status', 'Attivo')->orderBy('name')->get();
        $fathers = Adult::where('gender', 'Maschio')->where('status', 'Attivo')->orderBy('name')->get();

        return view('admin.litters.create', compact('mothers', 'fathers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'                => ['required', 'string', 'max:255'],
            'birth_date'           => ['required', 'date'],
            'status'               => ['required', 'string', 'in:In programma,Nata,Svezzata'],
            'mother_id'            => ['nullable', 'exists:adults,id'],
            'father_id'            => ['nullable', 'exists:adults,id'],
            'external_father_name' => ['nullable', 'string', 'max:255'],
            'description'          => ['nullable', 'string'],
        ]);

        $data = $request->all();

        // ATTRIBUTE MAPPING
        $litter = new Litter();
        $litter->title = $data['title'];
        $litter->birth_date = $data['birth_date'];
        $litter->status = $data['status'];
        $litter->mother_id  = $data['mother_id'];
        $litter->father_id  = $data['father_id'];
        $litter->external_father_name = $data['external_father_name'];
        $litter->description = $data['description'];

        if (array_key_exists('image', $data)) {
            $img_url = Storage::putFile('litter', $data['image']);

            $litter->image = $img_url;
        }

        $litter->save();

        return redirect()->route('admin.litters.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Litter $litter)
    {
        $litter->load(['puppies', 'mother', 'father']);

        return view('admin.litters.show', compact('litter'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Litter $litter)
    {
        $mothers = Adult::where('gender', 'Femmina')->orderBy('name')->get();
        $fathers = Adult::where('gender', 'Maschio')->orderBy('name')->get();

        return view('admin.litters.edit', compact('litter', 'mothers', 'fathers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Litter $litter)
    {
        $request->validate([
            'title'                => ['required', 'string', 'max:255'],
            'birth_date'           => ['required', 'date'],
            'status'               => ['required', 'string', 'in:In programma,Nata,Svezzata'],
            'mother_id'            => ['nullable', 'exists:adults,id'],
            'father_id'            => ['nullable', 'exists:adults,id'],
            'external_father_name' => ['nullable', 'string', 'max:255'],
            'description'          => ['nullable', 'string'],
        ]);

        $data = $request->all();

        // ATTRIBUTE UPDATE
        $litter->title = $data['title'];
        $litter->birth_date = $data['birth_date'];
        $litter->status = $data['status'];
        $litter->mother_id  = $data['mother_id'];
        $litter->father_id  = $data['father_id'];
        $litter->external_father_name = $data['external_father_name'];
        $litter->description = $data['description'];


        if ($request->hasFile('image')) {
            if ($litter->image) {
                Storage::delete($litter->image);
            }
            $img_url = Storage::putFile('litter', $request->image);
            $litter->image = $img_url;
        } elseif ($request->input('remove_image') == '1') {
            if ($litter->image) {
                Storage::delete($litter->image);
            }
            $litter->image = null;
        }

        $litter->update();

        return redirect()->route('admin.litters.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Litter $litter)
    {
        $litter->delete();

        return redirect()->route('admin.litters.index');
    }
}
