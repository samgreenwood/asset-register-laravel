@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Assets for {{$node->name()}}
                        <div class="pull-right">
                            <a class="btn btn-primary btn-xs" href="{{route('assets.create', ['node' => $node->uuid()])}}">Add Asset</a>
                        </div>
                    </div>

                    <div class="panel-body">
                        @include('assets.table')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
