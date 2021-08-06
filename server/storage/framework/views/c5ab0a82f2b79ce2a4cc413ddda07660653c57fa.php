<?php
    $random = str_random(20)
?>
<div class="card card-primary table-card" id="card-<?php echo e($random); ?>">
    <div class="card-header" style="background-color: #007bff; color: #fff;">
        <h3 class="card-title"><?php echo e($title); ?></h3>
        <div class="card-tools">
            <button type="button" onclick="func_<?php echo e($random); ?>()" class="btn btn-tool refresh-button"><i class="fas fa-sync-alt"></i></button>
        </div>
    </div>
    <div class="card-body p-0">
        <div id="<?php echo e($random); ?>"></div>
    </div>
    <div class="overlay">
        <div class="spinner-border" role="status">
            <span class="sr-only"><?php echo e(__('Yükleniyor...')); ?></span>
        </div>
    </div>
</div>

<style>
    .table-card table.dataTable{
        margin-top: 0 !important;
        margin-bottom: 0 !important;
    }
</style>

<script>
    function dataTableCustomTablePreset(){
        return Object.assign(
            dataTablePresets('normal'),
            {
                "paging": false,
                "info": false,
                "searching": false
            }
        );
    }
    var var_<?php echo e($random); ?>Timeout;
    function func_<?php echo e($random); ?>(noSpinner = false)
    {
        !noSpinner && $('#card-<?php echo e($random); ?>').find('.overlay').show();
        request("<?php echo e(route($api)); ?>", new FormData(), function(response) {
            $('#<?php echo e($random); ?>').html(response).find('table').DataTable(dataTableCustomTablePreset());
            !noSpinner && $('#card-<?php echo e($random); ?>').find('.overlay').hide();
            var_<?php echo e($random); ?>Timeout && clearTimeout(var_<?php echo e($random); ?>Timeout);
            var_<?php echo e($random); ?>Timeout = setTimeout(function(){
                if($("a[href=\"#usageTab\"]").hasClass("active")){
                    func_<?php echo e($random); ?>(true);
                }
            }, 15000);
        }, function(response){
            let error = JSON.parse(response);
            showSwal(error.message, 'error', 2000);
            var_<?php echo e($random); ?>Timeout && clearTimeout(var_<?php echo e($random); ?>Timeout);
            var_<?php echo e($random); ?>Timeout = setTimeout(function(){
                if($("a[href=\"#usageTab\"]").hasClass("active")){
                    func_<?php echo e($random); ?>(true);
                }
            }, 15000);
        });
    }
</script><?php /**PATH /liman/server/resources/views/components/table-card.blade.php ENDPATH**/ ?>