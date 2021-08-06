<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-6">
    <nav aria-label="breadcrumb" style="display:block; width: 100%;">
        <ol class="breadcrumb" style="float:left;">
            <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>"><?php echo e(__("Ana Sayfa")); ?></a></li>
            <li class="breadcrumb-item"><a href="<?php echo e(route('server_one', server()->id)); ?>"><?php echo e(server()->name); ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo e(server()->name); ?> <?php echo e(__(extension()->display_name)); ?> <?php echo e(__('eklentisi')); ?></li>
        </ol>
        
    </nav>
    </div>
    <div class="col-6">
        <div id="ext_menu" style="float:right;">
                <button data-toggle="tooltip" title="<?php echo e(__('Eklenti Ayarları')); ?>" class="btn btn-primary" onclick="window.location.href = '<?php echo e(route('extension_server_settings_page',[
                    "server_id" => server()->id,
                    "extension_id" => extension()->id
                ])); ?>'"><i class="fa fa-cogs"></i></button>
                <?php if(count($tokens) > 0): ?>
                <button data-toggle="tooltip" title="<?php echo e(__('Sorgu Oluştur')); ?>" class="btn btn-primary" onclick="showRequestRecords()"><i class="fa fa-book"></i></button>
                <?php endif; ?>
                <button data-toggle="tooltip" title="<?php echo e(__('Destek Al')); ?>" class="btn btn-primary" onclick="location.href = 'mailto:<?php echo e(env('APP_NOTIFICATION_EMAIL')); ?>?subject=<?php echo e(env('BRAND_NAME')); ?> <?php echo e(getVersion()); ?> - <?php echo e(extension()->display_name); ?> <?php echo e(extension()->version); ?>'"><i class="fas fa-headset"></i></button>
        </div>  
    </div>
</div>

<?php echo $__env->make('errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>    

<div class="card">
    <div class="card-body">
        <div class="tab-content">
            <div class="tab-pane fade show active" role="tabpanel" id="mainExtensionWrapper">
                <div class="spinner-grow text-primary"></div>
            </div>
        </div>
    </div>
</div>
<?php if(count($tokens) > 0): ?>
<div class="float" onclick="toggleRequestRecord()" id="requestRecordButton">
    <i class="fas fa-video my-float"></i>
</div>

<?php $__env->startComponent('modal-component',[
    "id" => "limanRequestsModal",
    "title" => "İstek Kayıtları"
]); ?>
<div class="limanRequestsWrapper">
    <div class="row">
        <div class="col-md-4">
        <ul class="list-group" id="limanRequestsList">
          
        </ul>
        </div>
        <div class="col-md-8">
            <p><?php echo e(__("Aşağıdaki komut ile Liman MYS'ye dışarıdan istek gönderebilirsiniz.Eğer SSL sertifikanız yoksa, komutun sonuna --insecure ekleyebilirsiniz.")); ?></p>
            <b><?php echo e(__("Bu sorgu içerisinde ve(ya) sonucunda kurumsal veriler bulunabilir, sorumluluk size aittir.")); ?></b>

            <div class="row">
                <div class="col-md-4" style="line-height: 2.25rem;"><?php echo e(__("Kullanılacak Kişisel Erişim Anahtarı")); ?></div>
                <div class="col-md-8">
                    <select id="limanRequestAccessToken" class="select2" onchange="clearCurlCommand()">
                        <?php $__currentLoopData = $tokens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $token): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($token['token']); ?>"><?php echo e($token['name']); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
            <pre id="limanRequestCurlOutput"></pre>
        </div>
    </div>
</div>
<?php echo $__env->renderComponent(); ?>
<style>

.float{
	position:fixed;
	width:30px;
	height:30px;
	bottom:20px;
	right:20px;
	background-color:grey;
	color:#FFF;
	border-radius:50px;
	text-align:center;
	box-shadow: 2px 2px 3px #999;
}

.my-float{
	line-height:30px;
    font-size : 15px;
}

pre {
    white-space: pre-wrap; 
    white-space: -moz-pre-wrap;
    white-space: -pre-wrap;
    white-space: -o-pre-wrap;
    word-wrap: break-word;
}
</style>

<script>
    function toggleRequestRecord(){
        var element = $("#requestRecordButton");
        limanRecordRequests = !limanRecordRequests;
        if(limanRecordRequests == true){
            element.css("backgroundColor","red");
        }else{
            element.css("backgroundColor","grey");
        }   
    }

    function showRequestRecords(){
        if(limanRequestList.length == 0){
            showSwal("Lütfen önce bir sorguyu kaydedin.","error",2000);
            return;
        }
        var listElement = $("#limanRequestsList");
        var modalElement = $("#limanRequestsModal");
        listElement.html("");
        $.each(limanRequestList, function(index, entries) {
            listElement.append("<li onclick='showCurlCommand(this," + index + ")' class='list-group-item liman-request-item'>" + entries["target"] +"</li>")
        });
        modalElement.modal('show');
    }

    function clearCurlCommand(){
        $("#limanRequestCurlOutput").text("");
        $(".liman-request-item").removeClass("active");
    }

    function showCurlCommand(element,index){
        $(".liman-request-item").removeClass("active");
        $(element).addClass("active");
        $("#limanRequestCurlOutput").text(limanRequestBuilder(index,$("#limanRequestAccessToken").val()));
    }
</script>
<?php endif; ?>
<script>
    $(function(){
        var list = [];
        $("#quickNavBar li>a").each(function(){
            list.push($(this).text());
        });
        if((new Set(list)).size !== list.length){
            
        }
    })
    function API(target)
    {
        return "<?php echo e(route('home')); ?>/extensionRun/" + target;
    }
    customRequestData["token"] = "<?php echo e($auth_token); ?>";
    customRequestData["locale"] = "<?php echo e(session()->get('locale')); ?>";
    request(API('<?php echo e(request('target_function') ? request('target_function') : 'index'); ?>'),new FormData(), function (success){
        $("#mainExtensionWrapper").html(success);
        window.onload();
        $('.modal').on('shown.bs.modal', function () {
            $(this).find(".alert").fadeOut();
        });
    },function (error){ 
        let json = JSON.parse(error);
        showSwal(json.message,'error',2000);
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /liman/server/resources/views/extension_pages/server.blade.php ENDPATH**/ ?>