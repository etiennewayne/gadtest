

<?php $__env->startSection('content'); ?>

    <section-page sections='<?php echo json_encode($sections, 15, 512) ?>' schedid="<?php echo e($sched_id); ?>"></section-page>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.student-app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\eshen\Desktop\Github\gadtest\resources\views/student/section-page.blade.php ENDPATH**/ ?>