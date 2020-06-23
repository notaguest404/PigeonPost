@extends('layouts.app')


@section('content')


<div class="infinite-scroll mt-5 pt-2">
    @if (count($posts) > 0)
        @foreach ($posts as $post)
            <div class="pt-3 pb-3">
                <div class="card" style="background-color: rgb(23, 23, 24)">
                <div class="media m-0 mt-4">
                    <div class="d-flex ml-3">
                        <img class="responsive-image rounded-circle" src="/storage/avatars/{{$post->user->avatar}}" alt="Profile Pic" style="height: 65px;width: 65px;">
                        <div class="media-body ml-3 mt-2">
                            <a class="lead text-white text-justify small-text" href="{{ url('/profile', $post->user->id) }}">{{ $post->user->name }}</a>
                            <p class="text-muted m-0 p-0" style="font-size: 0.7em">Posted at: {{ $post->updated_at }}</p>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div>
                        <a style="font-size: 2em" href="{{ url('/posts', $post->id) }}">{{ $post->title }} </a>
                    </div>

                    <p class="lead text-white text-justify small-text mt-2 mb-3">{{ $post->description }}</p>
                    @if ($post->postpic != 'null')
                        <img class="card-img-top rounded mt-2 mb-3" src='/storage/posts/{{$post->postpic}}' alt="Card image cap">
                    @endif
                </div>

                </div>

            </div>

        @endforeach
        {{ $posts->links() }}
    @endif




</div>

@endsection
