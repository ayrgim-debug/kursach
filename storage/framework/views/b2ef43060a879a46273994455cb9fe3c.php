

<?php $__env->startSection('title', 'Пользователи'); ?>

<?php $__env->startPush('styles'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/support.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="hero">
        <h2>👥 Пользователи</h2>
        <p>Управление аккаунтами: просмотр и блокировка.</p>
    </div>

    <?php echo $__env->make('admin._nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php if(session('success')): ?>
        <div class="sp-alert" style="background: var(--green-light); color: var(--green-dark); border-color: rgba(47, 82, 51, 0.4);">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>
    <?php if(session('error')): ?>
        <div class="sp-alert">
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>

    <form class="ad-filters" method="GET" action="<?php echo e(route('admin.users.index')); ?>">
        <input type="text" name="q" value="<?php echo e($search); ?>" placeholder="Поиск: имя или email">
        <button type="submit" class="sp-btn">🔍 Найти</button>
        <?php if($search !== ''): ?>
            <a href="<?php echo e(route('admin.users.index')); ?>" class="sp-btn sp-btn-secondary">Сбросить</a>
        <?php endif; ?>
    </form>

    <div class="ad-table-wrap">
        <table class="ad-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Дата регистрации</th>
                    <th>Имя</th>
                    <th>Email</th>
                    <th>Роль</th>
                    <th>Статус</th>
                    <th>Действие</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td>#<?php echo e($user->id); ?></td>
                        <td><?php echo e($user->created_at->format('d.m.Y')); ?></td>
                        <td>
                            <div style="display: flex; align-items: center; gap: 8px;">
                                <div class="avatar" style="width: 24px; height: 24px; font-size: 12px; background: var(--gradient-main); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                    <?php echo e($user->name[0] ?? '?'); ?>

                                </div>
                                <?php echo e($user->name); ?>

                            </div>
                        </td>
                        <td><?php echo e($user->email); ?></td>
                        <td>
                            <?php if($user->isAdmin()): ?>
                                <span class="st-badge st-new">Админ</span>
                            <?php else: ?>
                                <span class="st-badge st-closed">Пользователь</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if($user->is_banned): ?>
                                <span class="st-badge st-in_progress" style="background: var(--red-light); color: var(--red); border-color: rgba(179, 59, 44, 0.4);">Забанен</span>
                            <?php else: ?>
                                <span class="st-badge st-resolved">Активен</span>
                            <?php endif; ?>
                        </td>
                        <td class="ad-actions">
                            <?php if(!$user->isAdmin()): ?>
                                <form method="POST" action="<?php echo e(route('admin.users.ban', $user)); ?>">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PATCH'); ?>
                                    <?php if($user->is_banned): ?>
                                        <button type="submit" class="sp-btn sp-btn-small sp-btn-secondary">✅ Разбанить</button>
                                    <?php else: ?>
                                        <button type="submit" class="sp-btn sp-btn-small sp-btn-danger" onclick="return confirm('Забанить пользователя <?php echo e($user->name); ?>?')">🚫 Забанить</button>
                                    <?php endif; ?>
                                </form>
                            <?php else: ?>
                                <span class="sp-meta">Недоступно</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="7" class="empty-habits">🐷 Пользователи не найдены.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php echo e($users->links()); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OSPanel\domains\copicop1\resources\views/admin/users/index.blade.php ENDPATH**/ ?>