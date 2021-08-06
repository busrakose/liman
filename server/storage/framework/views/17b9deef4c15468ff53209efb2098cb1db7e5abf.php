<div class="card">
    <div class="card-header">
        <h3 class="card-title"><?php echo e(__("Eklenti Ayarları")); ?></h3>
    </div>
    <form action="<?php echo e(route('extension_server_settings',[
            "extension_id" => request()->route('extension_id'),
            "server_id" => request()->route('server_id')
        ])); ?>" method="POST">
    <?php echo csrf_field(); ?>
        <div class="card-body">
            <?php if(!empty($errors) && count($errors)): ?>
                <div class="alert alert-danger" role="alert">
                <?php echo $errors->getBag('default')->first('message'); ?>

                </div>
            <?php elseif(count($similar)): ?>
                <div class="alert alert-info" role="alert">
                    <?php echo e(__("Önceki ayarlarınızdan sizin için birkaç veri eklendi.")); ?>

                </div>
            <?php endif; ?>
            <?php if($extension["database"]): ?>
                <?php $__currentLoopData = $extension["database"]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($item["variable"] == "certificate"): ?>
                            <div class="form-group">
                                <label><?php echo e($item["name"]); ?></label>
                                <textarea name="certificate" cols="30" rows="10" class="form-control" <?php if(!isset($item["required"]) || $item["required"] === true): ?> required <?php endif; ?>></textarea><br>
                            </div>                    
                        <?php elseif($item["type"] == "extension"): ?>
                            <div class="form-group">
                                <label><?php echo e($item["name"]); ?></label>
                                <select class="form-control" name="<?php echo e($item["variable"]); ?>" <?php if(!isset($item["required"]) || $item["required"] === true): ?> required <?php endif; ?>>
                                    <option><?php echo e($item["name"]); ?></option>
                                    <?php $__currentLoopData = extensions(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $extension): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($extension->id); ?>" <?php if($extension->id == old($item["variable"], extensionDb($item["variable"]))): ?> selected <?php endif; ?> ><?php echo e($extension->display_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        <?php elseif($item["type"] == "server"): ?>
                            <div class="form-group">
                                <label><?php echo e($item["name"]); ?></label>
                                <select class="form-control" name="<?php echo e($item["variable"]); ?>" <?php if(!isset($item["required"]) || $item["required"] === true): ?> required <?php endif; ?>>
                                    <option><?php echo e($item["name"]); ?></option>
                                    <?php $__currentLoopData = servers(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $server): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($server->id); ?>" <?php if($server->id == old($item["variable"], extensionDb($item["variable"]))): ?> selected <?php endif; ?>><?php echo e($server->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        <?php else: ?>
                            <div class="form-group">
                                <label><?php echo e(__($item["name"])); ?></label>
                                <input <?php if(!isset($item["required"]) || $item["required"] === true): ?> required <?php endif; ?> class="form-control" type="<?php echo e($item["type"]); ?>"
                                    name="<?php echo e($item["variable"]); ?>" placeholder="<?php echo e(__($item["name"])); ?>"
                                    <?php if($item["type"] != "password"): ?>
                                        <?php if(extensionDb($item["variable"])): ?>
                                            value="<?php echo e(old($item["variable"], extensionDb($item["variable"]))); ?>"
                                        <?php elseif(array_key_exists($item["variable"],$similar)): ?>
                                            value="<?php echo e(old($item["variable"], $similar[$item["variable"]])); ?>"
                                        <?php endif; ?>
                                    <?php endif; ?>
                                >
                            </div>                    
                            <?php if($item["type"] == "password"): ?>
                            <div class="form-group">
                                <label><?php echo e(__($item["name"])); ?> <?php echo e(__('Tekrar')); ?></label>
                                <input <?php if(!isset($item["required"]) || $item["required"] === true): ?> required <?php endif; ?> class="form-control" type="<?php echo e($item["type"]); ?>"
                                        name="<?php echo e($item["variable"]); ?>_confirmation" placeholder="<?php echo e(__($item["name"])); ?> <?php echo e(__('Tekrar')); ?>"
                                >
                            </div>                    
                            <?php endif; ?>
                        <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <div><?php echo e(__("Bu eklentinin hiçbir ayarı yok.")); ?></div>
            <?php endif; ?>
        </div>
        <?php if($extension["database"]): ?>
        <div class="card-footer">
            <button type="submit" class="btn btn-success"><?php echo e(__("Kaydet")); ?></button>
        </div>
        <?php endif; ?>
    </form>
</div><?php /**PATH /liman/server/resources/views/extension_pages/setup_data.blade.php ENDPATH**/ ?>