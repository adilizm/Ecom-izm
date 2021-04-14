@extends('managment.layouts.master')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title ">All orders</h4>
                    <p class="card-category"> you have <span>{{ $orders->count() }}</span> orders </p>
                </div>
                @if ($orders->count() > 0)
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="dataTable" >
                                <thead class=" text-primary">
                                    <th>
                                        Name
                                    </th>
                                    <th>
                                        Tel
                                    </th>
                                    <th>
                                        email
                                    </th>
                                    <th>
                                        address
                                    </th>
                                    <th>
                                        status
                                    </th>
                                    <th>
                                        note
                                    </th>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>
                                                {{ $order->name }}
                                            </td>
                                            <td>
                                                {{ $order->telephone }}
                                            </td>
                                            <td>
                                                {{ $order->email }}
                                            </td>
                                            <td>
                                                {{ $order->address }}
                                            </td>
                                            <td>
                                                {{ $order->status }}
                                            </td>
                                            <td>
                                                {{ $order->note }}
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
