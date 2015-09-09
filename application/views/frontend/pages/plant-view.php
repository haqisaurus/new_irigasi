<div id="main"> 
	<a name="SampleTags"></a>
	<h1>Data pola tanam usulan</h1>
	<br>
	<a href="javascript:window.history.go(-1);"><button>Kembali</button></a>
	<a href="<?php echo site_url('plant-entry') ?>"><button>Input</button></a>

	
	<?php 

	if(!$table) echo '<span class="error">Data tidak ditemukan <span>	<br>' ;

	$monthOption = array(
        '11' => 'November',
        '12' => 'Desember',
        '01' => 'January',
        '02' => 'February',
        '03' => 'Maret',
        '04' => 'April',
        '05' => 'Mei',
        '06' => 'Juni',
        '07' => 'Juli',
        '08' => 'Agustus',
        '09' => 'September',
        '10' => 'Oktober',
        );
    ?>
	<br>
	<br>
	<br>
	<table width="468" height="221" border="0">
		<tbody>
			<tr>
				<th width="83">#</th>
				<th width="83">Tanggal</th>
				<th width=""> Padi </th>
				<th width=""> Palawija </th>
				<th width=""> Tebu </th>
				<th width=""> Bero </th>
				<th width=""> Total </th>
			</tr>
			<?php 
			foreach ($table as $key => $value) {
				?>
				<tr>
					<td><?php echo $key + 1 ?></td>
					<td><a href="<?php echo site_url('plant-edit/' . $value->id) ?>"><?php echo $value->year ?></a></td>
					<td><?php echo $value->rice ?> ha</td>
					<td><?php echo $value->palawija ?> ha</td>
					<td><?php echo $value->sugar ?> ha</td>
					<td><?php echo $value->bero ?> ha</td>
					<td><?php echo ( $value->rice + $value->palawija + $value->sugar + $value->bero) ?> ha</td>
				</tr>
				<?php
			}
			 ?>
		</tbody>
	</table>
	<br><br>
</div>