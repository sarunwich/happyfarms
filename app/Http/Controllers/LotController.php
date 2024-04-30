<?php

namespace App\Http\Controllers;

use App\Models\Lot;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class LotController extends Controller
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
            'myself' => 'required',
            'receive' => 'required',
            'packing_date' => 'required',
            'Expiration_date' => 'required',
            
            // Add your other validation rules here
        ]);
        $prefix = date("y")+43; 
        $prefix=$prefix.date("m");

        $products=Product::findOrFail($request->pid);
        if($products->farm_id<=9){
            $fid='0'.$products->farm_id;
        }else{
            $fid=$products->farm_id;
        }
        

        $prefix=$prefix.$fid;
        $id = IdGenerator::generate(['table' => 'lots', 'length' => 10, 'prefix' =>$prefix ,'reset_on_prefix_change' => true]);

        $lot = new Lot();
        $lot->id=$id;
        $lot->product_id = $request->pid;
        $lot->myself = $request->input('myself');
        $lot->receive = $request->input('receive');
        $lot->packing_date =  $request->input('packing_date');
        $lot->Expiration_date = $request->input('Expiration_date');
         $lot->save();
        return response()->json(['message' => 'บันทึกข้อมูลฟาร์มเรียบร้อย','id' => $request->pid], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Lot $lot,$id)
    {
        //
        $lot=Lot::findOrFail($id);
        $products=Product::findOrFail($lot->product_id);
        return view('manager.qrcode',compact('lot','products'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lot $lot)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lot $lot)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lot $lot)
    {
        //
    }
}
