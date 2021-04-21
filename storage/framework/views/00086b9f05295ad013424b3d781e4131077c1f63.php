<?php $__env->startSection('content'); ?>


<?php if(session('success')): ?>
<div class="alert alert-success">
  <?php echo e(session('success')); ?>

</div>
<?php endif; ?>

<?php if(session('error')): ?>
<div class="alert alert-danger">
  <?php echo e(session('error')); ?>

</div>
<?php endif; ?>
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
          <?php $__currentLoopData = $equipamento; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <tr>
            <th><?php echo e($e['id']); ?></th>
            <th><?php echo e($e['patrimonio']); ?></th>
            <th><?php echo e($e['modelo']); ?></th>
            <!-- exists é para relacionamentos n to n -->
            <?php if(!$e->manutencao->isEmpty()): ?>
            <th><?php echo e($e->manutencao->last()->status->name); ?></th>
             <th>
            <?php $__currentLoopData = $e->manutencao; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ma): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php echo e($ma->solucao); ?>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </th>
            <?php else: ?>
            <th>Sem Sol. Man</th>
            <th>Nenhuma Solicitação</th>
            <?php endif; ?>
            <?php if(!$e->manutencao->isEmpty() && $e->manutencao->last()->status->id != 4): ?>
            <th>Solicitação feita</th>
            <th>Não pode excluir</th>
            <?php else: ?>
            <th>
              <form method="post" action="<?php echo e(route('equipamento-manutencao')); ?>">
               <?php echo csrf_field(); ?>

               <input type="hidden" name="id" value="<?php echo e($e['id']); ?>">
               <button type="imput" class="btn btn-primary">Sol. Manutenção</button></th>
             </form>
           </th>
           <th>
            <form method="Delete" action="<?php echo e(route('equipamento.destroy', ['eqp' => $e])); ?>">
              <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
             <input type="hidden" name="id" value="<?php echo e($e['id']); ?>">
             <button type="imput" class="btn btn-primary">Excluir</button></th>
           </form>  
         </th>
         <?php endif; ?>
       </tr>
       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
     </table>
   </div>
   <!-- /.card-body -->
 </div>
 <!-- /.card -->
</div>
<!-- /.row -->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\DESENVOLVIMENTO\COMPUTACAO\Equipac\resources\views/usuarios/lista-equipamento.blade.php ENDPATH**/ ?>