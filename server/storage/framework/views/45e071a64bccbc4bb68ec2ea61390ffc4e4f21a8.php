<?php if(env('LIMAN_RESTRICTED') == true && !user()->isAdmin()): ?>
<nav class="main-header navbar navbar-expand navbar-dark" style="margin-left:0px;height:58.86px;border:0px;">
<ul class="navbar-nav"  style="line-height:60px;">
        <a href="/" class="brand-link">
            <img src="/images/limanlogo.png" height="30" style="opacity: .8;cursor:pointer;" title="Versiyon <?php echo e(getVersion()); ?>">
        </a>
<li class="nav-item d-none d-sm-inline-block">
              <a href="/" class="nav-link" style="padding-top: 0px;"><?php echo e(__("Ana Sayfa")); ?></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
              <a href="/ayarlar/<?php echo e(request('extension_id')); ?>/<?php echo e(request('server_id')); ?>" class="nav-link" style="padding-top: 0px;"><?php echo e(__("Ayarlar")); ?></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
              <a href="mailto:<?php echo e(env('APP_NOTIFICATION_EMAIL')); ?>?subject=<?php echo e(env('BRAND_NAME')); ?> <?php echo e(extension()->display_name); ?> <?php echo e(extension()->version); ?>" class="nav-link" style="padding-top: 0px;"><?php echo e(__("Destek Al")); ?></a>
            </li>
<?php else: ?>
<nav class="main-header navbar navbar-expand navbar-dark" style="height:58.86px;border:0px;"> <!-- exactly 58.86 :) -->
    <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-toggle="tooltip" title="<?php echo e(__('Menüyü gizle')); ?>" data-widget="pushmenu" href="#" onclick="collapseNav()"><i class="fas fa-bars"></i></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tooltip" title="<?php echo e(__('Karanlık mod')); ?>" onclick="toggleDarkMode()"><i id="darkModeIcon" class="fas fa-sun"></i></a>
          </li>
<?php endif; ?>
          <script>
            if(typeof currentlyDark != "undefined" && currentlyDark == true){
              setDarkMode();
            }

            function collapseNav(){
              $("#limanLogo").toggleClass("specialLogoMargin");
              request('<?php echo e(route('set_collapse')); ?>',new FormData(),null);
            }
          </script>
          <style>
            .specialLogoMargin{
              margin-left: -0.75rem;
            }
          </style>
          <li class="nav-item d-none d-md-block">
            <a href="/takip" class="nav-link" data-toggle="tooltip" title="<?php echo e(__('Sunucu Takibi')); ?>">
              <i class="nav-icon fas fa-grip-horizontal"></i>
            </a>
          </li>
          <li class="nav-item d-none d-md-block">
                <a href="/bilesenler" class="nav-link" data-toggle="tooltip" <?php if(request()->getRequestUri() == '/bilesenler'): ?>class="active"<?php endif; ?> title='<?php echo e(__("Bileşenler")); ?>'>
                      <i class="nav-icon fas fa-chart-pie"></i>
                </a>
          </li>
        </ul>
        <?php if(request('server') != null): ?>
        <ul class="mx-auto order-0 navbar-nav text-white d-md-block d-sm-none">
                <li style="font-weight:bolder;font-size:20px;cursor:pointer;" data-toggle="tooltip" data-original-title="<?php echo e(server()->ip_address); ?>" onclick="window.location.href = '<?php echo e(route('server_one',[
                    "server_id" => server()->id,
                ])); ?>'"><?php echo e(server()->name); ?></li>
            </ul>
        <?php endif; ?>
        <!-- Right navbar links -->
        <ul class="navbar-nav <?php if(request('server') == null): ?> ml-auto <?php endif; ?>">
          
          <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
              <?php if(session('locale') === "tr"): ?>
                TR
              <?php else: ?>
                EN
              <?php endif; ?>
            </a>
            <div class="dropdown-menu dropdown-menu-right p-0">
                <?php if(session('locale') === "tr"): ?>
                  <a href="<?php echo e(route('set_locale', ['locale' => 'en'])); ?>" class="dropdown-item active">
                    EN English
                  </a>
                <?php elseif(session('locale') === "en"): ?>
                  <a href="<?php echo e(route('set_locale', ['locale' => 'tr'])); ?>" class="dropdown-item active">
                    TR Türkçe
                  </a>
                <?php endif; ?>
            </div>
          </li>
          
          <!-- Notifications Dropdown Menu -->
          <?php if(user()->isAdmin()): ?>
            <li id="adminNotifications" class="nav-item dropdown">
              <?php echo $__env->make('notifications',["notifications" => adminNotifications(),"id" =>
              "adminNotifications","systemNotification" => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </li>
          <?php endif; ?>
        
          <li id="userNotifications" class="nav-item dropdown">
            <?php echo $__env->make('notifications',["notifications" => notifications()], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          </li>
          <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="fa fa-user mr-1"></i>
                    <span class="d-none d-sm-inline-block" title="<?php echo e(user()->name, 20); ?>"><?php echo e(str_limit(user()->name, 20)); ?></span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <div class="card card-widget widget-user-2" style="margin-bottom: 0px;">
                        <div class="widget-user-header bg-secondary" style="color:white">
                          <h3 class="widget-user-username" style="margin-left: 0px;" title="<?php echo e(user()->name, 20); ?>"><?php echo e(str_limit(user()->name, 20)); ?></h3>
                          <h5 class="widget-user-desc" style="margin-left: 0px;font-size: 13px;"><?php echo e(__("Son Giriş Tarihi : ") . \Carbon\Carbon::parse(user()->last_login_at)->isoFormat('LL')); ?></h5>
                          <h5 class="widget-user-desc" style="margin-left: 0px;font-size: 13px;"><?php echo e(__("Giriş Yapılan Son Ip : ") . user()->last_login_ip); ?></h5>
                          <h5 class="widget-user-desc" style="margin-left: 0px;font-size: 13px;"><?php echo e(__("Bağlı Liman : ") . getLimanHostname()); ?></h5>
                          <h5 class="widget-user-desc" style="margin-left: 0px;font-size: 11px;"><?php echo e(__("Liman ID: ") . getLimanId()); ?></h5>
                        </div>
                        <div class="card-footer p-0">
                          <ul class="nav flex-column" style="cursor:pointer;">
                          <?php if(auth()->user()->isAdmin()): ?>
                            <li class="nav-item">
                              <a href="/talepler" class="nav-link text-dark">
                              <i class="nav-icon fas fa-plus mr-1"></i>
                              <?php echo e(__("Yetki Talepleri")); ?>

                              <?php if(\App\Models\LimanRequest::where('status',0)->count()): ?>
                              <span class="badge badge-info right"><?php echo e(\App\Models\LimanRequest::where('status',0)->count()); ?></span>
                              <?php endif; ?>
                              </a>
                            </li>
                          <?php else: ?> 
                          <li class="nav-item">
                            <a href="/taleplerim" class="nav-link text-dark">
                              <i class="nav-icon fas fa-key mr-1"></i>
                              <?php echo e(__("Yetki Talebi")); ?>

                            </a>
                          </li>
                          <?php endif; ?>
                            <li class="nav-item">
                              <a href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link text-dark">
                                <?php echo e(__("Çıkış Yap")); ?>	&nbsp;<i class="fas fa-sign-out-alt"></i>
                              </a>
                              <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                  <?php echo csrf_field(); ?>
                              </form>
                            </li>
                          </ul>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
      </nav>

<?php /**PATH /liman/server/resources/views/layouts/navbar.blade.php ENDPATH**/ ?>