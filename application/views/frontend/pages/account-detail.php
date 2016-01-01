<div id="main"> 
	<a name="SampleTags"></a>
	<h1>Detail account</h1>
	<br>
	<a href="javascript:window.history.go(-1);"><button>Kembali</button></a>
	<br>
	<br>
	<?php $currentUser = $this->session->userdata('logged_in'); ?>
	<table class="table-detail">
		<tr>
			<td style="width: 20%;">Username</td>
			<td><?php echo $currentUser->username ?></td>
		</tr>
		<tr>
			<td style="width: 20%;">Nama depan </td>
			<td><?php echo $currentUser->first_name ?></td>
		</tr>
		<tr>
			<td style="width: 20%;">Nama belakang </td>
			<td><?php echo $currentUser->last_name ?></td>
		</tr>
		<tr>
			<td style="width: 20%;">Level </td>
			<td><?php echo $currentUser->role_id ?></td>
		</tr>
	</table>
</div>