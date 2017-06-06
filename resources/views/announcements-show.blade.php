@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">

            @include('menu') {{-- side nav is col-md-3 --}}

            <div class="col-md-9">
                <div class="announcements">

                    <article>
                        <h3>{{ $announcement->title }}</h3>

                        <section class="byline">
                            by <span class="author">{{ $announcement->authorFullName() }}</span>,
                            <span class="date">{{ date('F d, Y H:m', strtotime($announcement->created_at)) }}</span>
                        </section>

                        <section class="phpcontent"> {!! $announcement->content!!}</section>

                    </article>



                </div>
            </div>
        </div>
    </div>


@endsection


@section('custom-css')
    <style type="text/css">


        span.author {
            font-weight: bold;
            color: #596794;
        }
        section.byline {
            font-style: italic;
            border-bottom: 1px dotted #e0eae0;
            font-family: calibri, serif;
        }

        article > h3 {
            margin-bottom: 2px;
            font-size: 2.3em;
        }

    </style>
@endsection