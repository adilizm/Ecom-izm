@extends('managment.layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title ">Prodects</h4>
                    <p class="card-category"> Those are all the prodects </p>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-primary">
                                <th>
                                    Image
                                </th>
                                <th>
                                    Name
                                </th>
                                <th>
                                    Description
                                </th>
                                <th>
                                    price
                                </th>
                                <th>
                                    Qty left
                                </th>
                                <th>
                                    Tools
                                </th>
                            </thead>
                            <tbody>
                                @foreach ($prodects as $prodect)
                                    <tr>
                                        <td>
                                            <img src="{{$prodect->image1}}" width="50">
                                        </td>
                                        <td>
                                            {{ $prodect->name }}
                                        </td>
                                        <td>
                                            {{ $prodect->description }}
                                        </td>
                                        <td>
                                            {{ $prodect->price }}
                                        </td>
                                        <td>
                                            {{ $prodect->qty }}
                                        </td>
                                        <td>
                                           <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="{{'#modal_edite_'.$prodect->name}}"><i class="material-icons">edit</i></button>

                                           <div class="modal fade" id="{{'modal_edite_'.$prodect->name}}" tabindex="-1" aria-labelledby="{{'modal_edite_'.$prodect->name}}"
                                           aria-hidden="true">
                                           <div class="modal-dialog modal-xl">
                                               <div class="modal-content">
                                                   <div class="modal-header">
                                                       <h5 class="modal-title" id="{{'modal_edite_'.$prodect->name}}"> New Product Form</h5>
                                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                           <span aria-hidden="true">&times;</span>
                                                       </button>
                                                   </div>
                                                   <div class="modal-body">
                                                       <form method="POST"  action="{{ route('prodects.update',$prodect->slug)}}" enctype="multipart/form-data">
                                                           @csrf
                                                           @method('PUT')
                                                               <div class="form-row">
                                                                   <div class="form-group col-md-6">
                                                                       <label for="inputEmail4">Product name</label>
                                                                       <input type="text" required name="name" value="{{$prodect->name}}" class="form-control" id="inputEmail4">
                                                                   </div>
                                                                   <div class="form-group col-md-6">
                                                                       <select  name="categori_id" class="form-control">
                                                                           <option selected>Select Category</option>
                                                                           @foreach ($categories as $category)
                                                                           <option @if ($prodect->categori_id == $category->id) selected  @endif value="{{$category->id}}">{{$category->name}}</option>
                                                                           @endforeach
                                                                         </select>
                                                                   </div>
                                                               </div>
                                                               <div class="form-group">
                                                                   <div class="form-group col-12">
                                                                       <label for="textareadescription">prodect description</label>
                                                                       <textarea required type="text" minlength="40" maxlength="400" name="description"  style="height: 100px" class="form-control"
                                                                           id="textareadescription">{{$prodect->description}}</textarea>
                                                                   </div>
                                                               </div>
                                                               <div class="form-group">
                                                                   <div class="row">
                                                                       <div class="col-md-4 col-lg-4 col-xl-4">
                                                                   <label for="inputAddress2">Price</label>
                                                                   <input required type="text" name="price" value="{{$prodect->price}}" class="form-control" id="inputAddress2"
                                                                       placeholder="999.55 Dhs">
                                                                   </div>
                                                                   <div class="col-md-4 col-lg-4 col-xl-4">
                                                                       <label for="inputAddress2">Quantity</label>
                                                                       <input required type="number" name="qty"  value="{{$prodect->qty}}" class="form-control" id="inputAddress2">
                                                                       </div>
                                                                       <div class="col-md-4 col-lg-4 col-xl-4 text-center" >
                                                                           <input class="form-check-input" name="show_in_home" @if ($prodect->show_in_home) checked  @endif type="checkbox" id="inlineCheckbox1" value="true">
                                                                           <label class="form-check-label"  for="inlineCheckbox1"> Show in Home</label>
                                                                           </div>
                                                                   </div>
                                                               </div>
                                                               <div class="form-group col-12 ">
                                                                   <div class="row" style="    justify-content: space-around;">
                                                                        <div class="col-md-4 col-6 col-lg-4 col-xl-4 position-relative">
                                                                            <img src="{{$prodect->image1}}" alt="image1" width="100" height="100">
                                                                               <input type="file" name="image1" id="update-image" class=" opacity: 100; position: unset;">
                                                                        </div>
                                                                        <div class="col-md-4 col-6 col-lg-4 col-xl-4 position-relative">
                                                                            <img src="{{$prodect->image2}}" alt="image2" width="100" height="100">
                                                                               <input type="file" name="image2" id="update-image" class=" opacity: 100; position: unset;">
                                                                        </div>
                                                                        <div class="col-md-4 col-6 col-lg-4 col-xl-4 position-relative">
                                                                            <img @if (!isset($prodect->image3))
                                                                            src="http://127.0.0.1:8000/jscssmanagment/img/select_product_image_3.png"
                                                                            @else
                                                                            src="{{$prodect->image3}}"
                                                                            @endif alt="image3" width="100" height="100">
                                                                               <input type="file" name="image3" id="update-image" class=" opacity: 100; position: unset;">
                                                                        </div>
                                                                        
                                                                   </div>
                                                               </div>
                                                           <button type="submit" class="btn btn-success float-right">Update product</button>
                                                       </form>
                                                   </div>
                                               </div>
                                           </div>
                                       </div>



                                           <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="{{'#modeleDelete'.$prodect->id}}" ><i class="material-icons">delete</i></button>

                                           <div class="modal fade" id="{{'modeleDelete'.$prodect->id}}" tabindex="-1" aria-labelledby="{{'modeleDeletelabel'.$prodect->id}}" aria-hidden="true">
                                            <div class="modal-dialog">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <h5 class="modal-title" id="{{'modeleDeletelabel'.$prodect->id}}">Deleting prodect </h5>
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                  </button>
                                                </div>
                                                <div class="modal-body">
                                                <h5 class="text-danger"> Are you sure you want to delete prodect {{$prodect->name}} ?</h5>
                                                </div>
                                                <div class="modal-footer">
                                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                  <form action="{{ route('prodects.destroy',$prodect->slug)}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Confirm and delete</button>
                                                </form>

                                                </div>
                                              </div>
                                            </div>
                                          </div>

                                        </td>
                                @endforeach
                            </tbody>
                        </table>

                    </div>

                    <button class="btn btn-primary float-right" type="button" data-toggle="modal" data-target="#modal_new_">
                        New Prodect </button>
                    <div class="modal fade" id="modal_new_" tabindex="-1" aria-labelledby="{{ 'modal_new' }}"
                        aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modal_new"> New Product Form</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('prodects.store') }}" enctype="multipart/form-data">
                                        @csrf
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="inputEmail4">Product name</label>
                                                    <input type="text" required name="name" class="form-control" id="inputEmail4">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <select  name="categori_id" class="form-control">
                                                        <option selected>Select Category</option>
                                                        @foreach ($categories as $category)
                                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                                        @endforeach
                                                      </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="form-group col-12">
                                                    <label for="textareadescription">prodect description</label>
                                                    <textarea required type="text" minlength="40" maxlength="400" name="description"  style="height: 100px" class="form-control"
                                                        id="textareadescription"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-4 col-lg-4 col-xl-4">
                                                <label for="inputAddress2">Price</label>
                                                <input required type="text" name="price" class="form-control" id="inputAddress2"
                                                    placeholder="999.55 Dhs">
                                                </div>
                                                <div class="col-md-4 col-lg-4 col-xl-4">
                                                    <label for="inputAddress2">Quantity</label>
                                                    <input required type="number" name="qty" class="form-control" id="inputAddress2">
                                                    </div>
                                                    <div class="col-md-4 col-lg-4 col-xl-4 text-center" >
                                                        <input class="form-check-input" name="show_in_home" type="checkbox" id="inlineCheckbox1" value="true">
                                                        <label class="form-check-label" for="inlineCheckbox1"> Show in Home</label>
                                                        </div>
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
                                                                <input required type="file" name="image1" />
                                                            </span>
                                                            <a href="#pablo"
                                                                class="btn btn-danger btn-round fileinput-exists"
                                                                data-dismiss="fileinput"><i class="fa fa-times"></i>
                                                                Remove</a>
                                                        </div>
                                                    </div>
                                                    <div class="fileinput fileinput-new text-center m-1"
                                                    data-provides="fileinput">
                                                    <div class="fileinput-new thumbnail img-raised">
                                                        <img src="../jscssmanagment/img/select_product_image_2.png"
                                                            rel="nofollow" alt="...">
                                                    </div>
                                                    <div
                                                        class="fileinput-preview fileinput-exists thumbnail img-raised">
                                                    </div>
                                                    <div>
                                                        <span class="btn btn-raised btn-round btn-default btn-file">
                                                            <span class="fileinput-new">Select image</span>
                                                            <span class="fileinput-exists">Change</span>
                                                            <input type="file" name="image2" />
                                                        </span>
                                                        <a href="#pablo"
                                                            class="btn btn-danger btn-round fileinput-exists"
                                                            data-dismiss="fileinput"><i class="fa fa-times"></i>
                                                            Remove</a>
                                                    </div>
                                                </div>
                                                    <div class="fileinput fileinput-new text-center m-1"
                                                    data-provides="fileinput">
                                                    <div class="fileinput-new thumbnail img-raised">
                                                        <img src="../jscssmanagment/img/select_product_image_3.png"
                                                            rel="nofollow" alt="...">
                                                    </div>
                                                    <div
                                                        class="fileinput-preview fileinput-exists thumbnail img-raised">
                                                    </div>
                                                    <div>
                                                        <span class="btn btn-raised btn-round btn-default btn-file">
                                                            <span class="fileinput-new">Select image</span>
                                                            <span class="fileinput-exists">Change</span>
                                                            <input type="file" name="image3" />
                                                        </span>
                                                        <a href="#pablo"
                                                            class="btn btn-danger btn-round fileinput-exists"
                                                            data-dismiss="fileinput"><i class="fa fa-times"></i>
                                                            Remove</a>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                        <button type="submit" class="btn btn-success float-right">Add new product</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

@endsection
