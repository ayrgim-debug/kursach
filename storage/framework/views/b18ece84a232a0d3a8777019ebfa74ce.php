

<?php $__env->startSection('title', 'Копилка'); ?>

<?php $__env->startSection('content'); ?>
    <!-- ===== ГЕРОЙ ===== -->
    <div class="hero">
        <span class="badge">🐖 Копи-Копи!</span>
        <h2>Сколько <span class="highlight">накопишь</span> за год?</h2>
        <p>Введи свою ежедневную трату — и мы покажем, сколько можно было бы отложить! 💰</p>
    </div>

    <!-- ===== СТАТИСТИКА ===== -->
    <?php if(isset($stats)): ?>
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">💰</div>
                <div class="stat-number"><?php echo e(number_format($stats['total_savings'] ?? 0, 0, '', ' ')); ?></div>
                <div class="stat-label">Накоплено за год</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">📋</div>
                <div class="stat-number"><?php echo e($stats['habits_count'] ?? 0); ?></div>
                <div class="stat-label">Привычек</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">📜</div>
                <div class="stat-number"><?php echo e($stats['history_count'] ?? 0); ?></div>
                <div class="stat-label">Расчётов</div>
            </div>
        </div>
    <?php endif; ?>

    <!-- ===== КОНТЕЙНЕР ДЛЯ ВЕРХНЕЙ КАРТОЧКИ МЕЧТЫ ===== -->
    <div id="topDreamContainer">
        <?php if(isset($stats) && ($stats['has_dream'] ?? false)): ?>
            <div class="dream-card" id="topDreamCard" style="margin-bottom: 24px; padding: 20px 24px; background: var(--bg-input); border-radius: var(--radius-sm); border: 2px solid var(--border);">
                <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 6px;">
                    <span style="font-size: 24px;">🎯</span>
                    <h4 style="font-size: 17px; font-weight: 800; font-family: 'Fraunces', serif; color: var(--text-secondary); margin: 0;">Моя мечта</h4>
                </div>
                <div id="topDreamNameDisplay" style="font-size: 22px; font-weight: 900; font-family: 'Fraunces', serif; color: #b8873b;"><?php echo e($stats['dream_name']); ?></div>
                <div id="topDreamPriceDisplay" style="font-size: 15px; font-weight: 600; color: var(--text-muted); margin-bottom: 8px;"><?php echo e(number_format($stats['dream_price'] ?? 0, 0, '', ' ')); ?> ₽</div>
                <div style="width: 100%; height: 12px; background: var(--border); border-radius: 60px; overflow: hidden;">
                    <div id="topDreamFill" style="width: <?php echo e($stats['dream_progress'] ?? 0); ?>%; height: 100%; background: var(--gradient-gold); border-radius: 60px; transition: width 1s ease;"></div>
                </div>
                <div style="font-size: 14px; font-weight: 700; color: var(--text-muted); margin-top: 6px; text-align: right;">
                    <span id="topDreamPercent"><?php echo e($stats['dream_progress'] ?? 0); ?></span>% от цели
                </div>
            </div>
        <?php endif; ?>
    </div>

    <!-- ===== СКРЫТЫЙ ШАБЛОН ДЛЯ JS (Чтобы создавать карточку на лету) ===== -->
    <template id="dreamCardTemplate">
        <div class="dream-card" id="topDreamCard" style="margin-bottom: 24px; padding: 20px 24px; background: var(--bg-input); border-radius: var(--radius-sm); border: 2px solid var(--border);">
            <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 6px;">
                <span style="font-size: 24px;">🎯</span>
                <h4 style="font-size: 17px; font-weight: 800; font-family: 'Fraunces', serif; color: var(--text-secondary); margin: 0;">Моя мечта</h4>
            </div>
            <div id="topDreamNameDisplay" style="font-size: 22px; font-weight: 900; font-family: 'Fraunces', serif; color: #b8873b;"></div>
            <div id="topDreamPriceDisplay" style="font-size: 15px; font-weight: 600; color: var(--text-muted); margin-bottom: 8px;"></div>
            <div style="width: 100%; height: 12px; background: var(--border); border-radius: 60px; overflow: hidden;">
                <div id="topDreamFill" style="width: 0%; height: 100%; background: var(--gradient-gold); border-radius: 60px; transition: width 1s ease;"></div>
            </div>
            <div style="font-size: 14px; font-weight: 700; color: var(--text-muted); margin-top: 6px; text-align: right;">
                <span id="topDreamPercent">0</span>% от цели
            </div>
        </div>
    </template>

    <!-- ===== КАЛЬКУЛЯТОР ===== -->
    <div class="calc-grid">
        <div class="input-group">
            <label for="cost">💰 Сколько тратишь за раз?</label>
            <input type="number" id="cost" placeholder="Например, 150" value="0" min="0" step="1" />
        </div>
        <div class="input-group">
            <label for="frequency">📅 Как часто?</label>
            <select id="frequency">
                <option value="365">Каждый день</option>
                <option value="260" selected>По будням (5/7)</option>
                <option value="104">По выходным</option>
                <option value="52">Раз в неделю</option>
                <option value="12">Раз в месяц</option>
            </select>
        </div>
    </div>

    <div class="calc-actions">
        <button class="btn-primary" id="calcBtn">💰 Копи-Копи!</button>
        <button class="btn-secondary" id="resetBtn">🔄 Сброс</button>
    </div>

    <!-- ===== РЕЗУЛЬТАТ ===== -->
    <div class="result-box" id="resultBox">
        <div class="glow-text">✨ Ты можешь накопить ✨</div>
        <div class="result-row">
            <span class="result-label">💰 За год</span>
            <span class="result-number" id="resultAmount">0 <span>₽</span></span>
        </div>

        <?php echo $__env->make('partials.piggy', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="dream-section">
            <h4>🎯 Моя мечта</h4>
            <div class="dream-inputs">
                <input type="text" id="dreamName" placeholder="Что хочешь купить?" value="<?php echo e(auth()->check() ? auth()->user()->dream_name : ''); ?>" />
                <input type="number" id="dreamPrice" placeholder="Сколько стоит? (₽)" value="<?php echo e(auth()->check() && auth()->user()->dream_price > 0 ? (float) auth()->user()->dream_price : ''); ?>" />
                <button class="btn-success" id="setDreamBtn">🎯 Установить</button>
            </div>
            <div class="dream-progress" id="dreamProgress">
                Прогресс к мечте: <span id="dreamPercent">0%</span>
            </div>
        </div>
    </div>

    <!-- ===== ДОЛГОСРОЧНЫЙ ПРОГНОЗ ===== -->
    <div class="long-term" id="longTerm">
        <div class="term-card">
            <div class="label">📆 2 года</div>
            <div class="value" id="year2">0 ₽</div>
        </div>
        <div class="term-card">
            <div class="label">📆 5 лет</div>
            <div class="value" id="year5">0 ₽</div>
        </div>
        <div class="term-card">
            <div class="label">📆 10 лет</div>
            <div class="value" id="year10">0 ₽</div>
        </div>
    </div>

    <div class="inflation-box">
        <div class="label">📉 Реальная стоимость через год (с учётом инфляции 9%)</div>
        <div class="value" id="inflationValue">0 ₽</div>
    </div>

    <div class="chart-wrap">
        <h4>📈 Как растут твои копилки</h4>
        <canvas id="savingsChart"></canvas>
    </div>

    <!-- ===== ПОСЛЕДНИЕ РАСЧЁТЫ ===== -->
    <?php if(isset($recentHistory) && $recentHistory->count() > 0): ?>
        <div class="section-title mt-20">
            <h3>📜 Последние расчёты</h3>
        </div>
        <div class="history-list-mini">
            <?php $__currentLoopData = $recentHistory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="history-item-mini" style="display: flex; justify-content: space-between; padding: 10px 16px; background: var(--bg-input); border-radius: var(--radius-sm); border: 2px solid var(--border); margin-bottom: 6px;">
                    <span style="color: var(--text-muted); font-size: 13px;"><?php echo e($item->created_at->format('d.m.Y H:i')); ?></span>
                    <span><?php echo e($item->cost); ?> ₽ × <?php echo e($item->days); ?> дней</span>
                    <span style="font-weight: 800; color: #b8873b;"><?php echo e(number_format($item->total, 0, '', ' ')); ?> ₽</span>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>

    <?php if(isset($tips) && $tips->count() > 0): ?>
        <div class="section-title mt-20">
            <h3>💡 Полезные советы</h3>
        </div>
        <div class="tips-mini" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 12px;">
            <?php $__currentLoopData = $tips; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tip): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div style="background: var(--bg-input); border: 2px solid var(--border); border-radius: var(--radius-sm); padding: 14px 18px; transition: var(--transition);">
                    <span style="font-size: 24px;"><?php echo e($tip->icon); ?></span>
                    <div style="font-weight: 700; font-family: 'Fraunces', serif; color: var(--text-primary); margin-top: 4px;"><?php echo e($tip->title); ?></div>
                    <p style="font-size: 13px; color: var(--text-muted); font-weight: 600; margin-top: 2px;"><?php echo e($tip->description); ?></p>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OSPanel\domains\copicop1\resources\views/dashboard/calculator.blade.php ENDPATH**/ ?>