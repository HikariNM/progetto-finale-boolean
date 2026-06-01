<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Litter;
use App\Models\Puppy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PuppyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $puppies = Puppy::with('litter')->get()->sortBy(
        //     function ($puppy) {
        //         return $puppy->litter->birth_date ?? '';
        //     }
        // );

        $query = Puppy::with('litter');

        if ($request->has('status') && $request->query('status') != '') {
            $query->where('status', $request->query('status'));
        }

        $puppies = $query->get()->sortBy(function ($puppy) {
            return $puppy->litter->birth_date ?? '';
        });

        return view('admin.puppies.index', compact('puppies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $litters = Litter::all();

        return view('admin.puppies.create', compact('litters'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'litter_id'            => ['required', 'exists:litters,id'],
            'name'                 => ['required', 'string', 'max:255'],
            'gender'               => ['required', 'string', 'in:Maschio,Femmina'],
            'color'                => ['nullable', 'string', 'max:255'],
            'status'               => ['required', 'string', 'in:Disponibile,Prenotato,Venduto'],
            'description'          => ['nullable', 'string'],
            'image'                => ['nullable', 'image', 'max:2048']
        ]);

        // $data = $request->all();

        // ATTRIBUTE MAPPING
        $puppy = new Puppy();

        $puppy->litter_id = $data['litter_id'];
        $puppy->name = $data['name'];
        $puppy->gender  = $data['gender'];
        $puppy->color  = $data['color'];
        $puppy->status = $data['status'];
        $puppy->description = $data['description'];


        if ($request->hasFile('image')) {
            if ($puppy->image) {
                Storage::delete($puppy->image);
            }
            $img_url = Storage::putFile('puppy', $request->image);
            $puppy->image = $img_url;
        } elseif ($request->input('remove_image') == '1') {
            if ($puppy->image) {
                Storage::delete($puppy->image);
            }
            $puppy->image = null;
        }

        $puppy->save();

        return redirect()->route('admin.litters.show', $puppy->litter_id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Puppy $puppy)
    {
        return view('admin.puppies.show', compact('puppy'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Puppy $puppy)
    {
        $litters = Litter::all();

        return view('admin.puppies.edit', compact('puppy', 'litters'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Puppy $puppy)
    {
        $data = $request->validate([
            'litter_id'            => ['required', 'exists:litters,id'],
            'name'                 => ['required', 'string', 'max:255'],
            'gender'               => ['required', 'string', 'in:Maschio,Femmina'],
            'color'                => ['nullable', 'string', 'max:255'],
            'status'               => ['required', 'string', 'in:Disponibile,Prenotato,Venduto'],
            'description'          => ['nullable', 'string'],
            'image'                => ['nullable', 'image', 'max:2048']
        ]);

        // ATTRIBUTE UPDATE
        $puppy->litter_id = $data['litter_id'];
        $puppy->name = $data['name'];
        $puppy->gender  = $data['gender'];
        $puppy->color  = $data['color'];
        $puppy->status = $data['status'];
        $puppy->description = $data['description'];


        if ($request->hasFile('image')) {
            if ($puppy->image) {
                Storage::delete($puppy->image);
            }
            $img_url = Storage::putFile('puppy', $request->image);
            $puppy->image = $img_url;
        } elseif ($request->input('remove_image') == '1') {
            if ($puppy->image) {
                Storage::delete($puppy->image);
            }
            $puppy->image = null;
        }

        $puppy->update();

        return redirect()->route('admin.litters.show', $puppy->litter_id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Puppy $puppy)
    {
        if ($puppy->image) {
            Storage::delete($puppy->image);
        }
        $puppy->delete();
        return redirect()->route('admin.litters.index');
    }
}
