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
                                    price
                                </th>
                                <th>
                                    Tools
                                </th>
                            </thead>
                            <tbody>
                                @foreach ($prodects as $prodect)
                                    <tr>
                                        <td>
                                            <img src="{{$prodect['image1']}}" width="50">
                                        </td>
                                        <td>
                                            {{ $prodect['name'] }}
                                        </td>
                                        <td>
                                            {{ $prodect['price'] }}
                                        </td>
                                        <td>
                                           <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="{{'#modal_edite_'.$prodect['name']}}"><i class="material-icons">edit</i></button>
















                                           <div class="modal fade" id="{{'modal_edite_'.$prodect['name']}}" tabindex="-1" aria-labelledby="{{'modal_edite_'.$prodect['name']}}"
                                           aria-hidden="true">
                                           <div class="modal-dialog modal-xl">
                                               <div class="modal-content">
                                                   <div class="modal-header">
                                                       <h5 class="modal-title" id="{{'modal_edite_'.$prodect['name']}}"> New Product Form</h5>
                                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                           <span aria-hidden="true">&times;</span>
                                                       </button>
                                                   </div>
                                                   <div class="modal-body">
                                                       <form method="POST"  action="{{ route('prodects.update',$prodect['slug'])}}" enctype="multipart/form-data">
                                                           @csrf
                                                           @method('PUT')
                                                               <div class="form-row">
                                                                   <div class="form-group col-md-6">
                                                                       <label for="inputEmail4">Product name</label>
                                                                       <input type="text" required name="name" value="{{$prodect['name']}}" class="form-control" id="inputEmail4">
                                                                   </div>
                                                                   <div class="form-group col-md-6">
                                                                       <select  name="categori_id" class="form-control">
                                                                           <option selected>Select Category</option>
                                                                           @foreach ($categories as $category)
                                                                           <option @if ($prodect['categori_id'] == $category->id) selected  @endif value="{{$category->id}}">{{$category->name}}</option>
                                                                           @endforeach
                                                                         </select>
                                                                   </div>
                                                               </div>
                                                               <div class="form-group">
                                                                   <div class="form-group col-12">
                                                                       <label for="textareadescription">prodect description</label>
                                                                       <textarea required type="text" minlength="40" maxlength="400" name="description"  style="height: 100px" class="form-control"
                                                                           id="{{'editoredit'.$prodect['id']}}">{!! $prodect['description'] !!}</textarea>
                                                                   </div>
                                                               </div>
                                                               <div class="form-group">
                                                                   <div class="row">
                                                                       <div class="col-md-4 col-lg-4 col-xl-4">
                                                                   <label for="inputAddress2">Price</label>
                                                                   <input required type="text" name="price" value="{{$prodect['price']}}" class="form-control" id="inputAddress2"
                                                                       placeholder="999.55 Dhs">
                                                                   </div>
                                                           
                                                                       <div class="col-md-4 col-lg-4 col-xl-4 text-center" >
                                                                           <input class="form-check-input" name="show_in_home" @if ($prodect['show_in_home']) checked  @endif type="checkbox" id="inlineCheckbox1" value="true">
                                                                           <label class="form-check-label"  for="inlineCheckbox1"> Show in Home</label>
                                                                           </div>
                                                                   </div>
                                                               </div>
                                                               <div class="form-group ">

                                                                   <div class="row justify-content-between">
                                                                    <div id="variant_nameedite">
                                                                        
                                                                       <div id="Variants-containeredite">
                                                                        @foreach ($prodect['variants_values'] as $variant)
                                                                          <div id="cloneedite" class="d-flex notificationVariant">
                                                                             <span class="badgeVariant" onclick="DeleteValueedite(this)">X</span> <input required="" type="text" style=" max-width: 150px;" name="variant[]" value="{{$prodect['variants'][$loop->index]}}"  class="form-control" id="variant_nameedite" placeholder="Variant Name"> 
                                                                             @foreach ($variant as $value)
                                                                             <div class=" d-flex mx-2 notification"><input required="" type="text" name="values{{$loop->parent->index}}[]" value="{{$value}}" onkeydown="newValueedite(event.key,this)" class="form-control mx-2 ggedite" id="Variant_valuesedite" placeholder="Values">  <span class="badge" onclick="DeleteValueedite(this)">X</span> </div>
                                                                             @endforeach
                                                                            </div>
                                                                          @endforeach
                                                                       </div>
                                                                    </div>
                                                                    <div></div>
                                                                </div>
                                                                    <div class="mr-5">
                                                                       <span onclick="addNewVariantedite(this)" class="btn btn-sm btn-outline-primary">
                                                                          Add new variant
                                                                          <div class="ripple-container"></div>
                                                                       </span>
                                                                    </div>
                                                                 </div>
















                                                               {{--  @foreach ($prodect['variants_values'] as $variant)
                                                
                                                                        <div id="cloneedite" class="d-flex notificationVariant">
                                                                            <span class="badgeVariant" onclick="DeleteValueedite(this)">X</span> 
                                                                            <input required type="text" style=" max-width: 150px;" name="variant[]" value="{{$prodect['variants'][$loop->index]}}"  class="form-control" id="variant_nameedite" placeholder="Variant Name">
                                                                        @foreach ($variant as $value)
                                                                        <div class="mx-2 notification">
                                                                            <input  required type="text" name="values{{$loop->parent->index}}[]" value="{{$value}}" onkeydown="newValueedite(event.key,this)" class="form-control mx-2 ggedite" id="Variant_valuesedite" placeholder="Values">  
                                                                            <span onclick=" DeleteValueedite(this)" class="badge">X</span>
                                                                        </div>
                                                                        @endforeach
                                                                    </div>
                                                                  
                                                                @endforeach --}}
                                                               </div>
                                                               <div class="form-group col-12 ">
                                                                   <div class="row" style="    justify-content: space-around;">
                                                                        <div class="col-md-4 col-6 col-lg-4 col-xl-4 position-relative">
                                                                            <img src="{{$prodect['image1']}}" alt="image1" width="100" height="100">
                                                                               <input type="file" name="image1" id="update-image" class=" opacity: 100; position: unset;">
                                                                        </div>
                                                                        <div class="col-md-4 col-6 col-lg-4 col-xl-4 position-relative">
                                                                            <img src="{{$prodect['image2']}}" alt="image2" width="100" height="100">
                                                                               <input type="file" name="image2" id="update-image" class=" opacity: 100; position: unset;">
                                                                        </div>
                                                                        <div class="col-md-4 col-6 col-lg-4 col-xl-4 position-relative">
                                                                            <img @if (!isset($prodect['image3']))
                                                                            src="http://127.0.0.1:8000/jscssmanagment/img/select_product_image_3.png"
                                                                            @else
                                                                            src="{{$prodect['image3']}}"
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



                                           <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="{{'#modeleDelete'.$prodect['id']}}" ><i class="material-icons">delete</i></button>

                                           <div class="modal fade" id="{{'modeleDelete'.$prodect['id']}}" tabindex="-1" aria-labelledby="{{'modeleDeletelabel'.$prodect['id']}}" aria-hidden="true">
                                            <div class="modal-dialog">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <h5 class="modal-title" id="{{'modeleDeletelabel'.$prodect['id']}}">Deleting prodect </h5>
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                  </button>
                                                </div>
                                                <div class="modal-body">
                                                <h5 class="text-danger"> Are you sure you want to delete prodect {{$prodect['name']}} ?</h5>
                                                </div>
                                                <div class="modal-footer">
                                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                  <form action="{{ route('prodects.destroy',$prodect['slug'])}}" method="POST">
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

                    <button class="btn btn-primary float-right" id="add_new_product" type="button" data-toggle="modal" data-target="#modal_new_">
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
                                                    <label for="editor">prodect description</label>
                                                    <textarea  type="text" minlength="40" maxlength="400" name="description"  style="height: 100px" class="form-control"
                                                        id="editor"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-4 col-lg-4 col-xl-4">
                                                    <label for="inputAddress2">Price</label>
                                                    <input required type="text" name="price" class="form-control" id="inputAddress2"
                                                        placeholder="999.55 Dhs">
                                                    </div>
                                                 
                                                    <div class="col-md-4 col-lg-4 col-xl-4 text-center" >
                                                            <input class="form-check-input" name="show_in_home" type="checkbox" id="inlineCheckbox1" value="true">
                                                            <label class="form-check-label" for="inlineCheckbox1"> Show in Home</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row justify-content-between">
                                                    <div id="variant_name">
                                                        <div id="Variants-container">

                                                        </div>
                                                       
                                                        
                                                    </div>
                                                    <div class="mr-5">
                                                        <span id="add_variant" class="btn btn-sm btn-outline-primary">Add new variant</span>
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
    {{-- <script src="https://cdn.ckeditor.com/ckeditor5/27.0.0/classic/ckeditor.js"></script> --}}
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script>
let add_one_variant_by_newproduct=true

