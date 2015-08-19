<h1>Setengah bulan pertama</h1>
<table>
	<tr>
		<th>No</th>
		<th>Tanggal</th>
		<th>Kanan <b>(liter/det)</b></th>
		<th>Kiri <b>(liter/det)</b></th>
		<th>Limpas <b>(liter/det)</b></th>
		<th>Action</th>
	</tr>
	<?php foreach ($table as $key => $data): ?>
		<?php if ($key > 14) continue ?>
		<tr>
			<td style="width: 30px;"><?php echo $key + 1 ?></td>
			<td style="width: 95px;"><a href="<?php echo site_url('data-detail/' . $data->id) ?>"><?php echo date('d-F-Y', strtotime( $data->date)) ?></a></td>
			<td style="width: 95px;" class="right"><?php echo $data->right ?></td>
			<td style="width: 95px;" class="right"><?php echo $data->left ?></td>
			<td style="width: 95px;" class="right"><?php echo $data->limpas ?></td>
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
		<?php if ($key <= 14) continue ?>
		<tr>
			<td style="width: 30px;"><?php echo $key + 1 ?></td>
			<td style="width: 95px;"><a href="<?php echo site_url('data-detail/' . $data->id) ?>"><?php echo date('d-F-Y', strtotime( $data->date)) ?></a></td>
			<td style="width: 95px;" class="right"><?php echo $data->right ?></td>
			<td style="width: 95px;" class="right"><?php echo $data->left ?></td>
			<td style="width: 95px;" class="right"><?php echo $data->limpas ?></td>
			<td><a href="<?php echo site_url('edit-water/' . $data->id) ?>"><button>Edit</button></a></td>
		</tr>
	<?php endforeach ?>
</table>