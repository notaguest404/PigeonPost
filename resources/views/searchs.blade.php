
@extends('layouts.app')

@section('content')
<div class="container pt-5 mt-5">
    @if(isset($details))
    <h2>Search result(s):</h2>
    <div class="card">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach($details as $user)
                <tr>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    @if (Auth::User()->id == $user->id)
                    <td>Can't follow yourself</td>
                    @elseif (Auth::User()->isFollowing($user->id))
                        <td>
                            <form action="{{url('unfollow/' . $user->id)}}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}

                                <button type="submit" id="delete-follow-{{ $user->target_id }}" class="btn btn-danger">
                                <i class="fa fa-btn fa-trash"></i>Unfollow
                                </button>
                            </form>
                        </td>
                    @else
                        <td>
                            <form action="{{url('follow/' . $user->id)}}" method="POST">
                                {{ csrf_field() }}

                                <button type="submit" id="follow-user-{{ $user->id }}" class="btn btn-success">
                                <i class="fa fa-btn fa-user"></i>Follow
                                </button>
                            </form>
                        </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @endif
</div>

@endsection
