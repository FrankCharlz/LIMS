@extends('android.base')

@section('content')
    <div class="container-fluid">

        @foreach($announcements as $announcement)
            <div class="item">
                <h3><span>{{ $announcement->title }}</span></h3>
                <span>{{ $announcement->content }}</span>
                <span style="color: forestgreen;">{{ $announcement->created_at }}</span>
            </div>
        @endforeach


    </div>

    <script type="text/javascript">
        $(document).ready(function () {
            
        });
    </script>

@endsection

@section('custom-css')
    <style type="text/css">
        body {
            /*background: #8eb4cb;*/
            font-size: 16px;
        }

        .item {
            border-bottom: 1px solid #f2f2f2;
            margin: 20px 12px;
        }

        .item:hover{
            background: #fafafa;
        }

        .item span {
            display: block;
            text-transform: capitalize;
        }


    </style>
@endsection