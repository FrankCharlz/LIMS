@extends('android.base')

@section('content')
    <div class="container-fluid">

        @foreach($announcements as $announcement)
            <div class="item" data-href="/app/announcements/{{$announcement->id}}/view">
                <h3><span>{{ $announcement->title }}</span></h3>
                <span class="author">by <b>{{ $announcement->authorFullName() }}</b></span>
                <span class="time pull-right">{{ date('F d, Y H:m', strtotime($announcement->created_at)) }}</span>
            </div>
        @endforeach


    </div>

    <script type="text/javascript">
        $(document).ready(function () {

            $('div.item').click(function () {
                window.location = $(this).data('href');
            });

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
            padding: 0px 10px 12px 10px;
        }

        .item:hover{
            background: #fafafa;
        }

        h3 {
            display: block;
            text-transform: capitalize;
            font-size: 22px;
        }

        .author, .time {
            display: inline-block;
            font-size: 13px;
        }


    </style>
@endsection