<div class="col-md-9">
    <div class="card">
        <div class="card-header p-2">
            <ul class="nav nav-tabs" role="tablist">
                <?php ($firstRendered = false); ?>
                <?php if(server()->canRunCommand() && server()->isLinux()): ?>
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="pill" onclick="getDashboard()" href="#usageTab" role="tab"><?php echo e(__("Sistem Durumu")); ?></a>
                    </li>
                    <?php ($firstRendered = true); ?>
                <?php endif; ?>
                <li class="nav-item">
                    <a class="nav-link <?php if(!$firstRendered): ?> active <?php endif; ?>" data-toggle="pill" href="#extensionsTab" role="tab"><?php echo e(__("Eklentiler")); ?></a>
                </li>
                <?php if(server()->canRunCommand() && server()->isLinux()): ?>
                    <?php if(\App\Models\Permission::can(user()->id,'liman','id','server_services')): ?>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" onclick="getServices()" href="#servicesTab" role="tab"><?php echo e(__("Servisler")); ?></a>
                        </li>
                    <?php endif; ?>
                    <?php if(server()->canRunCommand() && server()->isLinux()): ?>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" onclick="getPackages()" href="#packagesTab" role="tab"><?php echo e(__("Paketler")); ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" onclick="getUpdates()" href="#updatesTab" role="tab">
                                <?php echo e(__("Güncellemeler")); ?>

                                <small class="badge bg-danger updateCount" style="display:none;margin-left: 5px;">0</small>
                            </a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                              <?php echo e(__('Kullanıcı İşlemleri')); ?> <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 40px, 0px);">
                                <a class="dropdown-item" href="#usersTab" onclick="getLocalUsers()" data-toggle="tab"><?php echo e(__("Yerel Kullanıcılar")); ?></a>
                                <a class="dropdown-item" href="#groupsTab" onclick="getLocalGroups()" data-toggle="tab"><?php echo e(__("Yerel Gruplar")); ?></a>
                                <a class="dropdown-item" href="#sudoersTab" onclick="getSudoers()" data-toggle="tab"><?php echo e(__("Yetkili Kullanıcılar")); ?></a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" onclick="getOpenPorts()" href="#openPortsTab" role="tab"><?php echo e(__("Açık Portlar")); ?></a>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>
                <?php if(\App\Models\Permission::can(user()->id,'liman','id','view_logs')): ?>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#logsTab" onclick="getLogs()" role="tab"><?php echo e(__("Erişim Kayıtları")); ?></a>
                    </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#settingsTab" role="tab"><?php echo e(__("Sunucu Ayarları")); ?></a>
                </li>
                <?php echo serverModuleButtons(); ?>

            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content">
                <?php if(server()->canRunCommand() && server()->isLinux()): ?>
                    <div class="tab-pane fade show active" id="usageTab" role="tabpanel">
                        <div class="card card-primary charts-card">
                            <div class="card-header" style="background-color: #007bff; color: #fff;">
                                <h3 class="card-title"><?php echo e(__('Kaynak Kullanımı')); ?></h3>
                            </div>
                            <div class="card-body">
                                <div class="row justify-content-center">
                                    <div class="col-md-3">
                                        <canvas id="cpuChart"></canvas>
                                    </div>
                                    <div class="col-md-3">
                                        <canvas id="ramChart"></canvas>
                                    </div>
                                    <div class="col-md-3">
                                        <canvas id="networkChart"></canvas>
                                    </div>
                                    <div class="col-md-3">
                                        <canvas id="ioChart"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="overlay">
                                <div class="spinner-border" role="status">
                                    <span class="sr-only"><?php echo e(__('Yükleniyor...')); ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <?php echo $__env->make('table-card', [
                                    "title" => __("Cpu Kullanımı"),
                                    "api" => "top_cpu_processes"
                                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                            <div class="col-md-4">
                                <?php echo $__env->make('table-card', [
                                    "title" => __("Ram Kullanımı"),
                                    "api" => "top_memory_processes"
                                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                            <div class="col-md-4">
                                <?php echo $__env->make('table-card', [
                                    "title" => __("Disk Kullanımı"),
                                    "api" => "top_disk_usage"
                                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="tab-pane fade show <?php if(!$firstRendered): ?> active <?php endif; ?>" id="extensionsTab" role="tabpanel">
                    <?php if(auth()->user()->id == server()->user_id || auth()->user()->isAdmin()): ?>
                        <button class="btn btn-success" data-toggle="modal" data-target="#install_extension"><i
                                    data-toggle="tooltip" title="Ekle"
                                    class="fa fa-plus"></i></button>
                        <button onclick="removeExtension()" class="btn btn-danger"><i data-toggle="tooltip" title="Kaldır" class="fa fa-minus"></i>
                        </button><br><br>
                    <?php endif; ?>
                    <?php echo $__env->make('table',[
                        "id" => "installed_extensions",
                        "value" => $installed_extensions,
                        "title" => [
                            "Eklenti Adı" , "Versiyon", "Düzenlenme Tarihi", "*hidden*"
                        ],
                        "display" => [
                            "name" , "version", "updated_at","id:extension_id"
                        ],
                        "noInitialize" => "true"
                    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    
                </div>
                    <?php echo serverModuleViews(); ?>


                <?php if($server->canRunCommand()): ?>
                    <div class="tab-pane fade show" id="servicesTab" role="tabpanel"></div>
                    <div class="tab-pane fade show right" id="updatesTab" role="tabpanel">
                        <button type="button" style="display: none; margin-bottom: 5px;" class="btn btn-success updateAllPackages" onclick="updateAllPackages()"><?php echo e(__('Tümünü Güncelle')); ?></button>
                        <button type="button" style="display: none; margin-bottom: 5px;" class="btn btn-success updateSelectedPackages" onclick="updateSelectedPackages()"><?php echo e(__('Seçilenleri Güncelle')); ?></button>
                        <div id="updatesTabTable"></div>
                    </div>

                    <?php if($server->isLinux()): ?>
                            <div class="tab-pane fade show" id="packagesTab" role="tabpanel">
                                <button type="button" data-toggle="modal" data-target="#installPackage" style="margin-bottom: 5px;" class="btn btn-success">
                                    <i class="fas fa-upload"></i> <?php echo e(__('Paket Kur')); ?>

                                </button>
                                <div id="packages">

                                </div>
                            </div>

                            <div class="tab-pane fade show" id="usersTab" role="tabpanel">
                                <?php echo $__env->make('modal-button',[
                                    "class"     =>  "btn btn-success mb-2",
                                    "target_id" =>  "addLocalUser",
                                    "text"      =>  "Kullanıcı Ekle",
                                    "icon" => "fas fa-plus"
                                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <div id="users"></div>
                            </div>

                            <div class="tab-pane fade show" id="groupsTab" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-12">
                                        <?php echo $__env->make('modal-button',[
                                            "class"     =>  "btn btn-success mb-2",
                                            "target_id" =>  "addLocalGroup",
                                            "text"      =>  "Grup Ekle",
                                            "icon" => "fas fa-plus"
                                        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        <div id="groups"></div>
                                    </div>
                                    <div class="col-md-6 d-none">
                                        <?php echo $__env->make('modal-button',[
                                            "class"     =>  "btn btn-success mb-2",
                                            "target_id" =>  "addLocalGroupUserModal",
                                            "text"      =>  "Kullanıcı Ekle",
                                            "icon" => "fas fa-plus"
                                        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        <div id="groupUsers"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade show" id="sudoersTab" role="tabpanel">
                                <?php echo $__env->make('modal-button',[
                                    "class"     =>  "btn btn-success mb-2",
                                    "target_id" =>  "addSudoers",
                                    "text"      =>  "Tam Yetkili Kullanıcı Ekle",
                                    "icon" => "fas fa-plus"
                                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <div id="sudoers"></div>
                            </div>
                    <?php endif; ?>
                <?php endif; ?>
                <div class="tab-pane fade show" id="logsTab" role="tabpanel">
                    <div class="form-group">
                            <label><?php echo e(__('Arama Terimi')); ?></label>
                            <div class="input-group">
                                <input id="logQueryFilter" type="text" class="form-control" placeholder="<?php echo e(__('Arama Terimi')); ?>">
                                <span class="input-group-append">
                                    <button type="button" class="btn btn-primary btn-flat" onclick="getLogs()"><i class="fa fa-search" aria-hidden="true"></i></button>
                                </span>
                            </div>
                        </div>
                    <div id="logsWrapper">
                    </div>
                </div>
                <div class="tab-pane fade show" id="openPortsTab" role="tabpanel"> 
                </div>
                
                <div class="tab-pane fade show" id="settingsTab" role="tabpanel">
                    <form id="edit_form" onsubmit="return request('<?php echo e(route('server_update')); ?>',this,reload)" target="#">
                        <label><?php echo e(__("Sunucu Adı")); ?></label>
                        <input type="text" name="name" placeholder="Sunucu Adı" class="form-control mb-3" required=""
                                value="<?php echo e(server()->name); ?>">
                        <label><?php echo e(__("Kontrol Portu")); ?></label>
                        <input type="number" name="control_port" placeholder="Kontrol Portu" class="form-control mb-3"
                                required="" value="<?php echo e(server()->control_port); ?>">
                        <label><?php echo e(__("Ip Adresi")); ?></label>
                        <input type="text" name="ip_address" placeholder="Ip Adresi" class="form-control mb-3"
                                required="" value="<?php echo e(server()->ip_address); ?>">
                        <label><?php echo e(__("Şehir")); ?></label>
                        <select name="city" class="form-control mb-3" required="">
                            <?php $__currentLoopData = cities(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($value); ?>" <?php if($value == server()->city): ?> selected <?php endif; ?>><?php echo e($city); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    
                        <div class="row">
                            <div class="col">
                                <button type="submit" class="btn btn-success btn-block"><?php echo e(__("Bilgileri Güncelle")); ?></button>
                            </div>
                            <div class="col">
                            <?php echo $__env->make('modal-button',[
                                "class" => "btn-danger btn-block",
                                "target_id" => "delete",
                                "text" => "Sunucuyu Sil"
                            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div><?php /**PATH /liman/server/resources/views/server/one/one.blade.php ENDPATH**/ ?>