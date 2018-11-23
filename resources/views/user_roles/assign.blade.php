@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            User Roles
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => ['userRoles.role',$user->id] , 'method' => 'POST' ]) !!}

                        @include('user_roles.fields', ['roles' => $roles , 'user' => $user])

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
