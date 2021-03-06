<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>OP Irigasi</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url('assets/integrated/bower_components/bootstrap/dist/css/bootstrap.min.css'); ?>" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url('assets/integrated/bower_components/metisMenu/dist/metisMenu.min.css'); ?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url('assets/integrated/style/sb-admin-2.css'); ?>" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url('assets/integrated/bower_components/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css">

    <!-- jquery ui -->
    <link href="<?php echo base_url('assets/integrated/style/jquery-ui.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/integrated/style/jquery-ui.structure.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/integrated/style/jquery-ui.theme.min.css') ?>" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- jQuery -->
    <script src="<?php echo base_url('assets/integrated/bower_components/jquery/dist/jquery.min.js'); ?>"></script>


</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo base_url(); ?>">Sistem Informasi OP Irigasi</a>
            </div>
            <!-- /.navbar-header -->

            
            <?php if ($this->session->userdata('logged_in')): ?>
                <?php $this->load->view('integrated/parts/top-nav/logged-in-nav-top') ?>
            <?php else: ?>
                <?php $this->load->view('integrated/parts/top-nav/unlogged-in-nav-top') ?>
            <?php endif ?>
            <!-- /.navbar-top-links -->
            
            <?php 
            $userData   = $this->session->userdata('logged_in');
            $roleID     = isset($userData->role_id) ? $userData->role_id : 0;
            
            switch ($roleID) {
                case 1:
                    $this->load->view('integrated/parts/side-nav/admin-in-nav-side');
                    break;
                case 2:
                    $this->load->view('integrated/parts/side-nav/juru-in-nav-side');
                    break;
                case 3:
                    $this->load->view('integrated/parts/side-nav/pengamat-in-nav-side');
                    break;
                case 4:
                    $this->load->view('integrated/parts/side-nav/pimpinan-in-nav-side');
                    break;
                default:
                    $this->load->view('integrated/parts/side-nav/unlogged-in-nav-side');
                    break;
            }
            ?>
            <!-- /.navbar-static-side -->
        </nav>

        <!-- Page Content -->
        <?php echo $content; ?>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <?php if (isset($popup)): ?>
        <?php echo $popup; ?>
    <?php endif ?>


    <script src="<?php echo base_url('assets/integrated/js/jquery-ui.min.js') ?>"></script>
        
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url('assets/integrated/bower_components/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url('assets/integrated/bower_components/metisMenu/dist/metisMenu.min.js'); ?>"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url('assets/integrated/js/sb-admin-2.js'); ?>"></script>

    <!-- My custom engine -->
    <script src="<?php echo base_url('assets/integrated/js/engine.js'); ?>"></script>

</body>

</html>
