<div id="sidebar">
    <?php $currentUser = $this->session->userdata('logged_in') ?>
    <!-- login juru  -->
    <?php if($currentUser && $currentUser['role_id'] == 2) : ?>
        <h1>Sidebar Menu</h1>
        <ul class="sidemenu">
            <li><a href="<?php echo site_url('data-water') ?>">Data debit perdaerah</a></li>
            <li><a href="<?php echo site_url('entri-water') ?>">Entery data debit air</a></li>
        </ul>
        <!-- login pengamat -->
    <?php elseif($currentUser && $currentUser['role_id'] == 3): ?>
        <ul class="sidemenu">
            <li><a href="<?php echo site_url('') ?>">Entery data debit air</a></li>
            <li><a href="<?php echo site_url('') ?>">Entery data debit air</a></li>
        </ul>
    <?php else: ?>
        <h1>Sidebar Menu</h1>
        <ul class="sidemenu">
            <li><a href="<?php echo site_url() ?>">Home</a></li>
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
        <p class="align-right">- HQs</p>
    <?php elseif($currentUser): ?>
        <h1>Keterangan</h1>
        <p>Anda login sebagai juru silahkan pilih menu yang telah disediakan</p>
        <p class="align-right">- HQs</p>
    <?php else: ?>
        <h1>Keterangan</h1>
        <p>Silahkan login melalui menu login yang telah di sediakan.</p>
        <p class="align-right">- HQs</p>
    <?php endif ?>
</div>