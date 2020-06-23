@extends('layouts.app')

@section('content')
<div class="container mt-5 pt-5">
            <div class="card"  style="background-color: rgb(23, 23, 24)">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                            <label for="email" class="">{{ __('E-Mail Address') }}</label>

                            <div class="w-100">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="w-100 mt-3">
                                <button type="submit" class="btn btn-primary w-100">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                    </form>
                </div>
            </div>
</div>
@endsection
