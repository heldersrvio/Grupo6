@extends('adminlte::page')
@section('content')

@if(session('success'))
<div class="alert alert-success">
  {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="alert alert-danger">
  {{ session('error') }}
</div>
@endif

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">

        <div class="container">
          <form method="POST" action="{{ route('admin-register-admin') }}">
            @csrf
            @if ($errors->has('errors'))
            <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('errors') }}</strong>
            </span>
            @endif
            <div class="form-group row">
              <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Name') }}</label>

              <div class="col-md-6">
                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
              </div>
            </div>

            <div class="form-group row">
              <label for="email" class="col-md-2 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

              <div class="col-md-6">
                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autocomplete="email">


              </div>
            </div>

            <div class="form-group row">
              <label for="password" class="col-md-2 col-form-label text-md-right">{{ __('Password') }}</label>

              <div class="col-md-6">
                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required autocomplete="new-password">


              </div>
            </div>

            <div class="card">
            <div class="form-group row mb-0">
              <div class="col-md-6 offset-md-2">
                <button type="submit" class="btn btn-primary">
                  {{ __('Register') }}
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection