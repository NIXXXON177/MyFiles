<?php $__env->startSection('content'); ?>
    <?php if(request('search')): ?>
        <?php if($posts->count() > 0): ?>
            <h2>Результаты поиска по запросу "<b><?php echo e(request('search')); ?></b>"</h2>
            <p class="lead">Всего найдено <?php echo e($posts->count()); ?> поста(ов)</p>
        <?php else: ?>
            <h2>По запросу "<b><?=htmlspecialchars($_GET['search'])?></b>" ничего не найдено</h2>
            <a href="<?php echo e(route('post.index')); ?>" class="btn btn-primary">Отобразить все посты</a>
        <?php endif; ?>
    <?php endif; ?>
    <div class="row">
        <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-6">
            <div class="card">
                <div class="card-header"><h2><?php echo e($post->short_title); ?></h2></div>
                <div class="card-body">
                    <div class="card-img" style="background-image: url('<?php echo e($post->img ?? asset('img/image.png')); ?>')"></div>
                    <div class="card-author">Автор: <b><?php echo e($post->author_name); ?></b></div>
                    <a href="<?php echo e(route('post.show', ['post' => $post->post_id])); ?>" class="btn btn-outline-primary">Посмотреть пост</a>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <?php echo e($posts->appends(request()->query())->links()); ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.layout', ['title' => 'Главная страница'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\KILLERFICHA_\Desktop\laravel9-to12\resources\views/posts/index.blade.php ENDPATH**/ ?>