<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DB;

class ServiceController extends Controller
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
                    ->join('generals as vh', 'services.generals_id', '=', 'vh.id')
                    ->join('generals as tp', 'services.types_id', '=', 'tp.id')
                    ->select('services.id', 'services.name', 'services.price','vh.name as vehicle','tp.name as type')
                    ->get();
       }else{
            $vehicle_id = DB::table('generals')->select('id')->where('name',$vehicle)->first();
            $data = DB::table('services')->where('generals_id',$vehicle_id->id)
                    ->join('generals as vh', 'services.generals_id', '=', 'vh.id')
                    ->join('generals as tp', 'services.types_id', '=', 'tp.id')
                    ->select('services.id', 'services.name', 'services.price','vh.name as vehicle','tp.name as type')
                    ->get();
       }
       return $data;
    }
}
