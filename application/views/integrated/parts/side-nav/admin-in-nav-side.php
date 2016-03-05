<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <!-- <li class="sidebar-search">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
            </li> -->
            <li>
                <a href="<?php echo site_url('admin') ?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
            </li>
            <li>
                <a href="#"><i class="fa fa-group fa-fw"></i> Users Management<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?php echo site_url('user') ?>">Users</a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('juru-access') ?>">Hak Akses Juru</a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('role') ?>">Roles</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="#"><i class="fa fa-database fa-fw"></i> Master Data<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?php echo site_url('region') ?>">Daerah irigasi</a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('wide') ?>">Luas daerah</a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('water') ?>">Debit air</a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('constant') ?>">Constant</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="<?php echo site_url('view-debit-andalan'); ?>"><i class="fa fa-bar-chart-o fa-fw"></i> Debit Andalan</span></a>
               
            </li>
            <li>
                <a href="<?php echo site_url('add-data-plan'); ?>"><i class="fa fa-thumb-tack fa-fw"></i> Rencana Tanam</a>
                
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="<?php echo site_url('allocation'); ?>"><i class="fa fa-code-fork fa-fw"></i> Alokasi Debit</a>
                
                <!-- /.nav-second-level -->
            </li>
            <!-- <li>
                <a href="#"><i class="fa fa-sitemap fa-fw"></i> Pembagian Air<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="flot.html">Flot Charts</a>
                    </li>
                    <li>
                        <a href="morris.html">Morris.js Charts</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-gears fa-fw"></i> Kinerja Irigasi<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="flot.html">Flot Charts</a>
                    </li>
                    <li>
                        <a href="morris.html">Morris.js Charts</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-wrench fa-fw"></i> Pemeliharaan<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="flot.html">Flot Charts</a>
                    </li>
                    <li>
                        <a href="morris.html">Morris.js Charts</a>
                    </li>
                </ul>
            </li> -->
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>