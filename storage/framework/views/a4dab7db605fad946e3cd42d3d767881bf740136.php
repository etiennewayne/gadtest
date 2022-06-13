

<?php $__env->startSection('content'); ?>

    <panel-question data-levels='<?php echo json_encode($levels, 15, 512) ?>' data-sections='<?php echo json_encode($sections, 15, 512) ?>'></panel-question>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.panel-app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\wayne\Desktop\GIthub\gadtest\resources\views/panel/question/panel-question.blade.php ENDPATH**/ ?>