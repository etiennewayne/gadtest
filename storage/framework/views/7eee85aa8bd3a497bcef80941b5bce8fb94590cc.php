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

<!-- Styles -->
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">

    <style>
        html, body{
            background: rgb(241, 241, 241);
        }
        
    </style>

</head>
<body>
<div id="app">

        <?php if(auth()->guard()->guest()): ?>
            <?php if(Route::has('login')): ?>
                <student-navbar is-auth="0"></student-navbar>
            <?php endif; ?>
        <?php else: ?>
            <student-navbar is-auth="1" firstname="<?php echo e(auth()->user()->fname); ?>" prop-id="<?php echo e(auth()->user()->user_id); ?>"></student-navbar>
        <?php endif; ?>

        <?php echo $__env->yieldContent('content'); ?>

</div>
    <?php echo $__env->yieldContent('extrascript'); ?>
</body>
</html>



<?php /**PATH C:\Users\eshen\Desktop\Github\gadtest\resources\views/layouts/student-app.blade.php ENDPATH**/ ?>