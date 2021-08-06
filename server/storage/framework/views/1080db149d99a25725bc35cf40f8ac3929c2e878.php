<?php ($id = isset($id) ? $id : bin2hex(random_bytes(10))); ?>
<div class="modal fade" id="<?php echo e($id); ?>">
    <div class="modal-dialog modal-dialog-centered <?php if(!isset($notSized) || !$notSized): ?> modal-xl <?php endif; ?> <?php echo e(isset($modalDialogClasses) ? $modalDialogClasses : ''); ?>">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    <?php if(isset($title)): ?>
                        <?php echo e(__($title)); ?>

                    <?php endif; ?>                    
                </h4>
                <button type="button" class="close" aria-label="Close" onclick="closeCurrentModal('<?php echo e($id); ?>')">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php if(isset($onsubmit)): ?>
                <form id="<?php echo e($id); ?>_form" onsubmit="return <?php echo e($onsubmit); ?>(this)" target="#">
            <?php else: ?>
                <form id="<?php echo e($id); ?>_form" onsubmit="return <?php if(isset($url)): ?>request('<?php echo e($url); ?>',this,<?php if(isset($next)): ?><?php echo e($next); ?><?php endif; ?>,<?php if(isset($error)): ?><?php echo e($error); ?><?php endif; ?>)"<?php endif; ?> target="#">
            <?php endif; ?>
                <div class="modal-body">
                    <div id="<?php echo e($id); ?>_alert" class="alert" role="alert" hidden></div>
                    <?php if(isset($selects) && is_array($selects)): ?>
                        <div class="form-group">
                            <label><?php echo e(__("Tipi")); ?></label>
                            <select class="form-control" required onchange="cs_<?php echo e($id); ?>(this.value)">
                                <?php $__currentLoopData = $selects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $select): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e(explode(":",$key)[1]); ?>"><?php echo e(__(explode(":",$key)[0])); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <?php $__currentLoopData = $selects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $select): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo $__env->make('inputs',[
                                    "inputs" => $select,
                                    "disabled" => "true",
                                    "id" => explode(":",$key)[1],
                                    "random" => $id
                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                    <?php if(isset($inputs)): ?>
                        <?php echo $__env->make('inputs',$inputs, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endif; ?>
                    <?php if(isset($text)): ?>
                        <?php echo e(__($text)); ?>

                    <?php endif; ?>
                    <?php if(isset($output)): ?>
                        <pre>
                            <textarea class="form-control" id="<?php echo e($output); ?>" hidden readonly rows="10"></textarea>
                        </pre>
                        <br>
                    <?php endif; ?>
                </div>
                <?php if(isset($submit_text)): ?>
                <div class="modal-footer justify-content-right">
                    <?php if(isset($noEnter)): ?>
                        <button type="button" class="btn btn-success"><?php if(isset($submit_text)): ?><?php echo e(__($submit_text)); ?><?php endif; ?></button>
                    <?php else: ?>
                        <button type="submit" class="btn btn-success"><?php if(isset($submit_text)): ?><?php echo e(__($submit_text)); ?><?php endif; ?></button>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </form>
        </div>
    </div>
</div>
<?php if(isset($selects)): ?>
    <script type="text/javascript">
        function cs_<?php echo e($id); ?>(target){
            Array.prototype.forEach.call(document.getElementsByClassName('<?php echo e($id); ?>'),function(element){
                element.setAttribute('hidden',"true");
                element.setAttribute('disabled',"true");
            });
            Array.prototype.forEach.call(document.getElementsByClassName(target),function(element){
                element.removeAttribute('hidden');
                element.removeAttribute('disabled');
            });
        }
        cs_<?php echo e($id); ?>('<?php echo e(explode(':',key($selects))[1]); ?>')
    </script>
<?php endif; ?><?php /**PATH /liman/server/resources/views/components/modal.blade.php ENDPATH**/ ?>