<!DOCTYPE html>
<html lang="ru" data-theme="dark">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
    <title>Копи-Копилка — <?php echo $__env->yieldContent('title', 'Вход'); ?></title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,500;9..144,600;9..144,700;9..144,800&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="<?php echo e(asset('css/kopi.css')); ?>">
    
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>

    <div class="coins-bg" id="coinsBg"></div>

    <div class="auth-page">
        <div class="auth-container">
            
            <div class="auth-header">
                <div class="auth-logo">
                    <span class="logo-icon"><?php echo $__env->make('partials.logo-mark', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?></span>
                    <h1>Копи-Копилка</h1>
                </div>
                <p class="auth-subtitle">✨ Копи и копи! ✨</p>
            </div>
            
            <?php echo $__env->yieldContent('content'); ?>
            
        </div>
    </div>

    <script src="<?php echo e(asset('js/app.js')); ?>"></script>
    <script src="<?php echo e(asset('js/coins.js')); ?>"></script>
    
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html><?php /**PATH C:\OSPanel\domains\copicop1\resources\views/layouts/guest.blade.php ENDPATH**/ ?>