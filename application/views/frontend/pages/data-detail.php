<div id="main"> 
	<a name="SampleTags"></a>
	<h1>Detail catatan per tanggal <?php echo date('d-F-Y', strtotime( $detail->date)) ?></h1>
	<br>
	<a href="javascript:window.history.go(-1);"><button>Kembali</button></a>
	<br>
	<br>
	<table class="table-detail">
		<tr>
			<td>Tanggal</td>
			<td><?php echo date('d-F-Y', strtotime($detail->date ))?></td>
		</tr>
		<tr>
			<td>Saluran Kanan </td>
			<td><?php echo $detail->right ?> dm<sup>3</sup></td>
		</tr>
		<tr>
			<td>Saluran kiri</td>
			<td><?php echo $detail->left ?> dm<sup>3</sup></td>
		</tr>
		<tr>
			<td>Saluran Limpas </td>
			<td><?php echo $detail->limpas ?> dm<sup>3</sup></td>
		</tr>
		<tr>
			<td>Lokasi pemantauan</td>
			<td><?php echo $detail->region_name ?></td>
		</tr>
	</table>
	<br><br>
</div>