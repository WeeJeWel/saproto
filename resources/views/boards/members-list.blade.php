


{{--@foreach($members['editions'] as $edition => $memberships)--}}
@if($memberships)
    <div class="panel panel-default members">

        <div class="panel-heading">
            <strong>Members</strong>
        </div>

        <div class="panel-body">

            @foreach($memberships as $i => $membership)

                <div class="member-picture"
                     style="background-image:url('{!! $membership->user->generatePhotoPath(100, 100) !!}');"></div>

                @if(Route::current()->getName() == "committee::edit")
                    <a href="{{ route("committee::membership::edit", ['id' => $membership->id]) }}">
                        <span class="label label-success"><i class="fa fa-pencil"></i></span>
                    </a>
                @endif
                <a href="{{ route('user::profile', ['id' => $membership->user->id]) }}">{{ $membership->user->name }}</a>
                ({{ ($membership->role ? $membership->role : 'General Member') }})
                <br>

                @if ($membership->trashed())
                    Between {{ date('j F Y', strtotime($membership->created_at)) }}
                    and {{ date('j F Y', strtotime($membership->deleted_at)) }}.
                @else
                    Since {{ date('j F Y', strtotime($membership->created_at)) }}.
                @endif
                @if($i != count($memberships) - 1)
                    <hr class="committee-seperator">
                @endif

            @endforeach

        </div>

    </div>
    @endif
{{--@endforeach--}}
