@extends('layouts.app')

@section('content')
    <div class="container mt-5 pt-5 w-50">
        <div class="card" style="background-color: rgb(23, 23, 24)">

                <div class="card-header" ><h3>Edit Profile</h3></div>
                <div class="profile-header-img mb-2 mr-2 ml-2 mt-3">

                    <img role="button" data-toggle="modal" data-target="#exampleModal" class="responsive-image rounded-circle" src="/storage/avatars/{{ $user->avatar }}" alt="Profile Pic" style="height: 65px;width: 65px;">
                    <span class="ml-1">{{$user->name}}</span>
                    <!-- badge -->
                </div>
                <form action="route('users.update', $user)" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('patch') }}
                    <div class="form-group mr-2 ml-2">
                        <label for="name">Name:</label>
                        <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}">
                    </div>
                    <div class="form-group mr-2 ml-2">
                        <label for="email">Email:</label>
                        <input id="email" type="text" class="form-control" name="email" value="{{ $user->email }}">
                    </div>
                    <button type="submit" class="btn btn-success w-100">Submit</button>
                </form>
        </div>
        <div class="row justify-content-center">

        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog bg-dark" role="document">
          <div class="modal-content bg-dark">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
              <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form action="/profile" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mr-2 ml-2">
                        <input class="mt-2" type="file" class="form-control-file" name="avatar" id="avatarFile" aria-describedby="fileHelp">
                        <small id="fileHelp" class="form-text text-muted">Please upload a valid image file. Size of image should not be more than 2MB.</small>
                    </div>

                    <button type="submit" class="btn btn-success w-100">Submit</button>
                </form>
            </div>
          </div>
        </div>
      </div>

@endsection
