@extends('adminlte::page')
@section('content')

<div class="card-body table-responsive p-0">
  <table class="table table-hover">
    <tr>
      <th>Id Chamado</th>
      <th>Id Usuario</th>
      <th>Nome Usuário</th>
      <td>Status</td>
      <td>Id problema</td>
      <td>Descrição</td>
    </tr>
    <tr>
      <th>{{ $cham->id}}</th>
      <th>{{ $cham->problema->usuario->id  }}</th>
      <th>{{ $cham->problema->usuario->nome  }}</th>
      <th>{{ $cham->status->name  }}</th>
      <th>{{ $cham->problema->id  }}</th>
      <th>{{ $cham->problema->descricao  }}</th>
    </tr>
  </table>
  <div>
    <form method="POST" role="form" action="{{route('solucao-chamado', $cham->id)}}">
      {!! csrf_field() !!}
      <div class="card-body">
        <div class="form-group">
          <label>Informe a solucão</label>
          <textarea name="solucao" id="solucao" class="form-control" rows="3" placeholder="Informe..."></textarea>
          <input type="hidden" name="idb" value="{{ auth()->user()->id }}">
        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Concluir chamado</button>
        </div>
      </div>
    </form>
  </div>
</div>

@endsection