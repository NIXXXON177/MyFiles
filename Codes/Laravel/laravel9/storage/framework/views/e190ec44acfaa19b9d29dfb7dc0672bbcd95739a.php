<div class="form-group">
<input type="text" name="title" id="title" class="form-control" placeholder="Заголовок" required value="<?php echo e(old('title') ?? $post->title ?? ''); ?>">
</div>
<div class="form-group">
<textarea name="descr" class="form-control" rows="7" placeholder="Описание" required><?php echo e(old('descr') ?? $post->descr ?? ''); ?></textarea>
</div>
<div class="form-group">
<input type="file" name="img" id="img" class="form-control">
</div>
<?php /**PATH C:\Users\KILLERFICHA_\Desktop\MyFiles\Codes\Laravel\laravel9\resources\views/posts/parts/form.blade.php ENDPATH**/ ?>