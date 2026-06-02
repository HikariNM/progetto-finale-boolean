<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Adult;
use App\Models\Title;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use League\CommonMark\Extension\CommonMark\Node\Inline\Strong;

class AdultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $adults = Adult::with('titles')->get();

        return view('admin.adults.index', compact('adults'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.adults.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // SERVER-SIDE VALIDATION

        // 'in:Value1,Value2' ensures the input matches EXACTLY one of the allowed options.
        // It acts as a server-side security shield, even if you are using an HTML select dropdown.
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'string', 'in:Maschio,Femmina'], // Whitelist: allows ONLY 'Maschio' or 'Femmina'
            'breed' => ['required', 'string', 'max:255'],
            'birth_date' => ['required', 'date'],
            'microchip' => ['nullable', 'string', 'size:15', 'unique:adults,microchip'],
            'pedigree_code' => ['nullable', 'string', 'max:35', 'unique:adults,pedigree_code'],
            'coat_color' => ['nullable', 'string', 'in:Black Tricolor,Red Tricolor,Blue Merle,Red Merle'],
            'tail_type' => ['nullable', 'string', 'in:NBT,Coda lunga'],
            'description' => ['nullable', 'string', 'max:255'],
            'status' => ['required', 'string', 'in:Attivo,Ritirato'],
            'is:neutered' => ['nullable', 'boolean'],
            'titles' => ['nullable', 'array'],
            // 'titles.*' validate EACH SINGLE ELEMENT inside the 'titles' array.
            // It ensures that every dynamically added title is a safe string and under 255 characters.
            'title' => ['nullable', 'string', 'max:255']
        ]);;

        $data = $request->all();


        // INSTANTIATING THE OBJECT
        $adult = new Adult();


        // ATTRIBUTE MAPPING
        $adult->name = $data['name'];
        $adult->gender = $data['gender'];
        $adult->breed = $data['breed'];
        $adult->birth_date = $data['birth_date'];
        $adult->microchip = $data['microchip'];
        $adult->pedigree_code = $data['pedigree_code'];
        $adult->coat_color = $data['coat_color'];
        $adult->tail_type = $data['tail_type'];
        $adult->description = $data['description'];
        $adult->status = $data['status'];
        $adult->is_neutered = $request->has('is_neutered') ? true : false;

        if (array_key_exists('image', $data)) {
            $img_url = Storage::putFile('studDogs', $data['image']);

            $adult->image = $img_url;
        }

        $adult->save();

        if ($request->has('titles')) {
            foreach ($request->titles as $title) {
                if (!empty(trim($title))) {
                    $newTitle = new Title();
                    $newTitle->adult_id = $adult->id;
                    $newTitle->name = $title;

                    $newTitle->save();
                }
            }
        }

        return redirect()->route('admin.adults.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Adult $adult)
    {
        return view('admin.adults.show', compact('adult'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Adult $adult)
    {
        $titles = Title::all();

        return view('admin.adults.edit', compact('adult', 'titles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Adult $adult)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'string', 'in:Maschio,Femmina'],
            'breed' => ['required', 'string', 'max:255'],
            'birth_date' => ['required', 'date'],
            'microchip' => ['nullable', 'string', 'size:15', 'unique:adults,microchip,' . $adult->id],
            'pedigree_code' => ['nullable', 'string', 'max:35', 'unique:adults,pedigree_code,' . $adult->id],
            'coat_color' => ['nullable', 'string', 'in:Black Tricolor,Red Tricolor,Blue Merle,Red Merle'],
            'tail_type' => ['nullable', 'string', 'in:NBT,Coda lunga'],
            'description' => ['nullable', 'string', 'max:255'],
            'status' => ['required', 'string', 'in:Attivo,Ritirato'],
            'is:neutered' => ['nullable', 'boolean'],
            'titles' => ['nullable', 'array'],
            // 'titles.*' validate EACH SINGLE ELEMENT inside the 'titles' array.
            // It ensures that every dynamically added title is a safe string and under 255 characters.
            'titles.*' => ['nullable', 'string', 'max:255']
        ]);

        $data = $request->all();


        // ATTRIBUTE UPDATE
        $adult->name = $data['name'];
        $adult->gender = $data['gender'];
        $adult->breed = $data['breed'];
        $adult->birth_date = $data['birth_date'];
        $adult->microchip = $data['microchip'];
        $adult->pedigree_code = $data['pedigree_code'];
        $adult->coat_color = $data['coat_color'];
        $adult->tail_type = $data['tail_type'];
        $adult->description = $data['description'];
        $adult->status = $data['status'];
        $adult->is_neutered = $request->has('is_neutered') ? true : false;


        if ($request->hasFile('image')) {
            if ($adult->image) {
                Storage::delete($adult->image);
            }
            $img_url = Storage::putFile('studDogs', $request->image);
            $adult->image = $img_url;
        } elseif ($request->input('remove_image') == '1') {
            if ($adult->image) {
                Storage::delete($adult->image);
            }
            $adult->image = null;
        }


        $adult->save();

        // Filter the titles coming from the form
        $submittedTitles = [];
        if ($request->has('titles')) {
            foreach ($request->titles as $titleName) {
                if (!empty(trim($titleName))) {
                    $submittedTitles[] = trim($titleName);
                }
            }
        }

        // We delete rows where the name is NOT in the submitted titles list
        $adult->titles()->whereNotIn('name', $submittedTitles)->delete();

        // Loop through submitted titles to check if they already exist or need insertion
        foreach ($submittedTitles as $titleName) {
            $exists = $adult->titles()->where('name', $titleName)->exists();

            // If it doesn't exist, insert it as a new record
            if (!$exists) {
                $newTitle  = new Title();
                $newTitle->adult_id = $adult->id;
                $newTitle->name = $titleName;

                $newTitle->save();
            }
        }

        return redirect()->route('admin.adults.show', $adult);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Adult $adult)
    {
        if ($adult->image) {
            Storage::delete($adult->image);
        }
        $adult->titles()->delete();
        $adult->delete();
        return redirect()->route('admin.adults.index');
    }
}
