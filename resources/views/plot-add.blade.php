@extends('layouts.app')

@section('content')
    {{--<example></example>--}}
    <div class="container-fluid">
        <div class="row">

            @include('menu') {{-- side nav is col-md-3 --}}

            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="panel panel-default">

                            @if(isset($addError))
                                <div class="add-error">
                                    {{ $error }}
                                </div>
                            @endif

                            <div class="panel-heading">Add plot to database</div>
                            <div class="panel-body">

                                {{ Form::open(array('url' => '/plots/new', 'class' => 'form-horizontal',
                                'role' => 'form', 'files' => true)) }}

                                {{ csrf_field() }}

                                <?php
                                //when adding from scratch no lat or lng is supplied;
                                $latLngOptions = ['class' => 'form-control ', 'id'=>'lat', 'required' => true];
                                $fromScratch = !isset($lat);
                                if ($fromScratch) {
                                    $lat = '';
                                    $lng = '';
                                } else {
                                    array_push($latLngOptions, 'readonly');
                                }
                                //print_r($fromScratch);
                                //print_r($latLngOptions);
                                ?>

                                <div class="form-group">
                                    {{ Form::label('lat', 'Latitude', ['class' => 'col-md-4 control-label']) }}
                                    <div class="col-md-6">
                                        {{ Form::text('lat', $lat, $latLngOptions) }}
                                    </div>
                                </div>

                                <div class="form-group">
                                    {{ Form::label('lng', 'Longitude', ['class' => 'col-md-4 control-label']) }}
                                    <div class="col-md-6">
                                        {{ Form::text('lng', $lng, $latLngOptions) }}
                                    </div>
                                </div>

                                <div class="form-group">
                                    {{ Form::label('plot-number', 'Plot no', ['class' => 'col-md-4 control-label']) }}
                                    <div class="col-md-6">
                                        {{ Form::text('plot-number', null, ['id'=>'plot-number', 'class' => 'form-control', 'required' => true]) }}
                                    </div>
                                </div>

                                <div class="form-group">
                                    {{ Form::label('area', 'Area (sqr metres)', ['class' => 'col-md-4 control-label']) }}
                                    <div class="col-md-6">
                                        {{ Form::text('area', null, ['id'=>'area', 'class' => 'form-control', 'required' => true]) }}
                                    </div>
                                </div>
                                <hr>

                                <div class="form-group">
                                    {{ Form::label('boundaries', 'Boundary coordinates', ['class' => 'col-md-4 control-label']) }}
                                    <div class="col-md-6">
                                        <input type="hidden" id="boundaries" name="boundaries">
                                        <ul id="bound-ul"></ul>
                                        <button class="btn" type="button" id="btn-add-bound">Add boundary</button>
                                    </div>
                                </div>

                                <hr>

                                <div class="form-group">
                                    {{ Form::label('owner', 'Owner', ['class' => 'col-md-4 control-label']) }}
                                    <div class="col-md-6">
                                        <select name="owner" class="form-control" id="owner" required>
                                            <option value="" selected>Select plot owner</option>
                                            @foreach($users as $user)
                                                <option value="{{$user['id']}}">
                                                    {{$user['firstname'] . ' ' . $user['othernames']}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    {{ Form::label('status', 'Status', ['class' => 'col-md-4 control-label']) }}
                                    <div class="col-md-6">
                                        <select name="status" id="status" class="form-control" required>
                                            @foreach($statuses as $status)
                                                <option value="{{ $status->id }}">{{ $status->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group">
                                    {{ Form::label('usage', 'usage', ['class' => 'col-md-4 control-label']) }}
                                    <div class="col-md-6">
                                        <select name="usage" id="usage" class="form-control" required>
                                            @foreach($usages as $usage)
                                                <option value="{{ $usage->id }}">{{ $usage->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    {{ Form::label('certificate', 'Upload plot certificate', ['class' => 'col-md-4 control-label']) }}
                                    <div class="col-md-6">
                                        <input type="file" name="image" id="btn-cert" class="form-control btn pull-left" required/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-8 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary" id="btn-submit">
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

        </div>

    </div>
@endsection


@section('custom-css')
    <script src="{{ asset('/js/plot-add.js') }}"></script>
    <style type="text/css">
        option {
            padding: 12px;
            border-bottom: 1px solid #dad8d8;
        }

        option:hover {
            padding: 12px;
            border-bottom: 1px solid #dad8d8;
            background: #e6e9e9;
        }

        div.add-error {
            padding: 20px;
            border-radius: 6px;
            font-style: italic;
            border: 1px solid #f89b9b;
            background: #f6e5e5;
        }

        #bound-ul li {
            display: block;
            margin: 8px 0;
        }

        #bound-ul {
            padding: 0;
        }

        #bound-ul li input{
            /*border-width:  0 0 1px 0;*/
        }

        .remove-li {
            color: rgba(255, 0, 0, 0.73);
            margin: 2px 6px;
            font-size: 1.33em!important;
        }

        .remove-li:hover {
            color: red;
        }




    </style>

@endsection