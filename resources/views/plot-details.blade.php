@extends('layouts.app')

@section('content')
    {{--<example></example>--}}
    <div class="container-fluid">
        <div class="row">

            @include('menu') {{-- side nav is col-md-3 --}}

            <div class="col-md-9">

                @if(isset($justAdded))
                    <div class="just-added">
                        <b>Plot {{ $plot->plot_number }}</b> was added successfully.
                        <a href="/plots/edit/{{ $plot->id }}">Edit details</a>
                        <span id="sp-close">x</span>
                    </div>
                @endif

                <div class="row p-info">

                    <div class="col-md-6 left">
                        <h4>Plot {{$plot->plot_number}}</h4>
                        <span class="wapi">{{ $wapi }}</span>
                        <span class="coord">Location: <a href="#"> {{$plot->latitude}}, {{$plot->longitude}}</a></span>
                    </div>

                    <div class="col-md-6 right">
                        <div class="container-of-action-buttons">
                            @php
                                if (Auth::guest()) $apps = []; //set size of apps to zero for non
                                else $apps = Auth::user()->hasAppliedFor($plot->id)
                            @endphp

                            @if(sizeof($apps) > 0)
                                <div class="jdi7">
                                    <span class="pull-right a-application-pay">Pay Now</span>
                                    <span class="pull-right a-application-cancel">Cancel Application</span>
                                </div>
                                <span class="pull-right a-application">
                                <i class="fa fa-check-circle-o" aria-hidden="true"></i>
                                You made an application for this plot on <b>{{ $apps[0]['created_at'] }}</b>
                            </span>

                            @else
                                @if(Auth::guest())
                                    <a href="/plots/buy/{{$plot->id}}" role="button" id="btn-login-to-buy" class="btn btn-default btn-plot-actions pull-right">
                                        Buy this plot
                                    </a>
                                @elseif((int)Auth::user()->role_id > 0)
                                    <a href="/plots/{{$plot->id}}/edit" role="button" id="btn-edit" class="btn btn-default btn-plot-actions pull-right">
                                        Edit plot details
                                    </a>
                                @elseif(Auth::id() === $plot->owner_id)
                                    <a role="button" id="btn-sell" class="btn btn-default btn-plot-actions pull-right">
                                        Sell this plot
                                    </a>
                                @else
                                    <a href="/plots/buy/{{$plot->id}}" role="button" id="btn-buy" class="btn btn-default btn-plot-actions pull-right">
                                        Buy this Plot
                                    </a>
                                @endif
                            @endif

                        </div>
                    </div>


                </div>

                <table class="table table-responsive">
                    <thead>

                    </thead>

                    <tbody>

                    <tr>
                        <?php
                        $owner = \App\User::find($plot->owner_id); //todo: optimize this, get required fields only
                        $owner_name = $owner->firstname. ' '.$owner->othernames;
                        ?>
                        <td>Owner name</td>
                        <td>{{ $owner_name }}</td>
                    </tr>

                    <tr>
                        <td>Status</td>
                        <td>{{ $plot->status->status_description }}</td>
                    </tr>

                    <tr>
                        <td>Description</td>
                        <td>{{ $plot->description or 'No description' }}</td>
                    </tr>


                    <tr>
                        <td>Total area <i>(m<sup>2</sup>)</i></td>
                        <td style="font-family: 'Source Sans Pro', serif"> {{ $plot->area }} </td>
                    </tr>

                    <tr>
                        <td>Certificate</td>
                        <td class="cert"><img src="/outis/{{ $plot->certificate->path }}"></td>
                    </tr>
                    <tr>
                        <td>Maps</td>
                        <td class="container-fluid maps">
                            <div id="gmap"></div>
                            <div id="smap"></div>
                        </td>
                    </tr>

                    </tbody>
                </table>

                {{-- for passing lat and long to js --}}
                <input type="hidden" id="lat" value="{{$plot->latitude}}">
                <input type="hidden" id="lng" value="{{$plot->longitude}}">




            </div>

        </div>
    </div>

    {{-- only prepare this if user is logged in --}}
    @if(Auth::user())
        <div class="buy-popup-mask">
            <div class="buy-popup-wrapper">
                <div class="buy-popup-container" id="buy-popup-container">
                    <h3>Plot application confirmation</h3>
                    <p>Dear <b>{{ Auth::user()->firstname }}</b>, please confirm your application for this plot
                        <b>Plot {{ $plot->plot_number }}</b>.
                    </p>

                    <button id="btn-buy-cancel" class="btn btn-danger">Cancel</button>
                    <button id="btn-buy-confirm" class="btn btn-success" data-pid="{{ $plot->id }}">Confirm</button>

                </div>
            </div>
        </div>
    @endif

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.3/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.0.3/dist/leaflet.js"></script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyByP5hKqYp0Y4HmBFYPkwB4Hdu9Yar6Vo8&callback=initMap">
    </script>
    <script type="text/javascript">
        $(document).ready(function () {

            //hide the div when someone clicks on the sp-close
            $('span#sp-close').click(function () {
                $('div.just-added').fadeOut();
            });

            function initMap() {

                var point = {
                    lat: parseFloat(document.getElementById('lat').value),
                    lng: parseFloat(document.getElementById('lng').value)
                };
                var zoom = 20;

                var gmap = new google.maps.Map(document.getElementById('gmap'), {
                    zoom: zoom,
                    center: point,
                    mapTypeId: 'satellite',
                    disableDefaultUI: true
                });

                var smap = L.map('smap').setView([ point.lat, point.lng], zoom);
                L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
                    attribution: '&copy;<a href="http://osm.org/copyright">OpenStreetMap</a>'
                }).addTo(smap);
                smap.dragging.disable();
                smap.touchZoom.disable();
                smap.doubleClickZoom.disable();
                smap.scrollWheelZoom.disable();
                smap.boxZoom.disable();
                smap.keyboard.disable();
                if (smap.tap) smap.tap.disable();

            }

            initMap();

        });

    </script>

    <script src="{{ asset('/js/plot.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/plot-details.css') }}"/>

@endsection

@section('custom-css')
    <style type="text/css">

        .btn-plot-actions {
            display: inline-block;
            padding: auto 18px;
            background: #d9edf7;
        }

        .a-application {
            padding: 7px 12px;
            background: #ebf2f2;
            border: 1px solid #c7c7c7;
            border-radius: 5px;
            text-decoration: none;
            color: black;cursor: pointer;
        }


        .a-application-cancel {
            padding: 6px 12px;
            background: #f3c1ce; border-radius: 5px;
            border: 1px solid #ff2c52;
            color: black;
            margin: 0 0 4px 4px;cursor: pointer;
        }


        .a-application-pay {
            padding: 6px 12px;
            background: #ebf2f2;  border-radius: 5px;
            border: 1px solid #c7c7c7;
            color: black;
            margin: 0 0 4px 4px;
            cursor: pointer;
        }


        div.just-added {
            padding: 20px;
            border-radius: 6px;
            font-style: italic;
            border: 1px solid #75958b;
            background: #e5f6ed;
            margin-bottom: 16px;
        }

        div.just-added a {
            color: #0f8cd3;
        }

        span#sp-close {
            position: absolute;
            top: -8px;
            right: 20px;
            font-style: normal;
            font-family: cursive;
            color: #03281f;
            padding: 4px;
            font-size: 2rem;
            cursor: pointer;
        }

        span#sp-close:hover {
            font-size: 2.2rem;
        }

        .right {
            position: relative;
            min-height: 72px;
        }

        .container-of-action-buttons {
            position: absolute;
            bottom: 0;
            right: 20px;
        }



    </style>

@endsection