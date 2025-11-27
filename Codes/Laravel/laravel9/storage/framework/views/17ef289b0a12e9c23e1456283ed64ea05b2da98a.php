

<?php $__env->startSection('content'); ?>
    <div class="card">
        <h2 class="card-header">Ты зашёл не туда, шальной (404 ошибка)</h2>
        <img src="<?php echo e(asset('img/maks.jpg')); ?>" alt="" class="maks">
    </div>
    <a href="/" class="btn btn-outline-primary">Срочно на главную страницу</a>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', ['title' => "404 ошибка. Вы попали не туда"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\KILLERFICHA_\Desktop\MyFiles\Codes\Laravel\laravel9\resources\views/errors/404.blade.php ENDPATH**/ ?>