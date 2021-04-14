<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class CreateordersController extends Controller
{
    
     public function CreateOrder(Request $request)
    {
     
        $New_order=new Order;
        $New_order->name=$request->firstname;
        $New_order->telephone=$request->Telephone;
        $New_order->email=$request->Email;
        $New_order->address=$request->Address;
        $New_order->status='new';
        $New_order->note='new order';
        $New_order->prodects_json= json_encode($request->prodects_json);
        $New_order->save();
   
        return $New_order;






    }
}
