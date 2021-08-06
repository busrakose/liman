<?php
$notification = \App\Models\AdminNotification::where(
    'id',
    request('notification_id')
)->first();
if (!$notification) {
    header("Location: /", true);
    exit();
}
switch ($notification->type) {
    case "cert_request":
        list($hostname, $port, $server_id) = explode(
            ":",
            $notification->message
        );
        $url =
            route('certificate_add_page') .
            "?notification_id=$notification->id&hostname=$hostname&port=$port&server_id=$server_id";
        header("Location: $url", true);
        exit();
        break;
    case "liman_update":
        $url = route('settings') . "#limanMarket";
        $notification->update([
            "read" => "true",
        ]);
        header("Location: $url", true);
        exit();
        break;
    case "health_problem":
        $url = route('settings') . "#health";
        $notification->update([
            "read" => "true",
        ]);
        header("Location: $url", true);
        exit();
        break;
    case "new_module":
        $url = route('modules_index');
        $notification->update([
            "read" => "true",
        ]);
        header("Location: $url", true);
        exit();
        break;
    case "extension_update":
        $url = route('settings') . "#extensions";
        $notification->update([
            "read" => "true",
        ]);
        header("Location: $url", true);
        exit();
        break;
    case "auth_request":
        $url = route("request_list");
        $notification->update([
            "read" => "true"
        ]);
        header("Location: $url", true);
        exit();
        break;
    default:
        break;
}
?>



<?php $__env->startSection('content'); ?>
    <div class="row pt-3">
        <div class="col-md-12">
            <?php echo $__env->make('errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="timeline">
                <div class="time-label">
                    <span class="bg-green">
                        <?php echo e(\Carbon\Carbon::parse($notification->created_at)->format("d.m.Y")); ?>

                    </span>
                </div>
                <div>
                    <div class="timeline-item">
                        <span class="time"><i class="fas fa-clock"></i> <?php echo e(\Carbon\Carbon::parse($notification->created_at)->format("h:i:s")); ?></span>

                        <h3 class="timeline-header">
                            <?php if(!$notification->read): ?><a href="javascript:void(0)"><?php endif; ?>
                                <?php echo e($notification->title); ?>

                                <?php if(!$notification->read): ?></a><?php endif; ?>
                        </h3>

                        <div class="timeline-body">
                            <?php echo $notification->message; ?>

                        </div>
                        <div class="timeline-footer">
                            <?php if(!$notification->read): ?>
                                <a class="btn btn-primary btn-xs mark_read"
                                notification-id="<?php echo e($notification->id); ?>"><?php echo e(__('Okundu Olarak İşaretle')); ?></a>
                            <?php endif; ?>
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /liman/server/resources/views/notification/system.blade.php ENDPATH**/ ?>