@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            @include('menu') {{-- side nav is col-md-3 --}}

            @php($isManagerOrAdmin = Auth::user() && (int)Auth::user()->role_id > 1)

            <div class="col-md-9">
                @if($isManagerOrAdmin)
                    <div>
                        <a role="button" class="btn btn-primary" href="/plots/add/scratch">Add single plot</a>
                        <a role="button" class="btn btn-primary" href="/plots/add/batch">Add plots batch (csv upload)</a>
                    </div>
                    <h2>Plots, {{ $plots->total()}}</h2>
                @else
                    <h2>My plots, {{ $plots->count() }}</h2>
                @endif
                <hr>
                    {{ $plots->links() }}
                <table class="table table-responsive table-hover">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Plot number</th>
                        <th>Location</th>
                        <th>Geo-location</th>
                        <th>Area</th>
                        @if(!$isManagerOrAdmin)
                            <th>Applied for</th>
                        @endif
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
                            @if(!$isManagerOrAdmin)
                                <td>{{ \App\Application::where('plot_id', $plot->id)->count() }}</td>
                            @endif
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