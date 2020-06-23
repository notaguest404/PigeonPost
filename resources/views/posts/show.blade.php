@extends('layouts.app')


@section('content')
<style>
    .dropdown {
            background-color: transparent;
        }
</style>
    <div class="container mt-5 pt-5">
        <div class="infinite-item pt-3 pb-1">
            <div class="card " style="background-color: rgb(23, 23, 24)">
              <div class="media m-0 mt-3">
                  <div class="d-flex mr-3">

                    </div>
                    <div class="media-body">
                        <img class="responsive-image rounded-circle" src="/storage/avatars/{{$post->user->avatar}}" alt="Profile Pic" style="height: 65px;width: 65px;">
                        @if (Auth::User()->id == $post->user_id)
                        <div class="dropdown btn-dark float-right mr-3">
                            <button class="btn bg-transparent text-white dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              ...
                            </button>

                            <div class="dropdown-menu bg-dark" aria-labelledby="dropdownMenuButton">
                                <a type="submit" class="btn text-success" href="{{ $post->id }}/edit">Edit Post</a>
                                <form action="/posts/{{ $post->id }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    @if (Auth::User()->id == $post->user_id)
                                        <button role="button" type="submit" class="btn text-danger">Delete Post</button>
                                    @endif
                                </form>
                            </div>

                        </div>
                        @endif
                        <a class="lead text-white text-justify small-text ml-2 mt-2">{{ $post->user->name }}</a>
                  </div>
              </div>
              <hr>
              <div class="card-body">
                <h2><a href="{{ url('/posts', $post->id) }}">{{ $post->title }}</a></h2>
                <p class="lead text-white text-justify small-text mt-2 mb-3">{{ $post->description }}</p>
                @if ($post->postpic != 'null')
                        <img class="card-img-top rounded mt-2 mb-3" src='/storage/posts/{{$post->postpic}}' alt="Card image cap">
                @endif

                <hr />
                <h4>Add comment</h4>
                <form method="post" action="{{ route('comment.add') }}">
                    @csrf
                    <div class="form-group">
                        <input type="text" name="comment_body" class="form-control" />
                        <input type="hidden" name="post_id" value="{{ $post->id }}" />
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-warning" value="Add Comment" />
                    </div>
                </form>

                <hr class="text-white" />
                    <h4 >Display Comments</h4>
                    @foreach($post->comments as $comment)
                        <div class="text-white display-comment card mt-4" style="background-color: rgb(48, 48, 54)">
                            <div class="card-header">

                                @if (Auth::User()->id == $comment->user_id)
                                <div class="dropdown btn-dark float-right mr-3 float-right">
                                    <button class="btn bg-transparent text-white dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    ...
                                    </button>

                                    <div class="dropdown-menu bg-dark" aria-labelledby="dropdownMenuButton">
                                        <form action="/comment/{{ $comment->id }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            @if (Auth::User()->id == $comment->user_id)
                                                <button role="button" type="submit" class="btn text-danger">Delete Comment</button>
                                            @endif
                                        </form>
                                    </div>

                                </div>
                                @endif

                                <img class="responsive-image rounded-circle " src="/storage/avatars/{{$comment->user->avatar}}" alt="Profile Pic" style="height: 65px;width: 65px;">
                                <a class="ml-2">{{ $comment->user->name }}</a>
                                <br>
                                <a class="text-muted float-right" style="font-size: 0.7em">Posted at: {{ $comment->updated_at }}</a>
                            </div>
                            <div class="card-body ">
                                <p>{{ $comment->body }}</p>
                            </div>



                        </div>
                    @endforeach
                    <hr />

              </div>

            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('.dropdown-toggle').dropdown();
        });
    </script>
@endsection
