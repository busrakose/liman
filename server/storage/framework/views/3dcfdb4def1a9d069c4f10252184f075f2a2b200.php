<?php $__env->startSection('content'); ?>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>"><?php echo e(__("Ana Sayfa")); ?></a></li>
            <li class="breadcrumb-item"><a href="<?php echo e(route('servers')); ?>"><?php echo e(__("Sunucular")); ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo e($server->name); ?></li>
        </ol>
    </nav>
    
    <div class="row mb-2 serverName">
        <div class="col-auto align-self-center">
            <?php if($favorite): ?>
                <button onclick="favorite('false')" class="btn btn-warning btn-sm" data-toggle="tooltip" title="Sabitlemeyi kaldır">
                    <i class="fas fa-thumbtack"></i>
                </button>
            <?php else: ?>
                <button onclick="favorite('true')" class="btn btn-success btn-sm" data-toggle="tooltip" title="Sunucuyu sabitle">
                    <i class="fas fa-thumbtack"></i>
                </button>
            <?php endif; ?>
        </div>
        <div class="col-auto align-self-center">
            <h5 class="font-weight-bold pt-2"><?php echo e($server->name); ?></h5>
        </div>
    </div>

    <?php echo $__env->make('errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php if(count(server()->extensions()) < 1): ?>
    <div class="alert alert-success alert-dismissible">
        <h5><i class="icon fas fa-smile-beam"></i> <?php echo e(__("Tavsiye")); ?></h5>
        <?php if(session('locale') == "tr"): ?>
        Bu sunucuya hiç eklenti eklememişsiniz. Limanı daha verimli kullanabilmek için <a data-toggle='pill' href='#extensionsTab' role='tab'><i class='fas fa-plug'></i> eklentiler</a> sekmesinden eklenti ekleyebilirsiniz veya <a href='/market'><i class='fas fa-shopping-cart'></i> eklenti mağazamızı</a> kullanarak açık kaynaklı eklentileri tek tuş ile yükleyebilirsiniz.
        <?php else: ?>
        You haven't added any extensions on this server. For using Liman more effectively add<a data-toggle='pill' href='#extensionsTab' role='tab'><i class='fas fa-plug'></i> extensions</a> or download and install with one click from our <a href='/market'><i class='fas fa-shopping-cart'></i> extension store</a>
        <?php endif; ?>
    </div>
    <?php endif; ?>

    <div class="row">
        <?php echo $__env->make('server.one.general.details',["shell" => false], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php echo $__env->make('server.one.one', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    </div>

    <?php echo $__env->make('server.one.general.modals', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('server.one.general.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /liman/server/resources/views/server/one/main.blade.php ENDPATH**/ ?>