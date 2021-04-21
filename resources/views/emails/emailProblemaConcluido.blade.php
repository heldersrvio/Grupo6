<html>
    <body>
        <p>Olá {{ $user->nome }}!</p>
        <p></p>
        <p>O Bolsista {{$bols->last()->nome}}
        alterou o status do problema: [{{$cham->problema->descricao}}] 
        para {{$cham->status->name}}
        .</p>
        <p>Solução: {{$cham->solucao}}</p>
        <p>At.te, <br>
        Equipac!</p>
    </body>
</html>