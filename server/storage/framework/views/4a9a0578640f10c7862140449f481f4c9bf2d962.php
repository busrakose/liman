<a class="nav-link" data-toggle="dropdown" href="#">
    <?php if(!isset($systemNotification)): ?>
        <i class="far fa-bell"></i>
    <?php else: ?>
        <i class="fas fa-cogs"></i>
    <?php endif; ?>
    <span class="badge badge-warning navbar-badge" id="<?php echo e(isset($systemNotification) ? 'adminNotificationsCount' : 'userNotificationsCount'); ?>"><?php echo e($notifications->count()); ?></span>
</a>
<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
    <span class="dropdown-item dropdown-header" onclick="<?php if(!isset($systemNotification)): ?> readNotifications() <?php else: ?> readSystemNotifications() <?php endif; ?>">
        <?php echo e(__('Tümünü Okundu Olarak İşaretle')); ?>

    </span>
    <div class="menu" style="max-height: 245px; overflow: scroll; overflow-x: hidden; overflow-y: auto;">
        <?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="dropdown-divider"></div>
            <?php switch($notification->type):
                case ('error'): ?>
                <?php case ('health_problem'): ?>
                <?php case ('liman_update'): ?>
                <a onclick="window.location.href = '/bildirim/<?php echo e($notification->id); ?>'" href="/bildirim/<?php echo e($notification->id); ?>" class="dropdown-item" style="color: #f56954;width: 100%">
                    <?php echo e($notification->title); ?>

                </a>
                <?php break; ?>
                <?php default: ?>
                <a onclick="window.location.href = '/bildirim/<?php echo e($notification->id); ?>'" href="/bildirim/<?php echo e($notification->id); ?>" class="dropdown-item" style="color: #00a65a;width: 100%">
                    <?php echo e($notification->title); ?>

                </a>
                <?php break; ?>
            <?php endswitch; ?>
        </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item dropdown-footer" href="<?php echo e(isset($systemNotification) ? route('all_system_notifications') : route('all_user_notifications')); ?>"><?php echo e(__('Tümünü gör')); ?></a>
</div><?php /**PATH /liman/server/resources/views/components/notifications.blade.php ENDPATH**/ ?>