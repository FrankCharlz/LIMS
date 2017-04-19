@extends('layouts.app')

@section('content')
    {{--<example></example>--}}
    <div class="container">
        <div class="row">

            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Add plot to database</div>
                    <div class="panel-body">

                        @if(!$fresh)
                            <div class="xxx">
                                @if ($success)
                                    Success
                                @else
                                    Failed
                                @endif
                            </div>
                        @endif

                        {{ Form::open(array('url' => '/plots/new', 'class' => 'form-horizontal',
                        'role' => 'form', 'files' => true)) }}

                        {{ csrf_field() }}

                        <div class="form-group">
                            {{ Form::label('lat', 'Latitude', ['class' => 'col-md-4 control-label']) }}
                            <div class="col-md-6">
                                {{ Form::text('lat', $lat, ['readonly' => true, 'class' => 'form-control ', 'id'=>'lat', 'required' => true]) }}
                            </div>
                        </div>

                        <div class="form-group">
                            {{ Form::label('lng', 'Longitude', ['class' => 'col-md-4 control-label']) }}
                            <div class="col-md-6">
                                {{ Form::text('lng', $lng, ['readonly' => true, 'id'=>'lng', 'class' => 'form-control', 'required' => true]) }}
                            </div>
                        </div>

                        <div class="form-group">
                            {{ Form::label('owner', 'Owner', ['class' => 'col-md-4 control-label']) }}
                            <div class="col-md-6">
                                {{ Form::select('owner', $users, null, ['class' => 'form-control', 'id' => 'owner']) }}
                            </div>
                        </div>

                        <?php
                        $options = [
                            1 => 'On sale',
                            2 => 'Reserved',
                            3 => 'Conflict',
                            4 => 'Other',
                            5 => 'Normal'
                        ];
                        ?>

                        <div class="form-group">
                            {{ Form::label('status', 'Status', ['class' => 'col-md-4 control-label']) }}
                            <div class="col-md-6">
                                {{ Form::select('status', $options, 5, ['class' => 'form-control', 'id' => 'status']) }}
                            </div>
                        </div>

                        <div class="form-group">
                            {{ Form::label('certificate', 'Upload plot certificate', ['class' => 'col-md-4 control-label']) }}
                            <div class="col-md-6">
                                {{ Form::file('image', null, ['id'=>'certificate', 'class' => 'form-control btn']) }}
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                            </div>
                        </div>

                        {{ Form::close() }}

                    </div>
                </div>
            </div>

        </div>

    </div>


@endsection