<div id="main"> 
	<a name="SampleTags"></a>
	<h1>Halaman login</h1>
	<br>
	<?php if ($this->session->flashdata('error')): ?>
		<?php echo $this->session->flashdata('error') ?>
	<?php endif ?>
    <?php echo form_open( 'login-action', '', array('id' => $this->uri->segment(2))); ?>
    <label for="username">Username</label>
    <input type="text" id="username" name="username">
    <label for="password">Login</label>
    <input type="password" id="password" name="password">
    <br>
    <br>
    <input type="submit" value="Login">
    <br>
    <br>
    <?php echo form_close(); ?>

</div>