<table class="table table-bordered">
    <thead>
    <tr>
        <th>ID</th>
        <th>Product</th>
        <th>Current Assignment</th>
        <th>Assigned By</th>
        <th>Assigned On</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    @foreach($assets as $asset)
        <tr>
            <td>{{$asset->id}}</td>
            <td><a href="{{route('assets.edit', $asset->id)}}">{{$asset->product->name}}</a></td>
            <td><a href="#">{{$asset->currentAssignment->assignable->name}}</a></td>
            <td>{{$asset->currentAssignment->currentAssignment->assignedBy}}</td>
            <td>{{$asset->currentAssignment->currentAssignment->assignedOn}}</td>
            <td>
                <a href="#">Reassign</a>
                <a href="#">Write Off</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>