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
                'message' => '❌ Invalid ID'
            ], 404);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|max:50',
                'image' => 'required|max:50',
                'kind' => 'required|max:50',
                'weight' => 'required|max:50',
                'age' => 'required|max:50',
                'breed' => 'required|max:50',
                'location' => 'required|max:50',
                'description' => 'required|max:50',
                'active' => 'required|max:50',
                'adopted' => 'required|max:50',
            ]);
            $pet = Pet::create($request->all());
            return response()->json([
                'message' => '✅ Pet created successfully',
                'pet' => $pet 
            ], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => '❌ Invalid data',
                'errors' => $e->errors()
            ], 400);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $pet = Pet::findOrFail($id);
            $pet->update($request->all());
            return response()->json([
                'message' => '✅ Pet updated successfully',
                'pet' => $pet 
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'message' => '❌ Invalid ID'
            ], 404);
        }
    }

    public function destroy($id)
    {
        try {
            $pet = Pet::findOrFail($id);
            $pet->delete();
            return response()->json([
                'message' => '✅ Pet deleted successfully'
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'message' => '❌ Invalid ID'
            ], 404);
        }
    }
}
