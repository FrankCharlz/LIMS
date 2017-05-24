@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            @include('menu') {{-- side nav is col-md-3 --}}

            <div class="col-md-9">

                <form method="get" action="/search/r">
                    <p>
                        Search for plots, areas, people, anything...
                    </p>
                    <input name="query" type="text" title="">
                    <button type="submit">Search</button>

                </form>
                <hr>

                <div class="search-results">

                </div>
                
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