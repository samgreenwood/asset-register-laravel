@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Edit {{$product->name}}
                    </div>

                    <div class="panel-body">
                        {!! Former::open(route('products.update', $product->id))->method('PUT') !!}
                        @include('products.form')
                        {!! Former::close() !!}
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Assets
                        <div class="pull-right">
                            <a class="btn btn-xs btn-primary" href="{{route('assets.create', ['product' => $product->id])}}">Add Asset</a>
                        </div>
                    </div>

                    <div class="panel-body">
                        @include('assets.table', ['assets' => $product->assets])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
