

<?php $__env->startSection('title', 'Админ-панель'); ?>

<?php $__env->startPush('styles'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/support.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="hero">
        <h2>⚙️ Админ-панель</h2>
        <p>Обращения пользователей: ошибки, вопросы и предложения.</p>
    </div>

    <?php echo $__env->make('admin._nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="ad-stats">
        <a class="ad-stat" href="<?php echo e(route('admin.tickets.index', ['status' => 'new'])); ?>">
            <div class="ad-stat-num accent"><?php echo e($stats['new']); ?></div>
            <div class="ad-stat-label">🆕 Новые</div>
        </a>
        <a class="ad-stat" href="<?php echo e(route('admin.tickets.index', ['status' => 'in_progress'])); ?>">
            <div class="ad-stat-num"><?php echo e($stats['in_progress']); ?></div>
            <div class="ad-stat-label">🔧 В работе</div>
        </a>
        <a class="ad-stat" href="<?php echo e(route('admin.tickets.index', ['status' => 'resolved'])); ?>">
            <div class="ad-stat-num"><?php echo e($stats['resolved']); ?></div>
            <div class="ad-stat-label">✅ Решено</div>
        </a>
        <a class="ad-stat" href="<?php echo e(route('admin.tickets.index', ['status' => 'closed'])); ?>">
            <div class="ad-stat-num"><?php echo e($stats['closed']); ?></div>
            <div class="ad-stat-label">📁 Закрыто</div>
        </a>
        <a class="ad-stat" href="<?php echo e(route('admin.tickets.index', ['type' => 'bug'])); ?>">
            <div class="ad-stat-num danger"><?php echo e($stats['open_bugs']); ?></div>
            <div class="ad-stat-label">🐞 Открытых ошибок</div>
        </a>
        <div class="ad-stat">
            <div class="ad-stat-num"><?php echo e($stats['users']); ?></div>
            <div class="ad-stat-label">👥 Пользователей</div>
        </div>
    </div>

    <div class="sp-card">
        <h3>🕒 Последние обращения</h3>

        <?php $__empty_1 = true; $__currentLoopData = $latest; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <a class="ad-latest" href="<?php echo e(route('admin.tickets.show', $ticket)); ?>">
                <div class="ad-latest-main">
                    <strong><?php echo e($ticket->subject); ?></strong>
                    <span class="sp-meta"><?php echo e($ticket->type_label); ?> · <?php echo e($ticket->name); ?> · <?php echo e($ticket->created_at->format('d.m.Y H:i')); ?></span>
                </div>
                <span class="st-badge st-<?php echo e($ticket->status); ?>"><?php echo e($ticket->status_label); ?></span>
            </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="empty-habits">🐷 Обращений пока нет.</div>
        <?php endif; ?>

        <?php if($stats['total'] > 0): ?>
            <div style="margin-top: 14px;">
                <a class="sp-btn sp-btn-secondary" href="<?php echo e(route('admin.tickets.index')); ?>">Все обращения (<?php echo e($stats['total']); ?>)</a>
            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OSPanel\domains\copicop1\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>