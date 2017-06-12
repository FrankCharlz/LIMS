@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            @include('menu') {{-- side nav is col-md-3 --}}

            @php($isManagerOrAdmin = Auth::user() && (int)Auth::user()->role_id > 1)

            <div class="col-md-9">
                @if($isManagerOrAdmin)
                    <div>
                        <button class="btn btn-primary">Add plot</button>
                        <button class="btn btn-primary">Add block</button>
                        <button class="btn btn-primary">Upload CSV file</button>
                    </div>
                    <h2>Plots, {{ sizeof($plots) }}</h2>
                @else
                    <h2>My plots, {{ sizeof($plots) }}</h2>
                @endif
                <hr>

                <table class="table table-responsive table-hover">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Plot number</th>
                        <th>Location</th>
                        <th>Geo-location</th>
                        <th>Area</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($plots as $plot)
                        <tr class="tr-plot-link" data-href="/plots/view/{{$plot->id}}">
                            <td>{{ $plot->id }}</td>
                            <td>{{ $plot->plot_number }}</td>
                            <td>{{ $plot->wapi() }}</td>
                            <td>{{ $plot->latitude }}, {{ $plot->longitude }}</td>
                            <td>{{ $plot->area }}m<sup>2</sup></td>
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