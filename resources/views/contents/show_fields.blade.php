<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $content->id !!}</p>
</div>

<!-- Title Field -->
<div class="form-group">
    {!! Form::label('title', 'Title:') !!}
    <p>{!! $content->title !!}</p>
</div>

<!-- Description Field -->
<div class="form-group">
    {!! Form::label('description', 'Description:') !!}
    <p>{!! $content->description !!}</p>
</div>

<!-- Og Type Field -->
<div class="form-group">
    {!! Form::label('og_type', 'Og Type:') !!}
    <p>{!! $content->og_type !!}</p>
</div>

<!-- Og Description Field -->
<div class="form-group">
    {!! Form::label('og_description', 'Og Description:') !!}
    <p>{!! $content->og_description !!}</p>
</div>

<!-- Og Images Field -->
<div class="form-group">
    {!! Form::label('og_images', 'Og Images:') !!}
    <p>
    <img src="{{ asset('/storage/'.$content->og_images) }}" alt="" title="" class="img-thumbnail">
    </p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $content->created_at !!}</p>
</div>

<!-- Robots Field -->
<div class="form-group">
    {!! Form::label('robots', 'Robots:') !!}
    <p>{!! $content->robots !!}</p>
</div>

<!-- Body Field -->
<div class="form-group">
    {!! Form::label('body', 'Body:') !!}
    <p>{!! $content->body !!}</p>
</div>

<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', 'Status:') !!}
    <p>{!! $content->status !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $content->updated_at !!}</p>
</div>

