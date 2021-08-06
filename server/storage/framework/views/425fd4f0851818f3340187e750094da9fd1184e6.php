<?php $__env->startSection('content'); ?>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page"><a href="<?php echo e(route('home')); ?>"><?php echo e(__("Ana Sayfa")); ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo e(__("Profilim")); ?></li>
        </ol>
    </nav>
    <?php echo $__env->make('errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="row">
        <div class="col-md-3">
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <h3 class="profile-username text-center font-weight-bold"><?php echo e(auth()->user()->name); ?></h3>
                <p class="text-muted text-center mb-0"><?php echo e(auth()->user()->email); ?></p>
              </div>
            </div>
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><?php echo e(__('Bilgiler')); ?></h3>
              </div>
              <div class="card-body">
                <strong><?php echo e(__('Son Giriş Yapılan IP')); ?></strong>
                <p class="text-muted"><?php echo e(auth()->user()->last_login_ip); ?></p>
                <hr>
                <strong><?php echo e(__('Son Giriş Tarihi')); ?></strong>
                <p class="text-muted"><?php echo e(\Carbon\Carbon::parse(auth()->user()->last_login_at)->isoFormat('LL')); ?></p>
              </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <form class="form-horizontal" onsubmit="return saveUser(this)">
                        <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label"><?php echo e(__("İsim Soyisim")); ?></label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputName" name="name" value="<?php echo e(auth()->user()->name); ?>" required minlength="6" maxlength="255" <?php if(user()->auth_type == "ldap"): ?> disabled <?php endif; ?>>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail" class="col-sm-2 col-form-label"><?php echo e(__("Email Adresi")); ?></label>
                            <div class="col-sm-10">
                            <input type="email" class="form-control" id="inputEmail" value="<?php echo e(auth()->user()->email); ?>" disabled required <?php if(user()->auth_type == "ldap"): ?> disabled <?php endif; ?>>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputOldPassword" class="col-sm-2 col-form-label"><?php echo e(__("Eski Parola")); ?></label>
                            <div class="col-sm-10">
                            <input type="password" class="form-control" id="inputOldPassword" name="old_password" required minlength="10" maxlength="32" <?php if(user()->auth_type == "ldap"): ?> disabled <?php endif; ?>>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-2 col-form-label"><?php echo e(__("Parola")); ?></label>
                            <div class="col-sm-10">
                            <input type="password" class="form-control" id="inputPassword" name="password" minlength="10" maxlength="32" <?php if(user()->auth_type == "ldap"): ?> disabled <?php endif; ?>>
                            <small><?php echo e(__("Yeni parolanız en az 10 karakter uzunluğunda olmalı ve en az 1 sayı,özel karakter ve büyük harf içermelidir.")); ?></small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPasswordConfirmation" class="col-sm-2 col-form-label"><?php echo e(__("Parola Onayı")); ?></label>
                            <div class="col-sm-10">
                            <input type="password" class="form-control" id="inputPasswordConfirmation" name="password_confirmation" minlength="10" maxlength="32" <?php if(user()->auth_type == "ldap"): ?> disabled <?php endif; ?>>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="offset-sm-2 col-sm-10">
                            <button type="submit" class="btn btn-danger" <?php if(user()->auth_type == "ldap"): ?> disabled <?php endif; ?>><?php echo e(__("Kaydet")); ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('input[type=password]').keyup(function(){
            var password = $('input[name=password]').val();
            var password_confirmation = $('input[name=password_confirmation]').val();
            $('.no-match').remove();
            if(password_confirmation!=="" && password !== password_confirmation){
                $('input[name=password_confirmation]').after('<span style="color: #dd4b39;" class="help-block no-match">Şifreler uyuşmuyor</span>');
            }
        });
        function saveUser(data) {
            showSwal('<?php echo e(__("Kaydediliyor...")); ?>','info');
            var form = new FormData(data);
            request('<?php echo e(route('profile_update')); ?>',form,function (response) {
                Swal.close();
                var json = JSON.parse(response);
                if(json["status"] === 200){
                    showSwal(json.message,'success',2000);
                    setTimeout(function () {
                        location.reload();
                    },1600);
                }
            },function (response) {
                var json = JSON.parse(response);
                showSwal(json.message,'error',2000);
            });
            return false;

        }
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /liman/server/resources/views/user/self.blade.php ENDPATH**/ ?>