<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Farm;
use App\Models\Farm_Staff;
use App\Models\Staff;
use App\Models\Packaging;
use App\Models\Type;
use App\Models\size;
use App\Models\Product;
use App\Models\Lot;
use Illuminate\Support\Facades\Auth;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class ManagerController extends Controller
{
    //
    public function farm()
    {
        //
        $farms=Farm::join('farm__staff','farm__staff.farm_id','farms.id')
        ->select('farms.*')
        ->where('farm__staff.user_id', '=', Auth::user()->id)
        ->orderBy('farms.id', 'desc')
        ->paginate(10);
        return view('manager.farms',compact('farms'));
    }
    public function addfarm()
    {
        //
      
        return view('manager.addfarms');
    }
    public function viewfarm(Request $request)
    {
        $id=$request->id;
        $farm = Farm::findOrFail($id);
        return view('manager.viewfarm',compact('farm'));
    }
    public function users()
    {
        $farms=Farm::join('farm__staff','farm__staff.farm_id','farms.id')
        ->select('farms.*')
        ->where('farm__staff.user_id', '=', Auth::user()->id)
        ->orderBy('farms.id', 'desc')
    
        ->paginate(10);
        return view('manager.users',compact('farms'));
    }
    public function adduser($id)
    {
        $farm = Farm::findOrFail($id);
        return view('manager.adduser',compact('id','farm'));
    }

    public function edituser($id)
    {
        $staff = Staff::findOrFail($id);
        return view('manager.edituser',compact('staff'));
    }
    public function product()
    {
        $farms=Farm::join('farm__staff','farm__staff.farm_id','farms.id')
        ->select('farms.*')
        ->where('farm__staff.user_id', '=', Auth::user()->id)
        ->orderBy('farms.id', 'desc')
    
        ->paginate(10);
        return view('manager.product',compact('farms'));
    }
    public function addproduct($id)
    {
        $farm = Farm::findOrFail($id);
        $packagings=Packaging::all();
        $types =Type::all();
        $sizes = size::all();
        return view('manager.addproduct',compact('id','farm','packagings','types','sizes'));
    }
    public function lot()
    {
        $farms=Farm::join('farm__staff','farm__staff.farm_id','farms.id')
        ->select('farms.*')
        ->where('farm__staff.user_id', '=', Auth::user()->id)
        ->orderBy('farms.id', 'desc')
    
        ->paginate(10);
        return view('manager.lot',compact('farms'));
    }
    public function addlot($id)
    {
        $farm = Farm::findOrFail($id);
        $packagings=Packaging::all();
        $types =Type::all();
        $sizes = size::all();
        return view('manager.addlot',compact('id','farm','packagings','types','sizes'));
    }
    public function viewlot($id)
    {
        $products=Product::findOrFail($id);
        // $farm = Farm::findOrFail($id);
        // $packagings=Packaging::all();
        // $types =Type::all();
        // $sizes = size::all();
        $prefix = date("y")+43; 
        $prefix=$prefix.date("m");
        if($products->farm_id<=9){
            $fid='0'.$products->farm_id;
        }else{
            $fid=$products->farm_id;
        }
        

        $prefix=$prefix.$fid;
        $id = IdGenerator::generate(['table' => 'lots', 'length' => 10, 'prefix' =>$prefix ,'reset_on_prefix_change' => true]);
        $lots = $products->lots() // Access the lots relationship
        ->orderByDesc('id') // Order the lots by id in descending order
        ->paginate(10); 
        // dd($lots);
        return view('manager.viewlot',compact('products','id','lots'));
    }
}
