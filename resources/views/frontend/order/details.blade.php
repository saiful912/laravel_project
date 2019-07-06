@extends('frontend.layouts.master')

@section('main')
    <div class="container">
        <br>
        <h4 class="text-center mt-5 font-weight-bold">Order Details</h4>
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{session('message')}}
            </div>
        @endif
        <hr>
        <div class="container">

            <ul class="list-group">
                {{--all orders data show details page            --}}
                @foreach($order->toArray() as $column => $value)
                    @if($column === 'user_id')
                        @continue
                    @endif
                    <li class="list-group-item">
                        {{ucwords(str_replace('_', ' ', $column))}}: {{$value}}
                    </li>
                @endforeach
            </ul>
            <h3 class="mt-3 mb-3">Ordered Products</h3>
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <td>Product Title</td>
                    <td>Quantity</td>
                    <td>Total Price</td>
                </tr>
                </thead>
                @foreach($products as $product)
                    <tr>
                        <td>{{$product->product->title}}</td>
                        <td>{{$product->quantity}}</td>
                        <td>{{number_format($product->price,2)}}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@stop