@extends('layouts.app')

@section('content')
    {{--<example></example>--}}
    <div class="container-fluid">
        <div class="row">

            @include('menu') {{-- side nav is col-md-3 --}}

            <div class="col-md-9">

                <div id="map" class="map" style="height: 500px;"></div>
                {{-- styles for popup --}}

                <div class="status-color-codes">
                    Key: &nbsp;&nbsp;&nbsp;
                    <span>Residential</span>
                    <span>Institutional</span>
                    <span>Open Space</span>
                    <span>Other</span>
                </div>

            </div>
        </div>

        <div style="display: none;">
            <div id="custom-popup-content" class="custom-popup-content">
                <ul>
                    @if(Auth::user() && Auth::user()->role_id > 0)
                        <li>
                            <a href=/plots/add/__LATLANG>
                                <i class="fa fa-plus" aria-hidden="true"></i>
                                Add plot information to database
                            </a>
                        </li>
                    @endif
                    <li onclick="copyToClipboard('__LATLANG')">
                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                        Copy coordinates to clipboard
                    </li>
                </ul>
            </div>
            <div id="custom-popup-content-2" class="custom-popup-content">
                <h3 style="margin: 0 auto 4px;">Plot __PLOT_NO</h3>
                <ul>
                    <li>
                        <a href=/plots/view/__PLOT_ID>
                            <i class="fa fa-edit" aria-hidden="true"></i>
                            View this plot information
                        </a>
                    </li>
                    @if(Auth::user() && Auth::user()->role_id > 0)
                        <li>
                            <a href=/plots/__PLOT_ID/edit>
                                <i class="fa fa-edit" aria-hidden="true"></i>
                                Edit this plot information
                            </a>
                        </li>
                    @endif
                    <li onclick="copyToClipboard('__LATLANG')">
                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                        Copy coordinates to clipboard
                    </li>
                </ul>
            </div>
        </div>


    </div>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.3/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.0.3/dist/leaflet.js"></script>
    <script src="{{ asset('js/leaflet/singleclick.js') }}"></script>
    <script src="{{ asset('js/24.js') }}"></script>


@endsection
@section('custom-css')
    <style type="text/css">
        .leaflet-popup-content-wrapper, .leaflet-popup-tip {
            background: white;
            box-shadow: 0 3px 14px rgba(0,0,0,0.4);
            border-radius: 0!important;
            font-family: 'Source Sans Pro', serif!important;
        }

        .leaflet-popup-content-wrapper {
            width: 400px!important;
        }

        .leaflet-popup-content {
            min-width: 400px!important;
        }

        .leaflet-popup-close-button {
            font-size: 3rem!important;
            margin: 4px 10px!important;
        }

        div.custom-popup-content {
            padding: 12px;
            color: #0d0d0d;
            font-size: 16px;
            border-top: 1px solid #918c8c;
            width: 360px;   /** debug this **/
        }

        div.custom-popup-content li {
            display: inline-block;
            cursor: hand;

        }

        div.custom-popup-content  a  {
            text-decoration: none;
            color: #0d0d0d;
        }

        div.custom-popup-content  li:hover {
            color: #000;
            border-bottom: 1px dotted #333;
        }
        .status-color-codes  span {
            display: inline-block;
            width: 20%;
            margin: 4px auto;
            padding: 0 12px;
        }

        .status-color-codes  span:nth-child(1){ border-left: 12px solid #c11d1d;}
        .status-color-codes  span:nth-child(2){ border-left: 12px solid #ffa2e2;}
        .status-color-codes  span:nth-child(3){ border-left: 12px solid  mediumpurple;}
        .status-color-codes  span:nth-child(4){ border-left: 12px solid  gray;}


    </style>
@endsection

