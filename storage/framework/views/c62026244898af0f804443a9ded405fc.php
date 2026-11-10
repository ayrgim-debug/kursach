

<?php $__env->startSection('title', 'Идеи'); ?>

<?php $__env->startSection('content'); ?>
    <div class="hero">
        <h2>💡 Идеи для копилки</h2>
        <p>Простые лайфхаки, которые помогут тебе копить быстрее и веселее! 🚀</p>
    </div>

    <div class="tips-grid">
        <?php $__currentLoopData = $tips; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tip): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="tip-card">
                <span class="tip-icon"><?php echo e($tip->icon); ?></span>
                <h5><?php echo e($tip->title); ?></h5>
                <p><?php echo e($tip->description); ?></p>
                <button class="btn-save-tip <?php echo e(in_array($tip->id, $savedTipIds) ? 'saved' : ''); ?>" 
                        data-id="<?php echo e($tip->id); ?>">
                    <?php echo e(in_array($tip->id, $savedTipIds) ? '⭐ Сохранён' : '💾 Сохранить'); ?>

                </button>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <div class="inflation-box mt-20" style="border-color: #b8873b;">
        <div class="label">🌟 Главный секрет копилки</div>
        <div class="value" style="font-size:18px; font-weight:700; color:var(--text-primary);">
            "Начни с 2-3 привычек, которые легче всего заменить, и копи с радостью!" 🐷
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.btn-save-tip').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.dataset.id;
                fetch(`/tips/${id}/save`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        if (data.saved) {
                            this.textContent = '⭐ Сохранён';
                            this.classList.add('saved');
                        } else {
                            this.textContent = '💾 Сохранить';
                            this.classList.remove('saved');
                        }
                    }
                });
            });
        });
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OSPanel\domains\copicop1\resources\views/tips/index.blade.php ENDPATH**/ ?>