<!-- Content Wrapper. Contains page content -->
<?php if(!request('partialRequest')): ?>
<div class="content-wrapper">
<?php endif; ?>
    <?php if(auth()->check() && user()->email == "administrator@liman.dev"): ?>
    <div class="alert alert-danger customAlert">
        <i class="fas fa-heart-broken mr-1"></i><?php echo e(__("Tam yetkili ana yönetici hesabı ile giriş yaptınız, sisteme zarar verebilirsiniz.")); ?> <a href="/ayarlar#users"><?php echo e(__('Yeni bir hesap oluşturup, yetkilendirmeleri ayarlamanızı tavsiye ederiz.')); ?></a>
    </div>
    <?php endif; ?>
    <!-- Content Header (Page header) -->
    <?php if(trim($__env->yieldContent('content_header'))): ?>
        <div class="content-header">
            <?php echo $__env->yieldContent('content_header'); ?>
        </div>
    <?php endif; ?>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid <?php if(auth()->check() && user()->email != 'administrator@liman.dev'): ?> pt-4 <?php endif; ?>">
            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </section>
<?php if(!request('partialRequest')): ?>
</div>
<?php endif; ?>
<!-- /.content-wrapper --><?php /**PATH /liman/server/resources/views/layouts/content.blade.php ENDPATH**/ ?>