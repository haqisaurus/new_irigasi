<div id="main"> 
	<a name="SampleTags"></a>
	<h1>Data pola tanam usulan pertahun <?php echo $year? : '' ?></h1>
	<br>
	<a href="javascript:window.history.go(-1);"><button>Kembali</button></a>
	<a href="<?php echo site_url('plant-entry') ?>"><button>Input</button></a>

	<?php if ($table): ?>
	<a href="<?php echo site_url('plant-edit/' . ($table?$table->id:0)) ?>"><button>Edit</button></a>
	<?php endif ?>

	<?php echo form_open('plant-view', ''); ?>
	<?php 

	$years = array();
	$thisYear = date('Y', strtotime('today')) + 1;
	for ($i = $thisYear; $i > 1990 ; $i--) { 
		$years[$i] = $i;
	}

	$default = set_value('year', $year?:'');

    echo form_dropdown('year', $years, $default, 'class="form-control" style="display:inline"');

	?>
	<button type="submit">Search</button>
	<?php echo form_close(); ?>
	<?php if(!$table) echo '<span class="error">Data tidak ditemukan <span>	<br>' ?>
	<br>
	<table width="468" height="221" border="0">
		<tbody>
			<tr>
				<td width="83"><?php echo $year ?></td>
				<td width="121"> MT 1 </td>
				<td width="121"> MT 2 </td>
				<td width="121"> MT 3 </td>
			</tr>

			<tr>
				<td>Padi</td>
				<td><?php echo $table? $table->rice_1 : '' ?></td>
				<td><?php echo $table? $table->rice_2 : '' ?></td>
				<td><?php echo $table? $table->rice_3 : '' ?></td>
			</tr>

			<tr>
				<td>Palawija</td>
				<td><?php echo $table? $table->palawija_1 : '' ?></td>
				<td><?php echo $table? $table->palawija_2 : '' ?></td>
				<td><?php echo $table? $table->palawija_3 : '' ?></td>
			</tr>

			<tr>
				<td>Tebu</td>
				<td><?php echo $table? $table->sugar_1 : '' ?></td>
				<td><?php echo $table? $table->sugar_2 : '' ?></td>
				<td><?php echo $table? $table->sugar_3 : '' ?></td>
			</tr>

			<tr>
				<td>Bero</td>
				<td><?php echo $table? $table->bero_1 : '' ?></td>
				<td><?php echo $table? $table->bero_2 : '' ?></td>
				<td><?php echo $table? $table->bero_3 : '' ?></td>
			</tr>				
		</tbody>
	</table>
	<br><br>
</div>