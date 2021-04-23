@extends('managment.layouts.master')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-primary d-flex justify-content-between">
                    <div>
                        <h4 class="card-title ">Call back Orders</h4>
                        <p class="card-category"> you have <span>{{ $number_orders }}</span> orders to call </p>
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
                                                                            onkeyup="dataSync('{{$order['id']}}')" class="form-control"
                                                                            id="exampleInputName1">
                                                                    </div>

                                                                    <div class="form-group col-6">
                                                                        <label for="exampleInputTel">Telephone :</label>
                                                                        <input id="costumer_telephone{{$order['id']}}" type="text"
                                                                            value=" {{ $order['telephone'] }}"
                                                                            onkeyup="dataSync('{{$order['id']}}')" name="telephone"
                                                                            class="form-control" id="exampleInputTel">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="form-group col-6">
                                                                        <label for="exampleInputaddres">Addres :</label>
                                                                        <input id="costumer_address{{$order['id']}}" type="text"
                                                                            value=" {{ $order['address'] }}"
                                                                            onkeyup="dataSync('{{$order['id']}}')" name="address"
                                                                            class="form-control" id="exampleInputaddres">
                                                                    </div>

                                                                    <div class="form-group col-6">
                                                                        <label for="exampleInputemail">Email :</label>
                                                                        <input id="costumer_email{{$order['id']}}" type="text"
                                                                            value=" {{ $order['email'] }}"
                                                                            onkeyup="dataSync('{{$order['id']}}')" name="email"
                                                                            class="form-control" id="exampleInputemail">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="form-group col-12">
                                                                        <label for="exampleInputemail">Note :</label>
                                                                        <input id="costumer_note{{$order['id']}}" type="text"
                                                                            value=" {{ $order['note'] }}"
                                                                            onkeyup="dataSync('{{$order['id']}}')" name="note"
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
                                                                    <form method="POST"
                                                                        action="{{ route('confirm_order',  $order['id']) }}">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <input type="hidden" id="costumer_name2{{$order['id']}}"
                                                                            name="name">
                                                                        <input type="hidden" id="costumer_address2{{$order['id']}}"
                                                                            name="address">
                                                                        <input type="hidden" id="costumer_telephone2{{$order['id']}}"
                                                                            name="telephone">
                                                                        <input type="hidden" id="costumer_email2{{$order['id']}}"
                                                                            name="email">
                                                                        <input type="hidden" id="costumer_note2{{$order['id']}}"
                                                                            name="note">
                                                                        <button class="dropdown-item"
                                                                            type="submit">confirme</button>
                                                                    </form>
                                                                    <form method="POST"
                                                                        action="{{ route('no_response', $order['id']) }}">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <button class="dropdown-item" type="submit">no
                                                                            response</button>
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
    <script>
       function dataSync(num) {
            var costumer_name = document.getElementById("costumer_name".concat(num)).value;
            document.getElementById("costumer_name2".concat(num)).setAttribute('value', costumer_name);
            var costumer_telephone = document.getElementById("costumer_telephone".concat(num)).value;
            document.getElementById("costumer_telephone2".concat(num)).setAttribute('value', costumer_telephone);
            var costumer_address = document.getElementById("costumer_address".concat(num)).value;
            document.getElementById("costumer_address2".concat(num)).setAttribute('value', costumer_address);
            var costumer_email = document.getElementById("costumer_email".concat(num)).value;
            document.getElementById("costumer_email2".concat(num)).setAttribute('value', costumer_email);
            var costumer_note = document.getElementById("costumer_note".concat(num)).value;
            document.getElementById("costumer_note2".concat(num)).setAttribute('value', costumer_note);
           
        }
        @foreach ($orders as $order)
        dataSync("{{$order['id']}}")
        @endforeach
       
        /* let name= document.getElementById('telephone')
        let name= document.getElementById('address')
        let name= document.getElementById('email') */
      
    </script>

@endsection
