@extends('backend.layouts.table')

@section('content')
    <h3>Sub Category: {{$sub_category->name}}</h3>
    <p>Id: {{$sub_category->id}}</p>
    <p>Categoty Id: {{$sub_category->category_id}}</p>
@endsection
