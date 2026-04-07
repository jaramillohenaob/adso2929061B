<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pets = Pet::orderBy('id', 'desc')->paginate(12);
        return view('pets.index')->with('pets', $pets);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pets.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            'name'        => ['required', 'string'],
            'kind'        => ['required', 'string'],
            'weight'      => ['required', 'numeric'],
            'age'         => ['required', 'integer'],
            'breed'       => ['required', 'string'],
            'location'    => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'image'       => ['required', 'image'],
            'active'      => ['required'],
            'adopted'     => ['required'],
        ]);

        if ($validation) {
            if ($request->hasFile('image')) {
                $image = time() . '.' . $request->image->extension();
                $request->image->move(public_path('images/pets'), $image);
            }
        }

        $pet = new Pet;
        $pet->name        = $request->name;
        $pet->kind        = $request->kind;
        $pet->weight      = $request->weight;
        $pet->age         = $request->age;
        $pet->breed       = $request->breed;
        $pet->location    = $request->location;
        $pet->description = $request->description;
        $pet->image       = $image;
        $pet->active      = $request->active;
        $pet->adopted     = $request->adopted;

        if ($pet->save()) {
            return redirect('pets')
                    ->with('message', 'The Pet: ' . $pet->name . ' was added successfully!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Pet $pet)
    {
        return view('pets.show')->with('pet', $pet);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pet $pet)
    {
        return view('pets.edit')->with('pet', $pet);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pet $pet)
    {
        $validation = $request->validate([
            'name'        => ['required', 'string'],
            'kind'        => ['required', 'string'],
            'weight'      => ['required', 'numeric'],
            'age'         => ['required', 'integer'],
            'breed'       => ['required', 'string'],
            'location'    => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'active'      => ['required'],
            'adopted'     => ['required'],
        ]);

        if ($validation) {
            if ($request->hasFile('image')) {
                $image = time() . '.' . $request->image->extension();
                $request->image->move(public_path('images/pets'), $image);
                // Delete old image
                if ($request->originimage != 'no-photo.png' && file_exists(public_path('images/pets/' . $pet->image))) {
                    unlink(public_path('images/pets/' . $pet->image));
                }
            } else {
                $image = $request->originimage;
            }
        }

        $pet->name        = $request->name;
        $pet->kind        = $request->kind;
        $pet->weight      = $request->weight;
        $pet->age         = $request->age;
        $pet->breed       = $request->breed;
        $pet->location    = $request->location;
        $pet->description = $request->description;
        $pet->image       = $image;
        $pet->active      = $request->active;
        $pet->adopted     = $request->adopted;

        if ($pet->save()) {
            return redirect('pets')
                    ->with('message', 'The Pet: ' . $pet->name . ' was edited successfully!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pet $pet)
    {
        if ($pet->delete()) {
            if ($pet->image != 'no-photo.png' && file_exists(public_path('images/pets/' . $pet->image))) {
                unlink(public_path('images/pets/' . $pet->image));
            }

            return redirect('pets')
                    ->with('message', 'The Pet: ' . $pet->name . ' was deleted successfully!');
        }
    }

    /**
     * Generate a PDF file
     */
    public function pdf()
    {
        $pets = Pet::all();
        $pdf = Pdf::loadView('pets.pdf', compact('pets'));
        return $pdf->download('allpets.pdf');
    }


    /**
     * Search pets
     */
    public function search(Request $request)
    {
        $pets = Pet::names($request->q)->orderBy('id', 'desc')->paginate(12);
        return view('pets.search')->with('pets', $pets);
    }
}
