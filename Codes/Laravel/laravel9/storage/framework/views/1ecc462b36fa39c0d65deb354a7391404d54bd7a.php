<?php $__env->startSection('content'); ?>
    <form action="<?php echo e(route('post.update', ['post' => $post->post_id])); ?>" method="post" enctype="multipart/form-data">
      <?php echo csrf_field(); ?>
      <?php echo method_field('PATCH'); ?>
      <h3>Редактировать пост</h3>
      <?php echo $__env->make('posts.parts.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <input type="submit" value="Редактировать пост" class="btn btn-outline-success">
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', ['title' => "Редактировать пост №$post->post_id $post->title"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\KILLERFICHA_\Desktop\MyFiles\Codes\Laravel\laravel9\resources\views/posts/edit.blade.php ENDPATH**/ ?>