@extends('website.layouts.default-nobg')

@section('page-title')
    Previous Boards
@endsection

@section('content')

    @foreach($data as $key => $board)
        <div class="col-md-4 col-xs-6">

        <a href="{{ route('board::show', ['id' => $board->id]) }}" class="committee-link">
            <div class="committee"
                 style="{{ ($board->image ? "background-image: url(".$board->image->generateImagePath(450, 300).");" : '') }}"
                {{--style = "background-image:url('http://www.takepart.com/sites/default/files/styles/large/public/wombat-MAIN.jpg');"--}}
            >
                <div class="committee-name">
                    {{ $board->edition }}
                </div>
            </div>
        </a>

    </div>
    @endforeach

@endsection

@section('stylesheet')

    @parent

    <style type="text/css">

        .committee {
            position: relative;
            width: 100%;
            height: 200px;

            background-color: #666;
            background: linear-gradient(to bottom right, #333, #666);
            background-size: cover;
            background-position: center center;

            margin-bottom: 30px;
        }

        .committee:hover {
            transform: scale(1.05,1.05);
        }
        .committee-name {
            position: absolute;
            bottom: 0;

            background-color: rgba(0, 0, 0, 0.7);
            color: #fff;
            padding: 10px 30px;
        }

        .committee-link:hover {
            text-decoration: none;

        }



    </style>

@endsection
