<div class="col-md-3">
    <div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title"><?php echo e(__('Sunucu Bilgileri')); ?></h3>
    </div>
    <div class="card-body">
        <?php if(server()->canRunCommand()): ?>
            <strong><?php echo e(__('Hostname')); ?></strong>
            <p class="text-muted"><?php echo e($outputs["hostname"]); ?></p>
            <hr>
            <strong><?php echo e(__('İşletim Sistemi')); ?></strong>
            <p class="text-muted"><?php echo e($outputs["version"]); ?></p>
            <hr>
        <?php endif; ?>
        <strong><?php echo e(__('IP Adresi')); ?></strong>
        <p class="text-muted">
            <?php echo e($server->ip_address); ?>

        </p>
        <hr>
        <strong><?php echo e(__('Şehir')); ?></strong>
        <p class="text-muted">
            <?php echo e(cities($server->city)); ?>

        </p>
        <hr>
        <strong><?php echo e(__('Eklenti Durumları')); ?></strong>
        <p class="text-muted">
            <?php if($installed_extensions->count() > 0): ?>
                <?php $__currentLoopData = $installed_extensions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $extension): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <span 
                        class="badge btn-secondary status_<?php echo e($extension->id); ?>"
                        style="cursor:pointer; font-size: 14px; margin-bottom: 5px"
                        onclick="window.location.href = '<?php echo e(route('extension_server',["extension_id" => $extension->id, "city" => $server->city, "server_id" => $server->id])); ?>'">
                        <?php echo e($extension->display_name); ?>

                    </span>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <?php echo e(__("Yüklü eklenti yok.")); ?>

            <?php endif; ?>
        </p>
        <?php if(server()->canRunCommand()): ?>
        <hr>
            <strong><?php echo e(__('Açık Kalma')); ?></strong>
            <?php if(!(server()->canRunCommand() && server()->isWindows())): ?>
            <p class="text-muted"><?php echo e(\Carbon\Carbon::parse($outputs["uptime"])->diffForHumans()); ?></p>
            <?php else: ?>
            <p class="text-muted"><?php echo e(\Carbon\Carbon::parse(explode(".", $outputs["uptime"])[0])->diffForHumans()); ?></p>
            <?php endif; ?>
            <hr>
            <strong><?php echo e(__('Servis Sayısı')); ?></strong>
            <p class="text-muted"><?php echo e($outputs["nofservices"]); ?></p>
            <hr>
            <strong><?php echo e(__('İşlem Sayısı')); ?></strong>
            <p class="text-muted"><?php echo e($outputs["nofprocesses"]); ?></p>
        <?php endif; ?>
    </div>
    </div>
</div><?php /**PATH /liman/server/resources/views/server/one/general/details.blade.php ENDPATH**/ ?>