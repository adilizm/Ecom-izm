@extends('managment.layouts.master')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-primary d-flex justify-content-between">
                    <div>
                        <h4 class="card-title ">Delivred Orders</h4>
                        <p class="card-category"> you have <span>{{ $number_orders }}</span> Delivred orders </p>
                    </div class="float-right">
                   
                </div>
                @if (count($orders) > 0)
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class=" text-primary">
                                    <th>
                                        Name
                                    </th>
                                    <th>
                                        Tel
                                    </th>
                                    <th>
                                        Adress
                                    </th>
                                    <th>
                                        date
                                    </th>
                                    <th>
                                        More
                                    </th>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>
                                                {{ $order['name'] }}
                                            </td>
                                            <td>
                                                {{ $order['telephone'] }}
                                            </td>
                                            <td>
                                                {{ $order['address'] }}
                                            </td>
                                            <td>
                                                {{ $order['created_at'] }}
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-primary"  data-toggle="modal"
                                                    data-target="#{{$order['name'].$loop->index}}"><i
                                                        class="material-icons">visibility</i></button>
                                                <div class="modal fade" id="{{$order['name'].$loop->index}}" tabindex="-1"
                                                    aria-labelledby="{{$order['name'].$loop->index}}Label" aria-hidden="true">
                                                    <div class="modal-dialog modal-xl">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="{{$order['name'].$loop->index}}Label">Order for
                                                                    {{ $order['name'] }}</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="form-group col-6">
                                                                        <label for="exampleInputName1">Full name :</label>
                                                                        <input id="costumer_name{{$order['id']}}" type="text"
                                                                            value="{{ $order['name'] }}" name="name"
                                                                             class="form-control"
                                                                            id="exampleInputName1">
                                                                    </div>

                                                                    <div class="form-group col-6">
                                                                        <label for="exampleInputTel">Telephone :</label>
                                                                        <input id="costumer_telephone{{$order['id']}}" type="text"
                                                                            value=" {{ $order['telephone'] }}"
                                                                             name="telephone"
                                                                            class="form-control" id="exampleInputTel">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="form-group col-6">
                                                                        <label for="exampleInputaddres">Addres :</label>
                                                                        <input id="costumer_address{{$order['id']}}" type="text"
                                                                            value=" {{ $order['address'] }}"
                                                                             name="address"
                                                                            class="form-control" id="exampleInputaddres">
                                                                    </div>

                                                                    <div class="form-group col-6">
                                                                        <label for="exampleInputemail">Email :</label>
                                                                        <input id="costumer_email{{$order['id']}}" type="text"
                                                                            value=" {{ $order['email'] }}"
                                                                            name="email"
                                                                            class="form-control" id="exampleInputemail">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="form-group col-12">
                                                                        <label for="exampleInputemail">Note :</label>
                                                                        <input id="costumer_note{{$order['id']}}" type="text"
                                                                            value=" {{ $order['note'] }}"
                                                                            name="note"
                                                                            class="form-control" id="exampleInputnote">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-12">
                                                                    <div class="table-responsive">
                                                                        <table class="table" id="{{ $order['name']. $order['id'].'table'}}">
                                                                            <thead>
                                                                                <th>Prodect image</th>
                                                                                <th>Prodect name</th>
                                                                                <th>Quantity</th>
                                                                                <th>price unit</th>
                                                                                <th>Full price</th>
                                                                               
                                                                            </thead>
                                                                            <tbody>
                                                                                @foreach ($order['orderds_prodects_ids'][0] as $prodect)
                                                                                    <tr>   
                                                                                        <td><img src="{{ $prodect->prodet['image1']}}"
                                                                                                width="50" alt=""></td>
                                                                                        <td>
                                                                                            <h4>{{  $prodect->prodet['name'] }}
                                                                                            </h4>
                                                                                        </td>
                                                                                         <td>
                                                                                             <h4> @foreach ($prodect->selected_variant as $variant)
                                                                                                  <strong><div> {{$variant[0]}} : {{$prodect->selected_values[$loop->index]}}</div></strong> 
                                                                                             @endforeach </h4> 
                                                                                        </td>
                                                                                        <td>
                                                                                             <h4>{{  $prodect->qty }}</h4> 
                                                                                        </td>
                                                                                        <td>
                                                                                            <h4>{{  $prodect->prodet['price'] }}
                                                                                            </h4>
                                                                                        </td>
                                                                                        <td>
                                                                                            <h4>{{ $prodect->prodet['price'] * $prodect->qty }}
                                                                                            </h4> 
                                                                                        </td>
                                                                                        <td></td>
                                                                                    </tr>
                                                                                @endforeach
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div> <button type="button"
                                                                    class="btn btn-secondary float-right"
                                                                    data-dismiss="modal">Close</button>
                                                                 <div class="dropdown float-right">
                                                                     <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                     Change status
                                                                    </a> 
                                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                                                    <form method="GET"
                                                                    action="{{ route('success_order', $order['id']) }}">
                                                                    @csrf
                                                                    <button class="dropdown-item" type="submit">success</button>
                                                                </form>
                                                           
                                                                    <form method="GET"
                                                                        action="{{ route('returned_order', $order['id']) }}">
                                                                        @csrf
                                                                        <button class="dropdown-item" type="submit">returned</button>
                                                                    </form>
                                                               
                                                                  
                                                                </div> 
                                                             </div> 
                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>
                        </div>
                        </td>
                @endforeach
                </tbody>
                </table>
            </div>
        </div>
        @endif

    </div>
    </div>
    </div>
    

@endsection
