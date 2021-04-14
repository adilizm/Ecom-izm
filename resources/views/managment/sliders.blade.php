@extends('managment.layouts.master')
@section('content')
<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title ">Sliders</h4>
        <p class="card-category"> Those are all the sliders</p>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <thead class=" text-primary">
                    <th>
                        image
                    </th>
                    <th>
                        titel
                    </th>
                    <th>
                        description
                    </th>
                    <th>
                        Tools
                    </th>
                </thead>
                <tbody>
                    @foreach ($sliders as $slider)
                    <tr>
                        <td>
                            <img src="{{$slider->image_url}}" width="130" height="100" alt="slider image">
                        </td>
                        <td>
                            {{$slider->title}}
                        </td>
                        <td>
                            {{$slider->description}}
                        </td>
                        <td>
                            
                            <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="{{'#modal_edite_'.$slider->id}}"><i class="material-icons">edit</i></button>
                          
                            <div class="modal fade" id="{{'modal_edite_'.$slider->id}}" tabindex="-1" aria-labelledby="{{'modal_edite_'.$slider->id}}"
                            aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="{{'#modal_edite_'.$slider->id}}"> New Slider Form</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="{{ route('sliders.update',$slider->id) }}" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                                <div class="form-row">
                                                    <div class="form-group col-12">
                                                        <label for="inputEmail4">slider name</label>
                                                        <input type="text" value="{{$slider->title}}" required name="title" class="form-control" id="inputEmail4">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="form-group col-12">
                                                        <label for="textareadescription">prodect description</label>
                                                        <textarea required type="text" minlength="20" maxlength="400" name="description"  style="height: 100px" class="form-control"
                                                            id="textareadescription"> {{$slider->description}}</textarea>
                                                    </div>
                                                </div>
                                             
                                                <div class="form-group col-12 ">
                                                    <div class="row" style="    justify-content: space-around;">
                                                        <div class="">
                                                           <img src="{{$slider->image_url}}" alt="" width="250">
                                                           <input type="file" name="image_url" style=" opacity: 100; position: unset;">
                                                        </div>
                                                    </div>
                                                </div>
                                            <button type="submit" class="btn btn-success float-right">Add Slider</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                          
                          
                          
                          
                          
                          
                          
                          
                          
                          
                            <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="{{'#modal_delete_'.$slider->id}}"><i class="material-icons">delete</i></button>

                        </td>
                    </tr>
                    @endforeach
                 
                  
                </tbody>
            </table>

        </div>

        <button class="btn btn-primary float-right" type="button" data-toggle="modal" data-target="#modal_new_"> New Slider </button>

        <div class="modal fade" id="modal_new_" tabindex="-1" aria-labelledby="{{ 'modal_new' }}"
        aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_new"> New Slider Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('sliders.store') }}" enctype="multipart/form-data">
                        @csrf
                            <div class="form-row">
                                <div class="form-group col-12">
                                    <label for="inputEmail4">slider name</label>
                                    <input type="text" required name="title" class="form-control" id="inputEmail4">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-group col-12">
                                    <label for="textareadescription">prodect description</label>
                                    <textarea required type="text" minlength="20" maxlength="400" name="description"  style="height: 100px" class="form-control"
                                        id="textareadescription"></textarea>
                                </div>
                            </div>
                         
                            <div class="form-group col-12 ">
                                <div class="row" style="    justify-content: space-around;">
                                    <div class="fileinput fileinput-new text-center m-1"
                                        data-provides="fileinput">
                                        <div class="fileinput-new thumbnail img-raised">
                                            <img src="../jscssmanagment/img/select_product_image_main.png"
                                                rel="nofollow" alt="...">
                                        </div>
                                        <div
                                            class="fileinput-preview fileinput-exists thumbnail img-raised">
                                        </div>
                                        <div>
                                            <span class="btn btn-raised btn-round btn-default btn-file">
                                                <span class="fileinput-new">Select image</span>
                                                <span class="fileinput-exists">Change</span>
                                                <input required type="file" name="image_url" />
                                            </span>
                                            <a href="#pablo"
                                                class="btn btn-danger btn-round fileinput-exists"
                                                data-dismiss="fileinput"><i class="fa fa-times"></i>
                                                Remove</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <button type="submit" class="btn btn-success float-right">Add Slider</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
      
    </div>
</div>
@endsection