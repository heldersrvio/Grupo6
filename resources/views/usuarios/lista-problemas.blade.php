@extends('adminlte::page')
@section('content')
<!-- /.card-header -->
<!-- form start -->


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
            <th>Status Chamado</th>
            <th>Solução</th>
            <th>Excluir problema</th>

          </tr>
          @foreach($problema as $p )
          <tr>
            <th>{{ $p['id']}}</th>
            <th>{{ $p['descricao']}}</th>
            <th>{{ $p['criacao']}}</th>
            <th>{{ $p->chamado->status->name }}</th>
            <th>{{ $p->chamado->solucao }}</th>
            @if($p->chamado->status->id == 1)
            <th><form method="post" action="{{route('excluir-problema')}}">
                {!! csrf_field() !!}
                <input type="hidden" name="id" value="{{$p['id']}}">
                <button type="imput" class="btn btn-primary">Excluir</button></th>
              </form>
            </th>
            @else
            <th>Não pode excluir</th>
            @endif
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