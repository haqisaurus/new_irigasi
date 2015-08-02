<div id="sidebar">
    <?php $currentUser = $this->session->userdata('logged_in') ?>
    <!-- login juru  -->
    <?php if($currentUser && $currentUser['role_id'] == 1) : ?>
        <h1>Sidebar Menu</h1>
        <ul class="sidemenu">
            <li><a href="<?php echo site_url('data-water') ?>">Data debit perdaerah</a></li>
            <li><a href="<?php echo site_url('entri-water') ?>">Entery data debit air</a></li>
            <li><a href="<?php echo site_url('plant-view') ?>">Pola tanam usulan</a></li>
            <?php 
            foreach ($region as $key => $item) {
                ?>
                <li><a href="<?php echo site_url('data-region/' . $item->id) ?>"><?php echo $item->region_name ?></a></li>
                <?php
            }
            ?>
        </ul>
    <?php elseif($currentUser && $currentUser['role_id'] == 2) : ?>
        <h1>Sidebar Menu</h1>
        <ul class="sidemenu">
            <li><a href="<?php echo site_url('data-water') ?>">Data debit perdaerah</a></li>
            <li><a href="<?php echo site_url('entri-water') ?>">Entery data debit air</a></li>
            <li><a href="<?php echo site_url('plant-view') ?>">Pola tanam usulan</a></li>
        </ul>
        <!-- login pengamat -->
    <?php elseif($currentUser && $currentUser['role_id'] == 3): ?>
        <ul class="sidemenu">
            <li><a href="<?php echo site_url() ?>">Home</a></li>
            <li><a href="<?php echo site_url('water-view') ?>">Data debit perdaerah</a></li>
        </ul>
    <?php else: ?>
        <h1>Sidebar Menu</h1>
        <ul class="sidemenu">
            <li><a href="<?php echo site_url() ?>">Home</a></li>
            <li><a href="<?php echo site_url('water-view') ?>">Data debit perdaerah</a></li>

            <?php 
            foreach ($region as $key => $item) {
                ?>
                <li><a href="<?php echo site_url('data-region/' . $item->id) ?>"><?php echo $item->region_name ?></a></li>
                <?php
            }
            ?>
        </ul>
    <?php endif ?>


    <!-- messages -->
    <?php if($currentUser && $currentUser['role_id'] == 1) : ?>
        <h1>User dashboard</h1>
        <p><a href="<?php echo site_url('dashboard') ?>">Go to dashboard side</a></p>
        <p>&quot;Anda bisa menambahkan, memodifikasi, data dalam dasboard mode admin silahkan masuk kedalam mode admin.&quot; </p>
        <p class="align-right">--</p>
    <?php elseif($currentUser && $currentUser['role_id'] == 2): ?>
        <h1>Keterangan</h1>
        <p>Anda login sebagai juru silahkan pilih menu yang telah disediakan</p>
        <p class="align-right">--</p>
    <?php elseif($currentUser && $currentUser['role_id'] == 3): ?>
        <h1>Keterangan</h1>
        <p>Anda login sebagai pengamat silahkan pilih menu yang telah disediakan</p>
        <p class="align-right">--</p>
    <?php else: ?>
        <h1>Keterangan</h1>
        <p>Silahkan login melalui menu login yang telah di sediakan.</p>
        <p class="align-right">--</p>
    <?php endif ?>
</div>