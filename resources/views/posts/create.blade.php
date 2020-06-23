@extends('layouts.app')
@section('content')
    <div class="container mt-5 pt-5">
        <div class="card" style="background-color: rgb(23, 23, 24)">
            <div class="card-header">
                <h1>Create a new post</h1>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/posts') }}" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="">Title</label>
                            <div class="w-100">
                                <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}">

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <input class="mt-2" type="file" class="form-control-file" name="postpic" id="postpicFile" aria-describedby="fileHelp">
                            <small id="fileHelp" class="form-text text-muted">Please upload a valid image file. Size of image should not be more than 4MB.</small>
                        </div>

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="">Description</label>
                            <div class="w-100">
                                <textarea type="text" class="form-control" placeholder="Post something" name="description" value=""></textarea>
                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group pt-2">
                            <div class="w-100 mt-2">
                                <button type="submit" class="btn btn-primary w-100">
                                    Create Post
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
