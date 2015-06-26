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
    <link href="<?php echo base_url('assets/backend/css/bootstrap.min.css') ?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url('assets/backend/css/sb-admin.css') ?>" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="<?php echo base_url('assets/backend/css/plugins/morris.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/backend/css/plugins/jquery-ui.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/backend/css/plugins/jquery-ui.structure.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/backend/css/plugins/jquery-ui.theme.min.css') ?>" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url('assets/backend/font-awesome/css/font-awesome.min.css') ?>" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
    <input type="hidden" id="base_url" value="<?php echo base_url() ?>">
    <input type="hidden" id="site_url" value="<?php echo site_url() ?>">
    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo site_url(); ?>">OP Irigasi</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <!-- <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> <b class="caret"></b></a>
                    <ul class="dropdown-menu message-dropdown">
                        <li class="message-preview">
                            <a href="#">
                                <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="http://placehold.it/50x50" alt="">
                                    </span>
                                    <div class="media-body">
                                        <h5 class="media-heading"><strong>John Smith</strong>
                                        </h5>
                                        <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                        <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="message-preview">
                            <a href="#">
                                <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="http://placehold.it/50x50" alt="">
                                    </span>
                                    <div class="media-body">
                                        <h5 class="media-heading"><strong>John Smith</strong>
                                        </h5>
                                        <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                        <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="message-preview">
                            <a href="#">
                                <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="http://placehold.it/50x50" alt="">
                                    </span>
                                    <div class="media-body">
                                        <h5 class="media-heading"><strong>John Smith</strong>
                                        </h5>
                                        <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                        <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="message-footer">
                            <a href="#">Read All New Messages</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> <b class="caret"></b></a>
                    <ul class="dropdown-menu alert-dropdown">
                        <li>
                            <a href="#">Alert Name <span class="label label-default">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-primary">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-success">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-info">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-warning">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-danger">Alert Badge</span></a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">View All</a>
                        </li>
                    </ul>
                </li> -->
                <li class="dropdown">
                    <?php $currentUser = $this->session->userdata('logged_in') ?>

                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $currentUser['first_name'] . ' ' . $currentUser['last_name'] ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <!-- <li>
                            <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
                        </li>
                        <li class="divider"></li> -->
                        <li>
                            <a href="<?php echo site_url('logout') ?>"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <?php echo $nav ?>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <?php echo $content ?>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

	<?php if (isset($popup)): ?>
		<?php echo $popup ?>
	<?php endif ?>

    <!-- jQuery -->
    <script src="<?php echo base_url('assets/backend/js/jquery.js') ?>"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url('assets/backend/js/bootstrap.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/backend/js/plugins/jquery.maskedinput.min.js') ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/backend/js/plugins/jquery-ui.min.js') ?>"></script>

    <!-- Morris Charts JavaScript -->
    <!-- <script src="<?php echo base_url('assets/backend/js/plugins/morris/raphael.min.js') ?>"></script>l
    <script src="<?php echo base_url('assets/backend/js/plugins/morris/morris.min.js') ?>"></script>l
    <script src="<?php echo base_url('assets/backend/js/plugins/morris/morris-data.js') ?>"></script>l -->
    <script src="<?php echo base_url('assets/backend/js/admin.js') ?>"></script>
    <input type="hidden" id="base_url" value="<?php echo base_url() ?>">
    <input type="hidden" id="site_url" value="<?php echo site_url() ?>">
</body>

</html>
