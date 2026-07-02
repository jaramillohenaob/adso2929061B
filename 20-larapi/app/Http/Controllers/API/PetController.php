<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pet;

class PetController extends Controller
{
    public function index()
    {
        $pets = Pet::all();
        return response()->json([
            'message' => '✅ Query success!',
            'pets' => $pets 
        ]);
    }

    public function show($id)
    {
        try {
            $pet = Pet::findOrFail($id);
            return response()->json([
                'message' => '✅ Query success!',
                'pet' => $pet 
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'message' => '❌ Pet with ID ' .$id. ' not found'
            ], 404);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name'        => 'required|max:50',
                'kind'        => 'required|max:50',
                'weight'      => 'nullable|max:50',
                'age'         => 'nullable|max:50',
                'breed'       => 'nullable|max:50',
                'location'    => 'nullable|max:50',
                'description' => 'nullable|max:255',
                'active'      => 'nullable|boolean',
                'adopted'     => 'nullable|boolean',
                'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            ]);

            $data = $request->except('image');

            if ($request->hasFile('image')) {
                $file      = $request->file('image');
                $filename  = uniqid('pet_', true) . '.' . $file->getClientOriginalExtension();
                $directory = storage_path('app/public/images');

                if (!file_exists($directory)) {
                    mkdir($directory, 0755, true);
                }

                $file->move($directory, $filename);
                $data['image'] = asset('storage/images/' . $filename);
            }

            $pet = Pet::create($data);
            return response()->json([
                'message' => '✅ Pet ' . $pet->name . ' created successfully with ID: ' . $pet->id,
                'pet'     => $pet,
            ], 200);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => '❌ Invalid data',
                'errors'  => $e->errors(),
            ], 400);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $pet  = Pet::findOrFail($id);
            $data = $request->except('image');

            if ($request->hasFile('image')) {
                $file      = $request->file('image');
                $filename  = uniqid('pet_', true) . '.' . $file->getClientOriginalExtension();
                $directory = public_path('images');

                if (!file_exists($directory)) {
                    mkdir($directory, 0755, true);
                }

                $file->move($directory, $filename);
                $data['image'] = asset('images/' . $filename);
            }

            $pet->update($data);
            return response()->json([
                'message' => '✅ Pet ' . $pet->name . ' updated successfully',
                'pet'     => $pet,
            ], 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'message' => '❌ Invalid ID',
            ], 404);
        }
    }

    public function destroy($id)
    {
        try {
            $pet = Pet::findOrFail($id);
            $pet->delete();
            return response()->json([
                'message' => '✅ Pet ' . $pet->name . ' deleted successfully',
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'message' => '❌ Invalid ID',
            ], 404);
        }
    }
}
