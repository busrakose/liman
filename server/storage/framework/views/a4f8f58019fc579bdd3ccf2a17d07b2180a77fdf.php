<?php
$item = \App\Models\Notification::where([
    "user_id" => auth()->id(),
    "id" => request('notification_id'),
])->first();
if (!$item) {
    if (
        auth()
            ->user()
            ->isAdmin() &&
        \App\Models\AdminNotification::find(
            request('notification_id')
        )->exists()
    ) {
        header(
            "Location: " .
                route('system_notification', [
                    "notification_id" => request('notification_id'),
                ]),
            true
        );
        exit();
    } else {
        return redirect()->back();
    }
}
?>


<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <?php echo $__env->make('errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="timeline">
                <div class="time-label">
                    <span class="bg-green">
                        <?php echo e(\Carbon\Carbon::parse($item->created_at)->format("d.m.Y")); ?>

                    </span>
                </div>
                <div>
                    <?php if($item->read): ?>
                        <i class="far fa-bell <?php if($item->type=="error"): ?> bg-red <?php else: ?> bg-blue <?php endif; ?>"></i>
                    <?php else: ?>
                        <i class="fas fa-bell <?php if($item->type=="error"): ?> bg-red <?php else: ?> bg-blue <?php endif; ?>"></i>
                    <?php endif; ?>
                    <div class="timeline-item">
                        <span class="time"><i class="fa fa-clock-o"></i> <?php echo e(\Carbon\Carbon::parse($item->created_at)->format("h:i:s")); ?></span>
        
                        <h3 class="timeline-header">
                            <?php if(!$item->read): ?><a href="javascript:void(0)"><?php endif; ?>
                                <?php echo e($item->title); ?>

                                <?php if(!$item->read): ?></a><?php endif; ?>
                        </h3>
        
                        <div class="timeline-body">
                            <?php echo $item->message; ?>

                        </div>
                        <div class="timeline-footer">
                            <?php if(!$item->read): ?>
                                <a class="btn btn-primary btn-xs mark_read"
                                    notification-id="<?php echo e($item->id); ?>"><?php echo e(__('Okundu Olarak İşaretle')); ?></a>
                            <?php endif; ?>
                            <a class="btn btn-danger btn-xs delete_not" notification-id="<?php echo e($item->id); ?>"><?php echo e(__('Sil')); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('.mark_read').click(function () {
            var data = new FormData();
            data.append('notification_id', $(this).attr('notification-id'));
            request('<?php echo e(route('notification_read')); ?>', data, function (response) {
                location.reload();
            }, function(response){
                var error = JSON.parse(response);
                showSwal(error.message,'error',2000);
            });
        });
        $('.delete_not').click(function () {
            var data = new FormData();
            data.append('notification_id', $(this).attr('notification-id'));
            request('<?php echo e(route('notification_delete')); ?>', data, function (response) {
                window.location.href = "<?php echo e(route('all_user_notifications')); ?>";
            }, function(response){
                var error = JSON.parse(response);
                showSwal(error.message,'error',2000);
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /liman/server/resources/views/notification/one.blade.php ENDPATH**/ ?>