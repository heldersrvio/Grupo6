<html>
    <body>
        <p>Olá {{ $user->nome }}!</p>
        <p></p>
        <p>O Bolsista {{$bols->last()->nome}}
        alterou o status do Equipamento: {{$manu->equipamento->modelo}} de patrimonio: {{$manu->equipamento->patrimonio}}
        para {{$manu->status->name}}
        .</p>
        <p>Solução: {{$manu->solucao}}</p>
        <p>At.te, <br>
        Equipac!</p>
    </body>
</html>