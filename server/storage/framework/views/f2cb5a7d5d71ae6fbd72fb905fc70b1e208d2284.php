<?php $__env->startSection('content'); ?>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>"><?php echo e(__("Ana Sayfa")); ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo e(__("Sistem Ayarları")); ?></li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-header p-2">
            <ul class="nav nav-tabs" role="tabpanel">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#users" aria-selected="true"><?php echo e(__("Kullanıcı Ayarları")); ?></a>
                </li>
                <li class="nav-item">
                    <a id="extensionNavLink" class="nav-link" data-toggle="tab" href="#extensions" aria-selected="true"><?php echo e(__("Eklentiler")); ?> <?php if(is_file(storage_path("extension_updates"))): ?> <span style="color:green" class="blinking">*</span> <?php endif; ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#roles" onclick="getRoleList()" aria-selected="true"><?php echo e(__("Rol Grupları")); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#serverGroups" aria-selected="true"><?php echo e(__("Sunucu Grupları")); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#certificates" ><?php echo e(__("Sertifikalar")); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#health" onclick="checkHealth()"><?php echo e(__("Sağlık Durumu")); ?></a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#update"><?php echo e(__("Güncelleme")); ?></a>
                </li> -->
                <!-- <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#changeLog"><?php echo e(__("Son Değişiklikler")); ?></a>
                </li> -->
                <!-- <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#rsyslog" onclick="readLogs()"><?php echo e(__("Log Yönetimi")); ?></a>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#externalNotifications" onclick=""><?php echo e(__("Dış Bildirimler")); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#restrictedMode" onclick=""><?php echo e(__("Kısıtlı Mod")); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#limanMarket" onclick="checkMarketAccess()"><?php echo e(__("Liman Market")); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#dnsSettings" onclick="getDNS()"><?php echo e(__("DNS Ayarları")); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#mailSettings" onclick="getCronMails()"><?php echo e(__("Mail Ayarları")); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#limanTweaks" onclick="getLimanTweaks()"><?php echo e(__("İnce Ayarlar")); ?></a>
                </li>
                <?php echo settingsModuleButtons(); ?>

            </ul>
        </div>
        <div class="card-body">
            <?php echo $__env->make('errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="users" role="tabpanel">
                    <?php echo $__env->make('modal-button',[
                        "class" => "btn-success",
                        "target_id" => "add_user",
                        "text" => "Kullanıcı Ekle"
                    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><br><br>
                    <div id="usersTable">
                        <?php echo $__env->make('table',[
                            "value" => \App\User::all(),
                            "title" => [
                                "İsim Soyisim", "Kullanıcı Adı", "Email", "*hidden*" ,
                            ],
                            "display" => [
                                "name", "username", "email", "id:user_id" ,
                            ],
                            "menu" => [
                                "Parolayı Sıfırla" => [
                                    "target" => "passwordReset",
                                    "icon" => "fa-lock"
                                ],
                                "Sil" => [
                                    "target" => "deleteUser",
                                    "icon" => " context-menu-icon-delete"
                                ]
                            ],
                            "onclick" => "userDetails"
                        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>
                <div class="tab-pane fade show" id="roles" role="tabpanel">
                    <?php echo $__env->make('modal-button',[
                        "class" => "btn-success",
                        "target_id" => "add_role",
                        "text" => "Rol Grubu Ekle"
                    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><br><br>
                    <div id="rolesTable">

                    </div>
                </div>
                <div class="tab-pane fade show" id="certificates" role="tabpanel">
                    <button class="btn btn-success" onclick="window.location.href = '<?php echo e(route('certificate_add_page')); ?>'"><i
                        class="fa fa-plus"></i> <?php echo e(__("Sertifika Ekle")); ?></button>
                    <br><br>
                    <?php echo $__env->make('table',[
                        "value" => \App\Models\Certificate::all(),
                        "title" => [
                            "Sunucu Adresi" , "Servis" , "*hidden*" ,
                        ],
                        "display" => [
                            "server_hostname" , "origin", "id:certificate_id" ,
                        ],
                        "menu" => [
                            "Güncelle" => [
                                "target" => "updateCertificate",
                                "icon" => "fa-sync-alt"
                            ],
                            "Sil" => [
                                "target" => "deleteCertificate",
                                "icon" => " context-menu-icon-delete"
                            ]
                        ],
                    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
                <div class="tab-pane fade show" id="health" role="tabpanel">
                    <pre id="output"></pre>
                </div>
                <div class="tab-pane fade show" id="extensions" role="tabpanel">
                    <?php echo $__env->make('extension_pages.manager', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
                <div class="tab-pane fade show" id="limanMarket" role="tabpanel">
                    <div id="marketStatus" class="alert alert-secondary" role="alert">

                    </div>
                    <div id="marketLoading">
                        <i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>
                    </div>
                    <div id="marketEnabled" style="display:none;">
                    <div id="marketTableWrapper">
                        <?php echo $__env->make('table',[
                            "id" => "marketTable",
                            "value" => [],
                            "title" => [
                                "Sistem Adı" , "Mevcut Versiyon", "Durumu"
                            ],
                            "display" => [
                                "packageName" , "currentVersion", "status"
                            ],
                        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>

                    </div>
                    <div id="marketDisabled" style="display:none">
                        <p><?php echo e(__("Liman kurulumunuzu Liman Market'e bağlayarak sistemdeki tüm güncellemeleri takip edebilir, güncellemeleri indirebilirsiniz.")); ?></p>
                        <button type="button" class="btn btn-primary btn-lg" onclick="location.href = '<?php echo e(route('redirect_market')); ?>'"><?php echo e(__("Liman Market'i Bağla")); ?></button>
                    </div>
                    <script>
                        function checkMarketAccess(){
                            var status = $("#marketStatus");
                            $("#marketTableWrapper").fadeOut(0);
                            status.html("<?php echo e(__('Market bağlantısı kontrol ediliyor...')); ?>");
                            status.attr("class","alert alert-secondary");
                            request("<?php echo e(route('verify_market')); ?>",new FormData(),function(success){
                                var json = JSON.parse(success);
                                $("#marketLoading").fadeOut(0);
                                $("#marketDisabled").fadeOut(0);
                                $("#marketEnabled").fadeIn();
                                status.html(json.message);
                                status.attr("class","alert alert-success");
                                setTimeout(() => {
                                    checkMarketUpdates();
                                }, 1000);
                            },function(error){
                                var json = JSON.parse(error);
                                $("#marketLoading").fadeOut(0);
                                $("#marketEnabled").fadeOut(0);
                                $("#marketDisabled").fadeIn();
                                status.html(json.message);
                                status.attr("class","alert alert-danger");
                            });
                        }

                        function checkMarketUpdates(){
                            var status = $("#marketStatus");
                            status.html("<?php echo e(__('Güncellemeler kontrol ediliyor...')); ?>");
                            status.attr("class","alert alert-secondary");
                            $("#marketLoading").fadeIn(0);
                            request("<?php echo e(route('check_updates_market')); ?>",new FormData(),function(success){
                                var json = JSON.parse(success);
                                var table = $("#marketTable").DataTable();
                                var counter = 1;
                                table.clear();
                                $.each(json.message,function (index,current) {
                                    var row = table.row.add([
                                        counter++, current["packageName"], current["currentVersion"], current["status"]
                                    ]).draw().node();
                                });
                                table.draw();
                                status.html("<?php echo e(__('Güncellemeler başarıyla kontrol edildi')); ?>");
                                status.attr("class","alert alert-success");
                                $("#marketLoading").fadeOut(0);
                                $("#marketTableWrapper").fadeIn(0);
                            },function(error){
                                var json = JSON.parse(error);
                                status.html(json.message);
                                status.attr("class","alert alert-danger");
                            });
                        }
                    </script>

                </div>
                <div class="tab-pane fade show" id="dnsSettings" role="tabpanel">
                    <p><?php echo e(__("Liman'ın sunucu adreslerini çözebilmesi için gerekli DNS sunucularını aşağıdan düzenleyebilirsiniz.")); ?></p>
                    <form onsubmit="return saveDNS(this);">
                        <label><?php echo e(__("Öncelikli DNS Sunucusu")); ?></label>
                        <input type="text" name="dns1" id="dns1" class="form-control mb-3">
                        <label><?php echo e(__("Alternatif DNS Sunucusu")); ?></label>
                        <input type="text" name="dns2" id="dns2" class="form-control mb-3">
                        <label><?php echo e(__("Alternatif DNS Sunucusu")); ?></label>
                        <input type="text" name="dns3" id="dns3" class="form-control"><br>
                        <button type="submit" class="btn btn-primary"><?php echo e(__("Kaydet")); ?></button>
                    </form>
                </div>
                <div class="tab-pane fade show" id="servers" role="tabpanel">
                    <?php
                    $servers = servers();
                    foreach ($servers as $server) {
                        $server->enabled = $server->enabled
                            ? __("Aktif")
                            : __("Pasif");
                    }
                    ?>
                    <button class="btn btn-success" onclick="serverStatus(true)" disabled><?php echo e(__("Aktifleştir")); ?></button>
                    <button class="btn btn-danger" onchange="serverStatus(false)" disabled><?php echo e(__("Pasifleştir")); ?></button><br><br>
                    <?php echo $__env->make('table',[
                        "value" => $servers,
                        "title" => [
                            "Sunucu Adı" , "İp Adresi" , "Durumu" , "*hidden*"
                        ],
                        "display" => [
                            "name" , "ip_address", "enabled", "id:server_id"
                        ],
                        "noInitialize" => true
                    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <script>
                        $("#servers table").DataTable(dataTablePresets('multiple'));
                    </script>
                </div>
                <?php echo settingsModuleViews(); ?>

                <div class="tab-pane fade show" id="update" role="tabpanel">
                    <?php ($updateOutput = shell_exec("apt list --upgradable | grep 'liman'")); ?>
                    <?php if($updateOutput): ?>
                        <pre><?php echo e($updateOutput); ?></pre>
                    <?php else: ?>
                        <pre><?php echo e(__("Liman Sürümünüz : " . getVersion() . " güncel.")); ?></pre>
                    <?php endif; ?>
                </div>

                <div class="tab-pane fade show" id="changeLog" role="tabpanel">
                    <ul>
                        <?php $__currentLoopData = explode("\n",$changelog); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($line); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>

                <div class="tab-pane fade show" id="restrictedMode" role="tabpanel">
                    <p><?php echo e(__("Liman'ı kısıtlamak ve kullanıcıların yalnızca bir eklentiyi kullanması için bu modu kullanabilirsiniz. Bu modu kullandığınız taktirde, kullanıcılar varsayılan olarak eklenti ve sunucu yetkisine sahip olacak, ancak fonksiyon yetkilerine sahip olmayacaklardır. Yöneticiler mevcut liman arayüzünü görmeye devam edecek, kullanıcılar ise yalnızca eklenti çerçevesini görüntüleyebilecektir.")); ?></p>
                    <form onsubmit="return saveRestricted(this);">
                        <div class="form-check">
                            <input name="LIMAN_RESTRICTED" type="checkbox" class="form-check-input" id="rectricedModeToggle" <?php if(env("LIMAN_RESTRICTED")): ?> checked <?php endif; ?>>
                            <label class="form-check-label" for="rectricedModeToggle"><?php echo e(__("Kısıtlı Modu Aktifleştir.")); ?></label>
                        </div><br>

                        <div class="form-group">
                            <label for="restrictedServer"><?php echo e(__("Gösterilecek Sunucu")); ?></label>
                            <select name="LIMAN_RESTRICTED_SERVER" id="restrictedServer" class="form-control select2" required>
                                <option value="" disabled selected><?php echo e(__('Lütfen bir sunucu seçin.')); ?></option>
                                        <?php $__currentLoopData = servers(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $server): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($server->id); ?>" <?php if(env("LIMAN_RESTRICTED_SERVER") == $server->id): ?> selected <?php endif; ?>><?php echo e($server->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="form-group">
                        <label for="restrictedExtension"><?php echo e(__("Gösterilecek Eklenti")); ?></label>
                            <select name="LIMAN_RESTRICTED_EXTENSION" id="restrictedExtension" class="form-control select2" required>
                                <option value="" disabled selected><?php echo e(__('Lütfen bir eklenti seçin.')); ?></option>
                                        <?php $__currentLoopData = extensions(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $extension): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($extension->id); ?>" <?php if(env("LIMAN_RESTRICTED_EXTENSION") == $extension->id): ?> selected <?php endif; ?>><?php echo e($extension->display_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary"><?php echo e(__("Ayarları Kaydet")); ?></button>
                    </form>
                    <script>
                        function saveRestricted(form){
                            return request('<?php echo e(route("restricted_mode_update")); ?>',form,function(success){
                                var json = JSON.parse(success);
                                showSwal(json.message,'success');
                                setTimeout(() => {
                                    reload();
                                }, 2000);
                            },function(error){
                                var json = JSON.parse(error);
                                showSwal(json.message,'danger',2000);
                            });
                        }
                    </script>
                </div>

                <div class="tab-pane fade show" id="externalNotifications" role="tabpanel">
                <?php echo $__env->make('modal-button',[
                        "class" => "btn-primary",
                        "target_id" => "addNewNotificationSource",
                        "text" => "Yeni İstemci Ekle"
                    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><br><br>
                    <?php echo $__env->make('table',[
                            "value" => \App\Models\ExternalNotification::all(),
                            "title" => [
                                "İsim" , "İp Adresi / Hostname", "Son Erişim Tarihi" , "*hidden*" ,
                            ],
                            "display" => [
                                "name" , "ip", "last_used", "id:id" ,
                            ],
                            "menu" => [
                                "Düzenle" => [
                                    "target" => "editExternalNotificationToken",
                                    "icon" => " context-menu-icon-edit"
                                ],
                                "Yeni Token Al" => [
                                    "target" => "renewExternalNotificationToken",
                                    "icon" => "fa-lock"
                                ],
                                "Sil" => [
                                    "target" => "deleteExternalNotificationToken",
                                    "icon" => " context-menu-icon-delete"
                                ]
                            ],
                        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>

                <div class="tab-pane fade show" id="rsyslog" role="tabpanel">
                <p><?php echo e(__("Liman Üzerindeki İşlem Loglarını hedef bir log sunucusuna rsyslog servisi ile göndermek için hedef log sunucusunun adresi ve portunu yazınız.")); ?></p>
                    <form id="logForm" onsubmit="return saveLogSystem()">
                        <div class="form-row">
                            <div class="form-group col-md-10">
                                <label for="targetHostname"><?php echo e(__("Sunucu Adresi")); ?></label>
                                <input type="text" class="form-control" name="targetHostname" id="logIpAddress">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="targetPort"><?php echo e(__("Sunucu Portu")); ?></label>
                                <input type="number" class="form-control" name="targetPort" value="514" id="logPort">
                            </div>
                        </div>
                        <div class="form-row">
                        <div class="form-group col-md-2">
                                <label for="logInterval"><?php echo e(__("Log Gönderme Aralığı (Dakika)")); ?></label>
                                <input type="number" class="form-control" name="logInterval" value="10" id="logInterval">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success"><?php echo e(__("Ayarları Kaydet")); ?></button>
                    </form>
                </div>
                <div class="tab-pane fade show" id="serverGroups" role="tabpanel">
                <?php echo $__env->make('modal-button',[
                        "class" => "btn-success",
                        "target_id" => "addServerGroup",
                        "text" => "Sunucu Grubu Ekle"
                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><br><br>

                <p><?php echo e(__("Sunucuları bir gruba ekleyerek eklentiler arası geçişi daha akıcı yapabilirsiniz.")); ?></p>
                <?php echo $__env->make('table',[
                            "value" => \App\Models\ServerGroup::all(),
                            "title" => [
                                "Adı", "*hidden*" , "*hidden*"
                            ],
                            "display" => [
                                "name" , "id:server_group_id" , "servers:servers"
                            ],
                            "menu" => [
                                "Düzenle" => [
                                    "target" => "modifyServerGroupHandler",
                                    "icon" => " context-menu-icon-edit"
                                ],
                                "Sil" => [
                                    "target" => "deleteServerGroup",
                                    "icon" => " context-menu-icon-delete"
                                ]
                            ],
                        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
                <div class="tab-pane fade show" id="mailSettings" role="tabpanel">
                    <div id="mailWrapper"></div>
                    <script>
                        function getCronMails(){
                            showSwal("Okunuyor...","info");
                            request("<?php echo e(route('cron_mail_get')); ?>",new FormData(),function (success){
                                $("#mailWrapper").html(success);
                                $("#mailWrapper table").DataTable(dataTablePresets("normal"));
                                Swal.close();
                            },function(error){
                                let json = JSON.parse(error);
                                showSwal(json.message,'error',2000);
                            });

                        }
                    </script>
                </div>
                <div class="tab-pane fade show" id="limanTweaks" role="tabpanel">
                    <?php echo $__env->make("settings.tweaks", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>
        </div>
    </div>
    <style>
        .blinking {
            animation: blinker 1s linear infinite;
        }

        @keyframes  blinker {
            50% { opacity: 0; }
        }
    </style>

    <?php echo $__env->make('modal',[
        "id"=>"add_user",
        "title" => "Kullanıcı Ekle",
        "url" => route('user_add'),
        "next" => "afterUserAdd",
        "selects" => [
            "Yönetici:administrator" => [
                "-:administrator" => "type:hidden"
            ],
            "Kullanıcı:user" => [
                "-:user" => "type:hidden"
            ]
        ],
        "inputs" => [
            "İsim Soyisim" => "name:text",
            "Kullanıcı Adı (opsiyonel)" => "username:text",
            "E-mail Adresi" => "email:email",
        ],
        "submit_text" => "Ekle"
    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('modal',[
        "id"=>"add_role",
        "title" => "Rol Grubu Ekle",
        "url" => route('role_add'),
        "next" => "getRoleList",
        "inputs" => [
            "Adı" => "name:text"
        ],
        "submit_text" => "Ekle"
    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('modal',[
       "id"=>"deleteUser",
       "title" =>"Kullanıcıyı Sil",
       "url" => route('user_remove'),
       "text" => "Kullanıcıyı silmek istediğinize emin misiniz? Bu işlem geri alınamayacaktır.",
       "next" => "reload",
       "inputs" => [
           "Kullanici Id:'null'" => "user_id:hidden"
       ],
       "submit_text" => "Kullanıcıyı Sil"
   ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('modal',[
        "id"=>"deleteRole",
        "title" =>"Rol Grubunu Sil",
        "url" => route('role_remove'),
        "text" => "Rol grubunu silmek istediğinize emin misiniz? Bu işlem geri alınamayacaktır.",
        "next" => "getRoleList",
        "inputs" => [
            "Rol Id:'null'" => "role_id:hidden"
        ],
        "submit_text" => "Rol Grubunu Sil"
    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('modal',[
           "id"=>"updateCertificate",
           "title" =>"Sertifikayı Güncelle",
           "url" => route('update_certificate'),
           "text" => "Sertifikayı güncellemek istediğinize emin misiniz?",
           "next" => "reload",
           "inputs" => [
               "Kullanici Id:'null'" => "certificate_id:hidden"
           ],
           "submit_text" => "Sertifikayı Güncelle"
       ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('modal',[
        "id"=>"deleteCertificate",
        "title" =>"Sertifikayı Sil",
        "url" => route('remove_certificate'),
        "text" => "Sertifikayı silmek istediğinize emin misiniz? Bu işlem geri alınamayacaktır.",
        "next" => "reload",
        "inputs" => [
            "Kullanici Id:'null'" => "certificate_id:hidden"
        ],
        "submit_text" => "Sertifikayı Sil"
    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('modal',[
       "id"=>"passwordReset",
       "title" =>"Parolayı Sıfırla",
       "url" => route('user_password_reset'),
       "text" => "Parolayı sıfırlamak istediğinize emin misiniz? Bu işlem geri alınamayacaktır.",
       "next" => "nothing",
       "inputs" => [
           "Kullanici Id:'null'" => "user_id:hidden"
       ],
       "submit_text" => "Parolayı Sıfırla"
   ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

   <?php echo $__env->make('modal',[
        "id"=>"deleteServerGroup",
        "title" =>"Sunucu Grubunu Sil",
        "url" => route('delete_server_group'),
        "text" => "Sunucu grubunu silmek istediğinize emin misiniz? Bu işlem geri alınamayacaktır.",
        "next" => "reload",
        "inputs" => [
            "-:-" => "server_group_id:hidden"
        ],
        "submit_text" => "Sunucu Grubunu Sil"
    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>




    <?php $__env->startComponent('modal-component',[
        "id" => "addServerGroup",
        "title" => "Sunucuları Gruplama",
        "footer" => [
            "class" => "btn-success",
            "onclick" => "addServerGroup()",
            "text" => "Ekle"
        ],
    ]); ?>
    <div class="form-group">
        <label><?php echo e(__("Sunucu Grubu Adı")); ?></label><br>
        <small><?php echo e(__("Görsel olarak hiçbir yerde gösterilmeyecektir, yalnızca düzenleme kısmındak kolay erişim için eklenmiştir.")); ?></small>
        <input type="text" class="form-control" id="serverGroupName">
    </div>
    <label><?php echo e(__("Sunucular")); ?></label><br>
    <small><?php echo e(__("Bu gruba eklemek istediğiniz sunucuları seçin.")); ?></small>
    <?php echo $__env->make('table',[
        "id" => "serverGroupServers",
        "value" => servers(),
        "title" => [
            "Sunucu Adı" , "İp Adresi" , "*hidden*"
        ],
        "display" => [
            "name" , "ip_address", "id:server_id"
        ],
        "noInitialize" => "true"
    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->renderComponent(); ?>

    <?php $__env->startComponent('modal-component',[
        "id" => "modifyServerGroupModal",
        "title" => "Sunucu Grubu Düzenleme",
        "footer" => [
            "class" => "btn-success",
            "onclick" => "modifyServerGroup()",
            "text" => "Ekle"
        ],
    ]); ?>
    <div class="form-group">
        <label><?php echo e(__("Sunucu Grubu Adı")); ?></label><br>
        <small><?php echo e(__("Görsel olarak hiçbir yerde gösterilmeyecektir, yalnızca düzenleme kısmındak kolay erişim için eklenmiştir.")); ?></small>
        <input type="text" class="form-control" id="serverGroupNameModify">
    </div>
    <label><?php echo e(__("Sunucular")); ?></label><br>
    <small><?php echo e(__("Bu gruba eklemek istediğiniz sunucuları seçin.")); ?></small>
    <?php echo $__env->make('table',[
        "id" => "modifyServerGroupTable",
        "value" => servers(),
        "title" => [
            "Sunucu Adı" , "İp Adresi" , "*hidden*"
        ],
        "display" => [
            "name" , "ip_address", "id:server_id"
        ],
        "noInitialize" => "true"
    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->renderComponent(); ?>

    <?php echo $__env->make('modal',[
        "id"=>"addNewNotificationSource",
        "title" => "Yeni Bildirim İstemcisi Ekle",
        "url" => route('add_notification_channel'),
        "text" => "İp Adresi bölümüne izin vermek istediğiniz bir subnet adresini ya da ip adresini yazarak erişimi kısıtlayabilirsiniz. Örneğin : 192.168.1.0/24",
        "next" => "debug",
        "inputs" => [
            "Adı" => "name:text",
            "İp Adresi / Hostname" => "ip:text",
        ],
        "submit_text" => "Ekle"
    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('modal',[
        "id"=>"editExternalNotificationToken",
        "title" =>"İstemciyi Düzenle",
        "url" => route('edit_notification_channel'),
        "text" => "İp Adresi bölümüne izin vermek istediğiniz bir subnet adresini ya da ip adresini yazarak erişimi kısıtlayabilirsiniz. Örneğin : 192.168.1.0/24",
        "next" => "reload",
        "inputs" => [
            "Adı" => "name:text",
            "İp Adresi / Hostname" => "ip:text",
            "-:-" => "id:hidden"
        ],
        "submit_text" => "Yenile"
    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('modal',[
        "id"=>"renewExternalNotificationToken",
        "title" =>"İstemci Token'ı Yenile",
        "url" => route('renew_notification_channel'),
        "text" => "İstemciye ait token'i yenilemek istediğinize emin misiniz? Bu işlem geri alınamayacaktır.",
        "next" => "debug",
        "inputs" => [
            "-:-" => "id:hidden"
        ],
        "submit_text" => "Yenile"
    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('modal',[
        "id"=>"deleteExternalNotificationToken",
        "title" =>"İstemciyi Sil",
        "url" => route('revoke_notification_channel'),
        "text" => "İstemciyi silmek istediğinize emin misiniz? Bu işlem geri alınamayacaktır.",
        "next" => "reload",
        "inputs" => [
            "-:-" => "id:hidden"
        ],
        "submit_text" => "Sil"
    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


    <script>

        function restrictionType(element){
            if($(element).val() == "user"){
                $('#domainUserSelect').show();
                $('#domainGroupSelect').hide();
            }else if($(element).val() == "group"){
                $('#domainGroupSelect').show();
                $('#domainUserSelect').hide();
            }
        }



        function saveLogSystem(){
            showSwal('<?php echo e(__("Kaydediliyor...")); ?>','info');
            var data = new FormData(document.querySelector('#logForm'));
            return request("<?php echo e(route("save_log_system")); ?>", data, function(res) {
                var response = JSON.parse(res);
                showSwal(response.message,'success');
                reload();
            }, function(response){
                var error = JSON.parse(response);
                showSwal(error.message,'error',2000);
            });
        }

        function addServerGroup(){
            showSwal('<?php echo e(__("Ekleniyor...")); ?>','info');
            var data = new FormData();
            var tableData = [];
            var table = $("#serverGroupServers").DataTable();
            table.rows( { selected: true } ).data().each(function(element){
                tableData.push(element[3]);
            });
            data.append('name', $('#serverGroupName').val());
            data.append('servers', tableData.join());
            request("<?php echo e(route("add_server_group")); ?>", data, function(response) {
                var res = JSON.parse(response);
                showSwal(res.message,'success',2000);
                setTimeout(() => {
                    location.reload();
                }, 1000);
            }, function(response){
                var error = JSON.parse(response);
                showSwal(error.message,'error',2000);
            });
        }
        function modifyServerGroupHandler(row){
            var server_group_id = row.querySelector('#server_group_id').innerHTML;
            var server_ids = row.querySelector('#servers').innerHTML.split(",");
            current_server_group = server_group_id;
            $('#serverGroupNameModify').val(row.querySelector('#name').innerHTML);
            var table = $("#modifyServerGroupTable").DataTable();
            table.rows().deselect();
            table.rows().every(function(){
                var data = this.data();
                var current = this;
                if(server_ids.includes(data[3])){
                    current.select();
                }
                this.draw();
            });
            $("#modifyServerGroupModal").modal('show');
        }

        var current_server_group = null;
        function modifyServerGroup(){
            showSwal('<?php echo e(__("Düzenleniyor...")); ?>','center');
            var data = new FormData();
            var tableData = [];
            var table = $("#modifyServerGroupTable").DataTable();
            table.rows( { selected: true } ).data().each(function(element){
                tableData.push(element[3]);
            });
            data.append('name', $('#serverGroupNameModify').val());
            data.append('servers', tableData.join());
            data.append('server_group_id',current_server_group);
            request("<?php echo e(route("modify_server_group")); ?>", data, function(response) {
                var res = JSON.parse(response);
                showSwal(res.message,'success',2000);
                setTimeout(() => {
                    location.reload();
                }, 1000);
            }, function(response){
                var error = JSON.parse(response);
                showSwal(error.message,'error',2000);
            });
        }

        function readLogs(){
            showSwal('<?php echo e(__("Okunuyor...")); ?>','info');
            request("<?php echo e(route("get_log_system")); ?>", new FormData(), function(res) {
                Swal.close();
                var response = JSON.parse(res);
                $("#logIpAddress").val(response["message"]["ip_address"]);
                $("#logPort").val(response["message"]["port"]);
                $("#logInterval").val(response["message"]["interval"]);
            }, function(response){
                var error = JSON.parse(response);
                showSwal(error.message,'error',2000);
            });
        }

        function afterUserAdd(response) {
            var json = JSON.parse(response);
            $("#add_user button[type='submit']").attr("disabled","true")
            getUserList();
        }

        $(function () {
            $("#add_user").find("input[name='username']").attr('required', false);

            $("#serverGroupServers").DataTable(dataTablePresets('multiple'));

            $("#modifyServerGroupTable").DataTable(dataTablePresets('multiple'));
        });
        function getUserList(){
            request('<?php echo e(route('get_user_list_admin')); ?>', new FormData(), function (response) {
                $("#usersTable").html(response);
                $('#usersTable table').DataTable();
            }, function(response){
                var error = JSON.parse(response);
                showSwal(error.message,'error',2000);
            });
        }

        function getRoleList(){
            $('.modal').modal('hide');
            request('<?php echo e(route('role_list')); ?>', new FormData(), function (response) {
                $("#rolesTable").html(response);
                $('#rolesTable table').DataTable(dataTablePresets('normal'));
            }, function(response){
                var error = JSON.parse(response);
                showSwal(error.message,'error',2000);
            });
        }

        function roleDetails(row){
            var role_id = row.querySelector('#role_id').innerHTML;
            window.location.href = '/rol/' + role_id;
        }

        function userDetails(row) {
            var user_id = row.querySelector('#user_id').innerHTML;
            window.location.href = '/ayarlar/' + user_id;
        }

        function checkHealth() {
            showSwal('<?php echo e(__("Okunuyor...")); ?>','info');
            request("<?php echo e(route('health_check')); ?>", new FormData(), function (success) {
                Swal.close();
                var json = JSON.parse(success);
                var box = $("#output");
                box.html("");
                for (var i = 0; i < json["message"].length; i++) {
                    var current = json["message"][i];
                    box.append("<div class='alert alert-" + current["type"] + "' role='alert'>" +
                        current["message"] +
                        "</div>");
                }

            }, function (error) {
                Swal.close();
                alert("hata");
            });
        }


        function saveDNS(form){
            return request('<?php echo e(route('set_liman_dns_servers')); ?>',form, function (success){
                var json = JSON.parse(success);
                showSwal(json["message"],'success',2000);
                setTimeout(() => {
                    getDNS();
                }, 1500);
            }, function(error){
                var json = JSON.parse(error);
                showSwal(json.message,'error',2000);
            });
        }

        function getDNS(){
            showSwal('<?php echo e(__("Okunuyor")); ?>','info');
            request('<?php echo e(route('get_liman_dns_servers')); ?>',new FormData(),function(success){
                var json = JSON.parse(success);
                $("#dns1").val(json["message"][0]);
                $("#dns2").val(json["message"][1]);
                $("#dns3").val(json["message"][2]);
                Swal.close();
            },function(error){
                var json = JSON.parse(error);
                showSwal(json.message,'error',2000);
            });
        }


        $('#add_user').on('shown.bs.modal', function (e) {
            $("#add_user button[type='submit']").removeAttr("disabled");
          })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /liman/server/resources/views/settings/index.blade.php ENDPATH**/ ?>