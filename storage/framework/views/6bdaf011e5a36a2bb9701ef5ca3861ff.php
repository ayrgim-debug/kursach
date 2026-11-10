<!DOCTYPE html>
<html lang="ru" data-theme="<?php echo e(session('theme', 'light')); ?>">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes" />
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
    <title>Копи-Копилка — <?php echo $__env->yieldContent('title', 'Копи и копи!'); ?></title>

    
    <script>
        (function() {
            var theme = localStorage.getItem('kopi-theme') || '<?php echo e(session('theme', 'light')); ?>';
            if (theme === 'dark') {
                document.documentElement.setAttribute('data-theme', 'dark');
            } else {
                document.documentElement.setAttribute('data-theme', 'light');
            }
        })();
    </script>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,500;9..144,600;9..144,700;9..144,800&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
    
    <!-- html2pdf -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    
    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('css/kopi.css')); ?>">

    
    <style>
        html { background: #e9dcbb; } /* Светлый фон */
        html[data-theme="dark"] { background: #14201a; } /* Тёмный фон */
    </style>
    
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>

    <!-- ===== ФОН С МОНЕТКАМИ ===== -->
    <div class="coins-bg" id="coinsBg"></div>

    <!-- ===== ОСНОВНОЙ КОНТЕЙНЕР ===== -->
    <div class="app" id="app">
        
        <!-- ===== ШАПКА ===== -->
        <?php echo $__env->make('partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        
        <!-- ===== ВКЛАДКИ ===== -->
        <?php echo $__env->make('partials.tabs', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        
        <!-- ===== ОСНОВНОЙ КОНТЕНТ ===== -->
        <main>
            <?php echo $__env->yieldContent('content'); ?>
        </main>
        
        <!-- ===== ПОДВАЛ ===== -->
        <?php echo $__env->make('partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        
    </div>

    <!-- ===== ФЛЕШ-СООБЩЕНИЯ ===== -->
    <?php if(session('success')): ?>
        <div class="flash-message flash-success" id="flashMessage">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>
    
    <?php if(session('error')): ?>
        <div class="flash-message flash-error" id="flashMessage">
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>

    <!-- ===== СКРИПТЫ ===== -->
    <script>
        // Глобальные переменные
        window.KOPI = {
            user: <?php echo json_encode(auth()->check() ? auth()->user() : null, 15, 512) ?>,
            isAuth: <?php echo json_encode(auth()->check(), 15, 512) ?>,
            csrf: '<?php echo e(csrf_token()); ?>',
            routes: {
                calculate: '<?php echo e(route("calculator.calculate")); ?>',
                habitsIndex: '<?php echo e(route("habits.index")); ?>',
                habitsStore: '<?php echo e(route("habits.store")); ?>',
                habitsTotal: '<?php echo e(route("habits.total")); ?>',
                dreamUpdate: '<?php echo e(route("dream.update")); ?>',
                dreamGet: '<?php echo e(route("dream.get")); ?>',
            },
            url: {
                tipsSave: function(id) { return '<?php echo e(url("tips")); ?>/' + id + '/save'; },
                habitsEdit: function(id) { return '<?php echo e(url("habits")); ?>/' + id + '/edit'; },
                habitsUpdate: function(id) { return '<?php echo e(url("habits")); ?>/' + id; },
                habitsDestroy: function(id) { return '<?php echo e(url("habits")); ?>/' + id; },
                historyDestroy: function(id) { return '<?php echo e(url("history")); ?>/' + id; }
            }
        };
    </script>
    
    <script src="<?php echo e(asset('js/app.js')); ?>"></script>
    <script src="<?php echo e(asset('js/coins.js')); ?>"></script>
    <script src="<?php echo e(asset('js/calculator.js')); ?>"></script>
    
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html><?php /**PATH C:\OSPanel\domains\copicop1\resources\views/layouts/app.blade.php ENDPATH**/ ?>