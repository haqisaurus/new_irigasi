<?php date_default_timezone_set('UTC'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <title>OP irigasi</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <link rel="stylesheet" href="<?php echo base_url('assets/frontend/css/SimpleBlog.css') ?>" type="text/css" />

    <link href="<?php echo base_url('assets/frontend/css/plugins/jquery-ui.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/frontend/css/plugins/jquery-ui.structure.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/frontend/css/plugins/jquery-ui.theme.min.css') ?>" rel="stylesheet">
    <!-- jQuery -->
    <script src="<?php echo base_url('assets/frontend/js/jquery.js') ?>"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url('assets/frontend/js/plugins/jquery.maskedinput.min.js') ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/frontend/js/plugins/jquery-ui.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/frontend/js/plugins/Chart.min.js') ?>"></script>
</head>
<body>
    <input type="hidden" id="base_url" value="<?php echo base_url() ?>">
    <input type="hidden" id="site_url" value="<?php echo site_url() ?>">
    <div id="wrap">
        <div id="header">
            <h1 id="logo">Sistem Informasi <span class="gray">OP Irigasi</span></h1>
            <h2 id="slogan">Informasi irigasi yogyakarta...</h2>
            <div id="searchform">

            </div>
        </div>
        <div id="menu">
            <?php echo $menuTop ?>
        </div>
        <div id="content-wrap">
            <?php   echo $sideBar ?>
            <?php   echo $content; ?>
        </div>
        <div id="footer">
            <p> &copy;<?php echo date('Y') ?> <strong>Fakultas Teknologi Pertanian Universitas Gadjah Mada</strong></p>
        </div>
    </div>

    <script src="<?php echo base_url('assets/frontend/js/main.js') ?>"></script>
</body>
</html>