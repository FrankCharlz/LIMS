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

                            <div class="panel-heading">Batch-add plots to database</div>
                            <div class="panel-body">

                                @if(session('error'))
                                    <div class="alert alert-danger">
                                        <h4>Error:</h4>
                                        {{ session('error')  }}
                                    </div>
                                @endif

                                {{ Form::open(array('url' => '/plots/new-batch', 'class' => 'form-horizontal',
                                'role' => 'form', 'files' => true)) }}

                                {{ csrf_field() }}

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
                                    {{ Form::label('certificate', 'Upload a CSV plots file', ['class' => 'col-md-4 control-label']) }}
                                    <div class="col-md-6">
                                        <input type="file" name="plots-csv" id="btn-cert" class="form-control btn pull-left" required/>
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
    <style type="text/css">
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