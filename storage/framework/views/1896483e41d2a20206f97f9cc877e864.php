<nav class="tabs" id="tabNav">
    <button class="tab-btn <?php echo e(request()->routeIs('calculator') ? 'active' : ''); ?>" data-tab="calculator" onclick="window.location.href='<?php echo e(route('calculator')); ?>'">
        💰 Копилка
    </button>
    <button class="tab-btn <?php echo e(request()->routeIs('habits*') ? 'active' : ''); ?>" data-tab="habits" onclick="window.location.href='<?php echo e(route('habits.index')); ?>'">
        📋 Привычки
    </button>
    <button class="tab-btn <?php echo e(request()->routeIs('history*') ? 'active' : ''); ?>" data-tab="history" onclick="window.location.href='<?php echo e(route('history')); ?>'">
        📜 История
    </button>
    <button class="tab-btn <?php echo e(request()->routeIs('tips*') ? 'active' : ''); ?>" data-tab="tips" onclick="window.location.href='<?php echo e(route('tips')); ?>'">
        💡 Идеи
    </button>
    <button class="tab-btn <?php echo e(request()->routeIs('profile') ? 'active' : ''); ?>" data-tab="profile" onclick="window.location.href='<?php echo e(route('profile')); ?>'">
        👤 Профиль
    </button>
    <button class="tab-btn <?php echo e(request()->routeIs('support*') ? 'active' : ''); ?>" data-tab="support" onclick="window.location.href='<?php echo e(route('support')); ?>'">
        🆘 Поддержка
    </button>
    <?php if(auth()->guard()->check()): ?>
        <?php if(auth()->user()->isAdmin()): ?>
            <?php $newTickets = \App\Models\SupportTicket::where('status', 'new')->count(); ?>
            <button class="tab-btn <?php echo e(request()->routeIs('admin.*') ? 'active' : ''); ?>" data-tab="admin" onclick="window.location.href='<?php echo e(route('admin.dashboard')); ?>'">
                ⚙️ Админка
                <?php if($newTickets > 0): ?>
                    <span style="display:inline-block; min-width:18px; padding:0 5px; margin-left:4px; border-radius:60px; background:#b33b2c; color:#fff; font-size:11px; line-height:18px; text-align:center;"><?php echo e($newTickets); ?></span>
                <?php endif; ?>
            </button>
        <?php endif; ?>
    <?php endif; ?>
</nav><?php /**PATH C:\OSPanel\domains\copicop1\resources\views/partials/tabs.blade.php ENDPATH**/ ?>