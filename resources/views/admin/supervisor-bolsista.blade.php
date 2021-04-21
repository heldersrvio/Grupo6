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

<!-- End Navbar -->
@if($bol != null)
<?php
$nome = $bol['nome'];
$email = $bol['email'];
?>
@else
<?php
$nome = "";
$email = "";
?>
@endif
<div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title justify-content-center">Editar Informações do Bolsista</h3>
          </div>
          <div class="card-body">
            <form method="post" action="{{ route('update-bolsista', $bol['id']) }}">
              @csrf
              <div class="row">
                <div class="col-md-5 pr-1">
                  <div class="form-group">
                    <label>Organização</label>
                    <input type="text" class="form-control" disabled="" placeholder="Company" value="UFPI">
                  </div>
                </div>
                <div class="col-md-3 px-1">
                  <div class="form-group">
                    <label>Nome de Usuário</label>
                    <input type="text" class="form-control" placeholder="Username" name="nome" value="{{$nome}}">
                  </div>
                </div>
                <div class="col-md-4 pl-1">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" placeholder="Email" name="email" value="{{$email}}">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 pr-1">
                  <div class="form-group">
                    <label>First Name</label>
                    <input type="text" class="form-control" placeholder="Company" value="{{$nome}}">
                  </div>
                </div>
                <div class="col-md-6 pl-1">
                  <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" class="form-control" placeholder="Last Name" value="">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Address</label>
                    <input type="text" class="form-control" placeholder="Home Address" value="Bld Mihail Kogalniceanu, nr. 8 Bl 1, Sc 1, Ap 09">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4 pr-1">
                  <div class="form-group">
                    <label>Cidade</label>
                    <input type="text" class="form-control" placeholder="City" value="Teresina">
                  </div>
                </div>
                <div class="col-md-4 px-1">
                  <div class="form-group">
                    <label>Estado</label>
                    <input type="text" class="form-control" placeholder="Country" value="Andrew">
                  </div>
                </div>
                <div class="col-md-4 pl-1">
                  <div class="form-group">
                    <label>CEP</label>
                    <input type="number" class="form-control" placeholder="ZIP Code">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>About Me</label>
                    <textarea rows="4" cols="80" class="form-control" placeholder="Here can be your description" value="Mike">Lamborghini Mercy, Your chick she so thirsty, I'm in that two seat Lambo.</textarea>
                  </div>
                </div>
              </div>
              <button type="imput" class="btn btn-info btn-fill pull-right">Atualizar Informações</button>
              <div class="clearfix"></div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>  
<div>
  @endsection
