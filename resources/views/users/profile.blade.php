@extends('layouts.app')

@section('content')

<div class="container mt-5 pt-5 w-50">
    <div class="text-white display-comment card mt-4" style="background-color: rgb(48, 48, 54)">
        <div class="card-header">
            <div class="d-flex ">
                <img class="responsive-image rounded-circle" src="/storage/avatars/{{$user->avatar}}" alt="Profile Pic" style="height: 65px;width: 65px;">
                <div class="media-body ml-3 mt-2">
                <a class="lead text-white text-justify small-text">{{ $user->name }}</a>
                <p class="text-muted m-0 p-0" style="font-size: 0.7em">Joined at: {{ $user->created_at }}</p>
                </div>
            </div>
            <div class="pt-3">
                @if (Auth::User()->id == $user->id)
                <a class="lead text-white text-justify small-text">{{ $user->email }}</a>
                @elseif (Auth::User()->isFollowing($user->id))
                        <form action="{{url('unfollow/' . $user->id)}}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}

                            <button type="submit" id="delete-follow-{{ $user->target_id }}" class="btn btn-danger w-100">
                            <i class="fa fa-btn fa-trash"></i>Unfollow
                            </button>
                        </form>
                @else
                        <form action="{{url('follow/' . $user->id)}}" method="POST">
                            {{ csrf_field() }}

                            <button type="submit" id="follow-user-{{ $user->id }}" class="btn btn-success w-100">
                            <i class="fa fa-btn fa-user"></i>Follow
                            </button>
                        </form>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
