<div class="input-group" style="max-width: 220px;z-index: 1;">
    <span class="input-group-btn">
        <button <?php if($current != 1): ?> onclick="<?php echo e($onclick . '(' . ($current - 1 ). ')'); ?>" <?php else: ?> disabled <?php endif; ?> class="btn btn-default" type="button"><?php echo e(__("Önceki")); ?></button>
    </span>
    <select onchange="<?php echo e($onclick . '(this.value)'); ?>" class="form-control">
        <?php for($i = 1 ; $i <= intval($count); $i++): ?>
            <option value="<?php echo e($i); ?>"<?php if($i == $current): ?> selected <?php endif; ?>"><?php echo e($i); ?></option>
        <?php endfor; ?>
    </select>
    <span class="input-group-btn">
        <button <?php if($current != $count): ?> onclick="<?php echo e($onclick . '(' . ($current + 1 ). ')'); ?>" <?php else: ?> disabled <?php endif; ?> class="btn btn-default" type="button"><?php echo e(__("Sonraki")); ?></button>
    </span>
</div><?php /**PATH /liman/server/resources/views/components/pagination.blade.php ENDPATH**/ ?>