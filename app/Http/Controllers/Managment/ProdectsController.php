<?php

namespace App\Http\Controllers\Managment;

use App\Http\Controllers\Controller;
use App\Models\category;
use App\Models\Prodect;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProdectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

       
        $prodects = Prodect::all()->toArray();
        $prods=[];
        $variants=[];
       $i=-1;
        foreach($prodects as $prodect){
            $i++;
           $prods[$i]=$prodect;
           $prods[$i]['variants_values']=json_decode($prodect['variants']);
        }
        $i=-1;
       // dd(array_keys( get_object_vars($prods[0]['variants_values'])));
     
        foreach($prods as $prodect){
            $i++;
           $prods[$i]['variants'] = array_keys( get_object_vars($prodect['variants_values']));
        }
    
     

     
      
                $categories = category::all();
        
        return view('managment.prodects', ['prodects' => $prods, 'categories' => $categories]);
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
        
        $variants=[];
        $values='values';
        $i=-1;
        $values='values'.$i;
        
        if( isset( $request->variant)){
            foreach($request->variant as $variant){
               $variants[$variant]=[];
            } 
           //dd($variants);
            $i=-1;
            foreach($request->variant as $variantt){
                $i++;
                $values='values'.$i;
                $variants[$variantt]=$request->$values;          
            } 
          
        }
        //dd(json_encode($variants));
        $request->validate([
            'name' => 'bail|required',
            'description' => 'bail|required',
            'categori_id' => 'required',
            'price' => 'required|numeric',
          //  'qty' => 'bail|required|numeric',
        ]);

        $product = new Prodect();
        $product->variants=json_encode($variants);
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->description = $request->description;
        $product->price = $request->price;

        $name_image1 = time() . '-' . $request->name  . '1' . '.' . $request->image1->guessExtension();
        $request->image1->move(public_path('images'), $name_image1);
        $product->image1 = '/images/' . $name_image1;

        if (isset($request->image2)) {
            $name_image2 = time() . '-' . $request->name . '2' . '.' . $request->image2->guessExtension();
            $request->image2->move(public_path('images'), $name_image2);
            $product->image2 = '/images/' . $name_image2;
        }

        if (isset($request->image3)) {
            $name_image3 = time() . '-' . $request->name  . '3' . '.' . $request->image3->guessExtension();
            $request->image3->move(public_path('images'), $name_image3);
            $product->image3 = '/images/' . $name_image3;
        }else{
            $product->image3 = 'null' ;
        }

        $product->show_in_home = isset($request->show_in_home) ? true : false;


       // $product->qty = $request->qty;
        $product->categori_id = $request->categori_id;
        $product->save();
       
        return redirect()->route('prodects.index');
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
    public function update(Request $request, $slug)
    {
          //  dd($request);
            $product = Prodect::where('slug',$slug)->first();
            $values='values';
            $i=-1;
            $values='values'.$i;
            $variants=[];
            if( isset( $request->variant)){
                        foreach($request->variant as $variant){
                           $variants[$variant]=[];
                        } 
                       //dd($variants);
                        $i=-1;
                        foreach($request->variant as $variantt){
                            $i++;
                            $values='values'.$i;
                            $variants[$variantt]=$request->$values;          
                        } 
                      
                    }
             $product->variants=json_encode($variants);
                  
            $product->name = $request->name;
            $product->slug = Str::slug($request->name);
            $product->description = $request->description;
            $product->price = $request->price;
            if(isset($request->image1)){
                $name_image1 = time() . '-' . Str::slug($request->name)  . '1' . '.' . $request->image1->guessExtension();
                $request->image1->move(public_path('images'), $name_image1);
                unlink(substr($product->image1,1));
                $product->image1 = '/images/' . $name_image1;
            }
           
            if (isset($request->image2)) {
                $name_image2 = time() . '-' . Str::slug($request->name) . '2' . '.' . $request->image2->guessExtension();
                $request->image2->move(public_path('images'), $name_image2);
                unlink(substr($product->image2,1));
                $product->image2 = '/images/' . $name_image2;
            }
    
            if (isset($request->image3)) {
                $name_image3 = time() . '-' . Str::slug($request->name)  . '3' . '.' . $request->image3->guessExtension();
                $request->image3->move(public_path('images'), $name_image3);
              //  dd($product->image3);
                if($product->image3 != null && $product->image3 != 'null' ){
                    unlink(substr($product->image3,1));
                }
               
                $product->image3 = '/images/' . $name_image3;
            }
    
            $product->show_in_home = isset($request->show_in_home) ? true : false;
    
            //dd(  $product->variants);
        //    $product->qty = $request->qty;
            $product->categori_id = $request->categori_id;
       
            $product->save();
         


         
            return redirect()->route('prodects.index');



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $product = Prodect::where('slug',$slug)->first();
        if(isset($product->image1)){
            unlink(substr($product->image1,1));
        }
        if(isset($product->image2)){
            unlink(substr($product->image2,1));
        }
        if(isset($product->image3)){
            unlink(substr($product->image3,1));
        }
        $product->delete();
        return redirect()->route('prodects.index');
    }
}
