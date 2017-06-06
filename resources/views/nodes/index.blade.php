@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Nodes</div>

                    <div class="panel-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Assets</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($nodes as $node)
                                <tr>
                                    <td>{{$node->uuid()}}</td>
                                    <td><a href="{{route('nodes.show', $node->uuid())}}">{{$node->name()}}</a></td>
                                    <td>{{$node->assets()->count()}}</td>
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
