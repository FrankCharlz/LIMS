@extends('android.base')

@section('content')
    <div class="container-fluid">

        @foreach($users as $user)
            {{ $user->id }} <br>
        @endforeach


    </div>

    <script type="text/javascript">
        $(document).ready(function () {
            alert('Hella!');
        });
    </script>

@endsection

@section('custom-css')
    <style type="text/css">
        body {
            background: #8eb4cb;
        }
    </style>
@endsection