<h1>Data tahun <?php echo $year ?></h1>
<table>
	<tr>
		<th>No</th>
		<th>Tanggal</th>
		<th>Rata-rata Kanan</th>
		<th>Rata-rata Kiri</th>
		<th>Rata-rata Limpas</th>
	</tr>
	<?php foreach ($table as $key => $data): ?>
		<tr>
			<td><?php echo $key + 1 ?></td>
			<td><a href="<?php echo site_url('data-detail/' . $data->id) ?>"><?php echo date('d-F-Y', strtotime( $data->date)) ?></a></td>
			<td><?php echo $data->kanan ?> dm<sup>3</sup></td>
			<td><?php echo $data->kiri ?> dm<sup>3</sup></td>
			<td><?php echo $data->limpass ?> dm<sup>3</sup></td>
		</tr>
	<?php endforeach ?>
</table>
<br>
