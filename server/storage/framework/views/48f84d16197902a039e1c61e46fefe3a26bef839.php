<!DOCTYPE html>
<html lang="<?php echo e(session('locale')); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo e(__("Liman Merkezi Yönetim Sistemi")); ?></title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo e(mix('/css/liman.css')); ?>">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta name="server_id" content="<?php echo e(request('server_id') ? request('server_id') : ''); ?>">
    <meta name="extension_id" content="<?php echo e(request('extension_id') ? request('extension_id') : ''); ?>">
</head>
<div class="il-isimleri"></div>
<body class="hold-transition <?php echo $__env->yieldContent('body_class'); ?>">
<script>
    var module = { };
</script>
<script src="<?php echo e(mix('/js/liman.js')); ?>"></script>
<!-- Admin Password Recovery : https://www.youtube.com/watch?v=dQw4w9WgXcQ -->
<?php if(auth()->check()): ?>
<script>
    toastr.options.closeButton = true;
    Echo.private('App.User.<?php echo e(auth()->user()->id); ?>')
        .notification((notification) => {
            var data = notification['\u0000*\u0000attributes'];
            if(data){
                var errors = [
                    "error" , "health_problem"
                ];
                if(errors.includes(data.type)){
                    toastElement = toastr.error(data.message, data.title, {timeOut: 5000});
                }else if(data.type == "liman_update"){
                    toastElement = toastr.warning(data.message, data.title, {timeOut: 5000})
                }else{
                    toastElement = toastr.success(data.message, data.title, {timeOut: 5000})
                }
                var displayedNots = [];

                if(localStorage.displayedNots){
                    displayedNots = JSON.parse(localStorage.displayedNots);
                } 
                displayedNots.push(data.id);
                localStorage.displayedNots = JSON.stringify(displayedNots);
                
                $(toastElement).click(function(){
                    window.location.href = "/bildirim/" + data.id;
                });
            }
            checkNotifications(data ? data.id : null);
    });

    function dataTablePresets(type){
        if(type == "normal"){
            return {
                bFilter: true,
                "language" : {
                    url : "<?php echo e(__("/turkce.json")); ?>"
                }
            };
        }else if(type == "multiple"){
            return {
                bFilter: true,
                select: {
                    style: 'multi',
                    selector: 'td:not(.table-menu)'
                },
                dom: 'Blfrtip',
                buttons: {
                    buttons: [
                        { extend: 'selectAll', className: 'btn btn-xs btn-primary mr-1' },
                        { extend: 'selectNone', className: 'btn btn-xs btn-primary mr-1' }
                    ],
                    dom: {
                        button: { className: 'btn' }
                    }
                },
                language: {
                    url : "<?php echo e(__("/turkce.json")); ?>",
                    buttons: {
                        selectAll: "<?php echo e(__('Tümünü Seç')); ?>",
                        selectNone: "<?php echo e(__('Tümünü Kaldır')); ?>"
                    }
                }
            };
        }
    }
</script>
<?php endif; ?>
<?php echo $__env->yieldContent('body'); ?>

</body>
<script>
    window.onload = function () {
        $(".dropdown-menu").on('click', 'a.dropdown-item', function(){
            $(this).closest('.dropdown').find('.dropdown-toggle').html($(this).html() + '<span class="caret"></span>');
        });
        $(".nav.nav-tabs a").on('click',function () {
            window.location.hash = $(this).attr("href");
        });
        initialPresets();
        navigateButtons();
        activeTab();
        var title = $(".breadcrumb-item.active").text();
        if(title != ""){
            document.title = title + " / Liman";
        }
        <?php if(auth()->check()): ?>
            checkNotifications();
        <?php endif; ?>

        $('.ext_nav').slice(<?php echo e(getExtensionViewCount()); ?>, $('.ext_nav').length).hide();
        $('.ext_nav_more_less').click(function(){
            if ($('.ext_nav').length == $('.ext_nav:visible').length) {
                $('.ext_nav_more_less').find('p').text("<?php echo e(__('...daha fazla')); ?>");
                $('.ext_nav').slice(<?php echo e(getExtensionViewCount()); ?>, $('.ext_nav').length).hide();
            }else{
                $('.ext_nav_more_less').find('p').text("<?php echo e(__('daha az...')); ?>");
                $('.ext_nav:hidden').show();
            }
        });
    };

    function initialPresets(){
        $('table').not('.notDataTable').DataTable({
            autoFill : true,
            bFilter: true,
            destroy: true,
            "language" : {
                url : "<?php echo e(asset(__('/turkce.json'))); ?>"
            }
        });
        $('.js-example-basic-multiple,.js-example-basic-single,.select2').select2({
            width: 'resolve',
            theme: 'bootstrap4',
        });
        $(":input").inputmask();
    }

    function navigateButtons(){
        jQuery(function($) {
            var path = window.location.href;
            $('nav ul a').each(function() {
                if (this.href === path) {
                    $(this).addClass('active');
                }else if(!$(this).hasClass("extension-link")){
                    $(this).removeClass('active')
                }
            });
            $('.list-group a').each(function() {
                if (this.href === path) {
                    $(this).addClass('active');
                }else{
                    $(this).removeClass('active')
                }
            });
            if(localStorage.nightMode === "on"){
                $('body').addClass('skin-dark');
            }
        });
    }
</script>
</html>
<?php /**PATH /liman/server/resources/views/layouts/master.blade.php ENDPATH**/ ?>