@foreach ($prodects as $prodect)
    
    CKEDITOR.replace( "{{'editoredit'.$prodect['id']}}", {
    filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
    filebrowserUploadMethod: 'form'
});


/* ClassicEditor
        .create( document.querySelector( "{{ '#editoredit'.$prodect['id'] }}" ) )
        .catch( error => {
            console.error( error );
        } );
 */
@endforeach
CKEDITOR.replace( "editor", {
    filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
    filebrowserUploadMethod: 'form'
});



    var num=0
    const variant0 ='<div id="clone" class="d-flex notificationVariant">  <span class="badgeVariant" onclick="DeleteValue(this)">X</span> <input required type="text" style=" max-width: 150px;" name="variant[]" class="form-control" id="variant_name" placeholder="Variant Name"> <div class="mx-2 notification"><input  required type="text" name="values0[]" onkeydown="newValue(event.key,this)" class="form-control mx-2 gg" id="Variant_values" placeholder="Values">  <span class="badge">X</span> </div></div>'
    document.getElementById("add_variant").addEventListener('click',()=>{
        const hasclone= document.getElementById("clone")
        console.log('hasclone = ',hasclone);
        if(hasclone){
            num++
           const clone= document.getElementById("Variants-container").lastChild.cloneNode(true);
           console.log('clone = ',clone)
           const ggs=clone.querySelectorAll(".gg")
          
            ggs.forEach(element => {
                element.name='values'.concat(num,'[]')
                console.log('gg =',element.name)
            });
            document.getElementById("Variants-container").appendChild(clone);
      
        }else{
            console.log(num)
            document.getElementById("Variants-container").innerHTML=variant0;
        }
       
    })
    document.getElementById("add_new_product").addEventListener('click',()=>{
        const hasclone= document.getElementById("clone")
        if(add_one_variant_by_newproduct || !hasclone){
     
        console.log('hasclone = ',hasclone);
        if(hasclone){
            num++
           const clone= document.getElementById("Variants-container").lastChild.cloneNode(true);
           console.log('clone = ',clone)
           const ggs=clone.querySelectorAll(".gg")
          
            ggs.forEach(element => {
                element.name='values'.concat(num,'[]')
                console.log('gg =',element.name)
            });
            document.getElementById("Variants-container").appendChild(clone);
      
        }else{
            console.log(num)
            document.getElementById("Variants-container").innerHTML=variant0;
        }
        add_one_variant_by_newproduct=false
    }
    })

// edite section script

    var numedite=-1
    const variant0edite ='<div id="cloneedite" class="d-flex notificationVariant">  <span class="badgeVariant" onclick="DeleteValueedite(this)">X</span> <input required type="text" style=" max-width: 150px;" name="variant[]" class="form-control" id="variant_nameedite" placeholder="Variant Name"> <div class="mx-2 notification"><input  required type="text" name="values0[]" onkeydown="newValueedite(event.key,this)" class="form-control mx-2 ggedite" id="Variant_valuesedite" placeholder="Values">  <span class="badge">X</span> </div></div>'
    function addNewVariantedite(el){
        const hasclone= el.parentElement.parentElement.firstElementChild.firstElementChild.firstElementChild.firstElementChild;
       
       /*  console.log('hasclone = ',hasclone);
        console.log('this buttton = ',el) */

        if(hasclone){
            numedite++
          // const cloneedite= document.getElementById("Variants-containeredite").lastChild.cloneNode(true);
            const containeredite=el.parentElement.parentElement.firstElementChild.firstElementChild.firstElementChild
            console.log('Variants-containeredite = ',containeredite);
            containeredite.insertAdjacentHTML('beforeend',variant0edite);

          containeredite.co

                console.log('numedite = ',  containeredite.children.length-1)


           const inserted_inpute=el.parentElement.parentElement.firstElementChild.firstElementChild.firstElementChild.lastElementChild.lastElementChild.firstElementChild
            inserted_inpute.name='values'.concat(containeredite.children.length-1,'[]')
           console.log('inserted_inpute name = ',inserted_inpute.name)
           console.log('numename = ',numedite)
            
        }else{;
            console.log(numedite)
            document.getElementById("Variants-containeredite").innerHTML=variant0edite;
        }
       
    }

    function newValueedite(c,el){
            if(c===' '){    
             
            const new_inputedite='<div class=" d-flex mx-2 notification" ><input required="" type="text" name="values[]" onkeydown="newValueedite(event.key,this)" class="form-control mx-2 ggedite" id="Variant_valuesedite" placeholder="Values">  <span class="badge" onclick="DeleteValueedite(this)">X</span> </div>'
            console.log('name =',el.name)
            el.parentElement.parentElement.insertAdjacentHTML('beforeend', new_inputedite);
           
            const cloneedite = el.parentElement.parentElement.lastElementChild.firstElementChild
            console.log('cloneedite = ',cloneedite)
            cloneedite.name=el.name
            cloneedite.value=''
            cloneedite.focus()
            console.log('cloneedite = ',cloneedite)

              
            }
        }
        function DeleteValueedite(el){
           el.parentElement.remove();
        }
        function DeleteVariantedite(el){
           el.parentElement.remove();
        }

       

  /*   ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } ); */
       
        function newValue(c,el){
            if(c===' '){    
                console.log('name =',el.parentElement.parentElement.lastElementChild.firstChild.name)
                const new_input='<div class=" d-flex mx-2 notification" ><input required="" type="text" name="values[]" onkeydown="newValue(event.key,this)" class="form-control mx-2 gg" id="Variant_values" placeholder="Values">  <span class="badge" onclick="DeleteValue(this)">X</span> </div>'
                const name=el.parentElement.parentElement.lastElementChild.firstChild.name
                const Variants_last_clone=document.getElementById("Variants-container")
               
                el.parentElement.parentElement.insertAdjacentHTML('beforeend', new_input);
             
             const clone =    el.parentElement.parentElement.lastElementChild.firstChild;
             console.log('clone = ',clone);
             clone.name=name;
             clone.value=''
             clone.focus()
               

              
            }
        }


