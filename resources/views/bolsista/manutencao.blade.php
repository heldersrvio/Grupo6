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
            <th>Id Equipamento</th>
            <th>Id Usuario</th>
            <th>nome</th>
            <td>Status</td>
            <td>Opcão</td>
          </tr>
          @foreach($manutencao as $index => $ma)
          <tr>
            @if($ma['status_id']!='4')
            <th>{{ $ma->id}}</th>
            <th>{{ $ma->equipamento->usuario->id  }}</th>
            <th>{{ $ma->equipamento->usuario->nome  }}</th>
            <th>{{ $ma->status->name  }}</th>
            <td>
              @if($ma['status_id']=='3')
              <a href="{{route('solucao-manutencao-index', $ma['id'])}}">
                <button type="imput" class="btn btn-primary">Concluir</button>
              </a>
              @else
              <form method="post" action="{{route('altera-status')}}">
                {!! csrf_field() !!}
                @if($ma['status_id']=='1')
                <input type="hidden" name="id" value="{{$ma['id']}}">
                <input type="hidden" name="status" value="2">
                <input type="hidden" name="idb" value="{{ auth()->user()->id }}">
                <button type="imput" class="btn btn-primary">Atribuir</button></th>
                @elseif($ma['status_id']=='2')
                <input type="hidden" name="id" value="{{$ma['id']}}">
                <input type="hidden" name="status" value="3">
                <input type="hidden" name="idb" value="{{ auth()->user()->id }}">
                <button type="imput" class="btn btn-primary">Em andamento</button></th>
                @endif
              </form>
              @endif
            </td>
            @endif
          </tr>
          @endforeach
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.row -->
  @endsection
