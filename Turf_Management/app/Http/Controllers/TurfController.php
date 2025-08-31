<?php

namespace App\Http\Controllers;

use App\Models\Turf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TurfController extends Controller
{
    public function index()
    {
        $turfs = Turf::all();
        return view('admin.turfs.index', compact('turfs'));
    }

    public function create()
    {
        return view('admin.turfs.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'sport_types' => 'required|array|min:1',
            'sport_types.*' => 'in:football,cricket,tennis,basketball,volleyball,badminton',
            'price_per_hour' => 'required|numeric|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'features' => 'nullable|array',
            'status' => 'required|in:available,maintenance,booked'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $imagePath = $request->file('image')->store('turfs', 'public');

        $turf = Turf::create([
            'name' => $request->name,
            'description' => $request->description,
            'sport_type' => implode(',', $request->sport_types),
            'price_per_hour' => $request->price_per_hour,
            'image_path' => $imagePath,
            'features' => $request->features ?? [],
            'status' => $request->status
        ]);

        return redirect()->route('admin.turfs.index')->with('success', 'Turf created successfully!');
    }

    public function show(Turf $turf)
    {
        return view('admin.turfs.show', compact('turf'));
    }

    public function edit(Turf $turf)
    {
        return view('admin.turfs.edit', compact('turf'));
    }

    public function update(Request $request, Turf $turf)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'sport_types' => 'required|array|min:1',
            'sport_types.*' => 'in:football,cricket,tennis,basketball,volleyball,badminton',
            'price_per_hour' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'features' => 'nullable|array',
            'status' => 'required|in:available,maintenance,booked'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'sport_type' => implode(',', $request->sport_types),
            'price_per_hour' => $request->price_per_hour,
            'features' => $request->features ?? [],
            'status' => $request->status
        ];

        if ($request->hasFile('image')) {
            // Delete old image
            if ($turf->image_path) {
                Storage::disk('public')->delete($turf->image_path);
            }
            $data['image_path'] = $request->file('image')->store('turfs', 'public');
        }

        $turf->update($data);

        return redirect()->route('admin.turfs.index')->with('success', 'Turf updated successfully!');
    }

    public function destroy(Turf $turf)
    {
        // Delete image
        if ($turf->image_path) {
            Storage::disk('public')->delete($turf->image_path);
        }

        $turf->delete();

        return redirect()->route('admin.turfs.index')->with('success', 'Turf deleted successfully!');
    }

    // Public method for users to view available turfs
    public function available()
    {
        $turfs = Turf::where('status', 'available')->get();
        return view('user.book-turf', compact('turfs'));
    }
}
