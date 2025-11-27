<?php $__env->startSection('content'); ?>
    <form action="<?php echo e(route('post.store')); ?>" method="post" enctype="multipart/form-data">
      <?php echo csrf_field(); ?>
      <h2>Создать пост</h2>
      <?php echo $__env->make('posts.parts.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <input type="submit" value="Создать пост" class="btn btn-outline-success">
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', ['title' => "Создать новый пост"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\KILLERFICHA_\Desktop\MyFiles\Codes\Laravel\laravel9\resources\views/posts/create.blade.php ENDPATH**/ ?>