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
<!-- /.card-header -->
<!-- form start -->
<form role="form" method="POST" action="{{ route('equipamento.store') }}">
  {!! csrf_field() !!}
  <div class="card-body" class="container-fluid">
    <!-- textarea -->
    <div class="form-group">
      <label>Patrimonio</label>
      <input type="number" class="form-control" id="patrimonio" name="patrimonio" placeholder="Patrimonio">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Modelo</label>
      <input type="text" class="form-control" id="modelo" name="modelo" placeholder="Modelo">
    </div>
    <div class="card-footer">
      <button type="submit" class="btn btn-primary">Adicionar</button>
    </div>
  </form>


<div class="row" class="container-fluid">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Equipamento cadastrados</h3>

        <div class="card-tools">
          <div class="input-group input-group-sm" style="width: 150px;">
            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

            <div class="input-group-append">
              <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
            </div>
          </div>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive p-0">
        <table class="table table-hover">
          <tr>
          <th>Id</th>
          <th>Patrimonio</th>
          <th>Modelo</th>
          <th>Solicitar Manutenção</th>
          <th>Excluir equipamento</th>
        </tr>
         @foreach($equipamento as $e )
         <tr>
          <th>{{ $e['id']}}</th>
          <th>{{ $e['patrimonio']}}</th>
          <th>{{ $e['modelo']}}</th>
         @endforeach
      </table>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.row -->

@endsection