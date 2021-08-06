<?php $__currentLoopData = $inputs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name => $input): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="form-group">
    <?php if(is_array($input)): ?>
        <?php if(isset($disabled)): ?>
            <select name="<?php echo e(explode(":",$name)[1]); ?>" class="form-control" required disabled hidden>
                <?php $__currentLoopData = $input; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($value); ?>"><?php echo e(__($key)); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        <?php else: ?>
            <label><?php echo e(__(explode(":",$name)[0])); ?></label>
            <select name="<?php echo e(explode(":",$name)[1]); ?>" class="form-control" required>
                <?php $__currentLoopData = $input; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($value); ?>"><?php echo e(__($key)); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        <?php endif; ?>
        <?php if(isset(explode(":", $name,3)[2])): ?>
        <small class="form-text text-muted"><?php echo e(__(explode(":", $name,3)[2])); ?></small>
        <?php endif; ?>
    <?php else: ?>
        <?php
            $placeholder = isset(explode(":", $input,3)[2]) ? explode(":", $input,3)[2] : "";
        ?>
        <?php if(explode(":", $input)[1] == "hidden"): ?>
            <?php if(explode(":", $input)[1] == "checkbox"): ?>
                <div class="form-check">
                    <input id="<?php echo e(explode(":", $input)[0]); ?>" class="form-check-input <?php if(isset($random,$id)): ?><?php echo e($random); ?> <?php echo e($id); ?><?php endif; ?>" type="checkbox" name="<?php echo e(explode(":", $input)[0]); ?>">
                    <label for="<?php echo e(explode(":", $input)[0]); ?>" class="form-check-label <?php if(isset($random,$id)): ?><?php echo e($random); ?> <?php echo e($id); ?><?php endif; ?>"><?php echo e(__($name)); ?></label>
                </div>
            <?php else: ?>
                <input type="<?php echo e(explode(":", $input)[1]); ?>" name="<?php echo e(explode(":", $input)[0]); ?>" placeholder="<?php echo e(__($placeholder)); ?>"
                    class="form-control <?php if(isset($random,$id)): ?><?php echo e($random); ?> <?php echo e($id); ?><?php endif; ?>" required value="<?php echo e(explode(":",$name)[1]); ?>"><?php if(explode(":", $input)[1] != "hidden"): ?><?php endif; ?>
            <?php endif; ?>
        <?php elseif(isset($disabled)): ?>
            <?php if(explode(":", $input)[1] == "checkbox"): ?>
                <div class="form-check">
                    <input id="<?php echo e(explode(":", $input)[0]); ?>" class="form-check-input <?php if(isset($random,$id)): ?><?php echo e($random); ?> <?php echo e($id); ?><?php endif; ?>" type="checkbox" name="<?php echo e(explode(":", $input)[0]); ?>">
                    <label for="<?php echo e(explode(":", $input)[0]); ?>" class="form-check-label <?php if(isset($random,$id)): ?><?php echo e($random); ?> <?php echo e($id); ?><?php endif; ?>"><?php echo e(__($name)); ?></label>
                </div>
            <?php else: ?>
                <label class="<?php if(isset($random,$id)): ?><?php echo e($random); ?> <?php echo e($id); ?><?php endif; ?>"><?php echo e(__(explode(":",$name)[0])); ?></label>
                <input type="<?php echo e(explode(":", $input)[1]); ?>" name="<?php echo e(explode(":", $input)[0]); ?>" placeholder="<?php echo e(__($placeholder)); ?>"
                    class="form-control <?php if(isset($random,$id)): ?><?php echo e($random); ?> <?php echo e($id); ?><?php endif; ?>" required disabled hidden>
            <?php endif; ?>
        <?php elseif(explode(":", $input)[1] == "textarea"): ?>
            <?php if(count($inputs)): ?>
                <textarea name="<?php echo e(explode(":", $input)[0]); ?>"
                        class="form-control" required style="height: 60%"></textarea>
            <?php else: ?>
                <textarea name="<?php echo e(explode(":", $input)[0]); ?>"
                        class="form-control" required></textarea>
            <?php endif; ?>
        <?php elseif(explode(":", $input)[1] == "file"): ?>
            <div class="custom-file">
                <input name="<?php echo e(explode(":", $input)[0]); ?>" type="file" class="custom-file-input <?php if(isset($random,$id)): ?><?php echo e($random); ?> <?php echo e($id); ?><?php endif; ?>">
                <label class="custom-file-label"><?php echo e(__($name)); ?></label>
            </div>
            <style>
                .custom-file-label::after{
                    content: "<?php echo e(__('Gözat')); ?>"
                }
            </style>
        <?php else: ?>
            <?php if(explode(":", $input)[1] == "checkbox"): ?>
                <div class="form-check">
                    <input id="<?php echo e(explode(":", $input)[0]); ?>" class="form-check-input <?php if(isset($random,$id)): ?><?php echo e($random); ?> <?php echo e($id); ?><?php endif; ?>" type="checkbox" name="<?php echo e(explode(":", $input)[0]); ?>">
                    <label for="<?php echo e(explode(":", $input)[0]); ?>" class="form-check-label <?php if(isset($random,$id)): ?><?php echo e($random); ?> <?php echo e($id); ?><?php endif; ?>"><?php echo e(__($name)); ?></label>
                </div>
            <?php else: ?>
                <?php if(substr(explode(":", $input)[0],0,2) != "d-"): ?>
                    <label><?php echo e(__($name)); ?></label>
                    <input type="<?php echo e(explode(":", $input)[1]); ?>" name="<?php echo e(explode(":", $input)[0]); ?>" placeholder="<?php echo e(__($placeholder)); ?>"
                        class="form-control <?php if(isset($random,$id)): ?><?php echo e($random); ?> <?php echo e($id); ?><?php endif; ?>" required><?php if(explode(":", $input)[1] != "hidden"): ?><?php endif; ?>
                <?php else: ?>
                    <label><?php echo e(__($name)); ?></label>
                    <input type="<?php echo e(explode(":", $input)[1]); ?>" name="<?php echo e(substr(explode(":", $input)[0],2)); ?>" placeholder="<?php echo e(__($placeholder)); ?>"
                        class="form-control <?php if(isset($random,$id)): ?><?php echo e($random); ?> <?php echo e($id); ?><?php endif; ?>"><?php if(explode(":", $input)[1] != "hidden"): ?><?php endif; ?>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>
        <?php if(isset(explode(":", $input,3)[2])): ?>
        <small class="form-text text-muted"><?php echo e(__(explode(":", $input,3)[2])); ?></small>
        <?php endif; ?>
    <?php endif; ?>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH /liman/server/resources/views/components/inputs.blade.php ENDPATH**/ ?>