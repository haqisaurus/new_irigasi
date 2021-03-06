<div id="sidebar">
    <?php $currentUser = $this->session->userdata('logged_in') ?>
    <!-- login admin  -->
    <?php if($currentUser && $currentUser->role_id == 2) : ?>
        <h1>Sidebar Menu</h1>
        <ul class="sidemenu">
            <li><a href="<?php echo site_url('juru') ?>">Home</a></li>
            <li>
                <a href="<?php echo site_url('juru-debit-view') ?>">Data debit air</a>
            </li>
        </ul>
    <!-- login pengamat -->
    <?php elseif($currentUser && $currentUser->role_id == 3): ?>
        <ul class="sidemenu">
            <li><a href="<?php echo site_url('pengamat') ?>">Home</a></li>
            <li>
                <a href="<?php echo site_url('pengamat-debit-view') ?>">Data debit air</a>
            </li>
            <li>
                <a href="<?php echo site_url('pengamat-debit-andalan') ?>">Debit andalan</a>
            </li>
            <li>
                <a href="<?php echo site_url('pengamat-rencana-tanam') ?>">Pola tanam usul</a>
            </li>
            <li>
                <a href="<?php echo site_url('pengamat-allocation') ?>">Daftar Alokasi</a>
            </li>
        </ul>
    <!-- login pimpinan -->
    <?php elseif($currentUser && $currentUser->role_id == 4): ?>
        <ul class="sidemenu">
            <li><a href="<?php echo site_url('pimpinan') ?>">Home</a></li>
            <li>
                <a href="<?php echo site_url('pimpinan-debit-view') ?>">Data debit air</a>
            </li>
            <li>
                <a href="<?php echo site_url('pimpinan-debit-andalan') ?>">Debit andalan</a>
            </li>
            <li>
                <a href="<?php echo site_url('pimpinan-rencana-tanam') ?>">Pola tanam usul</a>
            </li>
        </ul>
    <?php else: ?>
        <h1>Sidebar Menu</h1>
        <ul class="sidemenu">
            <li><a href="<?php echo site_url() ?>">Home</a></li>
        </ul>
    <?php endif ?>


    <!-- messages -->
    <?php if($currentUser && $currentUser->role_id == 1) : ?>
        <h1>User dashboard</h1>
        <p><a href="<?php echo site_url('dashboard') ?>">Go to dashboard side</a></p>
        <p>&quot;Anda bisa menambahkan, memodifikasi, data dalam dasboard mode admin silahkan masuk kedalam mode admin.&quot; </p>
        <p class="align-right">--</p>
    <?php elseif($currentUser && $currentUser->role_id == 2): ?>
        <h1>Keterangan</h1>
        <p>Anda login sebagai juru silahkan pilih menu yang telah disediakan</p>
        <p class="align-right">--</p>
    <?php elseif($currentUser && $currentUser->role_id == 3): ?>
        <h1>Keterangan</h1>
        <p>Anda login sebagai pengamat silahkan pilih menu yang telah disediakan</p>
        <p class="align-right">--</p>
    <?php elseif($currentUser && $currentUser->role_id == 4): ?>
        <h1>Keterangan</h1>
        <p>Anda login sebagai pimpinan silahkan pilih menu yang telah disediakan</p>
        <p class="align-right">--</p>
    <?php else: ?>
        <h1>Keterangan</h1>
        <p>Silahkan login melalui menu login yang telah di sediakan.</p>
        <p class="align-right">--</p>
    <?php endif ?>
</div>