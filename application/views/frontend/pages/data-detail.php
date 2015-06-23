<div id="main"> 
	<a name="SampleTags"></a>
	<h1>Detail catatan per tanggal <?php echo $detail->date ?></h1>
	<table class="table-detail">
		<tr>
			<td>Tanggal</td>
			<td><?php echo $detail->date ?></td>
		</tr>
		<tr>
			<td>Saluran Kanan </td>
			<td><?php echo $detail->right ?></td>
		</tr>
		<tr>
			<td>Saluran kiri</td>
			<td><?php echo $detail->left ?></td>
		</tr>
		<tr>
			<td>Saluran Limpas </td>
			<td><?php echo $detail->limpas ?></td>
		</tr>
		<tr>
			<td>Lokasi pemantauan</td>
			<td><?php echo $detail->region_name ?></td>
		</tr>
	</table>
</div>