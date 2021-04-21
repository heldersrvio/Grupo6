@extends('adminlte::page')
@section('content')
<!-- /.card-header -->
<!-- form start -->
<form method="POST" role="form" action="{{route('problemas.store')}}">
  {!! csrf_field() !!}
  <div class="card-body">
    <!-- textarea -->
    <div class="form-group">
      <label>Informe o problema</label>
      <textarea name="descricao" id="descricacao" class="form-control" rows="3" placeholder="Enter ..."></textarea>
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
      <button type="submit" class="btn btn-primary">Submit</button>
    </div>
  </form>
</div>
<div>
  <h1>Listagem dos problemas cadastrados:</h1>

  <div class="row" class="container-fluid">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Problemas cadastrados</h3>

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
              <th>Descrição</th>
              <th>Data</th>
              <th>Solicitar Chamado</th>
              <th>Excluir problema</th>
            </tr>
            @foreach($problema as $p )
            <tr>
              <th>{{ $p['id']}}</th>
              <th>{{ $p['descricao']}}</th>
              <th>{{ $p['criacao']}}</th>
            </tr>
            @endforeach
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div><!-- /.row -->
  @endsection