

<?php $__env->startSection('content'); ?>
    <registration data-programs='<?php echo json_encode($programs, 15, 512) ?>'
        prop-learning-modes='<?php echo json_encode($learningmodes, 15, 512) ?>'></registration>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.home-app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\eshen\Desktop\Github\gadtest\resources\views/auth/register.blade.php ENDPATH**/ ?>