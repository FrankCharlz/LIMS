@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">

            @include('menu') {{-- side nav is col-md-3 --}}

            <div class="col-md-9">
                <div class="announcements">
                    @foreach($announcements as $announcement)

                        <article>
                            <h3>{{ $announcement->title }} - {{ $announcement->id }}</h3>

                            <section class="byline">
                                by <span class="author" style="color: red;">{{ $announcement->authorFullName() }}</span>,
                                <span class="date">
                                {{ date('F d, Y', strtotime($announcement->created_at)) }} at
                                    {{ date('H:m', strtotime($announcement->created_at)) }}
                                </span>
                            </section>
                            <section class="content"> {!! $announcement->content !!}</section>

                        </article>
                    @endforeach

                </div>
                {{ $announcements->links() }}



            </div>
        </div>
    </div>


@endsection


@section('custom-css')
    <style type="text/css">

        div.announcements {
            /*font-family: calibri, lato, sans-serif;*/
            /*max-width: 79%;*/
        }

        article {
            background: white;
            display: inline-block;
            width: 45%;
            padding: 20px;
            border: 1px solid #fff;
            border-radius: 0;
        }

        span.author {
            font-weight: bold;
            color: #1f648b;
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