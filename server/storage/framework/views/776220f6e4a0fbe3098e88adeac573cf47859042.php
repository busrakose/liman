<?php ($random = str_random(20)); ?>
<div class="modal fade" id="<?php if(isset($id)): ?><?php echo e($id); ?><?php endif; ?>">
    <div class="modal-dialog modal-dialog-centered <?php if(!isset($notSized) || !$notSized): ?> modal-xl <?php endif; ?> <?php echo e(isset($modalDialogClasses) ? $modalDialogClasses : ''); ?>">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">
                <?php if(isset($title)): ?>
                    <?php echo e(__($title)); ?>

                <?php endif; ?>
            </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <?php echo e($slot); ?>

        </div>
        <?php if(isset($footer)): ?>
        <div class="modal-footer justify-content-right">
            <button class="btn <?php echo e($footer["class"]); ?>" onclick="<?php echo e($footer["onclick"]); ?>"><?php echo e(__($footer["text"])); ?></button>
        </div>
        <?php endif; ?>
        </div>
    </div>
</div><?php /**PATH /liman/server/resources/views/components/modal-component.blade.php ENDPATH**/ ?>