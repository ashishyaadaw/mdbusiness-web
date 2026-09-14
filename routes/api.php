<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| This file is loaded by the framework via bootstrap/app.php, which already
| assigns the "api" middleware group and the "/api" URI prefix to everything
| registered here. Routes are split by domain under routes/api/ and simply
| required below to keep this file short and each domain easy to find.
|
*/

require __DIR__.'/api/auth.php';
require __DIR__.'/api/otp.php';
require __DIR__.'/api/notifications.php';
require __DIR__.'/api/transactions.php';
require __DIR__.'/api/uploads.php';
require __DIR__.'/api/promo-ads.php';
require __DIR__.'/api/admin.php';
require __DIR__.'/api/staff.php';
require __DIR__.'/api/cities.php';
require __DIR__.'/api/menus.php';
require __DIR__.'/api/matters.php';