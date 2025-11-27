<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header"><h2><?php echo e($post->title); ?></h2></div>
                <div class="card-body">
                    <div class="card-img card-img__max" style="background-image: url('<?php echo e($post->img ?? asset('img/image.png')); ?>')"></div>
                    <div class="card-descr">Описание: <?php echo e($post->descr); ?></div>
                    <div class="card-author">Автор: <b><?php echo e($post->author_name); ?></b></div>
                    <div class="card-date">Пост создан: <b><?php echo e($post->created_at->diffForHumans()); ?></b></div>
                    <div class="card-btn">
                        <a href="<?php echo e(route('post.index')); ?>" class="btn btn-outline-primary">На главную</a>
                        <?php if(auth()->guard()->check()): ?>
                        <?php if(Auth::user()->id == $post->author_id): ?>
                        <a href="<?php echo e(route('post.edit', ['post' => $post->post_id])); ?>" class="btn btn-outline-success">Редактировать</a>
                        <form action="<?php echo e(route('post.destroy', ['post' => $post->post_id])); ?>" method="POST" Onsubmit="if (confirm('Точно удалить пост?')) {return true;} else {return false;}">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <input type="submit" class="btn btn-outline-danger" value="Удалить">
                        </form>
                        <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.layout', ['title' => "Пост №$post->post_id $post->title"], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\KILLERFICHA_\Desktop\laravel9-to12\resources\views/posts/show.blade.php ENDPATH**/ ?>