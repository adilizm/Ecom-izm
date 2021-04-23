<?php

namespace App\Http\Controllers\Managment;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Prodect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    public function new_Order()
    {

        $waitting_orders = Order::where('status', 'new')->get()->toArray();
        $number_orders = count($waitting_orders);
        $int = -1;
        $prodects_ordred = []; // this is prodects in all orders
        $number_call_back = Order::where('status', 'call_back')->count();
        if (count($waitting_orders) < 1) {
            return view('managment.New_orders', [
                'orders' => $waitting_orders,
                'number_orders' => $number_orders,
                'prodect_and_qty' => [],
                'prodects' => $prodects_ordred,
                'number_call_back' => $number_call_back,
            ]);
        }
        $orders1 = [];
        $orders = [];
        foreach ($waitting_orders as $order) {
            $int++;
            $order['orderds_prodects_ids'] = [];
            $order['total'] = 0;
            $a = json_decode($order['prodects_json']);
            array_push($order['orderds_prodects_ids'], $a->products);
            array_push($orders1, $order);
        }

        //dd($orders1);
        foreach ($orders1 as $order) {
            foreach ($order['orderds_prodects_ids'] as $orders) {
                foreach ($orders as $order) {
                    $p = Prodect::Find($order->prodect_id)->toArray();
                    $order->prodet = $p;
                }
            }
        }
        $v = [];
        $i = 0;
        foreach ($orders1 as $order_) {
            foreach ($order_['orderds_prodects_ids'] as $products) {
                $i++;
                foreach ($products as $productx) {
                    foreach ($productx->selected_variant as $variantx) {
                        $ar = get_object_vars(json_decode($productx->prodet['variants'])); // convert to array and propreteys are string 
                        Array_push($v, $ar[$variantx[0]][$variantx[1]]);
                        //  dd($variantx);
                    }
                    $productx->selected_values = $v;
                    $v = [];
                    //  dd($productx);
                }
            }
        }

        //   dd($orders1);
        //  dd($orders1[0]['orderds_prodects_ids'][0]);

        //  dd($orders1[0]['orderds_prodects_ids'][0][0]->selected_variant[0][1]);
        return view('managment.New_orders', [
            'orders' => $orders1,
            'number_orders' => $number_orders,
            'number_call_back' => $number_call_back,
        ]);
    }
    public function to_call_back_orders()
    {


        $waitting_orders = Order::where('status', 'call_back')->get()->toArray();
        $number_orders = count($waitting_orders);
        $orderds_prodects_ids = []; // this is ids of orderd prodects and qty
        $int = -1;
        $prodects_ordred = []; // this is prodects in all orders
        $number_call_back = Order::where('status', 'call_back')->count();
        if (count($waitting_orders) < 1) {
            return view('managment.New_orders', [
                'orders' => $waitting_orders,
                'number_orders' => $number_orders,
                'prodect_and_qty' => [],
                'prodects' => $prodects_ordred,
                'number_call_back' => $number_call_back,
            ]);
        }
        $orders1 = [];
        $orders = [];
        $orderds_prodects_ids = ['orderds_prodects_ids' => []];
        foreach ($waitting_orders as $order) {
            $int++;
            $order['orderds_prodects_ids'] = [];
            $a = json_decode($order['prodects_json']);

            array_push($order['orderds_prodects_ids'], $a->products);
            array_push($orders1, $order);
        }
        //dd($orders1);

        $int = -1;
        // dd($orders1[0]['orderds_prodects_ids']);
        foreach ($orders1 as $order) {
            foreach ($order['orderds_prodects_ids'] as $orders) {
                foreach ($orders as $order) {
                    $p = Prodect::Find($order->prodect_id)->toArray();
                    $order->prodet = $p;
                }
            }
        }
        // dd($orders1[0]['orderds_prodects_ids'][0]);
        /*  foreach($waitting_orders as $order){
           $order->prod_qty=$orderds_prodects_ids;
            dd($order);
        }
       dd($waitting_orders, $orderds_prodects_ids,$prodects_ordred); */
       $v = [];
       $i = 0;
       foreach ($orders1 as $order_) {
           foreach ($order_['orderds_prodects_ids'] as $products) {
               $i++;
               foreach ($products as $productx) {
                   foreach ($productx->selected_variant as $variantx) {
                       $ar = get_object_vars(json_decode($productx->prodet['variants'])); // convert to array and propreteys are string 
                       Array_push($v, $ar[$variantx[0]][$variantx[1]]);
                       //  dd($variantx);
                   }
                   $productx->selected_values = $v;
                   $v = [];
                   //  dd($productx);
               }
           }
       }


        return view('managment.to_call_back', [
            'orders' => $orders1,
            'number_orders' => $number_orders,
            'number_call_back' => $number_call_back,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
    public function all_Orders()
    {

        $orders = Order::all();
        return view('managment.all_orders', ['orders' => $orders]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function Confirme(Request $request, $id)
    {
        $order = Order::FindOrFail($id);
        $order->status = 'confirmed';
        $order->name = $request->name;
        $order->telephone = $request->telephone;
        $order->address = $request->address;
        $order->email = $request->email;
        $order->note = $request->note;
        $order->save();
        return redirect()->route('new-orders');
    }
    public function success($id)
    {
        $order = Order::FindOrFail($id);
        $order->status = 'success';
        $order->save();
        return redirect()->route('new-orders');
    }
    public function returned($id)
    {
        $order = Order::FindOrFail($id);
        $order->status = 'returned';

        $prodects_ids_and_qty = json_decode($order->prodects_json);
        $int = -1;

        foreach ($prodects_ids_and_qty->products as $prod) {
            $int++;
            $product = Prodect::FindOrFail($prod->prodect_id);
           // $product->qty = $product->qty + $prod->qty;
            $product->save();
        }
        $order->save();
        return redirect()->route('new-orders');
    }
    public function no_response($id)
    {
        $order = Order::FindOrFail($id);
        $order->status = 'no_response';
        $order->save();
        return redirect()->route('noresponse_Orders');
    }
    public function call_back(Request $request, $id)
    {
        $order = Order::FindOrFail($id);
        $order->status = 'call_back';
        $order->name = $request->name;
        $order->telephone = $request->telephone;
        $order->address = $request->address;
        $order->email = $request->email;
        $order->note = $request->note;
        $order->save();
        return redirect()->route('new-orders');
    }
    public function delivred($id)
    {
        $order = Order::FindOrFail($id);
        $prodects_ids_and_qty = json_decode($order->prodects_json);
        $int = -1;

        foreach ($prodects_ids_and_qty->products as $prod) {
            $int++;
            $product = Prodect::FindOrFail($prod->prodect_id);
           // $product->qty = $product->qty - $prod->qty;
            $product->save();
        }

        $order->status = 'delivred';

        $order->save();
        return redirect()->route('confirmed_orders');
    }

    public function confirmed_Orders()
    {
        $waitting_orders = Order::where('status', 'confirmed')->get()->toArray();
        $number_orders = count($waitting_orders);
        $orderds_prodects_ids = []; // this is ids of orderd prodects and qty
        $int = -1;
        $prodects_ordred = []; // this is prodects in all orders
        $number_call_back = Order::where('status', 'call_back')->count();
        $orders1 = [];
        $orders = [];
        if (count($waitting_orders) < 1) {
            return view('managment.confirmed_orders', [
                'orders' => $waitting_orders,
                'number_orders' => $number_orders,
                'prodect_and_qty' => [],
                'prodects' => $prodects_ordred,
                'number_call_back' => $number_call_back,
            ]);
        }

        $orderds_prodects_ids = ['orderds_prodects_ids' => []];
        foreach ($waitting_orders as $order) {
            $int++;
            $order['orderds_prodects_ids'] = [];
            $order['total'] = 0;
            $a = json_decode($order['prodects_json']);
            array_push($order['orderds_prodects_ids'], $a->products);
            array_push($orders1, $order);
        }
        //dd($orders1);

        $int = -1;
        // dd($orders1[0]['orderds_prodects_ids']);
        foreach ($orders1 as $order) {
            foreach ($order['orderds_prodects_ids'] as $orders) {
                foreach ($orders as $order) {
                    $p = Prodect::Find($order->prodect_id)->toArray();
                    $order->prodet = $p;
                }
            }
        }

        foreach ($orders1 as $order) {

            foreach ($order['orderds_prodects_ids'] as $orders) {
                foreach ($orders as $_order) {
                 //   $order['total'] += $_order->qty * $_order->prodet['price'];
                }
            }
        }

        $v = [];
        $i = 0;
        foreach ($orders1 as $order_) {
            foreach ($order_['orderds_prodects_ids'] as $products) {
                $i++;
                foreach ($products as $productx) {
                    foreach ($productx->selected_variant as $variantx) {
                        $ar = get_object_vars(json_decode($productx->prodet['variants'])); // convert to array and propreteys are string 
                        Array_push($v, $ar[$variantx[0]][$variantx[1]]);
                        //  dd($variantx);
                    }
                    $productx->selected_values = $v;
                    $v = [];
                    //  dd($productx);
                }
            }
        }

        // dd($orders1[0]['orderds_prodects_ids'][0]);
        /*  foreach($waitting_orders as $order){
           $order->prod_qty=$orderds_prodects_ids;
            dd($order);
        }
       dd($waitting_orders, $orderds_prodects_ids,$prodects_ordred); */


        return view('managment.confirmed_orders', [
            'orders' => $orders1,
            'number_orders' => $number_orders,
            'number_call_back' => $number_call_back,
        ]);
    }
    public function noresponse_Orders()
    {
        $waitting_orders = Order::where('status', 'no_response')->get()->toArray();
        $number_orders = count($waitting_orders);
        $orderds_prodects_ids = []; // this is ids of orderd prodects and qty
        $int = -1;
        $prodects_ordred = []; // this is prodects in all orders
        $number_call_back = Order::where('status', 'call_back')->count();

        $orders1 = [];
        $orders = [];
        if (count($waitting_orders) < 1) {
            return view('managment.noresponse_Orders', [
                'orders' => $orders1,
                'number_orders' => $number_orders,
                'number_call_back' => $number_call_back,
            ]);
        }
        foreach ($waitting_orders as $order) {
            $int++;
            $order['orderds_prodects_ids'] = [];
            $order['total'] = 0;
            $a = json_decode($order['prodects_json']);
            array_push($order['orderds_prodects_ids'], $a->products);
            array_push($orders1, $order);
        }
        $int = -1;

        foreach ($orders1 as $order) {
            foreach ($order['orderds_prodects_ids'] as $orders) {
                foreach ($orders as $order) {
                    $p = Prodect::Find($order->prodect_id)->toArray();
                    $order->prodet = $p;
                }
            }
        }
        $v = [];
        $i = 0;
        foreach ($orders1 as $order_) {
            foreach ($order_['orderds_prodects_ids'] as $products) {
                $i++;
                foreach ($products as $productx) {
                    foreach ($productx->selected_variant as $variantx) {
                        $ar = get_object_vars(json_decode($productx->prodet['variants'])); // convert to array and propreteys are string 
                        Array_push($v, $ar[$variantx[0]][$variantx[1]]);
                        //  dd($variantx);
                    }
                    $productx->selected_values = $v;
                    $v = [];
                    //  dd($productx);
                }
            }
        }
        return view('managment.noresponse_Orders', [
            'orders' => $orders1,
            'number_orders' => $number_orders,
            'number_call_back' => $number_call_back,
        ]);
    }
    public function success_Orders()
    {
        $waitting_orders = Order::where('status', 'success')->get()->toArray();
        $number_orders = count($waitting_orders);
        $orderds_prodects_ids = []; // this is ids of orderd prodects and qty
        $int = -1;
        $prodects_ordred = []; // this is prodects in all orders
        $number_call_back = Order::where('status', 'call_back')->count();

        $orders1 = [];
        $orders = [];
        if (count($waitting_orders) < 1) {
            return view('managment.success', [
                'orders' => $orders1,
                'number_orders' => $number_orders,
                'number_call_back' => $number_call_back,
            ]);
        }
        foreach ($waitting_orders as $order) {
            $int++;
            $order['orderds_prodects_ids'] = [];
            $order['total'] = 0;
            $a = json_decode($order['prodects_json']);
            array_push($order['orderds_prodects_ids'], $a->products);
            array_push($orders1, $order);
        }
        $int = -1;

        foreach ($orders1 as $order) {
            foreach ($order['orderds_prodects_ids'] as $orders) {
                foreach ($orders as $order) {
                    $p = Prodect::Find($order->prodect_id)->toArray();
                    $order->prodet = $p;
                }
            }
        }
        $v = [];
        $i = 0;
        foreach ($orders1 as $order_) {
            foreach ($order_['orderds_prodects_ids'] as $products) {
                $i++;
                foreach ($products as $productx) {
                    foreach ($productx->selected_variant as $variantx) {
                        $ar = get_object_vars(json_decode($productx->prodet['variants'])); // convert to array and propreteys are string 
                        Array_push($v, $ar[$variantx[0]][$variantx[1]]);
                        //  dd($variantx);
                    }
                    $productx->selected_values = $v;
                    $v = [];
                    //  dd($productx);
                }
            }
        }
        return view('managment.success', [
            'orders' => $orders1,
            'number_orders' => $number_orders,
            'number_call_back' => $number_call_back,
        ]);
    }
    public function returned_Orders()
    {
        $waitting_orders = Order::where('status', 'returned')->get()->toArray();
        $number_orders = count($waitting_orders);
        $orderds_prodects_ids = []; // this is ids of orderd prodects and qty
        $int = -1;
        $prodects_ordred = []; // this is prodects in all orders
        $number_call_back = Order::where('status', 'call_back')->count();

        $orders1 = [];
        $orders = [];
        if (count($waitting_orders) < 1) {
            return view('managment.returned', [
                'orders' => $orders1,
                'number_orders' => $number_orders,
                'number_call_back' => $number_call_back,
            ]);
        }
        foreach ($waitting_orders as $order) {
            $int++;
            $order['orderds_prodects_ids'] = [];
            $order['total'] = 0;
            $a = json_decode($order['prodects_json']);
            array_push($order['orderds_prodects_ids'], $a->products);
            array_push($orders1, $order);
        }
        $int = -1;

        foreach ($orders1 as $order) {
            foreach ($order['orderds_prodects_ids'] as $orders) {
                foreach ($orders as $order) {
                    $p = Prodect::Find($order->prodect_id)->toArray();
                    $order->prodet = $p;
                }
            }
        }
        $v = [];
        $i = 0;
        foreach ($orders1 as $order_) {
            foreach ($order_['orderds_prodects_ids'] as $products) {
                $i++;
                foreach ($products as $productx) {
                    foreach ($productx->selected_variant as $variantx) {
                        $ar = get_object_vars(json_decode($productx->prodet['variants'])); // convert to array and propreteys are string 
                        Array_push($v, $ar[$variantx[0]][$variantx[1]]);
                        //  dd($variantx);
                    }
                    $productx->selected_values = $v;
                    $v = [];
                    //  dd($productx);
                }
            }
        }
        return view('managment.returned', [
            'orders' => $orders1,
            'number_orders' => $number_orders,
            'number_call_back' => $number_call_back,
        ]);
    }

    public function delivred_Orders()
    {
        $waitting_orders = Order::where('status', 'delivred')->get()->toArray();
        $number_orders = count($waitting_orders);
        $orderds_prodects_ids = []; // this is ids of orderd prodects and qty
        $int = -1;
        $prodects_ordred = []; // this is prodects in all orders
        $number_call_back = Order::where('status', 'call_back')->count();
        $orders1 = [];
        $orders = [];
        if (count($waitting_orders) < 1) {
            return view('managment.delivred_orders', [
                'orders' => $waitting_orders,
                'number_orders' => $number_orders,
                'prodect_and_qty' => [],
                'prodects' => $prodects_ordred,
                'number_call_back' => $number_call_back,
            ]);
        }

        foreach ($waitting_orders as $order) {
            $int++;
            $order['orderds_prodects_ids'] = [];
            $order['total'] = 0;
            $a = json_decode($order['prodects_json']);
            array_push($order['orderds_prodects_ids'], $a->products);
            array_push($orders1, $order);
        }
        $int = -1;

        foreach ($orders1 as $order) {
            foreach ($order['orderds_prodects_ids'] as $orders) {
                foreach ($orders as $order) {
                    $p = Prodect::Find($order->prodect_id)->toArray();
                    $order->prodet = $p;
                }
            }
        }
        $v = [];
        $i = 0;
        foreach ($orders1 as $order_) {
            foreach ($order_['orderds_prodects_ids'] as $products) {
                $i++;
                foreach ($products as $productx) {
                    foreach ($productx->selected_variant as $variantx) {
                        $ar = get_object_vars(json_decode($productx->prodet['variants'])); // convert to array and propreteys are string 
                        Array_push($v, $ar[$variantx[0]][$variantx[1]]);
                        //  dd($variantx);
                    }
                    $productx->selected_values = $v;
                    $v = [];
                    //  dd($productx);
                }
            }
        }
        return view('managment.delivred_orders', [
            'orders' => $orders1,
            'number_orders' => $number_orders,
            'number_call_back' => $number_call_back,
        ]);
    }
}
