<?php $__env->startSection('content'); ?>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>"><?php echo e(__("Ana Sayfa")); ?></a></li>
            <li class="breadcrumb-item"><a href="<?php echo e(route('settings')); ?>"><?php echo e(__("Sistem Ayarları")); ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo e(__("Sertifika Ekle")); ?></li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><?php echo e(__("Sisteme SSL Sertifikası Ekleme")); ?></h3>
        </div>
        <div class="card-body">
            <?php if(request('server_id')): ?>
                <h5 style="font-weight: 600"><?php echo e(server()->name . " " . __("sunucusu talebi.")); ?></h5>
                <br>
            <?php endif; ?>
            <div class="row">
                <div class="col-md-4">
                    <label for="hostname"><?php echo e(__("Hostname")); ?></label>
                    <input type="text" name="hostname" class="form-control" id="hostname" value="<?php echo e(request('hostname')); ?>"></td>
                </div>
                <div class="col-md-4">
                    <label for="port"><?php echo e(__("Port")); ?></label>
                    <input type="number" name="port" class="form-control" aria-valuemin="1" aria-valuemax="65555" id="port" value="<?php echo e(request('port')); ?>">
                </div>
                <div class="col-md-4" style="line-height: 95px">
                    <button onclick="retrieveCertificate()" class="btn btn-success"><?php echo e(__("Al")); ?></button>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="box box-solid">
                    <div class="box-header with-border">
                        <h5 class="box-title" style="font-weight: 600"><?php echo e(__("İmzalayan")); ?></h5>
                    </div>
                    <hr class="my-2">
                    <div class="box-body clearfix">
                        <div class="form-group">
                            <label><?php echo e(__("İstemci")); ?></label>
                            <input type="text" id="issuerCN" readonly class="form-control">
                        </div>
                        <div class="form-group">
                            <label><?php echo e(__("Otorite")); ?></label>
                            <input type="text" id="issuerDN" readonly class="form-control">
                        </div>
                    </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="box box-solid">
                        <div class="box-header with-border">
                            <h5 class="box-title" style="font-weight: 600"><?php echo e(__("Parmak İzleri")); ?></h5>
                        </div>
                        <hr class="my-2">
                    <div class="box-body clearfix">
                        <div class="form-group">
                            <label><?php echo e(__("İstemci")); ?></label>
                            <input type="text" id="subjectKeyIdentifier" readonly class="form-control">
                        </div>
                        <div class="form-group">
                            <label><?php echo e(__("Otorite")); ?></label>
                            <input type="text" id="authorityKeyIdentifier" readonly class="form-control">
                        </div>
                    </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="box box-solid">
                    <div class="box-header with-border">
                        <h5 class="box-title" style="font-weight: 600"><?php echo e(__("Geçerlilik Tarihi")); ?></h5>
                    </div>
                    <hr class="my-2">
                    <div class="box-body clearfix">
                        <div class="form-group">
                            <label><?php echo e(__("Başlangıç Tarihi")); ?></label>
                            <input type="text" id="validFrom" readonly class="form-control">
                        </div>
                        <div class="form-group">
                            <label><?php echo e(__("Bitiş Tarihi")); ?></label>
                            <input type="text" id="validTo" readonly class="form-control">
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <div class="row">
                    <div class="col-md-12">
                        <div class="box box-solid">
                            <br>
                            <div class="box-header with-border">
                                <h4 class="box-title" style="font-weight: 600"><?php echo e(__("Sertifikayı Onayla")); ?></h4>
                            </div>
                            <div class="box-body clearfix">
                                <span><?php echo e(__("Not : Eklediğiniz sertifika işletim sistemi tarafından güvenilecektir.")); ?></span><br><br>
                                <button class="btn btn-success" onclick="verifyCertificate()" id="addButton" disabled><?php echo e(__("Sertifikayı Onayla")); ?></button>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    <script>
        var path = "";
        function retrieveCertificate() {
            showSwal('<?php echo e(__("Sertifika Alınıyor...")); ?>','info');
            var form = new FormData();
            form.append('hostname',$("#hostname").val());
            form.append('port',$("#port").val());
            request('<?php echo e(route('certificate_request')); ?>',form,function (success) {
                var json = JSON.parse(success)["message"];
                if(json["issuer"]["DC"]){
                    $("#issuerCN").val(json["issuer"]["CN"]);
                }
                if(json["issuer"]["DC"]){
                    $("#issuerDN").val(json["issuer"]["DC"].reverse().join('.'));
                }
                $("#validFrom").val(json["validFrom_time_t"]);
                $("#validTo").val(json["validTo_time_t"]);
                $("#authorityKeyIdentifier").val(json["authorityKeyIdentifier"]);
                $("#subjectKeyIdentifier").val(json["subjectKeyIdentifier"]);
                $("#addButton").prop('disabled',false);
                path = json["path"];
                Swal.close();
            },function (errors) {
                var json = JSON.parse(errors);
                showSwal(json["message"],'error',2000);
            });

        }
        
        function verifyCertificate() {
            showSwal('<?php echo e(__("Sertifika Ekleniyor...")); ?>','info');
            var form = new FormData();
            form.append('path',path);
            form.append('server_hostname',$("#hostname").val());
            form.append('origin',$("#port").val());
            form.append('notification_id','<?php echo e(request('notification_id')); ?>');
            form.append('server_id','<?php echo e(request('server_id')); ?>');
            request('<?php echo e(route('verify_certificate')); ?>',form,function (success) {
                var json = JSON.parse(success);
                showSwal(json["message"],'info',2000);
                setTimeout(function () {
                    window.location.href = "<?php echo e(route('settings')); ?>" + "#certificates";
                },1000);
            },function (errors) {
                var json = JSON.parse(errors);
                showSwal(json["message"],"error",2000);
            });
        }
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /liman/server/resources/views/settings/certificate.blade.php ENDPATH**/ ?>