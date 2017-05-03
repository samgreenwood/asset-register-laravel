@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Products
                        <div class="pull-right">
                            <a class="btn btn-primary btn-xs" href="{{route('products.create')}}">Add Product</a>
                        </div>
                    </div>

                    <div class="panel-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Manufacturer</th>
                                <th>Name</th>
                                <th>Assets</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>{{$product->id}}</td>
                                    <td>{{$product->manufacturer}}</td>
                                    <td><a href="{{route('products.edit', $product->id)}}">{{$product->name}}</a></td>
                                    <td>{{$product->assets->count()}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
