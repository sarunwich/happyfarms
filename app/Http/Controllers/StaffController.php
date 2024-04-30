<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StaffController extends Controller
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
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'farmid' => 'required',
            'image.*' => 'required',
            'role' => 'required',

            // Add your other validation rules here
        ]);
        $staff = new Staff();
        $staff->name = $request->input('name');
        $staff->address = $request->input('address');
        $staff->phone = $request->input('phone');
        $staff->role = $request->input('role');
        $staff->farm_id = $request->input('farmid');
        if ($request->hasFile('image')) {
            $file = $request->file("image");
            $filensme = $request->file("image")->getClientOriginalName();
            $filensme = explode(".", $filensme);
            $name = "Staff_" . $filensme[0] . "_" . time() . rand(1, 100) . '.' . $file->extension();
            // $file->move(public_path('signature'), $name);
            $imagePath = $file->storeAs('public/picture', $name);
            $staff->picture = $name;
        }
        $staff->save();
        return response()->json(['message' => 'บันทึกข้อมูลผู้ดำเนินงานในฟาร์มเรียบร้อย', 'id' => $request->farmid], 200);

    }

    /**
     * Display the specified resource.
     */
    public function show(Staff $staff)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Staff $staff)
    {
        //
        // $staff = Staff::findOrFail($id);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Staff $staff , $id)
    {
        //


        // $validatedData = $request->validate([
        //     'name' => 'required',
        //     'address' => 'required',
        //     'phone' => 'required',
        //     // 'farmid' => 'required',
        //     // 'image.*' => 'required',
        //     'role' => 'required',

        //     // Add your other validation rules here
        // ]);

        $staff = Staff::findOrFail($id);
        $staff->update([
            'name' => $request->input('name'),
            'address' => $request->input('address'),
            'role' =>$request->input('role'),
            'phone' => $request->input('phone'),
           
            
            // Update other fields as needed
        ]);
        if ($request->hasFile('image')) {
            Storage::delete('public/picture/'.$staff->picture);
            $file = $request->file("image");
            $filensme = $request->file("image")->getClientOriginalName();
            $filensme = explode(".", $filensme);
            $name = "img_" . $filensme[0] . "_" . time() . rand(1, 100) . '.' . $file->extension();
            // $file->move(public_path('signature'), $name);
            $imagePath = $file->storeAs('public/picture', $name);
            $staff->update([
                'picture' => $name,
            ]);
        }


        return response()->json(['message' => 'บันทึกแก้ไขข้อมูลผู้ดำเนินงานในฟาร์มเรียบร้อย', 'id' => $staff->farm_id], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, $farm_id)
    {
        //
        $staff = Staff::findOrFail($id);
        $staff->delete();
        Storage::delete('public/picture/'.$staff->picture);
        // dd($staff->picture);
        // $id = $request->input('id');
        // $fram_id = $request->input('fram_id');
         return redirect()->route('manager.adduser', $farm_id)->with('success', 'Farm deleted successfully.');
        // return response()->json(['success' => true]);
        //  return response()->json(['success' => 'บันทึกข้อมูลฟาร์มเรียบร้อย'], 200);
    }
}
