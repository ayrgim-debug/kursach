<?php if($paginator->hasPages()): ?>
    <nav class="kopi-pagination" role="navigation" aria-label="Страницы">
        <?php if($paginator->onFirstPage()): ?>
            <span class="page-btn disabled">‹ Назад</span>
        <?php else: ?>
            <a class="page-btn" href="<?php echo e($paginator->previousPageUrl()); ?>" rel="prev">‹ Назад</a>
        <?php endif; ?>

        <?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(is_string($element)): ?>
                <span class="page-btn disabled"><?php echo e($element); ?></span>
            <?php endif; ?>

            <?php if(is_array($element)): ?>
                <?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($page == $paginator->currentPage()): ?>
                        <span class="page-btn active"><?php echo e($page); ?></span>
                    <?php else: ?>
                        <a class="page-btn" href="<?php echo e($url); ?>"><?php echo e($page); ?></a>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <?php if($paginator->hasMorePages()): ?>
            <a class="page-btn" href="<?php echo e($paginator->nextPageUrl()); ?>" rel="next">Вперёд ›</a>
        <?php else: ?>
            <span class="page-btn disabled">Вперёд ›</span>
        <?php endif; ?>
    </nav>
<?php endif; ?><?php /**PATH C:\OSPanel\domains\copicop1\resources\views/vendor/pagination/kopi.blade.php ENDPATH**/ ?>