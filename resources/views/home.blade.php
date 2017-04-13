@extends('layouts.app')

@section('content')
    {{--<example></example>--}}
    <div class="container-fluid">
        <div class="row">

            @include('menu') {{-- side nav is col-md-3 --}}

            <div class="col-md-9">

                <div id="map" class="map" style="height: 500px;"></div>
                {{-- styles for popup --}}

                <button id="btn-show-plots" class="btn btn-default" style="margin: 12px 0">SHOW ON SALE</button>

            </div>
        </div>
    </div>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.3/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.0.3/dist/leaflet.js"></script>
    <script src="{{ asset('js/leaflet/singleclick.js') }}"></script>
    <script src="{{ asset('js/24.js') }}"></script>


@endsection
<style type="text/css">
    .leaflet-popup-content-wrapper, .leaflet-popup-tip {
        background: white;
        color: #b21111!important;
        box-shadow: 0 3px 14px rgba(0,0,0,0.4);
        border-radius: 0!important;
        font-family: monospace;
    }

    .leaflet-container a {
        color: #0078A8;
        font-size: 1.3rem!important;
        font-family: Lato, Raleway, serif!important;
    }
</style>

