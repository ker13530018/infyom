
@if($user)
<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::text('user_id', $user->id, ['class' => 'form-control' , 'readonly' => true]) !!}
</div>

<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_email', 'User Email:') !!}
    {!! Form::text('user_email', $user->email, ['class' => 'form-control', 'readonly' => true]) !!}
</div>

@else
<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::number('user_id', null, ['class' => 'form-control']) !!}
</div>
@endif

<!-- Role Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('role_id', 'Role Id:') !!}

    <select name="role_id" class="form-control" id="role_id" >
        @foreach($roles as $ur)
            <option value="{{ $ur->id }}">{{ $ur->name }}</option>
        @endforeach
    </select>
</div>

<div class="clearfix"></div>
<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('status', false) !!}
        {!! Form::checkbox('status', '1', [ 'checked' => true ]) !!} Active
    </label>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('userRoles.index') !!}" class="btn btn-default">Cancel</a>
</div>
