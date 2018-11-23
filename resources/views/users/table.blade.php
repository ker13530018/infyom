<table class="table table-responsive" id="users-table">
    <thead>
        <tr>
            <th>IDx</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Remember Token</th>
            <th>Created At</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($users as $users)
        <tr>
            <td>{!! $users->id !!}</td>
            <td>{!! $users->name !!}</td>
            <td>{!! $users->email !!}</td>
            <td>{!! $users->usersRoles->first()->role->name !!}</td>
            <td>{!! $users->remember_token !!}</td>
            <td>{!! $users->created_at !!}</td>
            <td>
                {!! Form::open(['route' => ['users.destroy', $users->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('users.show', [$users->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('users.edit', [$users->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
    <!-- <tfoot>
        <tr>
            <th>IDx</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Remember Token</th>
            <th>Created At</th>
            <th colspan="3">Action</th>
        </tr>
    </tfoot> -->
</table>

@section('scripts')
    <script>
        $(document).ready(function () {
            $('#users-table').DataTable();
        });
    </script>
@endsection