<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Farm;
use App\Models\Farm_Staff;
use Illuminate\Support\Facades\Auth;

class ManagerController extends Controller
{
    //
    public function farm()
    {
        //
        $farms=Farm::join('farm__staff','farm__staff.farm_id','farms.id')
        ->select('farms.*')
        ->where('farm__staff.user_id', '=', Auth::user()->id)
        ->paginate(10);
        return view('manager.farms',compact('farms'));
    }
    public function addfarm()
    {
        //
      
        return view('manager.addfarms');
    }
}
