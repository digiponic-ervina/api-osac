<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DB;

class GeneralsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function data(Request $request)
    {
       $vehicle = $request->input('vehicle');
       if(empty($vehicle)){
           $data = DB::table('services')
                        ->join('generals', 'services.generals_id', '=', 'generals.id')
                        ->select('services.id', 'services.name', 'services.price','generals.name')
                        ->get();
       }else{
            $vehicle_id = DB::table('generals')->select('id')->where('name',$vehicle)->first();
            $data = DB::table('services')->where('generals_id',$vehicle_id->id)->get();

       }
       return $data;

    }
}
