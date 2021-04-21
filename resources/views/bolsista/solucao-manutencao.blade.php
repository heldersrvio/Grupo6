@extends('adminlte::page')
@section('content')

<div class="card-body table-responsive p-0">
  <table class="table table-hover">
    <tr>
      <th>Id Manutencao</th>
      <th>Id Usuario</th>
      <th>nome</th>
      <td>Status</td>
      <td>Id Equipamento</td>
      <td>Patrimonio</td>
      <td>Modelo</td>
    </tr>
    <tr>
      <th>{{ $manut->id}}</th>
      <th>{{ $manut->equipamento->usuario->id  }}</th>
      <th>{{ $manut->equipamento->usuario->nome  }}</th>
      <th>{{ $manut->status->name  }}</th>
      <th>{{ $manut->equipamento->id  }}</th>
      <th>{{ $manut->equipamento->patrimonio  }}</th>
      <th>{{ $manut->equipamento->modelo  }}</th>
    </tr>
  </table>
  <div>
    <form method="POST" role="form" action="{{route('solucao-manutencao', $manut->id)}}">
      {!! csrf_field() !!}
      <div class="card-body">
        <div class="form-group">
          <label>Informe a solucão</label>
          <textarea name="solucao" id="solucao" class="form-control" rows="3" placeholder="Informe..."></textarea>
          <input type="hidden" name="idb" value="{{ auth()->user()->id }}">
        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Concluir manutenção</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection