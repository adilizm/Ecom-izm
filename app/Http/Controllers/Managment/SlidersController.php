<?php

namespace App\Http\Controllers\Managment;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class SlidersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders=Slider::all();
        return view('managment.sliders',['sliders'=>$sliders]);
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
            $slider = new Slider();
            $slider->title= $request->title;
            $slider->description= $request->description;
            $name_image = time() . '-' . Str::slug($request->title) . '.' . $request->image_url->guessExtension();
            $request->image_url->move(public_path('images'), $name_image);
            $slider->image_url = '/images/' . $name_image;
            $slider->save();
            return redirect()->route('sliders.index');
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
        $slider=Slider::find($id);
        $slider->title=$request->title;
        $slider->description=$request->description;
        if(isset($request->image_url)){
            $name_image = time() . '-' . Str::slug($request->title) . '.' . $request->image_url->guessExtension();
            $request->image_url->move(public_path('images'), $name_image);
            unlink(substr($slider->image_url,1));
            $slider->image_url = '/images/' . $name_image; 
        }
        $slider->save();
        return redirect()->route('sliders.index');
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
}
