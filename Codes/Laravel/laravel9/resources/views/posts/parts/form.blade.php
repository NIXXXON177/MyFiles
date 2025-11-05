<div class="form-group">
<input type="text" name="title" id="title" class="form-control" placeholder="Заголовок" required value="{{ old('title') ?? $post->title ?? ''}}">
</div>
<div class="form-group">
<textarea id="descr" name="descr" class="form-control" rows="7" placeholder="Описание" required>{{ old('descr') ?? $post->descr ?? ''}}</textarea>
</div>
<div class="form-group">
<input type="file" name="img" id="img" class="form-control">
</div>

<script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
<script>
ClassicEditor
    .create(document.querySelector('#descr'), {
        language: 'ru'
    })
    .catch(error => {
        console.error(error);
    });
</script>