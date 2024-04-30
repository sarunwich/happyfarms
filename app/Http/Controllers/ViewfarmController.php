<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Farm;
use App\Models\Lot;
use App\Models\Product;
use Illuminate\Http\Request;

class ViewfarmController extends Controller
{
    //
    public function farm($id)
    {
        $farm = Farm::findOrFail($id);
        return view('farm.index',compact('farm'));
    }
    
    public function contact($id)
    {
        $farm = Farm::findOrFail($id);
        return view('farm.contact',compact('farm'));
    }
    public function product($id)
     {
        $farm = Farm::findOrFail($id);
        return view('farm.product',compact('farm'));
    }
    public function viewqr($id)
    {
        $lot=Lot::findOrFail($id);
        $product=Product::findOrFail( $lot->product_id);
        $farm = Farm::findOrFail($product->farm_id);
        
        return view('farm.view',compact('lot','farm','product'));
    }
}
