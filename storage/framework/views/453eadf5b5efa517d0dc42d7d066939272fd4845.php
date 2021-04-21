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
<form role="form" method="POST" action="<?php echo e(route('equipamento.store')); ?>">
  <?php echo csrf_field(); ?>

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
         <?php $__currentLoopData = $equipamento; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
         <tr>
          <th><?php echo e($e['id']); ?></th>
          <th><?php echo e($e['patrimonio']); ?></th>
          <th><?php echo e($e['modelo']); ?></th>
          <th>
            <form method="post" action="<?php echo e(route('equipamento-manutencao')); ?>">
              <?php echo csrf_field(); ?>

              <input type="hidden" name="id" value="<?php echo e($e['id']); ?>">
              <button type="imput" class="btn btn-primary">Sol. Manutenção</button></th>
            </form>
          </th>
          <th>
            <form method="post" action="<?php echo e(route('login-usuario')); ?>">
              <?php echo csrf_field(); ?>

              <input type="hidden" name="id" value="<?php echo e($e['id']); ?>">
              <button type="imput" class="btn btn-primary">Excluir equipamento</button></th>
            </form>
          </th>
         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </table>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.row -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\DESENVOLVIMENTO\COMPUTACAO\Equipac\resources\views/usuarios/equipamento.blade.php ENDPATH**/ ?>