

<?php $__env->startSection('content'); ?>

    <students-result prop-programs='<?php echo json_encode($programs, 15, 512) ?>'></students-result>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.panel-app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\wayne\Desktop\GIthub\gadtest\resources\views/panel/admission/students-result.blade.php ENDPATH**/ ?>