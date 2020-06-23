@extends('layouts.app')
@section('content')
    <div class="container mt-5 pt-5">
        @if (Auth::User()->id == $post->user_id)
        <div class="card" style="background-color: rgb(23, 23, 24)">
            <div class="card-header">
                <h1>Edit {{ $post->title }}</h1>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/posts', $post->id) }}" enctype="multipart/form-data">
                        {{ method_field('PUT') }}
                        {!! csrf_field() !!}
                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="">Title</label>
                            <div class="w-100">
                                <input id="title" type="text" class="form-control" name="title" value="{{ $post->title }}">

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('pospic') ? ' has-error' : '' }}">
                            <input class="mt-2" type="file" class="form-control-file" name="postpic" id="postpicFile" aria-describedby="fileHelp">
                            <small id="fileHelp" class="form-text text-muted">Please upload a valid image file. Size of image should not be more than 4MB.</small>
                            @if ($errors->has('pospic'))
                                <span class="help-block">
                                    <strong>File too big!</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="">Description</label>

                            <div class="w-100">
                                <textarea class="form-control" name="description">{{ $post->description }}</textarea>

                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group pt-2">
                            <div class="w-100" style="text-align: right">
                                <button type="submit" class="btn btn-primary w-100">
                                    Edit Post
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        @else
            <div class="card bg-dark">
                <div class="card-header">Error</div>
                <div class="card-body"><a href="/posts">Retornar ao feed</a></div>
            </div>
        @endif
    </div>
@endsection
