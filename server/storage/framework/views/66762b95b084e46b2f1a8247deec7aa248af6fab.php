<?php $__env->startComponent('modal-component',[
        "id"=>"installPackage",
        "title" => "Paket Kur",
        "footer" => [
            "class" => "btn-success",
            "onclick" => "installPackageButton()",
            "text" => "Kur"
        ],
    ]); ?>
    <ul class="nav nav-pills" role="tablist" style="margin-bottom: 15px;">
        <li class="nav-item">
            <a class="nav-link active" href="#fromRepo" data-toggle="tab"><?php echo e(__("Depodan Yükle")); ?></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#fromDeb" data-toggle="tab"><?php echo e(__("Paket Yükle (.deb)")); ?></a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade show active" id="fromRepo" role="tabpanel">
            <?php echo $__env->make('inputs', [
                'inputs' => [
                    "Paketin Adı" => "package:text:Paketin depodaki adını giriniz. Örneğin: chromium",
                ]
            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <div class="tab-pane fade show" id="fromDeb" role="tabpanel">
            <?php echo $__env->make('file-input', [
                'title' => 'Deb Paketi',
                'name' => 'debUpload',
                'callback' => 'onDebUploadSuccess'
            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
    <?php echo $__env->renderComponent(); ?>

    <?php echo $__env->make('modal',[
        "id"=>"delete",
        "title" => "Sunucuyu Sil",
        "url" => route('server_remove'),
        "text" => "$server->name isimli sunucuyu silmek istediğinize emin misiniz? Bu işlem geri alınamayacaktır.",
        "type" => "danger",
        "next" => "redirect",
        "submit_text" => "Sunucuyu Sil"
    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('modal',[
        "id"=>"delete_extensions",
        "title" => "Eklentileri Sil",
        "text" => "Seçili eklentileri silmek istediğinize emin misiniz?",
        "type" => "danger",
        "onsubmit" => "removeExtensionFunc",
        "submit_text" => "Eklentileri Sil"
    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('modal',[
        "id"=>"addLocalUser",
        "title" => "Kullanıcı Ekle",
        "url" => route('server_add_local_user'),
        "next" => "reload",
        "inputs" => [
            "İsim" => "user_name:text",
            "Şifre" => "user_password:password",
            "Şifre Onayı" => "user_password_confirmation:password"
        ],
        "submit_text" => "Kullanıcı Ekle"
    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('modal',[
        "id"=>"addSudoers",
        "title" => "Tam Yetkili Kullanıcı Ekle",
        "url" => route('server_add_sudoers'),
        "next" => "getSudoers",
        "inputs" => [
            "İsim" => "name:text:Grup veya kullanıcı ekleyebilirsiniz. Örneğin: kullanıcı adı veya %grupadı"
        ],
        "submit_text" => "Grup Ekle"
    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('modal',[
        "id"=>"addLocalGroup",
        "title" => "Grup Ekle",
        "url" => route('server_add_local_group'),
        "next" => "reload",
        "inputs" => [
            "İsim" => "group_name:text"
        ],
        "submit_text" => "Grup Ekle"
    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php $__env->startComponent('modal-component',[
        "id"=>"addLocalGroupUserModal",
        "title" => "Gruba Kullanıcı Ekle",
        "submit_text" => "Ekle",
        "footer" => [
            "class" => "btn-success",
            "onclick" => "addLocalGroupUser()",
            "text" => "Ekle"
        ],
    ]); ?>
        <?php echo $__env->make('inputs', [
            "inputs" => [
                "İsim" => "user:text"
            ],
        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->renderComponent(); ?>


    <?php echo $__env->make('modal',[
        "id"=>"startService",
        "title" => "Servisi Başlat",
        "text" => "Seçili servisi başlatmak istediğinize emin misiniz?",
        "type" => "danger",
        "next" => "reload",
        "inputs" => [
            "name:-" => "name:hidden",
        ],
        "url" => route('server_start_service'),
        "submit_text" => "Servisi Başlat"
    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('modal',[
        "id"=>"stopService",
        "title" => "Servisi Durdur",
        "text" => "Seçili servisi durdurmak istediğinize emin misiniz?",
        "type" => "danger",
        "next" => "reload",
        "inputs" => [
            "name:-" => "name:hidden",
        ],
        "url" => route('server_stop_service'),
        "submit_text" => "Servisi Durdur"
    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('modal',[
        "id"=>"restartService",
        "title" => "Servisi Yeniden Başlat",
        "text" => "Seçili servisi yeniden başlatmak istediğinize emin misiniz?",
        "type" => "danger",
        "next" => "reload",
        "inputs" => [
            "name:-" => "name:hidden",
        ],
        "url" => route('server_restart_service'),
        "submit_text" => "Servisi Yeniden Başlat"
    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('modal',[
        "id"=>"file_upload",
        "title" => "Dosya Yükle",
        "url" => route('server_upload'),
        "next" => "nothing",
        "inputs" => [
            "Yüklenecek Dosya" => "file:file",
            "Yol" => "path:text",
        ],
        "submit_text" => "Yükle"
    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('modal',[
        "id"=>"file_download",
        "onsubmit" => "downloadFile",
        "title" => "Dosya İndir",
        "next" => "",
        "inputs" => [
            "Yol" => "path:text",
        ],
        "submit_text" => "İndir"
    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('modal-table',[
        "id" => "log_table",
        "title" => "Sunucu Logları",
        "table" => [
            "value" => [],
            "title" => [
                "Komut" , "User ID", "Tarih", "*hidden*"
            ],
            "display" => [
                "command" , "username", "created_at", "_id:_id"
            ],
            "onclick" => "logDetails"
        ]
    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php if(count($input_extensions)): ?>
        <?php $__env->startComponent('modal-component',[
            "id"=>"install_extension",
            "title" => "Eklenti Ekle",
            "footer" => [
                "class" => "btn-success",
                "onclick" => "server_extension()",
                "text" => "Ekle"
            ],
        ]); ?>
            <?php echo $__env->make('table', [
                "value" => $input_extensions,
                "noInitialize" => true,
                "title" => [
                    "Eklenti", "*hidden*"
                ],
                "display" => [
                    "name", "id:id"
                ]
            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->renderComponent(); ?>
    <?php else: ?>
        <script>
        $("button[data-target='#install_extension']").click(function(){
            showSwal("<?php echo e(__('Seçilebilir herhangi bir eklenti bulunmamaktadır!')); ?>",'error',2000);
        });
        </script>
    <?php endif; ?>

    <?php $__env->startComponent('modal-component',[
        "id" => "updateLogs",
        "title" => "Paket Yükleme Günlüğü"
    ]); ?>
        <pre style='height: 500px; font-family: "Menlo", "DejaVu Sans Mono", "Liberation Mono", "Consolas", "Ubuntu Mono", "Courier New", "andale mono", "lucida console", monospace;'>
            <code class="updateLogsBody"></code>
        </pre>
        <p class="progress-info"><p>
        <div class="progress progress-sm active">
            <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                <span class="sr-only progress-info"></span>
            </div>
        </div>
    <?php echo $__env->renderComponent(); ?>

    <?php $__env->startComponent('modal-component',[
        "id" => "serviceStatusModal",
        "title" => "Servis Durumu"
    ]); ?>
        <pre id="serviceStatusWrapper"></pre>
    <?php echo $__env->renderComponent(); ?>

    <?php $__env->startComponent('modal-component',[
        "id"=>"logDetailModal",
        "title" => "Log Detayı"
    ]); ?>
    <div class="row">
        <div class="col-4">
            <div class="list-group" role="tablist" id="logTitleWrapper">
            </div>
        </div>
        <div class="col-8">
            <div class="tab-content" id="logContentWrapper">
            </div>
        </div>
    </div>
    <?php echo $__env->renderComponent(); ?><?php /**PATH /liman/server/resources/views/server/one/general/modals.blade.php ENDPATH**/ ?>