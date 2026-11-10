<div class="ad-nav">
    <a href="<?php echo e(route('admin.dashboard')); ?>" class="<?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>">📊 Обзор</a>
    <a href="<?php echo e(route('admin.tickets.index')); ?>" class="<?php echo e(request()->routeIs('admin.tickets.*') ? 'active' : ''); ?>">📨 Обращения</a>
    <a href="<?php echo e(route('admin.users.index')); ?>" class="<?php echo e(request()->routeIs('admin.users.*') ? 'active' : ''); ?>">👥 Пользователи</a>
</div><?php /**PATH C:\OSPanel\domains\copicop1\resources\views/admin/_nav.blade.php ENDPATH**/ ?>