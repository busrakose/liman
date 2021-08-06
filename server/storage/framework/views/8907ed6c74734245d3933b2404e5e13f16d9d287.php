<?php $__env->startSection('content'); ?>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>"><?php echo e(__("Ana Sayfa")); ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo e(__("Sunucular")); ?></li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-3">
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <h3 class="profile-username text-center font-weight-bold"><?php echo e(__("Sunucular")); ?></h3>
                <p class="text-muted text-center mb-0"><?php echo e(__("Bu sayfadan mevcut sunucularını görebilirsiniz. Ayrıca yeni sunucu eklemek için Sunucu Ekle butonunu kullanabilirsiniz.")); ?></p>
              </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <?php if(\App\Models\Permission::can(user()->id,'liman','id','add_server')): ?>
                        <button href="#tab_1" type="button" class="btn btn-success" data-toggle="modal" data-target="#add_server"><i class="nav-icon fas fa-plus mr-1"></i> <?php echo e(__("Sunucu Ekle")); ?></button><br><br>
                    <?php endif; ?>
                    
                    <?php echo $__env->make('errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php
                    use Illuminate\Support\Facades\DB;
                    $servers = servers();
                    foreach ($servers as $server) {
                        $server->extension_count = DB::table(
                            'server_extensions'
                        )
                            ->where('server_id', $server->id)
                            ->count();
                    }
                    ?>
                    <?php echo $__env->make('table',[
                        "value" => $servers,
                        "title" => [
                            "Sunucu Adı" , "İp Adresi" , "*hidden*" , "Kontrol Portu", "Eklenti Sayısı", "*hidden*" ,"*hidden*"
                        ],
                        "display" => [
                            "name" , "ip_address", "type:type" , "control_port", "extension_count", "city:city", "id:server_id"
                        ],
                        "menu" => [
                            "Düzenle" => [
                                "target" => "edit",
                                "icon" => " context-menu-icon-edit"
                            ],
                            "Sil" => [
                                "target" => "delete",
                                "icon" => " context-menu-icon-delete"
                            ]
                        ],
                        "onclick" => "details"
                    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="add_server">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><?php echo e(__("Sunucu Ekle")); ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                </div>
                <ul class="nav nav-tabs" role="tablist" style="padding:20px;">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="pill" id="networkTab" href="#network" role="tab" aria-controls="network" aria-selected="true"><?php echo e(__("Bağlantı Bilgileri")); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" id="generalTab" href="#general" role="tab" aria-controls="general"><?php echo e(__("Genel Ayarlar")); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" id="keyTab" href="#key" role="tab" aria-controls="key"><?php echo e(__("Anahtar")); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" id="summaryTab" onclick="setSummary()" href="#summary" role="tab" aria-controls="summary"><?php echo e(__("Özet")); ?></a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="network" role="tabpanel" aria-labelledby="networkTab">
                        <form onsubmit="return checkAccess(this)">
                            <div class="modal-body">
                                <label class="text-md"><?php echo e(__("Sunucunuzun Adresi")); ?></label>
                                <input type="text" id="serverHostName" name="hostname" class="form-control" placeholder="<?php echo e(__("Sunucunuzun Hostname yada IP Adresini girin.")); ?>" required><br>
                                <label class="text-md"><?php echo e(__("Sunucunuzun Portu")); ?></label>
                                <div><?php echo e(__("Sunucunuzun açık olup olmadığını algılamak için kontrol edilebilecek bir port girin.")); ?></div>
                                <pre><?php echo e(__("SSH : 22\nWinRM : 5986\nActive Directory, Samba : 636")); ?></pre>
                                <input id="serverControlPort" type="number" name="port" class="form-control" placeholder="<?php echo e(__("Kontrol Portu Girin (Yalnızca Sayı).")); ?>" required min="-1">
                                <small><i><?php echo e(__("Eğer hedefiniz UDP protokolü üzerinden dinliyorsa bu kontrolü atlamak için -1 girebilirsiniz.")); ?></i></small>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-plug"></i> <?php echo e(__("Bağlantıyı Kontrol Et")); ?></button>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="general" role="tabpanel" aria-labelledby="generalTab">
                        <form onsubmit="return checkGeneral(this)">
                            <div class="modal-body">
                                <label class="text-md"><?php echo e(__("Sunucunuzun Adı")); ?></label>
                                <input id="server_name" type="text" name="server_name" class="form-control" placeholder="<?php echo e(__("Sunucunuzun Adı")); ?>" required><br>
                                <label class="text-md mb-0" style="width: 100%;"><?php echo e(__("Şehir")); ?></label>
                                <small><?php echo e(__("Sunucunuza bir şehir atayarak, eklentileri kullanırken Türkiye haritası üzerinde erişiminizi kolaylaştırabilirsiniz.")); ?></small><br>
                                <select name="server_city" id="serverCity" class="form-control select2" required>
                                    <option value="" disabled selected><?php echo e(__('Şehir Seçiniz')); ?></option>
                                    <?php $__currentLoopData = cities(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name=>$code): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($code); ?>"><?php echo e($name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select><br>
                                <label class="text-md"><?php echo e(__("Sunucunuzun İşletim Sistemi")); ?></label>
                                <div class="form-group">
                                    <div class="radio">
                                        <label style="font-weight: 400; margin-right: 10px;">
                                            <input type="radio" name="operating_system" value="windows" data-content="<?php echo e(__("Microsoft Windows")); ?>">
                                            <?php echo e(__("Microsoft Windows")); ?>

                                        </label>
                                        <label style="font-weight: 400">
                                            <input type="radio" name="operating_system" value="linux" checked data-content="<?php echo e(__("GNU/Linux")); ?>">
                                            <?php echo e(__("GNU/Linux")); ?>

                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-wrench"></i> <?php echo e(__("Ayarları Onayla")); ?></button>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="key" role="tabpanel" aria-labelledby="keyTab">
                        <?php echo $__env->make('keys.add', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                    <div class="tab-pane fade" id="summary" role="tabpanel" aria-labelledby="summaryTab">
                        <div class="modal-body">
                            <style>td{padding:15px;}</style>
                            <table class="notDataTable">
                                <tr>
                                    <td><?php echo e(__("Sunucu Adı")); ?></td>
                                    <td id="tableServerName"></td>
                                </tr>
                                <tr>
                                    <td><?php echo e(__("Şehir")); ?></td>
                                    <td id="tableServerCity"></td>
                                </tr>
                                <tr>
                                    <td><?php echo e(__("İşletim Sistemi")); ?></td>
                                    <td id="tableOperatingSystem"></td>
                                </tr>
                                <tr>
                                    <td><?php echo e(__("Sunucu Adresi")); ?></td>
                                    <td id="tableServerHostname"></td>
                                </tr>
                                <tr>
                                    <td><?php echo e(__("Sunucu Portu")); ?></td>
                                    <td id="tableServerPort"></td>
                                </tr>
                                <tr>
                                    <td><?php echo e(__("Anahtar")); ?></td>
                                    <td id="tableKey"></td>
                                </tr>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" onclick="addServer()" class="btn btn-success"><i class="fas fa-check"></i> <?php echo e(__("Sunucuyu Ekle")); ?></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var isNetworkOK = false;
        var isGeneralOK = false;
        
        function checkAccess(form) {
            showSwal('<?php echo e(__("Kontrol Ediliyor...")); ?>','info');
            return request('<?php echo e(route('server_check_access')); ?>',form,function (response) {
                var json = JSON.parse(response);
                showSwal(json["message"],'success',2000);
                isNetworkOK = true;
                $("#networkTab").css('color','green');
                $("#generalTab").click();
            },function (response) {
                var json = JSON.parse(response);
                showSwal(json.message,'error',2000);
                isNetworkOK = false;
                $("#networkTab").css('color','red');
            });
        }

        function checkGeneral(form){
            showSwal('<?php echo e(__("Kontrol Ediliyor...")); ?>','info');
            return request('<?php echo e(route('server_verify_name')); ?>',form,function (response) {
                var json = JSON.parse(response);
            showSwal(json["message"],'success',500);
                isGeneralOK = true;
                $("#generalTab").css('color','green');
                $("#keyTab").click();
            },function (response) {
                var json = JSON.parse(response);
                showSwal(json["message"],'error',2000);
                isGeneralOK = false;
                $("#generalTab").css('color','red');
            });
        }
        var helper;
        
        function details(element) {
            var server_id = element.querySelector('#server_id').innerHTML;
            window.location.href = "/sunucular/" + server_id;
        }
        

        function setSummary(){
            $("#tableServerHostname").text($("#serverHostName").val());
            $("#tableServerPort").text($("#serverControlPort").val());
            $("#tableOperatingSystem").text($("input[name=operating_system]:checked").attr('data-content'));
            $("#tableServerName").text($("#server_name").val());
            $("#tableServerCity").text($("#serverCity").val());
            $("#tableKey").text(($("#useKey").is(':checked') === true) ? $("#keyType").val() : "<?php echo e(__("Anahtarsız")); ?>");
        }

        function addServer() {
            if(!isNetworkOK || !isGeneralOK || !isKeyOK){
                showSwal('<?php echo e(__("Lütfen Tüm Ayarları Tamamlayın")); ?>','info',2000);
                return false;
            }
            showSwal('<?php echo e(__("Sunucu Ekleniyor...")); ?>','info');
            var form = new FormData();
            form.append("name",$("#server_name").val());
            form.append("ip_address",$("#serverHostName").val());
            form.append("control_port",$("#serverControlPort").val());
            form.append("city",$("#serverCity").val());

            if($("#useKey").is(':checked') === true){
                form.append('username',$("#keyUsername").val());
                form.append('keyType',$("#keyType").val());
                if($("#keyType").val() == "ssh_certificate"){
                    form.append('password',$("#keyPasswordCert").val());
                }else{
                    form.append('password',$("#keyPassword").val());
                }
                
                form.append('type',$("#keyType").val());
                form.append('key_port',$("#port").val());
            }
            form.append('os',$("input[name=operating_system]:checked").val());
            request('<?php echo e(route('server_add')); ?>',form,function (errors) {
                var json = JSON.parse(errors);
                if(json["status"] == "202"){
                    showSwal(json["message"],'info');
                    $(".modal").modal('hide');
                }else{
                    showSwal(json["message"],'error',2000);
                }
            }, function(response){
                var error = JSON.parse(response);
                showSwal(error.message,'error',2000);
            });
        }
    </script>


    <?php echo $__env->make('modal',[
       "id"=>"delete",
       "title" =>"Sunucuyu Sil",
       "url" => route('server_remove'),
       "text" => "Sunucuyu silmek istediğinize emin misiniz? Bu işlem geri alınamayacaktır.",
       "next" => "reload",
       "inputs" => [
           "Sunucu Id:'null'" => "server_id:hidden"
       ],
       "submit_text" => "Sunucuyu Sil"
   ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('modal',[
        "id"=>"edit",
        "title" => "Sunucuyu Düzenle",
        "url" => route('server_update'),
        "next" => "updateTable",
        "inputs" => [
            "Sunucu Adı" => "name:text",
            "Kontrol Portu" => "control_port:number",
            "Sunucu Id:''" => "server_id:hidden",
            "IP Adresi" => "ip_address:text",
            "Şehir:city" => cities(),
        ],
        "submit_text" => "Düzenle"
    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /liman/server/resources/views/server/index.blade.php ENDPATH**/ ?>