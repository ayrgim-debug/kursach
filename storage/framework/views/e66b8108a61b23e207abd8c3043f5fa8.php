

<?php $__env->startSection('title', 'Профиль'); ?>

<?php $__env->startSection('content'); ?>
    <div class="hero">
        <h2>👤 Мой профиль</h2>
        <p>Здесь ты можешь посмотреть свою статистику и настроить профиль! 🐷</p>
    </div>

    <div class="profile-container">
        <!-- ===== АВАТАР И ИМЯ ===== -->
        <div class="profile-header">
            <div class="profile-avatar">
                <?php if(auth()->user()->avatar && file_exists(public_path('uploads/avatars/' . auth()->user()->avatar))): ?>
                    <img src="<?php echo e(asset('uploads/avatars/' . auth()->user()->avatar)); ?>" alt="Аватар" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
                <?php else: ?>
                    <?php echo e(auth()->user()->name[0] ?? 'К'); ?>

                <?php endif; ?>
            </div>
            <div class="profile-name"><?php echo e(auth()->user()->name); ?></div>
            <div class="profile-email"><?php echo e(auth()->user()->email); ?></div>
            <div class="profile-badge">🐷 В Копи-Копилке с <?php echo e($stats['member_since'] ?? 'недавно'); ?></div>

            <!-- ФОРМА РЕДАКТИРОВАНИЯ ПРОФИЛЯ -->
            <details class="profile-edit-details">
                <summary>✏️ Редактировать профиль</summary>
                <form class="profile-edit-form" method="POST" action="<?php echo e(route('profile.update')); ?>" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    
                    <div class="input-group">
                        <label for="name">Новое имя</label>
                        <input type="text" id="name" name="name" value="<?php echo e(auth()->user()->name); ?>" required>
                    </div>
                    
                    <div class="input-group">
                        <label for="avatar">Аватарка (JPG, PNG до 2 МБ)</label>
                        <input type="file" id="avatar" name="avatar" accept="image/*">
                    </div>
                    
                    <button type="submit" class="btn-primary" style="padding: 10px 24px; font-size: 14px; margin-top: 4px;">Сохранить изменения</button>
                </form>
            </details>
        </div>

        <!-- ===== СТАТИСТИКА ===== -->
        <div class="profile-stats">
            <div class="profile-stat-card">
                <div class="profile-stat-icon">📋</div>
                <div class="profile-stat-number"><?php echo e($stats['habits_count'] ?? 0); ?></div>
                <div class="profile-stat-label">Привычек</div>
            </div>
            <div class="profile-stat-card">
                <div class="profile-stat-icon">📜</div>
                <div class="profile-stat-number"><?php echo e($stats['history_count'] ?? 0); ?></div>
                <div class="profile-stat-label">Расчётов</div>
            </div>
            <div class="profile-stat-card">
                <div class="profile-stat-icon">💰</div>
                <div class="profile-stat-number"><?php echo e(number_format($stats['total_savings'] ?? 0, 0, '', ' ')); ?></div>
                <div class="profile-stat-label">Экономия в год (₽)</div>
            </div>
        </div>

        <!-- ===== МЕЧТА ===== -->
        <?php if($stats['has_dream'] ?? false): ?>
            <div class="profile-dream">
                <div class="profile-dream-header">
                    <span class="profile-dream-icon">🎯</span>
                    <h4>Моя мечта</h4>
                </div>
                <div class="profile-dream-name"><?php echo e($stats['dream_name']); ?></div>
                <div class="profile-dream-price"><?php echo e(number_format($stats['dream_price'] ?? 0, 0, '', ' ')); ?> ₽</div>
                <div class="profile-dream-bar">
                    <div class="profile-dream-fill" style="width: <?php echo e($stats['dream_progress'] ?? 0); ?>%;"></div>
                </div>
                <div class="profile-dream-progress">
                    <?php echo e($stats['dream_progress'] ?? 0); ?>% от цели
                </div>
            </div>
        <?php else: ?>
            <div class="profile-dream-empty">
                <p>🐷 У тебя пока нет мечты!</p>
                <p style="font-size:14px; color:var(--text-muted);">Перейди в раздел <strong>«Копилка»</strong> и установи свою мечту!</p>
            </div>
        <?php endif; ?>

        <!-- ===== КНОПКА ВЫХОДА ===== -->
        <div class="profile-actions">
            <form method="POST" action="<?php echo e(route('logout')); ?>">
                <?php echo csrf_field(); ?>
                <button type="submit" class="btn-secondary" style="width:100%; border-color:#b33b2c; color:#b33b2c;">
                    🚪 Выйти из аккаунта
                </button>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
    /* ===== ПРОФИЛЬ ===== */
    .profile-container {
        max-width: 800px;
        margin: 0 auto;
    }

    .profile-header {
        text-align: center;
        padding: 30px 20px 24px;
        background: var(--bg-input);
        border-radius: var(--radius-sm);
        border: 2px solid var(--border);
        margin-bottom: 24px;
        transition: all var(--transition);
    }

    .profile-avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: var(--gradient-main);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 36px;
        font-weight: 900;
        font-family: 'Fraunces', serif;
        margin: 0 auto 12px;
        box-shadow: 0 8px 32px rgba(184, 135, 59, 0.35);
        overflow: hidden;
    }

    .profile-name {
        font-size: 24px;
        font-weight: 900;
        font-family: 'Fraunces', serif;
        color: var(--text-primary);
    }

    .profile-email {
        color: var(--text-muted);
        font-size: 16px;
        font-weight: 600;
        margin-top: 4px;
    }

    .profile-badge {
        display: inline-block;
        margin-top: 10px;
        background: var(--gradient-gold);
        color: #8a611f;
        font-size: 13px;
        font-weight: 700;
        padding: 4px 18px;
        border-radius: 60px;
        font-family: 'Fraunces', serif;
    }

    /* ===== ФОРМА РЕДАКТИРОВАНИЯ (ИСПРАВЛЕНО) ===== */
    .profile-edit-details {
        margin-top: 16px;
        text-align: center; /* Центрируем кнопку */
    }

    .profile-edit-details summary {
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--text-secondary);
        background: var(--bg-card);
        font-weight: 700;
        font-size: 14px;
        font-family: 'Fraunces', serif;
        padding: 8px 20px;
        border: 1px solid var(--border);
        border-radius: 60px; /* Делаем форму пилюлей */
        transition: var(--transition);
        list-style: none; /* Убираем стандартный треугольник */
    }

    /* Убираем стандартный треугольник в Chrome/Safari */
    .profile-edit-details summary::-webkit-details-marker {
        display: none;
    }

    .profile-edit-details summary:hover {
        border-color: var(--bronze);
        color: var(--bronze-dark);
        background: var(--bg-input);
    }

    .profile-edit-details[open] summary {
        margin-bottom: 16px;
        border-color: var(--bronze);
        color: var(--bronze-dark);
        background: var(--bg-input);
    }

    [data-theme="dark"] .profile-edit-details summary:hover,
    [data-theme="dark"] .profile-edit-details[open] summary {
        color: var(--bronze-light);
    }

    /* Сама форма, которая выезжает */
    .profile-edit-form {
        max-width: 400px;
        margin: 0 auto;
        padding: 20px;
        background: var(--bg-card);
        border-radius: var(--radius);
        border: 1px solid var(--border);
        display: flex;
        flex-direction: column;
        gap: 14px;
        text-align: left; /* Текст в форме выравниваем по левому краю */
        box-shadow: var(--shadow-sm);
    }
    
    .profile-edit-form .input-group input[type="file"] {
        font-size: 14px;
        border: none;
        padding: 8px 0;
        background: transparent;
        color: var(--text-secondary);
    }

    /* ===== СТАТИСТИКА ===== */
    .profile-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 16px;
        margin-bottom: 24px;
    }

    .profile-stat-card {
        background: var(--bg-input);
        border: 2px solid var(--border);
        border-radius: var(--radius-sm);
        padding: 20px 16px;
        text-align: center;
        transition: all var(--transition);
    }

    .profile-stat-card:hover {
        transform: translateY(-4px);
        border-color: #b8873b;
        box-shadow: var(--shadow-sm);
    }

    .profile-stat-icon {
        font-size: 28px;
        margin-bottom: 4px;
    }

    .profile-stat-number {
        font-size: 28px;
        font-weight: 900;
        color: #b8873b;
        font-family: 'Fraunces', serif;
    }

    .profile-stat-label {
        font-size: 13px;
        font-weight: 600;
        color: var(--text-muted);
        font-family: 'Fraunces', serif;
        margin-top: 2px;
    }

    /* ===== МЕЧТА ===== */
    .profile-dream {
        background: var(--bg-input);
        border: 2px solid #b8873b;
        border-radius: var(--radius-sm);
        padding: 24px 28px;
        margin-bottom: 24px;
        transition: all var(--transition);
    }

    .profile-dream:hover {
        border-color: #b8873b;
        box-shadow: 0 0 30px rgba(184, 135, 59, 0.12);
    }

    .profile-dream-header {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 8px;
    }

    .profile-dream-icon {
        font-size: 24px;
    }

    .profile-dream-header h4 {
        font-size: 17px;
        font-weight: 800;
        font-family: 'Fraunces', serif;
        color: var(--text-secondary);
        margin: 0;
    }

    .profile-dream-name {
        font-size: 22px;
        font-weight: 900;
        font-family: 'Fraunces', serif;
        color: #b8873b;
        margin-bottom: 2px;
    }

    .profile-dream-price {
        font-size: 16px;
        font-weight: 700;
        color: var(--text-muted);
        margin-bottom: 12px;
    }

    .profile-dream-bar {
        width: 100%;
        height: 18px;
        background: var(--border);
        border-radius: 60px;
        overflow: hidden;
        transition: background var(--transition);
    }

    .profile-dream-fill {
        height: 100%;
        background: var(--gradient-gold);
        border-radius: 60px;
        transition: width 1.2s cubic-bezier(0.34, 1.56, 0.64, 1);
        box-shadow: 0 0 20px rgba(184, 135, 59, 0.35);
    }

    .profile-dream-progress {
        font-size: 14px;
        font-weight: 700;
        color: var(--text-muted);
        margin-top: 8px;
        font-family: 'Fraunces', serif;
        text-align: right;
    }

    .profile-dream-empty {
        background: var(--bg-input);
        border: 2px dashed var(--border);
        border-radius: var(--radius-sm);
        padding: 30px 20px;
        text-align: center;
        margin-bottom: 24px;
        transition: all var(--transition);
    }

    .profile-dream-empty p {
        font-size: 16px;
        font-weight: 600;
        color: var(--text-secondary);
        font-family: 'Fraunces', serif;
    }

    /* ===== КНОПКА ВЫХОДА ===== */
    .profile-actions {
        margin-top: 8px;
    }

    .profile-actions .btn-secondary {
        padding: 14px;
        font-size: 16px;
        font-weight: 700;
        font-family: 'Fraunces', serif;
        border-color: #b33b2c;
        color: #b33b2c;
        background: transparent;
        transition: all var(--transition);
        cursor: pointer;
    }

    .profile-actions .btn-secondary:hover {
        background: #b33b2c;
        color: white;
        transform: scale(1.02);
    }

    /* ===== АДАПТИВ ===== */
    @media (max-width: 600px) {
        .profile-stats {
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .profile-dream {
            padding: 18px 16px;
        }

        .profile-dream-name {
            font-size: 18px;
        }

        .profile-stat-number {
            font-size: 22px;
        }
    }

    @media (max-width: 400px) {
        .profile-stats {
            grid-template-columns: 1fr;
        }
    }
</style>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OSPanel\domains\copicop1\resources\views/dashboard/profile.blade.php ENDPATH**/ ?>