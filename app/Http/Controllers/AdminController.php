<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\Models\Farm;
use App\Models\Farm_Staff;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
class AdminController extends Controller
{
    public function managerfarm(Request $request, $id)
    {
        $farm_staff = new Farm_Staff();
        $farm_staff->user_id = $request->user_id;
        $farm_staff->farm_id = $id;
        $farm_staff->save();

        return response()->json(['message' => 'บันทึกข้อมูลเรียบร้อย'], 200);
    }
    public function autocomplete(Request $request): JsonResponse
    {
        $data = [];
    
        if($request->filled('q')){
            $data = User::select("name", "id")
                        ->where('name', 'LIKE', '%'. $request->get('q'). '%')
                        ->where('type','2')
                        ->get();
        }
     
        return response()->json($data);
    }
    public function addmanager(Request $request)
    {
        $id=$request->id;
        $users=User::where('type','2')
        ->get();
        return view('admin.addmanager',compact('id','users'));
    
       
    }
    public function farm()
    {
        //
        $farms=Farm::join('farm__staff','farm__staff.farm_id','farms.id')
        ->select('farms.*')
        // ->where('farm__staff.user_id', '=', Auth::user()->id)
        ->orderBy('farms.id', 'desc')
        ->paginate(10);
        return view('admin.farms',compact('farms'));
    }
    //
    public function managuser()
    {
        //
        $users=User::paginate(10);
        return view('admin.users',compact('users'));
    }
    public function UpstatusType(Request $request)
    {
        $id = $request->id;
        $intValue = intval($request->type);
        try {
            DB::table('users')
                ->where('id', $id)
                ->update(['type' => $intValue]);
            //  return response($request);
        } catch (QueryException $e) {
            // Handle the query exception
            echo 'Error: ' . $e->getMessage();
            return ($e->getMessage());
        }
        // return response($request)->red;
        return response()->json(['success' => 'Data is successfully added']);
    }

}
