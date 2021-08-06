<div class="modal fade" id="<?php if(isset($id)): ?><?php echo e($id); ?><?php endif; ?>">
    <div class="modal-dialog modal-dialog-centered modal-xl">
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
            <div class="modal-body" style="width:100%; height:auto;padding:10px;">
                <?php echo $__env->make('table',$table, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            <?php if(isset($footer)): ?>
            <div class="modal-footer justify-content-right">
                <button class="btn <?php echo e($footer["class"]); ?>" onclick="<?php echo e($footer["onclick"]); ?>"><?php echo e($footer["text"]); ?></button>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div><?php /**PATH /liman/server/resources/views/components/modal-table.blade.php ENDPATH**/ ?>