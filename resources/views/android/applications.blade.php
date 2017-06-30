@extends('android.base')

@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">
                @php( $statuses = ['Pending', 'Cancelled', 'Deleted', 'Complete'])

                @foreach($applications as $application)
                    @php( $plot = \App\Plot::find($application['plot_id']) )
                    <div class="item">
                        <h3>Plot {{ $plot->plot_number }}</h3>
                        <div><span>Location:</span> {{ $plot->wapi() }}</div>
                        <div><span>Owner:</span> {{ $plot->db_owner_name() }}</div>
                        <div><span>Status:</span> {{ $statuses[$application['status']] }}</div>
                        <div><span>Date:</span> {{ date('F d, Y H:m', strtotime($application->created_at)) }}</div>
                    </div>
                @endforeach

                <script type="text/javascript" src="{{ asset('/js/application.js') }}"></script>
            </div>
        </div>
    </div>



@endsection


@section('custom-css')
    <style>
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