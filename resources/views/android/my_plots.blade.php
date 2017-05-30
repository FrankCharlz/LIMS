@extends('android.base')

@section('content')
    <div class="container-fluid">

        @foreach($plots as $plot)
            <div class="item">
                <span>{{ $plot->plot_number }}</span>
                <span>{{ $plot->wapi() }}</span>
                <span class="span-map" data-map="{{$plot->map_url}}">{{ $plot->latitude }}, {{ $plot->longitude }}</span>
                <span>{{ $plot->area }}m<sup>2</sup></span>
            </div>
        @endforeach


    </div>

    <script type="text/javascript">
        $(document).ready(function () {
            $('.span-map').click(new function () {
                var url = $(thi).data('map');
                Android.openMap(url);
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