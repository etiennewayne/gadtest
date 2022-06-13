<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Laravel')); ?></title>

    <!-- Scripts -->
    <script src="<?php echo e(asset('js/app.js')); ?>" defer></script>

    <!-- Fonts -->



<!-- Styles -->
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">

    <style>
        html, body{
            background: #F3F3FB;
        }
    </style>

</head>
<body>
<div id="app">

    <?php if(auth()->guard()->guest()): ?>
        <admin-navbar is-auth="0"></admin-navbar>
    <?php else: ?>
        <admin-navbar is-auth="1"></admin-navbar>
    <?php endif; ?>

    <?php echo $__env->yieldContent('content'); ?>

</div>
</body>
</html>
<?php /**PATH C:\Users\eshen\Desktop\Github\gadtest\resources\views/layouts/panel-app.blade.php ENDPATH**/ ?>