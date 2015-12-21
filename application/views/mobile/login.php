<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>OP Irigasi</title>

    <!-- JQuery Mobile -->
    <link href="<?php echo base_url('assets/mobile/jquery.mobile-1.4.5/jquery.mobile-1.4.5.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/mobile/jquery.mobile-1.4.5/jquery.mobile.theme-1.4.5.min.css'); ?>" rel="stylesheet">

    
    <!-- jQuery -->
    <script src="<?php echo base_url('assets/integrated/bower_components/jquery/dist/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/mobile/jquery.mobile-1.4.5/jquery.mobile-1.4.5.min.js'); ?>"></script>


</head>

<body>
    <input type="hidden" id="site-url" value="<?php echo site_url(); ?>">
    <div id="login" data-role="page">
        <div role="main" class="ui-content">
            <h1 is="gk-text" style="text-align: center;margin-top: 100px;">Login</h1>
            <input type="text" name="username" id="username">
            <input type="password" name="password" id="password">
            
                <input id="remember" name="remember" type="checkbox">
                <label for="remember">Ingat Saya</label>
            
            <button id="login-button" class="ui-btn ui-icon-user ui-btn-b ui-btn-icon-left" is="button" data-transition="fade" class="show-page-loading-msg" data-theme="b" data-textonly="false" data-textvisible="true" data-msgtext="Loading..." data-inline="true">Masuk</button>
        </div>
    </div>
    
    <!-- popup dialog -->
    <div data-role="dialog" id="popupDialog">
        <div role="main" class="ui-content" style="text-align: center;">
            <h3 class="ui-title">Akun yang anda masukan tidak terdaftar!!!</h3>
            <a href="#" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" id="close-dialog" data-rel="back">OK</a>
        </div>
    </div>
    <!-- My custom engine -->
    <script src="<?php echo base_url('assets/mobile/underscore-min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/mobile/backbone-min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/mobile/engine.js'); ?>"></script>

</body>

</html>
