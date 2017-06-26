<table class="table table-bordered">
    <thead>
    <tr>
        <th>ID</th>
        <th>Product</th>
        <th>Serial</th>
        <th>Current Assignment</th>
        <th>Assigned By</th>
        <th>Assigned On</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    @foreach($assets as $asset)
        <tr>
            <td><a href="{{route('assets.show', $asset->id())}}">{{$asset->id()}}</a></td>
            <td>{{$asset->product()->name()}}</td>
            <td>{{$asset->serial()}}</td>
            <td>{{$asset->currentLocation()}}</td>
            <td>{{$asset->currentAssignment()->assignedBy()}}</td>
            <td>{{$asset->currentAssignment()->assignedAt()}}</td>
            <td>
                <a class="btn btn-default btn-xs" href="{{route('assets.reassign', $asset->id())}}">Reassign</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>