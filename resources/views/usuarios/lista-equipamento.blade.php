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
        <h3 class="card-title">Equipamentos cadastrados</h3>

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
            <th>Status</th>
            <th>Solucao</th>
            <th>Solicitar Manutenção</th>
            <th>Excluir equipamento</th>          
          </tr>
          @foreach($equipamento as $index => $e )
          <tr>
            <th>{{ $e['id']}}</th>
            <th>{{ $e['patrimonio']}}</th>
            <th>{{ $e['modelo']}}</th>
            <!-- exists é para relacionamentos n to n -->
            @if(!$e->manutencao->isEmpty())
            <th>{{ $e->manutencao->last()->status->name }}</th>
             <th>
            @foreach($e->manutencao as $ma)
            {{ $ma->solucao }}
            @endforeach
            </th>
            @else
            <th>Sem Sol. Man</th>
            <th>Nenhuma Solicitação</th>
            @endif
            @if(!$e->manutencao->isEmpty() && $e->manutencao->last()->status->id != 4)
            <th>Solicitação feita</th>
            <th>Não pode excluir</th>
            @else
            <th>
              <form method="post" action="{{route('equipamento-manutencao')}}">
               {!! csrf_field() !!}
               <input type="hidden" name="id" value="{{$e['id']}}">
               <button type="imput" class="btn btn-primary">Sol. Manutenção</button></th>
             </form>
           </th>
           <th>
            <form method="Delete" action="{{route('equipamento.destroy', ['eqp' => $e])}}">
              @csrf @method('DELETE')
             <input type="hidden" name="id" value="{{$e['id']}}">
             <button type="imput" class="btn btn-primary">Excluir</button></th>
           </form>  
         </th>
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
