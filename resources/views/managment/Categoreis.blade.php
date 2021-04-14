@extends('managment.layouts.master')

@section('content')
<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header card-header-primary">
          <h4 class="card-title ">Categoreis</h4>
          <p class="card-category"> Those are all the categoreis </p>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table">
              <thead class=" text-primary">
                <th>
                    Name
                </th>
                <th>
                    Description
                </th>
                <th>
                    Tools
                </th>
              </thead>
              <tbody>
                @foreach ($categoreis as $category)
                <tr>
                  <td>
                    {{$category->name}}
                  </td>
                  <td>
                    {{$category->description}}
                  </td>
                  <td>
                   <button class="btn btn-sm btn-warning" type="button" data-toggle="modal" data-target=" {{'#modal_edit_'.$category->id}}"><i class="material-icons">edit</i></button>
                   <button class="btn btn-sm btn-danger" type="button" data-toggle="modal" data-target=" {{'#modal_delete_'.$category->id}}"><i class="material-icons">delete</i></button>
                 
                  </td>

                  <div class="modal fade" id="{{'modal_edit_'.$category->id}}" tabindex="-1" aria-labelledby="{{'exampleModalLabel'.$category->id}}" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="{{'exampleModalLabel'.$category->id}}">EDITE CATEGORY {{$category->name}}</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{route('categories.update',$category->slug)}}">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                  <label for="formGroupExampleInput">Category name</label>
                                  <input type="text" name="name" class="form-control" value="{{$category->name}} " id="formGroupExampleInput" >
                                </div>
                                <div class="form-group">
                                  <label for="formGroupExampleInput2">Category description</label>
                                  <textarea class="form-control" name="description"  required>{{$category->description}} </textarea>
                                </div>
                                <button type="submit" class="btn btn-primary float-right">Save changes</button>
                              </form>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="modal fade" id="{{'modal_delete_'.$category->id}}" tabindex="-1" aria-labelledby="{{'exampleModaldelet'.$category->id}}" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="{{'exampleModaldelet'.$category->id}}"> Delete CATEGORY {{$category->name}}</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{route('categories.destroy',$category->slug)}}">
                                @csrf
                                @method('DELETE')
                                <h5>Would You will delete <b>{{$category->name}}</b> Category </h5>
                                <button type="submit" class="btn btn-danger float-right">Yes delete</button>
                              </form>
                        </div>
                      </div>
                    </div>
                  </div>
                  @endforeach
              </tbody>
            </table>
        
          </div>
        
          <button class="btn btn-primary float-right" type="button" data-toggle="modal" data-target="#modal_new_"> New Category </button>
          <div class="modal fade" id="modal_new_" tabindex="-1" aria-labelledby="{{'modal_new'}}" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="modal_new"> New CATEGORY Form</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{route('categories.store')}}">
                        @csrf
                            <div class="form-group">
                              <label for="formGroupExampleInput">Category name</label>
                              <input type="text" name="name" class="form-control"  id="formGroupExampleInput" >
                            </div>
                            <div class="form-group">
                              <label for="formGroupExampleInput2">Category description</label>
                              <textarea class="form-control" name="description"  required rows="2"></textarea>
                            </div>
                        <button type="submit" class="btn btn-success float-right">Add Category</button>
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