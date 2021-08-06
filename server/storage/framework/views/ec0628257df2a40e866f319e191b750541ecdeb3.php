<?php $__env->startSection('content'); ?>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>"><?php echo e(__("Ana Sayfa")); ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo e(__("Sunucu Takibi")); ?></li>
        </ol>
    </nav>
    
    <div class="row">
            <?php $__currentLoopData = $monitor_servers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $server): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($server->online): ?>
                <div class="col-md-3 monitorServer" id="<?php echo e($server->id); ?>">
                    <div class="info-box bg-success">
                    <span class="info-box-icon"><i class="fa fa-thumbs-up"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text"><?php echo e($server->ip_address . " : " . $server->port); ?></span>
                        <span class="info-box-number"><?php echo e($server->name); ?></span>
                        <span class="progress-description"><?php echo e(__("Son Kontrol : " . $server->last_checked)); ?></span>
                    </div>
                    </div>
                </div>
                <?php else: ?>
                <div class="col-md-3 monitorServer" id="<?php echo e($server->id); ?>">
                    <div class="info-box bg-danger">
                    <span class="info-box-icon"><i class="fa fa-thumbs-down"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text"><?php echo e($server->ip_address . " : " . $server->port); ?></span>
                        <span class="info-box-number"><?php echo e($server->name); ?></span>
                        <span class="progress-description"><?php echo e(__("Son Kontrol : " . $server->last_checked)); ?></span>
                    </div>
                    </div>
                </div>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <?php $__env->startComponent('modal-component',[
                "id" => "addNewMonitor",
                "title" => "Yeni Sunucu Takibi Ekle"
            ]); ?>
            <div class="row">
                <div class="col-md-4">
                    <select name="server_list" id="server_list" class="select2">
                        <?php $__currentLoopData = $servers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $server): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($server->ip_address . ':' . $server->control_port); ?>"><?php echo e($server->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <button class="btn btn-primary" onclick="loadServer()"><?php echo e(__("Seçili sunucudan bilgileri oku")); ?></button>
                </div>
            </div><br>
            <div class="row" id="monitorInputs">
                <div class="col-md-4">
                    <?php echo $__env->make('inputs', [
                        'inputs' => [
                            "İsim" => "name:text:Kolay hatırlanması için bir isim.",
                        ]
                    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
                <div class="col-md-3">
                    <?php echo $__env->make('inputs', [
                        'inputs' => [
                            "Sunucu İp Adresi" => "ip_address:text",
                        ]
                    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
                <div class="col-md-1">
                    <?php echo $__env->make('inputs', [
                        'inputs' => [
                            "Port" => "port:number",
                        ]
                    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
                
            </div><br>
            <button class="btn btn-primary" onclick="addNewServerMonitor()"><?php echo e(__("Ekle")); ?></button>
            <?php echo $__env->renderComponent(); ?>
        <script>

            function loadServer(){
                let arr = $("#server_list").val().split(":");
                $("input[name='ip_address']").val(arr[0]);
                $("input[name='port']").val(arr[1]);
            }

            function addNewServerMonitor(){
                showSwal("Ekleniyor...","info");
                let form = new FormData();
                form.append("ip_address", $("input[name='ip_address']").val());
                form.append("port", $("input[name='port']").val());
                form.append("name", $("input[name='name']").val());
                request("<?php echo e(route('monitor_add')); ?>",form,function(success){
                    let json = JSON.parse(success);
                    showSwal(json.message,'success',2000);
                    setTimeout(() => {
                        location.reload();    
                    }, 1500);
                },function(error){
                    let json = JSON.parse(error);
                    showSwal(json.message,'error',2000);
                });
            }
            $.contextMenu({
                selector: '.monitorServer',
                callback: function (key, options) {
                    let form = new FormData();
                    form.append('server_monitor_id',options.$trigger[0].getAttribute("id"));
                    switch(key){
                        case "refresh":
                            request("<?php echo e(route('monitor_refresh')); ?>",form,function(success){
                                let json = JSON.parse(success);
                                showSwal(json.message,'success',2000);
                                setTimeout(() => {
                                    location.reload();
                                }, 1500);
                            },function(error){
                                let json = JSON.parse(error);
                                showSwal(json.message,'error',2000);
                            });
                            break;
                        case "remove":
                            request("<?php echo e(route('monitor_remove')); ?>",form,function(success){
                                let json = JSON.parse(success);
                                showSwal(json.message,'success',2000);
                                setTimeout(() => {
                                    location.reload();
                                }, 1500);
                            },function(error){
                                let json = JSON.parse(error);
                                showSwal(json.message,'error',2000);
                            });
                            break;
                    }
                },
                items: {
                    "refresh" : {
                        "name" : "Şimdi Güncelle",
                        "icon" : "fas fa-redo"
                    },
                    "remove" : {
                        "name" : "Sil",
                        "icon" : "fas fa-trash"
                    },
                }
            });
            function addNewMonitor(){
                $("#addNewMonitor").modal('show');
            }
        </script>

        <div class="float" onclick="addNewMonitor()" id="requestRecordButton">
            <i class="fas fa-plus"></i>
        </div>
        <style>
            .float {
                position: fixed;
                font-size: 25px;
                line-height: 50px;
                width: 50px;
                height: 50px;
                bottom: 20px;
                right: 20px;
                background-color: grey;
                color: #FFF;
                border-radius: 50px;
                text-align: center;
                box-shadow: 2px 2px 3px #999;
            }
        </style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /liman/server/resources/views/monitor/index.blade.php ENDPATH**/ ?>