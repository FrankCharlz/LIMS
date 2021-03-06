@extends('android.base')

@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">
                @foreach($plots as $plot)
                    <div class="item">
                        <h3>Plot {{ $plot->plot_number }}</h3>
                        <div><span>Location:</span> {{ $plot->wapi() }}</div>
                        <div><span>Owner:</span> {{ $plot->db_owner_name() }}</div>
                        <div><span>Coordinates:</span>{{ $plot->latitude }}, {{ $plot->longitude }}</div>
                        <div><span>Date added:</span> {{ date('F d, Y H:m', strtotime($plot->created_at)) }}</div>
                    </div>
                @endforeach

            </div>
        </div>
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
        div.item div {
            text-transform: capitalize;
            font-size: 1.4rem;
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
            margin-bottom: 0;
        }

        .item div > span {
            font-weight: bold;
        }
    </style>
@endsection