@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Asset #{{$asset->id()}} {{$asset->product()->name()}}
                        <div class="pull-right">
                            <a class="btn btn-primary btn-xs" href="{{route('assets.reassign', $asset->id())}}">Reassign</a>
                        </div>
                    </div>

                    <div class="panel-body">
                        <h3>Purchase Information</h3>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Purchased At</th>
                                <td>{{$asset->purchasedAt()->format('d/m/Y h:i:s')}}</td>
                            </tr>
                            <tr>
                                <th>Purchase Reference</th>
                                <td>{{$asset->purchaseReference()}}</td>
                            </tr>
                            </thead>
                        </table>
                        <h3>Assignments</h3>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>On</th>
                                <th>From</th>
                                <th>To</th>
                                <th>By</th>
                                <th>Notes</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($asset->assignments() as $assignment)
                                    <tr>
                                        <td>{{$assignment->assignedAt()->format('d/m/Y h:i:s')}}</td>
                                        <td>{{$assignment->previousLocation()}}</td>
                                        <td>{{$assignment->location()}}</td>
                                        <td>{{$assignment->assignedBy()}}</td>
                                        <td>{{$assignment->notes()}}</td>
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
