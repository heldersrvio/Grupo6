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

<div class="single-pro-review-area mt-t-30 mg-b-15">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="product-payment-inner-st">
          <div id="myTabContent" class="tab-content custom-product-edit">
            <div class="product-tab-list tab-pane fade active in" id="description">
              <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <div class="review-content-section">
                    <div id="dropzone1" class="pro-ad">
                      <form method="POST" action="{{ route('supervisor-register-bolsista') }}" class="dropzone dropzone-custom needsclick add-professors" id="demo1-upload">
                        @csrf
                        @if ($errors->has('errors'))
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('errors') }}</strong>
                        </span>
                        @endif
                        <div class="row">
                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                              <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Nome">
                            </div>
                            <div class="form-group">
                              <input id="cpf" type="text" class="form-control{{ $errors->has('cpf') ? ' is-invalid' : '' }}" name="cpf" value="{{ old('cpf') }}" required autocomplete="cpf" autofocus placeholder="CPF">
                            </div>
                          </div>
                          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                           <div class="form-group">
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="E-mail">
                          </div>
                          <div class="form-group">
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required autocomplete="new-password" placeholder="Password">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-12">
                          <div class="payment-adress">
                            <button type="submit" class="btn btn-primary waves-effect waves-light">Registrar</button>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

@endsection