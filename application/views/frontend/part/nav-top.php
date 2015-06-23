
<?php if($this->session->userdata('logged_in')) : ?>

<ul>
    <li id="current"><a href="<?php echo site_url('/') ?>"><span>Home</span></a></li>

    <li><a href="<?php echo site_url('/') ?>"><span>Akun</span></a></li>
</ul>

<?php else: ?>

<ul>
    <li id="current"><a href="<?php echo site_url('/') ?>"><span>Home</span></a></li>

    <li><a href="<?php echo site_url('/') ?>"><span>Login</span></a></li>
</ul>
<?php endif ?>