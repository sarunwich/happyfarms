<?php

namespace App\Http\Controllers;
use App\Models\Picture;

use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PictureController extends Controller
{
    //
    public function index($fid)
    {
        session(['farm_id' => $fid]);
        
        $pictures = Picture::where('farm_id', $fid)
        ->get();
        return view('manager.pictures.index', compact('pictures'));
    }

    public function create()
    {
        return view('manager.pictures.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'images' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:8192',
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('pictures', 'public');

                $picture = new Picture();
                $picture->farm_id = session('farm_id');
                $picture->title = $request->title;
                $picture->image_path = $imagePath;
                $picture->save();
            }
        }

        return redirect()->route('manager.pictures.index', ['fid' => session('farm_id')])->with('success', 'Picture uploaded successfully');
    }
    public function destroy(Picture $picture)
    {
        if ($picture->farm_id != session('farm_id')) {
            return redirect()->route('manager.pictures.index', ['fid' => session('farm_id')])->with('error', 'Unauthorized access.');
        }

        Storage::disk('public')->delete($picture->image_path);
        $picture->delete();

        return redirect()->route('manager.pictures.index', ['fid' => session('farm_id')])->with('success', 'Picture deleted successfully');
    }
}
