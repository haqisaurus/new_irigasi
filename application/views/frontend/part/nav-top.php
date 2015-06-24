
<?php if($this->session->userdata('logged_in')) : ?>

<ul>
    <li id="current" class="<?php echo ($this->uri->segment(1)) == '' ? 'current' : '' ; ?>"><a href="<?php echo site_url('/') ?>"><span>Home</span></a></li>

    <li class="<?php echo ($this->uri->segment(1)) == 'account-detail' ? 'current' : '' ; ?>"><a href="<?php echo site_url('account-detail') ?>"><span>Akun</span></a></li>
    <li ><a href="<?php echo site_url('logout') ?>"><span>Logout</span></a></li>
</ul>

<?php else: ?>

<ul>
    <li id="current" class="<?php echo ($this->uri->segment(1)) == '' ? 'current' : '' ; ?>"><a href="<?php echo site_url('/') ?>"><span>Home</span></a></li>

    <li class="<?php echo ($this->uri->segment(1)) == 'user-login' ? 'current' : '' ; ?>"><a href="<?php echo site_url('user-login') ?>"><span>Login</span></a></li>
</ul>
<?php endif ?>