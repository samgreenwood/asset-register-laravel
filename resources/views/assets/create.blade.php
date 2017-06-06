@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Create Asset
                    </div>

                    <div class="panel-body">
                        {!! Former::open(route('assets.store')) !!}
                        {!! Former::select('product_id', 'Product')->options($products)->value(request('product')) !!}
                        {!! Former::text('purchase_reference', 'Purchase Reference') !!}
                        {!! Former::date('purchased_date', 'Purchased Date')->value(date('Y-m-d')) !!}
                        {!! Former::select('assignable_type', 'Assignment Type')->options(['node' => 'Node', 'member' => 'Member']) !!}

                        <div id="node_select">
                            {!! Former::select('assignable_id', 'Assigned To')->options($nodes)->value(request('node')) !!}
                        </div>

                        <div id="member_select">
                            {!! Former::select('assignable_id', 'Assigned To')->options($members) !!}
                        </div>

                        {!! Former::textarea('notes') !!}
                        {!! Former::submit('save')->addClass('btn-primary pull-right') !!}
                        {!! Former::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
