

<?php $__env->startSection('content'); ?>

        <home-page is-not-scheduled="<?php if(session('error') == 'not_scheduled'): ?>1 <?php endif; ?>"
                already-visited-section="<?php if(session('error') == 'already_visited_section'): ?>visited <?php endif; ?>"
                is-exist="<?php if(session('error') == 'exist'): ?>exist <?php endif; ?>" prop-user='<?php echo json_encode(auth()->user(), 15, 512) ?>'></home-page>







<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.student-app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\eshen\Desktop\Github\gadtest\resources\views/student/home.blade.php ENDPATH**/ ?>