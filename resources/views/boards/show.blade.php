
@extends('website.layouts.default-nobg')

@section('page-title')
    Board {{$data->edition}}
@endsection

@section('content')

    <div class="row">

        <div class="col-md-{{ (Auth::check() && Auth::user()->member ? '7' : '6 col-md-offset-3') }}">

            @if($data->image)
                <img src="{{ $data->image->generateImagePath(800,300) }}"
                     style="width: 100%; margin-bottom: 30px; box-shadow: 0 0 20px -7px #000;">

            @else
                    <img src="https://i.ytimg.com/vi/OiuQ_rVM-WE/maxresdefault.jpg"
                         style="width: 100%; margin-bottom: 30px; box-shadow: 0 0 20px -7px #000;">
            @endif
            <div class="panel panel-default container-panel">

                <div class="panel-body">

                    {!! Markdown::convertToHtml($data->description) !!}


                </div>

                @if(Auth::check() &&  Auth::user()->can('board'))

                    <div class="panel-footer clearfix">

                        @if(Auth::check() && Auth::user()->can('board'))

                            {{--<a href="{{ route("committee::edit", ["id" => $data->id]) }}"--}}
                               {{--class="btn btn-default pull-right">--}}
                                {{--Edit--}}
                            {{--</a>--}}

                        @endif





                    </div>

                @endif

            </div>

        </div>


        @if(Auth::check() && Auth::user()->member)

            <div class="col-md-5">


                @include('boards.members-list')

            </div>

        @endif


    </div>

@endsection

@section('stylesheet')

    @parent



@endsection