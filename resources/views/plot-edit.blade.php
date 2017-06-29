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

                                {{ Form::open(array('url' => '/plots/editSave', 'class' => 'form-horizontal',
                                'role' => 'form', 'files' => true)) }}

                                {{ csrf_field() }}

                                <input type="hidden" name="edited-plot" value="{{ $plot->id }}">

                                <div class="form-group">
                                    {{ Form::label('lat', 'Latitude', ['class' => 'col-md-4 control-label']) }}
                                    <div class="col-md-6">
                                        {{ Form::text('lat', $plot->latitude, ['readonly' => true, 'class' => 'form-control ', 'id'=>'lat', 'required' => true]) }}
                                    </div>
                                </div>

                                <div class="form-group">
                                    {{ Form::label('lng', 'Longitude', ['class' => 'col-md-4 control-label']) }}
                                    <div class="col-md-6">
                                        {{ Form::text('lng', $plot->longitude, ['readonly' => true, 'id'=>'lng', 'class' => 'form-control', 'required' => true]) }}
                                    </div>
                                </div>

                                <div class="form-group">
                                    {{ Form::label('plot-number', 'Plot no', ['class' => 'col-md-4 control-label']) }}
                                    <div class="col-md-6">
                                        {{ Form::text('plot-number', $plot->plot_number, ['id'=>'plot-number', 'class' => 'form-control', 'required' => true]) }}
                                    </div>
                                </div>


                                <div class="form-group">
                                    {{ Form::label('area', 'Area (sqr metres)', ['class' => 'col-md-4 control-label']) }}
                                    <div class="col-md-6">
                                        {{ Form::text('area', $plot->area, ['id'=>'area', 'class' => 'form-control', 'required' => true]) }}
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
                                    {{ Form::label('certificate', 'Upload new plot certificate', ['class' => 'col-md-4 control-label']) }}
                                    <div class="col-md-6">
                                        <img width="100%" src="/outis/{{ $plot->certificate->path }}">
                                        <input type="file" name="image" id="btn-cert" class="form-control btn">
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

            });

        });
    </script>


@endsection


@section('custom-css')
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

    </style>

@endsection