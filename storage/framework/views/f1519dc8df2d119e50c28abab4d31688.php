

<?php $__env->startSection('title', 'История'); ?>

<?php $__env->startSection('content'); ?>
    <div class="hero">
        <h2>📜 История твоих копилок</h2>
        <p>Все расчёты в одном месте. Смотри, как растут твои сбережения! 📈</p>
    </div>

    <div class="calc-actions">
        <button class="btn-secondary" id="clearHistoryBtn">🗑️ Очистить</button>
    </div>

    <div class="history-list" id="historyList">
        <?php $__empty_1 = true; $__currentLoopData = $histories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="history-item">
                <span class="date"><?php echo e($item->created_at->format('d.m.Y H:i')); ?></span>
                <span><?php echo e($item->cost); ?> ₽ × <?php echo e($item->days); ?> дней</span>
                <span class="amount"><?php echo e(number_format($item->total, 0, '', ' ')); ?> ₽</span>
                <button class="btn-danger delete-history" data-id="<?php echo e($item->id); ?>">✕</button>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="empty-habits">🐷 История пуста. Сделай первый расчёт!</div>
        <?php endif; ?>
    </div>

    <?php echo e($histories->links()); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const headers = {
            'Accept': 'application/json',
            'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
        };

        function send(url) {
            return fetch(url, { method: 'DELETE', headers: headers })
                .then(r => r.json())
                .then(data => {
                    if (data.success) { location.reload(); }
                    else { alert('Не удалось удалить. Попробуй ещё раз.'); }
                })
                .catch(() => alert('Ошибка соединения. Попробуй ещё раз.'));
        }

        // Удаление одной записи
        document.querySelectorAll('.delete-history').forEach(btn => {
            btn.addEventListener('click', function() {
                if (!confirm('Удалить запись из истории?')) return;
                send(`/history/${this.dataset.id}`);
            });
        });

        // Очистка всей истории
        const clearBtn = document.getElementById('clearHistoryBtn');
        if (clearBtn) {
            clearBtn.addEventListener('click', function() {
                if (!confirm('Очистить всю историю расчётов?')) return;
                send('<?php echo e(route("history.clear")); ?>');
            });
        }
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OSPanel\domains\copicop1\resources\views/history/index.blade.php ENDPATH**/ ?>