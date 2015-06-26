<div id="sidebar">
    <?php $currentUser = $this->session->userdata('logged_in') ?>
    <?php if($currentUser && $currentUser['role_id'] == 2) : ?>
    <h1>Sidebar Menu</h1>
        
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

    <?php if($this->session->userdata('logged_in')) : ?>
        <h1>User dashboard</h1>
        <p><a href="<?php echo site_url('dashboard') ?>">Go to dashboard side</a></p>
        <p>&quot;Anda bisa menambahkan, memodifikasi, data dalam dasboard mode admin silahkan masuk kedalam mode admin.&quot; </p>
        <p class="align-right">- HQs</p>
    <?php else: ?>
        <h1>Keterangan</h1>
        <p>Silahkan login melalui menu login yang telah di sediakan.</p>
        <p class="align-right">- HQs</p>
    <?php endif ?>
</div>