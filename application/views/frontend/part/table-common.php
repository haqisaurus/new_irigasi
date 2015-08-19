<h1>Data tahun <?php echo $year ?></h1>
<table>
	<tr>
		<th>No</th>
		<th>Tanggal</th>
		<th>Rata-rata Kanan <b>(liter/det)</b></th>
		<th>Rata-rata Kiri <b>(liter/det)</b></th>
		<th>Rata-rata Limpas <b>(liter/det)</b></th>
	</tr>
	<?php foreach ($table as $key => $data): ?>
		<?php 
		$month = date('d-F-Y', strtotime( $data->date));
		$match = explode('-', $month);
		$string = '';
		if (is_array($match)) {
			$string = $match[1] . ' ' . ($match[0] == '01' ? '1' : '2') ;
		}
		?>
		<tr>
			<td><?php echo $key + 1 ?></td>
			<td style="width: 100px;"><a href="<?php echo site_url('data-detail/' . $data->id) ?>"><?php echo $string ?></a></td>
			<td class="right"><?php echo round($data->kanan, 4) ?></td>
			<td class="right"><?php echo round($data->kiri, 4) ?></td>
			<td class="right"><?php echo round($data->limpas, 4) ?></td>
		</tr>
	<?php endforeach ?>
</table>
<br>
