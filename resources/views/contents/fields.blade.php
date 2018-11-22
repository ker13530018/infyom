<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Og Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('og_type', 'Og Type:') !!}
    {!! Form::text('og_type', null, ['class' => 'form-control']) !!}
</div>

<!-- Og Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('og_description', 'Og Description:') !!}
    {!! Form::text('og_description', null, ['class' => 'form-control']) !!}
</div>

<!-- Og Images Field -->
<div class="form-group col-sm-6">
    {!! Form::label('og_images', 'Og Images:') !!}
    {!! Form::file('og_images') !!}
</div>
<div class="clearfix"></div>

<!-- Robots Field -->
<div class="form-group col-sm-6">
    {!! Form::label('robots', 'Robots:') !!}
    {!! Form::select('robots', ['index, follow' => 'follow', 'Noindex,  Nofollow' => 'unfollow'], null, ['class' => 'form-control']) !!}
</div>

<!-- Body Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('body', 'Body:') !!}
    {!! Form::textarea('body', null, ['class' => 'form-control wysiwyg']) !!}
</div>

<!-- Status Field -->
<div class="form-group col-sm-12">
    {!! Form::label('status', 'Status:') !!}
    <label class="radio-inline">
        {!! Form::radio('status', "1", null) !!} Active
    </label>

    <label class="radio-inline">
        {!! Form::radio('status', "0", null) !!} InActive
    </label>

</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('contents.index') !!}" class="btn btn-default">Cancel</a>
</div>

@section('scripts')
    <script>
    // In your Javascript (external .js resource or <script> tag)
    $(document).ready(function() {
        $('#robots').select2();
    });
    </script>
@endsection