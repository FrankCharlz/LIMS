@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">

            @include('menu') {{-- side nav is col-md-3 --}}

            <div class="col-md-9">
                <h2>Post a new announcement</h2>
                <hr>

                <div class="m-editor">
                    <form class="form1" method="post" action="/announcements/create-post">
                        {{ csrf_field() }}
                        <div>
                            <label for="heading">Heading:</label>
                            <input id="heading" type="text" name="heading" required>
                        </div>


                        <textarea cols="80" id="editor1" name="editor1" rows="10"></textarea>

                        <input type="submit" class="btn btn-default" value="POST">

                    </form>

                    <script>
                        $(document).ready(function () {

                            CKEDITOR.replace( 'editor1', {
                                width: '100%'
                            });

                        });
                    </script>
                </div>

            </div>
        </div>
    </div>


@endsection


@section('custom-css')
    <script src="http://cdn.ckeditor.com/4.7.0/standard-all/ckeditor.js"></script>
    <style type="text/css">

        .form1 div {
            margin: 4px 0;
        }

        .form1 div input {
            margin: auto 12px;
            outline: none;
            border-width: 0;
            border-bottom: 1px solid grey;
            width: 80%;
        }

    </style>
@endsection