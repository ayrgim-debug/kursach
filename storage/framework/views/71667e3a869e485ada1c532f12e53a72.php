

<?php $__env->startSection('title', 'Обращения'); ?>

<?php $__env->startPush('styles'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/support.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="hero">
        <h2>📨 Обращения</h2>
        <p>Все сообщения пользователей в одном месте.</p>
    </div>

    <?php echo $__env->make('admin._nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <form class="ad-filters" method="GET" action="<?php echo e(route('admin.tickets.index')); ?>">
        <select name="status">
            <option value="">Все статусы</option>
            <?php $__currentLoopData = \App\Models\SupportTicket::STATUSES; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($key); ?>" <?php echo e($status === $key ? 'selected' : ''); ?>><?php echo e($label); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>

        <select name="type">
            <option value="">Все типы</option>
            <?php $__currentLoopData = \App\Models\SupportTicket::TYPES; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($key); ?>" <?php echo e($type === $key ? 'selected' : ''); ?>><?php echo e($label); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>

        <input type="text" name="q" value="<?php echo e($search); ?>" placeholder="Поиск: тема, текст, имя, email">

        <button type="submit" class="sp-btn">🔍 Найти</button>
        <?php if($status || $type || $search !== ''): ?>
            <a href="<?php echo e(route('admin.tickets.index')); ?>" class="sp-btn sp-btn-secondary">Сбросить</a>
        <?php endif; ?>
    </form>

    <div class="ad-table-wrap">
        <table class="ad-table">
            <thead>
                <tr>
                    <th>№</th>
                    <th>Дата</th>
                    <th>От кого</th>
                    <th>Тип</th>
                    <th>Тема</th>
                    <th>Статус</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td>#<?php echo e($ticket->id); ?></td>
                        <td><?php echo e($ticket->created_at->format('d.m.Y H:i')); ?></td>
                        <td>
                            <?php echo e($ticket->name); ?>

                            <div class="sp-meta"><?php echo e($ticket->email); ?></div>
                        </td>
                        <td><?php echo e($ticket->type_label); ?></td>
                        <td><a class="ad-link" href="<?php echo e(route('admin.tickets.show', $ticket)); ?>"><?php echo e(\Illuminate\Support\Str::limit($ticket->subject, 60)); ?></a></td>
                        <td><span class="st-badge st-<?php echo e($ticket->status); ?>"><?php echo e($ticket->status_label); ?></span></td>
                        <td class="ad-actions">
                            <a class="sp-btn sp-btn-small" href="<?php echo e(route('admin.tickets.show', $ticket)); ?>">Открыть</a>
                            <form method="POST" action="<?php echo e(route('admin.tickets.destroy', $ticket)); ?>" onsubmit="return confirm('Удалить обращение #<?php echo e($ticket->id); ?>?');">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="sp-btn sp-btn-small sp-btn-danger">✕</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="7" class="empty-habits">🐷 Ничего не найдено.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php echo e($tickets->links()); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OSPanel\domains\copicop1\resources\views/admin/tickets/index.blade.php ENDPATH**/ ?>