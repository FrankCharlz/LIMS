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

                    <div class="col-md-4 left">
                        <h4>Plot {{$plot->plot_number}}</h4>
                        <span class="wapi">{{ $wapi }}</span>
                        <span class="coord">Location:
                            <a href="/home?map={{ $plot->latitude.'+'.$plot->longitude }}">
                                {{$plot->latitude}}, {{$plot->longitude}}
                            </a>
                        </span>
                    </div>

                    @php
                        //logic for sale buttons;
                        $userOwnsIt = Auth::user() && Auth::user()->owns($plot->id);
                        $userIsApplyingForIt = Auth::user() && !Auth::user()->owns($plot->id) && Auth::user()->isApplyingFor($plot->id);
                    @endphp

                    <div class="col-md-8 right">
                        <div class="container-of-action-buttons">

                            @if($userIsApplyingForIt)

                                <button class="pull-right a-application-cancel" id="btn-cancel-application">
                                    Cancel Application
                                </button>

                                <button class="pull-right a-application">
                                    <i class="fa fa-check-circle-o" aria-hidden="true"></i> You made an application for this plot on
                                    <b>{{ Auth::user()->isApplyingFor($plot->id)[0]['created_at'] }}</b>
                                </button>
                            @else
                                @if(Auth::guest())
                                    <a href="/login" role="button" id="btn-login-to-buy" class="btn btn-default btn-plot-actions pull-right">
                                        Login to buy this plot
                                    </a>
                                @elseif((int)Auth::user()->role_id > 0)
                                    <a href="/plots/{{$plot->id}}/edit" role="button" id="btn-edit-plot" class="btn btn-default btn-plot-actions pull-right">
                                        Edit plot details
                                    </a>
                                @elseif(Auth::id() === $plot->owner_id && (int)$plot->status_id === 1)
                                    <button id="btn-remove-from-sales" class="btn btn-default btn-plot-actions pull-right">
                                        Remove from sales
                                    </button>
                                @elseif(Auth::id() === $plot->owner_id)
                                    <button id="btn-sell-plot" class="btn btn-default btn-plot-actions pull-right">
                                        Sell this plot
                                    </button>
                                @else
                                    <button id="btn-buy-plot" class="btn btn-default btn-plot-actions pull-right">
                                        Buy this Plot
                                    </button>
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
                        <td>{{ $plot->status->name }}</td>
                    </tr>

                    <tr>
                        <td>Usage</td>
                        <td>{{ $plot->usage->name }}</td>
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

    @if($userIsApplyingForIt)
        {{-- cancel application --}}
        <div class="buy-popup-mask">
            <div class="buy-popup-wrapper">
                <div class="buy-popup-container" id="buy-popup-container">
                    <h3><b>Plot {{ $plot->plot_number }}</b> application cancellation confirmation</h3>
                    <div id="message">
                        <p>Dear {{ Auth::user()->firstname }} Please confirm the <b>removal</b> of your application for this plot.</p>
                        <p>If you click <b>confirm</b> your application for this plot will be cancelled.</p>
                    </div>
                    {{--@php(dd(Auth::user()->isApplyingFor($plot->id)))--}}
                    <button id="btn-cancel" class="btn btn-danger">Cancel</button>
                    <button id="btn-cancel-application-confirm" class="btn btn-success"
                            data-aid="{{ Auth::user()->isApplyingFor($plot->id)[0]['id'] }}">
                        Confirm
                    </button>

                </div>
            </div>
        </div>
    @elseif( $userOwnsIt && ((int)$plot->status_id === 1) /*plot on sale*/)
        {{-- remove from sell --}}
        <div class="buy-popup-mask">
            <div class="buy-popup-wrapper">
                <div class="buy-popup-container" id="buy-popup-container">
                    <h3>Remove  <b> Plot {{ $plot->plot_number }}</b> from sales</h3>
                    <div id="message">
                        <p>Dear {{ Auth::user()->firstname }} Please confirm the <b>removal</b> of this plot from sale.</p>
                        {{--<p>If you click <b>confirm</b> your application for this plot will be cancelled.</p>--}}
                    </div>
                    <button id="btn-cancel" class="btn btn-danger">Cancel</button>
                    <button id="btn-remove-from-sales-confirm" class="btn btn-success"
                            data-pid="{{ $plot->id }}">
                        Confirm
                    </button>

                </div>
            </div>
        </div>
    @elseif($userOwnsIt)
        {{-- put it on sale --}}
        <div class="buy-popup-mask">
            <div class="buy-popup-wrapper">
                <div class="buy-popup-container" id="buy-popup-container">
                    <h3><b>Plot {{ $plot->plot_number }}</b> sale confirmation</h3>
                    <div id="message">
                        <p>Dear {{ Auth::user()->firstname }} Please confirm the putting this plot on sale.</p>
                    </div>
                    <button id="btn-cancel" class="btn btn-danger">Cancel</button>
                    <button id="btn-sell-plot-confirm" class="btn btn-success"
                            data-pid="{{ $plot->id }}">
                        Confirm
                    </button>

                </div>
            </div>
        </div>
    @else
        {{-- put it on sale --}}
        <div class="buy-popup-mask">
            <div class="buy-popup-wrapper">
                <div class="buy-popup-container" id="buy-popup-container">
                    <h3><b>Plot {{ $plot->plot_number }}</b> buy confirmation</h3>
                    <div id="message">
                        <p>Dear {{ Auth::user()->firstname }} Please confirm buying this plot.</p>
                        <p>If you click <b>confirm</b> this plot will be added to your land applications.</p>
                    </div>
                    <button id="btn-cancel" class="btn btn-danger">Cancel</button>
                    <button id="btn-buy-plot-confirm" class="btn btn-success"
                            data-pid="{{ $plot->id }}">
                        Confirm
                    </button>

                </div>
            </div>
        </div>
    @endif


    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.3/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.0.3/dist/leaflet.js"></script>
    {{--<script async defer--}}
    {{--src="https://maps.googleapis.com/maps/api/js?key=AIzaSyByP5hKqYp0Y4HmBFYPkwB4Hdu9Yar6Vo8&callback=initMap">--}}
    {{--</script>--}}

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