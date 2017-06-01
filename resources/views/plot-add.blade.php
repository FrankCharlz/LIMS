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
                                        <ul id="bound-ul"></ul>
                                        <button class="btn pull-right" id="btn-add-bound">Add boundary</button>
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
                                        <input type="file" name="image" id="btn-cert" class="form-control btn" required/>
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

    <script type="text/javascript">

        $(document).ready(function () {

            $('#btn-submit').click(function () {
                var cert_file = $('#btn-cert').val();

                var area = $("input[name='area']").val();
                console.log(parseFloat(area));

                if (isNaN(parseFloat(area))) {
                    alert("The area you entered ["+area+"]is not in correct format");
                    return false;
                }

                if (parseFloat(area) > 9999 || parseFloat(area) < 0) {
                    alert("The area you entered ["+area+"] is out of range");
                    return false;
                }

                if (cert_file == "") {
                    alert("No photo is uploaded for the plot certificate. \nPlease select a photo");
                    return false;
                }
            });

        });
    </script>


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

        #bound-ul li input{
            /*border-width:  0 0 1px 0;*/

        }



    </style>

@endsection