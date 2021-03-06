@extends('layouts.app')

@section('content')
    {{--<example></example>--}}
    <div class="container">
        <div class="col-md-4"></div>

        <div class="col-md-8">

            <div class="row">
                {{ Form::open(array('url' => '/plots/new', 'class' => 'form form-horizontal', 'files' => true)) }}

                {{ csrf_field() }}


                <div class="form-group">
                    {{ Form::label('owner', 'Owner') }}
                    {{ Form::text('owner', 'test' , ['id'=>'owner', 'class' => 'form-control']) }}
                </div>


                <div class="form-group">
                    {{ Form::label('status', 'Status') }}
                    {{ Form::text('status', 'test' , ['id'=>'status', 'class' => 'form-control']) }}
                </div>

                <div class="form-group">
                    {{ Form::label('certificate', 'Upload plot certificate') }}
                    {{ Form::file('image', null, ['id'=>'certificate', 'class' => 'form-control']) }}
                </div>

                {{ Form::submit('SUBMIT') }}

                {{ Form::close() }}


            </div>
        </div>

    </div>


@endsection