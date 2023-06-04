

<?php $__env->startSection('content'); ?>
    <?php if(Auth::user()->role == 'STAFF'): ?>
        <test-schedule-staff></test-schedule-staff>
    <?php else: ?>
        <test-schedule></test-schedule>   
    <?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.panel-app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\eshen\Desktop\Github\gadtest\resources\views/panel/test_schedule/test-schedule.blade.php ENDPATH**/ ?>