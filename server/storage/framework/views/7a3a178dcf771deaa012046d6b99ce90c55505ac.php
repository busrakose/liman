<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo e(__("Liman Merkezi Yönetim Sistemi")); ?></title>

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="<?php echo e(mix('/css/liman.css')); ?>">
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('css/auth.css')); ?>">
</head>

<body>
  <script>
      var module = { };
  </script>
  <script src="<?php echo e(mix('/js/liman.js')); ?>"></script>
  <div class="container-fluid">
    <div class="row">
      <div class="col-4 auth-bg">
        <div class="flex items-center justify-center" style="height: 100vh; flex-direction: column;">
          <a href="https://liman.havelsan.com.tr">
              <img class="mx-auto h-12 w-auto" src="<?php echo e(asset('images/limanlogo.png')); ?>" alt="Liman MYS">
            </a>
            <h6 style="color: #fff"><?php echo e(env("BRAND_NAME")); ?></h6>
        </div>
      </div>
      <div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8 col-8">
        <div class="max-w-md w-full space-y-8">
          <?php if($errors->count() > 0 ): ?>
              <div class="alert alert-danger">
                  <?php echo e($errors->first()); ?>

              </div>
          <?php endif; ?>
          <?php if(session('warning')): ?>
              <div class="alert alert-warning">
                  <?php echo e(session('warning')); ?>

              </div>
          <?php endif; ?>
          <?php if(session('status')): ?>
              <div class="alert alert-success">
                  <?php echo e(session('status')); ?>

              </div>
          <?php endif; ?>
          <div>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
              <?php echo e(__('Hesabınıza giriş yapın')); ?>

            </h2>
          </div>
          <form class="mt-8 space-y-6" action="<?php echo e(route('login')); ?>" method="post" autocomplete="off">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="remember" value="true">
            <div class="rounded-md shadow-sm -space-y-px">
              <div>
                <label for="email-address" class="sr-only"><?php echo e(__('Email Adresi')); ?></label>
                <input  id="email-address" name="liman_email_mert" type="email" autocomplete="email" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="<?php echo e(__('Email Adresi')); ?>" value="<?php echo e(old('liman_email_mert')); ?>">
              </div>
              <div>
                <label for="password" class="sr-only"><?php echo e(__('Parola')); ?></label>
                <input id="password" name="liman_password_baran" type="password" autocomplete="current-password" required class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="<?php echo e(__('Parola')); ?>">
              </div>
            </div>
            <?php if(!env('EXTENSION_DEVELOPER_MODE')): ?>
            <div class="input-group mb-3">
                    <button class="group relative justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" type="button" onclick="getCaptcha()">
                        <span class="fas fa-sync text-indigo-500 group-hover:text-indigo-400"></span>
                    </button>
                <div class="rounded" id="captcha">
                    <?php echo captcha_img(); ?>

                </div>
                <input id="captcha_field" autocomplete="off" type="text" name="captcha" class="appearance-none shadow-sm rounded relative block px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 sm:text-sm <?php echo e($errors->has('captcha') ? 'is-invalid' : ''); ?>" placeholder="<?php echo e(__("Doğrulama")); ?>" value="<?php echo e(old('captcha')); ?>" required>
            </div>
            <?php endif; ?>
            <div class="flex items-center justify-between">
              <div class="flex items-center">
                <input id="remember_me" name="remember" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                <label for="remember_me" class="ml-2 block text-sm text-gray-900" style="margin-top: 7px; font-weight: 400!important">
                  <?php echo e(__("Beni Hatırla")); ?>

                </label>
              </div>
            </div>

            <div>
              <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                  <svg class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                  </svg>
                </span>
                <?php echo e(__("Giriş Yap ")); ?>

              </button>
            </div>

            <div class="flex align-items-center justify-center">
              <a href="https://aciklab.org" target="_blank">
                <img src="<?php echo e(asset('images/havelsan-aciklab_hq.png')); ?>" alt="HAVELSAN Açıklab"
                   style="filter: invert(0.9); max-width: 120px;">
              </a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script>
    function getCaptcha(){
        request("<?php echo e(route('captcha')); ?>", new FormData(), function (response) {
            $('#captcha').html(response);
        }, function(response){
            var error = JSON.parse(response);
            showSwal(error.message,'error',2000);
        })
    }
  </script>
</body>
</html><?php /**PATH /liman/server/resources/views/auth/login.blade.php ENDPATH**/ ?>