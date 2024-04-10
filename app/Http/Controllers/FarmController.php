<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Farm;
use App\Models\Farm_Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FarmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
            'Name' => 'required',
            'address' => 'required',
            'lat' => 'required',
            'long' => 'required',
            'phone' => 'required',
            'image.*' => 'required',
            'description' => 'required',
            // Add your other validation rules here
        ]);
        // Process the form data and store in the database
        $farm = new Farm();
        $farm->name = $request->input('Name');
        $farm->address = $request->input('address');
        $farm->lat = $request->input('lat');
        $farm->long = $request->input('long');
        $farm->phone = $request->input('phone');
        $farm->description = $request->input('description');

        // Handle image upload if necessary
        // if ($request->hasFile('image')) {
        //     $imagePath = $request->file('image')->store('images');
        //     $farm->image = $imagePath;
        // }
        if ($request->hasFile('image')) {
            $file = $request->file("image");
            $filensme = $request->file("image")->getClientOriginalName();
            $filensme = explode(".", $filensme);
            $name = "img_" . $filensme[0] . "_" . time() . rand(1, 100) . '.' . $file->extension();
            // $file->move(public_path('signature'), $name);
            $imagePath = $file->storeAs('public/images', $name);
            $farm->image = $imagePath;
        }
        $farm->save();
        // $farm->id;
        $farm_staff = new Farm_Staff();
        $farm_staff->user_id = Auth::user()->id;
        $farm_staff->farm_id = $farm->id;
        $farm_staff->save();
        return response()->json(['message' => 'บันทึกข้อมูลฟาร์มเรียบร้อย'], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Farm $farm)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Farm $farm)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Farm $farm)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Farm $farm)
    {
        //
    }
}
