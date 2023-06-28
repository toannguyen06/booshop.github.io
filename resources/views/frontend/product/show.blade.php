@extends('backend.layouts.main')

@section('content')
    <h3>Product Code: {{$product->product_code}}</h3>
    <p>Id: {{$product->id}}</p>
    <p>Quantity: {{$product->quantity}}</p>
    <h3>Rate: {{$product->rate}}</h3>
    <p>Price: {{$product->price}}</p>
    <p>Promotion Id: {{$product->promotion_id}}</p>
@endsection