/* 
khdama
  function newValue(c,el){
            if(c===' '){    
                console.log('parent parent element in parameter =',el.parentElement.parentElement)
                const new_input='<div class=" d-flex mx-2 notification" ><input required="" type="text" name="values[]" onkeydown="newValue(event.key,this)" class="form-control mx-2 gg" id="Variant_values" placeholder="Values">  <span class="badge" onclick="DeleteValue(this)">X</span> </div>'

                const Variants_last_clone=document.getElementById("Variants-container")
               
                el.parentElement.parentElement.insertAdjacentHTML('beforeend', new_input);
             
             const clone =    Variants_last_clone.lastChild.lastChild.firstChild
             clone.name='values'.concat(num,'[]')
             clone.value=''
             clone.focus()
                console.log(clone)

              
            }
        }
        
        
        
        
        function newValueedite(c,el){
            if(c===' '){    
                console.log(el.parentElement.parentElement)
                const new_inputedite='<div class=" d-flex mx-2 notification" ><input required="" type="text" name="values[]" onkeydown="newValueedite(event.key,this)" class="form-control mx-2 ggedite" id="Variant_valuesedite" placeholder="Values">  <span class="badge" onclick="DeleteValueedite(this)">X</span> </div>'

                const Variants_last_cloneedite=document.getElementById("Variants-containeredite")
               
                el.parentElement.parentElement.insertAdjacentHTML('beforeend', new_inputedite);
             
             const cloneedite =    Variants_last_cloneedite.lastChild.lastChild.firstChild
             cloneedite.name='values'.concat(numedite,'[]')
             cloneedite.value=''
             cloneedite.focus()
                console.log(cloneedite)

              
            }
        }
        
        
        
        
        
         */


        function DeleteValue(el){
           el.parentElement.remove();
        }
        function DeleteVariant(el){
           el.parentElement.remove();
        }

</script>

@endsection
