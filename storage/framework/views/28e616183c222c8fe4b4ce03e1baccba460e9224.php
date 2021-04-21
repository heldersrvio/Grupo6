<?php $__env->startSection('content'); ?>
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
          <?php $__currentLoopData = $problema; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <tr>
            <th><?php echo e($p['id']); ?></th>
            <th><?php echo e($p['descricao']); ?></th>
            <th><?php echo e($p['criacao']); ?></th>
            <th><?php echo e($p->chamado->status->name); ?></th>
            <th><?php echo e($p->chamado->solucao); ?></th>
            <?php if($p->chamado->status->id == 1): ?>
            <th><form method="post" action="<?php echo e(route('excluir-problema')); ?>">
                <?php echo csrf_field(); ?>

                <input type="hidden" name="id" value="<?php echo e($p['id']); ?>">
                <button type="imput" class="btn btn-primary">Excluir</button></th>
              </form>
            </th>
            <?php else: ?>
            <th>Não pode excluir</th>
            <?php endif; ?>
          </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
</div><!-- /.row -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\DESENVOLVIMENTO\COMPUTACAO\Equipac\resources\views/usuarios/lista-problemas.blade.php ENDPATH**/ ?>