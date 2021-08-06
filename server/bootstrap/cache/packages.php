<?php return array (
  'beyondcode/laravel-websockets' => 
  array (
    'providers' => 
    array (
      0 => 'BeyondCode\\LaravelWebSockets\\WebSocketsServiceProvider',
    ),
    'aliases' => 
    array (
      'WebSocketRouter' => 'BeyondCode\\LaravelWebSockets\\Facades\\WebSocketRouter',
    ),
  ),
  'intervention/image' => 
  array (
    'providers' => 
    array (
      0 => 'Intervention\\Image\\ImageServiceProvider',
    ),
    'aliases' => 
    array (
      'Image' => 'Intervention\\Image\\Facades\\Image',
    ),
  ),
  'mews/captcha' => 
  array (
    'providers' => 
    array (
      0 => 'Mews\\Captcha\\CaptchaServiceProvider',
    ),
    'aliases' => 
    array (
      'Captcha' => 'Mews\\Captcha\\Facades\\Captcha',
    ),
  ),
  'nesbot/carbon' => 
  array (
    'providers' => 
    array (
      0 => 'Carbon\\Laravel\\ServiceProvider',
    ),
  ),
);