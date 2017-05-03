@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Add a Product
                    </div>

                    <div class="panel-body">
                        {!! Former::open(route('products.store')) !!}
                        @include('products.form')
                        {!! Former::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
