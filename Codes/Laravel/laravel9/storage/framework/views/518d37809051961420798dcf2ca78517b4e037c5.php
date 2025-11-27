<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($title ?? config('app.name')); ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-..." crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
    <link rel="shortcut icon" href="<?php echo e(asset('img/magazine.png')); ?>">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container container-fluid">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 col-6">
        <li class="nav-item active">
          <a class="nav-link active" aria-current="page" href="/">Главная</a>
        </li>
        <li class="nav-item offset-3">
          <a class="nav-link active" aria-current="page" href="<?php echo e(route('post.create')); ?>">Создать пост</a>
        </li>
      </ul>
      <form class="d-flex" role="search" action="<?php echo e(route('post.index')); ?>">
        <input class="form-control me-2" type="search" name="search" placeholder="Найти пост" aria-label="Search"/>
        <button class="btn btn-outline-success" type="submit">Поиск</button>
      </form>
      <ul class="navbar-nav ms-auto">
        <?php if(auth()->guard()->guest()): ?>
            <?php if(Route::has('login')): ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('login')); ?>"><?php echo e(__('Войти')); ?></a>
                </li>
            <?php endif; ?>
            <?php if(Route::has('register')): ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('register')); ?>"><?php echo e(__('Зарегистрироваться')); ?></a>
                </li>
            <?php endif; ?>
        <?php else: ?>
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    <?php echo e(Auth::user()->name); ?>

                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                        <?php echo e(__('Выйти')); ?>

                    </a>
                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                        <?php echo csrf_field(); ?>
                    </form>
                </div>
            </li>
        <?php endif; ?>
    </ul>
    </div>
  </div>
</nav>

<div class="container">
    <?php if($errors->any()): ?>
    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?php echo e($error); ?>

        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true"></span>
        </button>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>

    <?php if(session('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php echo e(session('success')); ?>

        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true"></span>
        </button>
    </div>
    <?php endif; ?>
    <?php echo $__env->yieldContent('content'); ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-..." crossorigin="anonymous"></script>
<script src="<?php echo e(asset('js/app.js')); ?>"></script>
</body>
</html>
<?php /**PATH C:\Users\KILLERFICHA_\Desktop\MyFiles\Codes\Laravel\laravel9\resources\views/layouts/layout.blade.php ENDPATH**/ ?>