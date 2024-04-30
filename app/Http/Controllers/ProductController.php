<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
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
            'product_name' => 'required',
            'type_id' => 'required',
            'packaging_id' => 'required',
            'farmid' => 'required',
            'image.*' => 'required',
            'unit' => 'required',
            'size_id' => 'required',
            'recommen' => 'required',
            'information' => 'required',
            'details' => 'required',
            // Add your other validation rules here
        ]);
        $product = new Product();
        $product->product_name = $request->input('product_name');
        $product->type_id = $request->input('type_id');
        $product->packaging_id = $request->input('packaging_id');
        $product->unit = $request->input('unit');
        $product->farm_id = $request->input('farmid');
        $product->size_id = $request->input('size_id');
        $product->recommen = $request->input('recommen');
        $product->information = $request->input('information');
        $product->details = $request->input('details');
        $product->status = 1;
        if ($request->hasFile('image')) {
            $file = $request->file("image");
            $filensme = $request->file("image")->getClientOriginalName();
            $filensme = explode(".", $filensme);
            $name = "Staff_" . $filensme[0] . "_" . time() . rand(1, 100) . '.' . $file->extension();
            // $file->move(public_path('signature'), $name);
            $imagePath = $file->storeAs('public/products', $name);
            $product->picture = $name;
        }
        $product->save();
        return response()->json(['message' => 'บันทึกข้อมูลฟาร์มเรียบร้อย','id' => $request->farmid], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product,$id,$farm_id)
    {
        //
        $product = Product::findOrFail($id);
        $product->delete();
        Storage::delete('public/products/'.$product->picture);
        
         return redirect()->route('manager.addproduct', $farm_id)->with('success', 'Farm deleted successfully.');
        
    }
    public function upstatus(Request $request)
    {
        $status =$request->status== 1 ? 0 : 1;
        
        $product = Product::findOrFail($request->id);
        $product->update([   
          
            'status' => $status,     
            // Update other fields as needed
        ]);
        return response()->json(['message' => 'Data received successfully']);
    }
}
