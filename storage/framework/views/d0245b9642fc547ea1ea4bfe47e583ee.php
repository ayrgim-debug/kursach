<header class="header">
    <a class="logo" href="<?php echo e(route('calculator')); ?>">
        <span class="logo-icon"><?php echo $__env->make('partials.logo-mark', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?></span>
        <div>
            <h1>Копи-Копилка</h1>
            <span class="sub">✨ Копи и копи! ✨</span>
        </div>
    </a>
    
    <div class="header-actions">
        <span class="user-counter">
            <span class="heart">❤️</span> <span id="userCount"><?php echo e(number_format(rand(2800, 3500))); ?></span> копят с нами
        </span>
        
        <?php if(auth()->guard()->check()): ?>
            <span class="user-badge" id="userBadge">
                <span class="avatar"><?php echo e(auth()->user()->name[0] ?? 'К'); ?></span>
                <span id="userNameDisplay"><?php echo e(auth()->user()->name); ?></span>
            </span>
            
            <div class="header-auth-actions">
                <a href="<?php echo e(route('profile')); ?>" class="btn-header-outline">
                    👤 Профиль
                </a>
                <form method="POST" action="<?php echo e(route('logout')); ?>" style="display: inline;">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn-header-danger">
                        🚪 Выйти
                    </button>
                </form>
            </div>
        <?php else: ?>
            <div class="header-auth-actions">
                <a href="<?php echo e(route('login')); ?>" class="btn-header-outline">
                    🔑 Войти
                </a>
                <a href="<?php echo e(route('register')); ?>" class="btn-header-primary">
                    📝 Регистрация
                </a>
            </div>
        <?php endif; ?>
        
        <button class="theme-toggle" id="themeToggle">
            <?php if(session('theme', 'light') === 'dark'): ?>
                ☀️ Светлая
            <?php else: ?>
                🌙 Тёмная
            <?php endif; ?>
        </button>
    </div>
</header><?php /**PATH C:\OSPanel\domains\copicop1\resources\views/partials/header.blade.php ENDPATH**/ ?>