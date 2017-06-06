@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Reassign Asset {{$asset->id()}}
                    </div>

                    <div class="panel-body">
                        {!! Former::open(route('assets.doreassign', $asset->id())) !!}

                        {!! Former::select('assignable_type', 'Assignment Type')->options(['node' => 'Node', 'member' => 'Member']) !!}

                        <div id="node_select">
                            {!! Former::select('assignable_id', 'Assigned To')->options($nodes) !!}
                        </div>

                        <div id="member_select">
                            {!! Former::select('assignable_id', 'Assigned To')->options($members) !!}
                        </div>

                        {!! Former::textarea('notes') !!}
                        {!! Former::submit('reassign')->addClass('btn-primary pull-right') !!}
                        {!! Former::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
