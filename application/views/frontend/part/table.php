<h1>Setengah bulan pertama</h1>
<table>
	<tr>
		<th>No</th>
		<th>Tanggal</th>
		<th>Kanan</th>
		<th>Kiri</th>
		<th>Limpas</th>
		<th>Action</th>
	</tr>
	<?php foreach ($table as $key => $data): ?>
		<?php if ($key > 14) continue ?>
		<tr>
			<td><?php echo $key + 1 ?></td>
			<td><a href="<?php echo site_url('data-detail/' . $data->id) ?>"><?php echo date('d-F-Y', strtotime( $data->date)) ?></a></td>
			<td><?php echo $data->right ?> dm<sup>3</sup></td>
			<td><?php echo $data->left ?> dm<sup>3</sup></td>
			<td><?php echo $data->limpas ?> dm<sup>3</sup></td>
			<td><a href="<?php echo site_url('edit-water/' . $data->id) ?>"><button>Edit</button></a></td>
		</tr>
	<?php endforeach ?>
</table>
<br>
<br>
<h1>Setengah bulan kedua</h1>
<table>
	<tr>
		<th>No</th>
		<th>Tanggal</th>
		<th>Kanan</th>
		<th>Kiri</th>
		<th>Limpas</th>
		<th>Action</th>
	</tr>
	<?php foreach ($table as $key => $data): ?>
		<?php if ($key < 14) continue ?>
		<tr>
			<td><?php echo $key + 1 ?></td>
			<td><a href="<?php echo site_url('data-detail/' . $data->id) ?>"><?php echo date('d-F-Y', strtotime( $data->date)) ?></a></td>
			<td><?php echo $data->right ?> dm<sup>3</sup></td>
			<td><?php echo $data->left ?> dm<sup>3</sup></td>
			<td><?php echo $data->limpas ?> dm<sup>3</sup></td>
			<td><a href="<?php echo site_url('edit-water/' . $data->id) ?>"><button>Edit</button></a></td>
		</tr>
	<?php endforeach ?>
</table>