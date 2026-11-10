

<?php $__env->startSection('title', 'Обращение #' . $ticket->id); ?>

<?php $__env->startPush('styles'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/support.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="hero">
        <h2>📨 Обращение #<?php echo e($ticket->id); ?></h2>
        <p><a class="ad-link" href="<?php echo e(route('admin.tickets.index')); ?>">← Ко всем обращениям</a></p>
    </div>

    <?php echo $__env->make('admin._nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php if($errors->any()): ?>
        <div class="sp-alert">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div>• <?php echo e($error); ?></div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>

    <div class="sp-card">
        <div class="sp-ticket-head">
            <h3 style="margin:0;"><?php echo e($ticket->subject); ?></h3>
            <span class="st-badge st-<?php echo e($ticket->status); ?>"><?php echo e($ticket->status_label); ?></span>
        </div>

        <dl class="ad-meta">
            <dt>Тип</dt>
            <dd><?php echo e($ticket->type_label); ?></dd>

            <dt>От кого</dt>
            <dd>
                <?php echo e($ticket->name); ?> ·
                <a class="ad-link" href="mailto:<?php echo e($ticket->email); ?>"><?php echo e($ticket->email); ?></a>
                <?php if($ticket->user): ?>
                    <span class="sp-meta">(аккаунт #<?php echo e($ticket->user->id); ?>)</span>
                <?php else: ?>
                    <span class="sp-meta">(гость)</span>
                <?php endif; ?>
            </dd>

            <dt>Отправлено</dt>
            <dd><?php echo e($ticket->created_at->format('d.m.Y H:i')); ?></dd>

            <dt>Страница</dt>
            <dd>
                <?php if($ticket->safe_page_url): ?>
                    <a class="ad-link" href="<?php echo e($ticket->safe_page_url); ?>" target="_blank" rel="noopener noreferrer"><?php echo e($ticket->safe_page_url); ?></a>
                <?php elseif($ticket->page_url): ?>
                    <?php echo e($ticket->page_url); ?>

                <?php else: ?>
                    <span class="sp-meta">не указана</span>
                <?php endif; ?>
            </dd>

            <dt>Браузер</dt>
            <dd class="sp-meta"><?php echo e($ticket->user_agent ?: 'неизвестно'); ?></dd>
        </dl>

        <div class="sp-text sp-message"><?php echo e($ticket->message); ?></div>
    </div>

    <div class="sp-card">
        <h3>💬 Ответ и статус</h3>

        <form class="sp-form" method="POST" action="<?php echo e(route('admin.tickets.update', $ticket)); ?>">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PATCH'); ?>

            <div class="sp-field">
                <label for="adStatus">Статус</label>
                <select id="adStatus" name="status">
                    <?php $__currentLoopData = \App\Models\SupportTicket::STATUSES; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($key); ?>" <?php echo e(old('status', $ticket->status) === $key ? 'selected' : ''); ?>><?php echo e($label); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="sp-field">
                <label for="adReply">Ответ пользователю (он увидит его на странице «Поддержка»)</label>
                <textarea id="adReply" name="admin_reply" maxlength="3000" placeholder="Напиши ответ..."><?php echo e(old('admin_reply', $ticket->admin_reply)); ?></textarea>
                <?php if($ticket->replied_at): ?>
                    <div class="sp-hint">Последний ответ: <?php echo e($ticket->replied_at->format('d.m.Y H:i')); ?></div>
                <?php endif; ?>
            </div>

            <div class="ad-form-actions">
                <button type="submit" class="sp-btn">💾 Сохранить</button>
            </div>
        </form>

        <form method="POST" action="<?php echo e(route('admin.tickets.destroy', $ticket)); ?>" style="margin-top: 14px;" onsubmit="return confirm('Удалить это обращение навсегда?');">
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
            <button type="submit" class="sp-btn sp-btn-danger">🗑️ Удалить обращение</button>
        </form>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OSPanel\domains\copicop1\resources\views/admin/tickets/show.blade.php ENDPATH**/ ?>