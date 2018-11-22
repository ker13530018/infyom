<table class="table table-responsive" id="contents-table">
    <thead>
        <tr>
            <th>Title</th>
        <th>Og Type</th>
        <th>Og Description</th>
        <th>Og Images</th>
        <th>Robots</th>
        <th>Status</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($contents as $content)
        <tr>
            <td>{!! $content->title !!}</td>
            <td>{!! $content->og_type !!}</td>
            <td>{!! $content->og_description !!}</td>
            <td>{!! $content->og_images !!}</td>
            <td>{!! $content->robots !!}</td>
            <td>{!! $content->status !!}</td>
            <td>
                {!! Form::open(['route' => ['contents.destroy', $content->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('contents.show', [$content->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('contents.edit', [$content->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>