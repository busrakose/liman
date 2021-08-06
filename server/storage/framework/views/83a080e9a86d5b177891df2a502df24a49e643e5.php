<?php echo $__env->make('layouts.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="/" class="brand-link">
            <img id="limanLogo" src="/images/limanlogo_hq.png" height="20" style="opacity: .8;cursor:pointer;" title="Versiyon <?php echo e(getVersion() . ' Build : ' . getVersionCode()); ?>">
        </a>
        <!-- Sidebar -->
        <div class="sidebar">  
          <!-- Sidebar Search -->
          <div id="liman_search" autocomplete="off">
            <div class="form-group has-search">
                <span class="fa fa-search form-control-feedback"></span>
                <input autocomplete="off" autocomplete="" type="text" id="liman_search_input" class="form-control" placeholder="<?php echo e(__('Arama')); ?>" name="search_query">
            </div> 
            <div id="liman_search_results">

            </div>
          </div>
          <!-- Sidebar Menu -->
          <nav>
            <ul id="liman-sidebar" class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <?php if(count($SERVERS)): ?>
                <li class="nav-header"><?php echo e(__("Sunucular")); ?></li>
                <?php endif; ?>
                <?php $__currentLoopData = $USER_FAVORITES; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $server): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="nav-item has-treeview <?php if(request('server_id') == $server->id): ?> menu-open <?php endif; ?>">
                    <a href="#" class="nav-link <?php if(request('server_id') == $server->id): ?> active <?php endif; ?>">
                        <i class="fab <?php echo e($server->isLinux() ? 'fa-linux' : 'fa-windows'); ?> nav-icon" style="font-weight: 400"></i>
                        <p>
                            <?php echo e($server->name); ?>

                            <i class="right fas fa-angle-right"></i>
                            <i class="fas fa-thumbtack right mr-3 mt-1" style="font-size: 14px; transform: none!important"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" <?php if(request('server_id') == $server->id): ?> style="display: block;" <?php endif; ?>>
                        <li class="nav-item">
                            <a href="/sunucular/<?php echo e($server->id); ?>" class="nav-link">
                                <i class="fa fa-info nav-icon"></i>
                                <p><?php echo e(__("Sunucu Detayları")); ?></p>
                            </a>
                        </li>
                        <?php $__currentLoopData = $server->extensions(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $extension): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="nav-item">
                            <a href='/l/<?php echo e($extension->id); ?>/<?php echo e($server->city); ?>/<?php echo e($server->id); ?>' class="nav-link <?php if(request('extension_id') == $extension->id): ?> active <?php endif; ?>">
                                <i class="nav-icon <?php echo e(empty($extension->icon) ? 'fab fa-etsy' : 'fas fa-'.$extension->icon); ?>"></i>
                                <p><?php echo e(__($extension->display_name)); ?></p>
                            </a>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php $__currentLoopData = $SERVERS; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $server): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="nav-item has-treeview <?php if(request('server_id') == $server->id): ?> menu-open <?php endif; ?>">
                    <a href="#" class="nav-link <?php if(request('server_id') == $server->id): ?> active <?php endif; ?>">
                        <i class="fab <?php echo e($server->isLinux() ? 'fa-linux' : 'fa-windows'); ?> nav-icon" style="font-weight: 400"></i>
                        <p>
                            <?php echo e($server->name); ?>

                            <i class="right fas fa-angle-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" <?php if(request('server_id') == $server->id): ?> style="display: block;" <?php endif; ?>>
                        <li class="nav-item">
                            <a href="/sunucular/<?php echo e($server->id); ?>" class="nav-link">
                                <i class="fa fa-info nav-icon"></i>
                                <p><?php echo e(__("Sunucu Detayları")); ?></p>
                            </a>
                        </li>
                        <?php $__currentLoopData = $server->extensions(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $extension): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="nav-item">
                            <a href='/l/<?php echo e($extension->id); ?>/<?php echo e($server->city); ?>/<?php echo e($server->id); ?>' class="nav-link <?php if(request('extension_id') == $extension->id): ?> active <?php endif; ?>">
                                <i class="nav-icon <?php echo e(empty($extension->icon) ? 'fab fa-etsy' : 'fas fa-'.$extension->icon); ?>"></i>
                                <p><?php echo e(__($extension->display_name)); ?></p>
                            </a>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php if(count($SERVERS) > 0): ?> 
                <li class="nav-item">
                <a href='/sunucular' class="nav-link">
                    <i class="nav-icon fas fa-ellipsis-h"></i>
                    <p><?php echo e(__("Tüm sunucuları gör")); ?></p>
                </a>
                 </li>
                <?php else: ?>
                    <?php if(!user()->isAdmin()): ?>
                    <li class="nav-item">
                        <p style="color: #e2e8f0; padding: 10px 20px; font-weight: 600;">
                        <?php echo e(__('Henüz yetkilendirildiğiniz')); ?> <br><?php echo e(__('bir sunucu mevcut değil.')); ?><br><br>
                        <?php echo e(__('Sistem yöneticinize başvurun.')); ?>

                        </p>
                    </li>
                    <?php else: ?>
                    <li class="nav-item">
                    <a href='/sunucular' class="nav-link">
                        <i class="nav-icon fas fa-plus"></i>
                        <p><?php echo e(__("Sunucu ekle")); ?></p>
                    </a>
                    </li>

                    <li class="nav-item">
                        <p style="color: #e2e8f0; padding: 10px 20px; font-weight: 600;">
                        <?php echo e(__('Liman kullanmaya başlamak için')); ?><br> <?php echo e(__('yukarıdan sunucu ekleyin.')); ?>

                        </p>
                    </li>
                    <?php endif; ?>
                <?php endif; ?>
            </ul>
          </nav>
          
          <!-- /.sidebar-menu -->
        </div>
        <div class="sidebar-bottom">
            <div class="container">
                <div class="row">
                    <?php if(auth()->user()->isAdmin()): ?>
                    <div class="col">
                        <a href="/ayarlar" data-toggle="tooltip" <?php if(request()->getRequestUri() == '/ayarlar'): ?>class="active"<?php endif; ?> title='<?php echo e(__("Sistem Ayarları")); ?>'>
                            <i class="nav-icon fas fa-cog"></i>
                        </a>
                    </div>
                    <?php endif; ?>
                    <div class="col">
                        <a href="/profil" data-toggle="tooltip" <?php if(request()->getRequestUri() == '/profil'): ?>class="active"<?php endif; ?> title='<?php echo e(__("Profil")); ?>'>
                            <i class="nav-icon fas fa-user"></i>
                        </a>
                    </div>
                    <?php if(auth()->user()->isAdmin()): ?>
                    <div class="col">
                        <a href="<?php echo e(route('market')); ?>" data-toggle="tooltip" <?php if(str_contains(request()->getRequestUri(), "market")): ?>class="active"<?php endif; ?> title='<?php echo e(__("Eklenti Mağazası")); ?>'>
                            <i class="nav-icon fas fa-shopping-cart"></i>
                        </a>
                    </div>
                    <?php endif; ?>
                    <div class="col">
                        <a href="/kasa" data-toggle="tooltip" <?php if(request()->getRequestUri() == '/kasa'): ?>class="active"<?php endif; ?> title='<?php echo e(__("Kasa")); ?>'>
                            <i class="nav-icon fas fa-wallet"></i>
                        </a>
                    </div>
                    <div class="col">
                        <a href="/profil/anahtarlarim" data-toggle="tooltip" <?php if(request()->getRequestUri() == '/profil/anahtarlarim'): ?>class="active"<?php endif; ?> title='<?php echo e(__("Erişim Anahtarları")); ?>'>
                            <i class="nav-icon fas fa-user-secret"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.sidebar -->
      </aside><?php /**PATH /liman/server/resources/views/layouts/header.blade.php ENDPATH**/ ?>