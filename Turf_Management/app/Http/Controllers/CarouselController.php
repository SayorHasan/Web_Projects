<?php

namespace App\Http\Controllers;

use App\Models\CarouselImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CarouselController extends Controller
{
    public function index()
    {
        $carouselImages = CarouselImage::orderBy('order')->get();
        return view('admin.carousel.index', compact('carouselImages'));
    }

    public function create()
    {
        return view('admin.carousel.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'sport_type' => 'nullable|string|max:255',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'nullable'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $imagePath = $request->file('image')->store('carousel', 'public');

            CarouselImage::create([
                'title' => $request->title,
                'description' => $request->description,
                'image_path' => $imagePath,
                'sport_type' => $request->sport_type,
                'order' => $request->order ?? 0,
                'is_active' => $request->has('is_active')
            ]);

            return redirect()->route('admin.carousel.index')->with('success', 'Carousel image added successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to create carousel image. Please try again.'])->withInput();
        }
    }

    public function show(CarouselImage $carousel)
    {
        $carouselImage = $carousel;
        return view('admin.carousel.show', compact('carouselImage'));
    }

    public function edit(CarouselImage $carousel)
    {
        $carouselImage = $carousel;
        return view('admin.carousel.edit', compact('carouselImage'));
    }

    public function update(Request $request, CarouselImage $carousel)
    {
        $carouselImage = $carousel;
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'sport_type' => 'nullable|string|max:255',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'nullable'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'sport_type' => $request->sport_type,
            'order' => $request->order ?? 0,
            'is_active' => $request->has('is_active')
        ];

        if ($request->hasFile('image')) {
            try {
                // Delete old image if it exists
                if ($carouselImage->image_path && Storage::disk('public')->exists($carouselImage->image_path)) {
                    Storage::disk('public')->delete($carouselImage->image_path);
                }
                
                // Store new image
                $data['image_path'] = $request->file('image')->store('carousel', 'public');
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['image' => 'Failed to upload image. Please try again.'])->withInput();
            }
        }

        try {
            $carouselImage->update($data);
            return redirect()->route('admin.carousel.index')->with('success', 'Carousel image updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to update carousel image. Please try again.'])->withInput();
        }
    }

    public function destroy(CarouselImage $carousel)
    {
        $carouselImage = $carousel;
        try {
            // Delete image if it exists
            if ($carouselImage->image_path && Storage::disk('public')->exists($carouselImage->image_path)) {
                Storage::disk('public')->delete($carouselImage->image_path);
            }

            $carouselImage->delete();

            return redirect()->route('admin.carousel.index')->with('success', 'Carousel image deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->route('admin.carousel.index')->with('error', 'Failed to delete carousel image. Please try again.');
        }
    }

    // Public method to get active carousel images
    public function getActiveImages()
    {
        return CarouselImage::active()->ordered()->get();
    }

    // Static method to get active carousel images for welcome page
    public static function getActiveCarousels()
    {
        return CarouselImage::active()->ordered()->get();
    }

    // Method to check and fix missing images
    public function checkMissingImages()
    {
        $missingImages = CarouselImage::whereNotNull('image_path')
            ->get()
            ->filter(function ($image) {
                return !$image->image_exists;
            });

        return view('admin.carousel.missing-images', compact('missingImages'));
    }
}
