<?php if(isset($id)): ?>
    <?php ($rand = $id); ?>
<?php else: ?>
    <?php ($rand = str_random(10)); ?>
<?php endif; ?>
<div class="form-group">
    <label><?php echo e(isset($title) ? __($title) : ''); ?></label>
    <div class="input-group" id="<?php echo e($rand); ?>-file-input">
        <input type="text" id="<?php echo e($rand); ?>-selected-file" placeholder="<?php echo e(isset($title) ? __($title) : ''); ?>" class="form-control" readonly>
        <span class="input-group-btn">
            <button type="button" class="btn btn-labeled btn-secondary" id="<?php echo e($rand); ?>-browse" style="border-radius: 0px;"><?php echo e(__('Gözat')); ?></button>
        </span>
        <span class="input-group-btn">
            <button type="button" class=" btn btn-labeled btn-primary" id="<?php echo e($rand); ?>-upload" disabled style="border-radius: 0px;"><?php echo e(__('Yükle')); ?></button>
        </span>
        <input type="file" name="<?php echo e(isset($name) ? $name : ''); ?>" id="<?php echo e($rand); ?>-upload-file" style="display:none;"/>
    </div>

</div>
<div class="progress active" id="<?php echo e($rand); ?>-progress" style="display:none; margin-top: 5px;">
    <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
        <span class="progress-txt"></span>
    </div>
</div>
<script type="text/javascript">
    jQuery(document).ready(function ($) {
        var uploadButton = $('#<?php echo e($rand); ?>-upload'),
        selectedFile = $('#<?php echo e($rand); ?>-selected-file');
        
        $('#<?php echo e($rand); ?>-file-input').on('change', function (e) {
        var name = e.target.value.split('\\').reverse()[0];
    
        if (name) {
            selectedFile.val(name);
            uploadButton.attr('disabled', false);
        } else {
            selectedFile.val('');
            uploadButton.attr('disabled', true);
        }
        });

        $('#<?php echo e($rand); ?>-browse, #<?php echo e($rand); ?>-selected-file').click(function(){
            $('#<?php echo e($rand); ?>-upload-file').click();
        });

    });

    $( "#<?php echo e($rand); ?>-upload" ).click(function() {
        var selectedFile = $('#<?php echo e($rand); ?>-upload-file').prop('files');
        upload({
            file: selectedFile[0],
            onError: function(error){
                showSwal(error,'error');
            },
            onProgress: function(bytesUploaded, bytesTotal){
                var percent = (bytesUploaded/bytesTotal)*100;
                $('#<?php echo e($rand); ?>-progress').show();
                $('#<?php echo e($rand); ?>-progress').addClass('active');
                $('#<?php echo e($rand); ?>-progress').find('.progress-bar').attr('aria-valuenow', percent);
                $('#<?php echo e($rand); ?>-progress').find('.progress-bar').attr('style', 'width: '+percent+'%');
                $('#<?php echo e($rand); ?>-progress').find('.progress-txt').text(Math.round(percent)+"%");
            },
            onSuccess: function(upload){
                <?php if(isset($callback)): ?>
                    <?php echo e($callback); ?>(upload);
                <?php endif; ?>
                $('#<?php echo e($rand); ?>-progress').removeClass('active');
                $('#<?php echo e($rand); ?>-progress').find('.progress-txt').text("<?php echo e(__('Yükleme tamamlandı')); ?>");
            },
        });
    });

</script>
<?php /**PATH /liman/server/resources/views/components/file-input.blade.php ENDPATH**/ ?>