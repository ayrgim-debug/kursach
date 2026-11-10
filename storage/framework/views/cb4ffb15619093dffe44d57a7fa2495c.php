

<?php $__env->startSection('title', 'Регистрация'); ?>

<?php $__env->startSection('content'); ?>
    <div class="auth-form-container">
        <h2>📝 Регистрация</h2>
        <p class="auth-desc">Создай аккаунт и начни копить на мечту! 🐷</p>

        <?php if($errors->any()): ?>
            <div class="auth-status error">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div><?php echo e($error); ?></div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="<?php echo e(route('register')); ?>" class="auth-form">
            <?php echo csrf_field(); ?>

            <div class="input-group">
                <label for="name">👤 Как тебя зовут?</label>
                <input type="text" id="name" name="name" value="<?php echo e(old('name')); ?>" placeholder="Иван" required autofocus />
            </div>

            <div class="input-group">
                <label for="email">📧 Email</label>
                <input type="email" id="email" name="email" value="<?php echo e(old('email')); ?>" placeholder="example@mail.ru" required />
            </div>

            <div class="input-group">
                <label for="password">🔒 Пароль (мин. 6 символов)</label>
                <input type="password" id="password" name="password" placeholder="••••••••" required />
            </div>

            <div class="input-group">
                <label for="password_confirmation">✅ Подтверди пароль</label>
                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="••••••••" required />
            </div>

            <button type="submit" class="btn-primary" style="width:100%; text-align:center; justify-content:center;">
                📝 Создать аккаунт
            </button>
        </form>

        <p class="auth-switch">
            Уже есть аккаунт? <a href="<?php echo e(route('login')); ?>">Войди</a>
        </p>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
    /* ===== ТЁМНАЯ ТЕМА ДЛЯ СТРАНИЦЫ РЕГИСТРАЦИИ ===== */
    body {
        background: #1a120b !important;
    }
    .auth-container {
        background: #2d1f14 !important;
        border-color: #4d3728 !important;
    }
    .auth-logo h1 {
        color: #b8873b !important;
    }
    .auth-subtitle {
        color: #b88a7a !important;
    }
    .auth-form-container h2 {
        color: #fdf4ed !important;
    }
    .auth-desc {
        color: #b88a7a !important;
    }
    .input-group label {
        color: #e8c98a !important;
    }
    .input-group input {
        background: #3d2b1c !important;
        border-color: #4d3728 !important;
        color: #fdf4ed !important;
    }
    .input-group input:focus {
        border-color: #b8873b !important;
        box-shadow: 0 0 0 6px rgba(184, 135, 59, 0.18) !important;
    }
    .auth-switch {
        color: #b88a7a !important;
    }
    .auth-switch a {
        color: #b8873b !important;
    }
</style>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.guest', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OSPanel\domains\copicop1\resources\views/auth/register.blade.php ENDPATH**/ ?>