<div id="main"> 
	<a name="SampleTags"></a>
	<h1>Data pola tanam usulan pertahun</h1>
	<br>
	<a href="javascript:window.history.go(-1);"><button>Kembali</button></a>
	<br>
	<br>
	<?php echo form_open('action-plant-edit', '', array('id' => $update->id) ); ?>
	<?php 

	$years = array();
	$thisYear = date('Y', strtotime('today')) + 1;
	for ($i = $thisYear; $i > 1990 ; $i--) { 
		$years[$i] = $i;
	}
	
	$default = set_value('year', $update->year);
	echo form_label('Tahun usulan', 'year', array('style' => 'display:inline'));
	echo '&nbsp;&nbsp;&nbsp;';
    echo form_dropdown('year', $years, $default, 'class="form-control" style="display:inline"');
	?>
	<br>
	<br>
	<table class="table-form form-plant" style="">
		<tr>
			<th>&nbsp;</th>
			<th> MT 1 </th>
			<th> MT 2 </th>
			<th> MT 3 </th>
		</tr>
		<tr>
			<td>Padi</td>
			<td><input type="text" id="rice-1" name="rice-1" value="<?php echo set_value('rice-1', $update->rice_1) ?>"> <?php echo form_error('rice-1'); ?></td>
			<td><input type="text" id="rice-2" name="rice-2" value="<?php echo set_value('rice-2', $update->rice_2) ?>"> <?php echo form_error('rice-2'); ?></td>
			<td><input type="text" id="rice-3" name="rice-3" value="<?php echo set_value('rice-3', $update->rice_3) ?>"> <?php echo form_error('rice-3'); ?></td>
		</tr>
		<tr>
			<td>Palawija</td>
			<td><input type="text" id="palawija-1" name="palawija-1" value="<?php echo set_value('palawija-1', $update->palawija_1) ?>"><?php echo form_error('palawija-1'); ?></td>
			<td><input type="text" id="palawija-2" name="palawija-2" value="<?php echo set_value('palawija-2', $update->palawija_2) ?>"><?php echo form_error('palawija-2'); ?></td>
			<td><input type="text" id="palawija-3" name="palawija-3" value="<?php echo set_value('palawija-3', $update->palawija_3) ?>"><?php echo form_error('palawija-3'); ?></td>
		</tr>
		<tr>
			<td>Tebu</td>
			<td><input type="text" id="sugar-1" name="sugar-1" value="<?php echo set_value('sugar-1', $update->sugar_1) ?>"><?php echo form_error('sugar-1'); ?></td>
			<td><input type="text" id="sugar-2" name="sugar-2" value="<?php echo set_value('sugar-2', $update->sugar_2) ?>"><?php echo form_error('sugar-2'); ?></td>
			<td><input type="text" id="sugar-3" name="sugar-3" value="<?php echo set_value('sugar-3', $update->sugar_3) ?>"><?php echo form_error('sugar-3'); ?></td>
		</tr>
		<tr>
			<td>Bero</td>
			<td><input type="text" id="bero-1" name="bero-1" value="<?php echo set_value('bero-1', $update->bero_1) ?>"><?php echo form_error('bero-1'); ?></td>
			<td><input type="text" id="bero-2" name="bero-2" value="<?php echo set_value('bero-2', $update->bero_2) ?>"><?php echo form_error('bero-2'); ?></td>
			<td><input type="text" id="bero-2" name="bero-2" value="<?php echo set_value('bero-2', $update->bero_3) ?>"><?php echo form_error('bero-2'); ?></td>
		</tr>
		<tr>
			<td colspan="4"><br><button type="submit">Update</button><br></td>
		</tr>
	</table>
	<?php echo form_close(); ?>
	<br><br>
</div>