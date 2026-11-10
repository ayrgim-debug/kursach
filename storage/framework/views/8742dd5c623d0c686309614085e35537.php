

<?php $__env->startSection('title', 'Поддержка'); ?>

<?php $__env->startPush('styles'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/support.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="hero">
        <h2>🆘 Поддержка</h2>
        <p>Что-то сломалось или есть вопрос? Расскажи нам — мы всё посмотрим и ответим. 🐷</p>
    </div>

    <div class="sp-card">
        <h3>✉️ Новое обращение</h3>

        <?php if($errors->any()): ?>
            <div class="sp-alert">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div>• <?php echo e($error); ?></div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>

        <form class="sp-form" method="POST" action="<?php echo e(route('support.store')); ?>">
            <?php echo csrf_field(); ?>

            <?php if(auth()->guard()->guest()): ?>
                <div class="sp-row">
                    <div class="sp-field">
                        <label for="spName">Твоё имя</label>
                        <input type="text" id="spName" name="name" value="<?php echo e(old('name')); ?>" maxlength="100" placeholder="Как тебя зовут?">
                    </div>
                    <div class="sp-field">
                        <label for="spEmail">Email для ответа</label>
                        <input type="email" id="spEmail" name="email" value="<?php echo e(old('email')); ?>" maxlength="150" placeholder="name@example.com">
                    </div>
                </div>
            <?php endif; ?>

            <div class="sp-row">
                <div class="sp-field">
                    <label for="spType">Тип обращения</label>
                    <select id="spType" name="type">
                        <?php $__currentLoopData = \App\Models\SupportTicket::TYPES; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($key); ?>" <?php echo e(old('type', 'bug') === $key ? 'selected' : ''); ?>><?php echo e($label); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="sp-field">
                    <label for="spSubject">Тема</label>
                    <input type="text" id="spSubject" name="subject" value="<?php echo e(old('subject')); ?>" maxlength="150" placeholder="Коротко: что случилось?">
                </div>
            </div>

            <div class="sp-field">
                <label for="spMessage">Описание</label>
                <textarea id="spMessage" name="message" maxlength="3000" placeholder="Что ты делал, что ожидал увидеть и что произошло на самом деле?"><?php echo e(old('message')); ?></textarea>
                <div class="sp-hint"><span id="spCounter">0</span> / 3000</div>
            </div>

            <div class="sp-field">
                <label for="spPage">Страница, где возникла проблема (необязательно)</label>
                <input type="text" id="spPage" name="page_url" value="<?php echo e(old('page_url', $from)); ?>" maxlength="500" placeholder="https://...">
            </div>

            <div>
                <button type="submit" class="sp-btn">📨 Отправить</button>
            </div>
        </form>
    </div>

    <?php if(auth()->guard()->check()): ?>
        <div class="sp-card">
            <h3>📬 Мои обращения</h3>

            <?php $__empty_1 = true; $__currentLoopData = $myTickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="sp-ticket">
                    <div class="sp-ticket-head">
                        <strong><?php echo e($ticket->subject); ?></strong>
                        <span class="st-badge st-<?php echo e($ticket->status); ?>"><?php echo e($ticket->status_label); ?></span>
                    </div>
                    <div class="sp-meta">
                        <?php echo e($ticket->type_label); ?> · <?php echo e($ticket->created_at->format('d.m.Y H:i')); ?>

                    </div>
                    <div class="sp-text"><?php echo e($ticket->message); ?></div>

                    <?php if($ticket->admin_reply): ?>
                        <div class="sp-reply">
                            <div class="sp-reply-title">💬 Ответ поддержки
                                <?php if($ticket->replied_at): ?>
                                    <span>· <?php echo e($ticket->replied_at->format('d.m.Y H:i')); ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="sp-text"><?php echo e($ticket->admin_reply); ?></div>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="empty-habits">🐷 Ты пока ничего не отправлял.</div>
            <?php endif; ?>
        </div>
    <?php else: ?>
        <div class="sp-note">
            💡 Войди в аккаунт, и здесь появятся твои обращения с ответами поддержки.
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const textarea = document.getElementById('spMessage');
        const counter = document.getElementById('spCounter');
        if (!textarea || !counter) return;

        const update = () => { counter.textContent = textarea.value.length; };
        textarea.addEventListener('input', update);
        update();
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OSPanel\domains\copicop1\resources\views/support/index.blade.php ENDPATH**/ ?>