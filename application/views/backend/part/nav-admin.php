
<?php if ($this->session->userdata('logged_in')['role_id'] == 1): ?>
<ul class="nav navbar-nav side-nav">
    <li class="active">
        <a href="index.html"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
    </li>
    <li>
        <a href="javascript:;" data-toggle="collapse" data-target="#user"><i class="fa fa-fw fa-users"></i> Akun <i class="fa fa-fw fa-caret-down"></i></a>
        <ul id="user" class="collapse">
            <li>
                <a href="<?php echo site_url('user') ?>">Pengguna</a>
            </li>
            <li>
                <a href="<?php echo site_url('role') ?>">Hak akses</a>
            </li>
        </ul>
    </li>
    <li>
        <a href="javascript:;" data-toggle="collapse" data-target="#data"><i class="fa fa-fw fa-bar-chart-o" ></i> Data irigasi <i class="fa fa-fw fa-caret-down"></i></a>
        <ul id="data" class="collapse">
            <li>
                <a href="<?php echo site_url('region') ?>">Daerah irigasi</a>
            </li>
            <li>
                <a href="<?php echo site_url('wide') ?>">Luas daerah</a>
            </li>
            <li>
                <a href="<?php echo site_url('water') ?>">Debit air</a>
            </li>
        </ul>
    </li>
    <li>
        <a href="tables.html"><i class="fa fa-fw fa-table"></i> Tables</a>
    </li>
    <li>
        <a href="forms.html"><i class="fa fa-fw fa-edit"></i> Forms</a>
    </li>
    <li>
        <a href="bootstrap-elements.html"><i class="fa fa-fw fa-desktop"></i> Bootstrap Elements</a>
    </li>
    <li>
        <a href="bootstrap-grid.html"><i class="fa fa-fw fa-wrench"></i> Bootstrap Grid</a>
    </li>
    <li>
        <a href="blank-page.html"><i class="fa fa-fw fa-file"></i> Blank Page</a>
    </li>
    <li>
        <a href="index-rtl.html"><i class="fa fa-fw fa-dashboard"></i> RTL Dashboard</a>
    </li>
</ul>
<?php elseif($this->session->userdata('logged_in')['role_id'] == 2): ?>
<ul class="nav navbar-nav side-nav">
    <li class="active">
        <a href="index.html"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
    </li>
    <li>
        <a href="charts.html"><i class="fa fa-fw fa-bar-chart-o"></i> Charts</a>
    </li>
    <li>
        <a href="tables.html"><i class="fa fa-fw fa-table"></i> Tables</a>
    </li>
    <li>
        <a href="forms.html"><i class="fa fa-fw fa-edit"></i> Forms</a>
    </li>
    <li>
        <a href="bootstrap-elements.html"><i class="fa fa-fw fa-desktop"></i> Bootstrap Elements</a>
    </li>
    <li>
        <a href="bootstrap-grid.html"><i class="fa fa-fw fa-wrench"></i> Bootstrap Grid</a>
    </li>
    <li>
        <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-users"></i> Dropdown <i class="fa fa-fw fa-caret-down"></i></a>
        <ul id="demo" class="collapse">
            <li>
                <a href="#">Dropdown Item</a>
            </li>
            <li>
                <a href="#">Dropdown Item</a>
            </li>
        </ul>
    </li>
    <li>
        <a href="blank-page.html"><i class="fa fa-fw fa-file"></i> Blank Page</a>
    </li>
    <li>
        <a href="index-rtl.html"><i class="fa fa-fw fa-dashboard"></i> RTL Dashboard</a>
    </li>
</ul>
<?php elseif($this->session->userdata('logged_in')['role_id'] == 3): ?>
<ul class="nav navbar-nav side-nav">
    <li class="active">
        <a href="index.html"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
    </li>
    <li>
        <a href="charts.html"><i class="fa fa-fw fa-bar-chart-o"></i> Charts</a>
    </li>
    <li>
        <a href="tables.html"><i class="fa fa-fw fa-table"></i> Tables</a>
    </li>
    <li>
        <a href="forms.html"><i class="fa fa-fw fa-edit"></i> Forms</a>
    </li>
    <li>
        <a href="bootstrap-elements.html"><i class="fa fa-fw fa-desktop"></i> Bootstrap Elements</a>
    </li>
    <li>
        <a href="bootstrap-grid.html"><i class="fa fa-fw fa-wrench"></i> Bootstrap Grid</a>
    </li>
    <li>
        <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i> Dropdown <i class="fa fa-fw fa-caret-down"></i></a>
        <ul id="demo" class="collapse">
            <li>
                <a href="#">Dropdown Item</a>
            </li>
            <li>
                <a href="#">Dropdown Item</a>
            </li>
        </ul>
    </li>
    <li>
        <a href="blank-page.html"><i class="fa fa-fw fa-file"></i> Blank Page</a>
    </li>
    <li>
        <a href="index-rtl.html"><i class="fa fa-fw fa-dashboard"></i> RTL Dashboard</a>
    </li>
</ul>
<?php elseif($this->session->userdata('logged_in')['role_id'] == 4): ?>
<ul class="nav navbar-nav side-nav">
    <li class="active">
        <a href="index.html"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
    </li>
    <li>
        <a href="charts.html"><i class="fa fa-fw fa-bar-chart-o"></i> Charts</a>
    </li>
    <li>
        <a href="tables.html"><i class="fa fa-fw fa-table"></i> Tables</a>
    </li>
    <li>
        <a href="forms.html"><i class="fa fa-fw fa-edit"></i> Forms</a>
    </li>
    <li>
        <a href="bootstrap-elements.html"><i class="fa fa-fw fa-desktop"></i> Bootstrap Elements</a>
    </li>
    <li>
        <a href="bootstrap-grid.html"><i class="fa fa-fw fa-wrench"></i> Bootstrap Grid</a>
    </li>
    <li>
        <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i> Dropdown <i class="fa fa-fw fa-caret-down"></i></a>
        <ul id="demo" class="collapse">
            <li>
                <a href="#">Dropdown Item</a>
            </li>
            <li>
                <a href="#">Dropdown Item</a>
            </li>
        </ul>
    </li>
    <li>
        <a href="blank-page.html"><i class="fa fa-fw fa-file"></i> Blank Page</a>
    </li>
    <li>
        <a href="index-rtl.html"><i class="fa fa-fw fa-dashboard"></i> RTL Dashboard</a>
    </li>
</ul>
<?php endif ?>