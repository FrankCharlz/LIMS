@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            @include('menu') {{-- side nav is col-md-3 --}}

            <div class="col-md-9">

                <form method="get" action="/search/r">
                    <p style="font-size: 2em; font-weight: 300;">
                        Search for plots, areas, people, anything...
                    </p>
                    <input name="query" type="text" title="" placeholder="search here" autofocus>
                </form>
                <hr>

                @if( isset($doneSearching) )
                    <div class="search-results">



                        @if(sizeof($plots))
                            <h2>Plots</h2>
                            @php($i = 1)
                            @foreach($plots as $plot)
                                <div>{{ $i++ }}.
                                    <a href="#home?v=plot&id={{$plot->id}}"> Plot {{ $plot->plot_number }}</a>
                                </div>
                            @endforeach
                        @endif


                        @if(sizeof($locations))
                            <h2>Locations</h2>
                            @php($i = 1)
                            @foreach($locations as $location)
                                <div>{{ $i++ }}.
                                    <a href="#home?v=street&id={{$location->street_id}}"> {{ $location->location }}</a>
                                </div>
                            @endforeach
                        @endif


                        @if(!sizeof($plots) && !sizeof($locations))
                            <div class="zero">
                                0 results!, <br>No items match your search

                            </div>
                        @endif



                    </div>
                @endif


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

        form input {
            outline: none;
            border-width: 0;
            border-bottom: 1px solid #e4e3e5;
            margin-right: 4px;
            width: 100%;
            font-size: 3.6em;
            font-weight: 300;
        }
        div.search-results h2 {
            color: cadetblue;
            /*font-size: 1.1em;*/
        }

        div.search-results a {
            text-transform: capitalize;
        }

        .zero {
            text-align: left;
            font-size: 4rem;
            padding: 60px;
            color: rgb(175, 124, 124);
        }
    </style>
@endsection