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
                        {!! Former::open('assets.store') !!}
                        {!! Former::select('product_id', 'Product')->options($products) !!}
                        {!! Former::text('purchase_reference', 'Purchase Reference') !!}
                        {!! Former::date('purchased_at', 'Purchased Date') !!}
                        {!! Former::select('assignable_type', 'Assignment Type')->options(['node' => 'Node', 'member' => 'Member']) !!}

                        <div id="node_select">
                            {!! Former::select('assignable_id_node', 'Assigned To')->options($nodes) !!}
                        </div>

                        <div id="member_select">
                            {!! Former::select('assignable_id_member', 'Assigned To')->options($members) !!}
                        </div>

                        {!! Former::submit('save')->addClass('btn-primary pull-right') !!}
                        {!! Former::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">

    </script>
@endsection
