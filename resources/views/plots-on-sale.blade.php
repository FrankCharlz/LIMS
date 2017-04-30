@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            @include('menu') {{-- side nav is col-md-3 --}}

            <div class="col-md-9">
                <h2>Plots on sale, {{ sizeof($plots) }}</h2>
                <h4 style="margin: -8px auto -12px 2px;">
                    <a href="/home?v=on-sale"><i class="fa fa-map-o" aria-hidden="true"></i> View on map</a>
                </h4>
                <hr>

                <table class="table table-responsive table-hover">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Plot number</th>
                        <th>Block</th>
                        <th>Location</th>
                        <th>Geo-location</th>
                        <th>Area</th>
                        <th>Price (Tsh)</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($plots as $plot)
                            <tr class="tr-plot-link" data-href="/plots/view/{{$plot->id}}">
                                <td>{{ $plot->id }}</td>
                                <td>{{ $plot->plot_number }}</td>
                                <td>{{ strtolower($plot->block->block_name) }}</td>
                                <td>{{ $plot->wapi() }}</td>
                                <td>{{ $plot->latitude }}, {{ $plot->longitude }}</td>
                                <td>{{ $plot->area }}m<sup>2</sup></td>
                                <td>{{ number_format( $plot->area * $plot->area * random_int(20, 100 )) }}.00</td>
                            </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <script type="text/javascript">

        $(document).ready(function () {

            $('.tr-plot-link').click(function () {
                console.log($(this).data("href"));
                window.location = $(this).data("href").toString();
            });

        });

    </script>

@endsection

@section('custom-css')
    <style type="text/css">
        td {text-transform: capitalize;}
    </style>
@endsection