<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use DB;

class TransactionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    public function post(Request $request)
    {
        $data = DB::table('orders')->insert(array(
            'order_number'   => $request->json()->get('order_number'),
            'police_number'  => $request->json()->get('order_number'),
            'generals_id'    => $request->json()->get('generals_id'),
            'total'          => $request->json()->get('total'),
            'discount'       => $request->json()->get('discount'),
            'grand_total'    => $request->json()->get('grand_total'),
            "created_at"   => null,
            "updated_at"   => null,
            "deleted_at"   => null, 
        ));
        if($data){
            $order_detail = DB::table('orders_detail')->insert(array(
                'orders_id'         => $data['id'],
                'services_id'       => $request->json()->get('services_id'),
                'services_name'     => $request->json()->get('services_name'),
                'services_prices'   => $request->json()->get('services_prices'),
                "created_at"   => null,
                "updated_at"   => null,
            ));
            $status = ($order_detail) ? true : false;
        }else{
            $status = false;
        }
        $status = ($data) ? true : false;
        $msg = array(
            'status'    => $status,
            'message'   => ($status) ? 'Success' : 'Failed'
        );
        return $msg;
    }
}
