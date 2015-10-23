<div id="main"> 
	<a name="SampleTags"></a>
	<h1>Data pola tanam usulan pertahun</h1>
	<br>
	<a href="javascript:window.history.go(-1);"><button>Kembali</button></a>
	<br>
	<br>
	<?php echo form_open('action-plant-entry', '' ); ?>
	<?php 
	$regionOption = array();
    foreach ($regions as $key => $region) {
        $regionOption[$region->id] = $region->region_name;
    }
	?>
	<table class="table-form form-plant" style="">
		<tr>
			<th colspan="4">Entry pola tanam usulan</th>
		</tr>
		<tr>
			<td> <label for="region-id">Region</label> </td>
			<td colspan="3"><?php echo form_dropdown('region-id', $regionOption, $region, 'class="form-control"'); ?></td>
		</tr>
		<tr>
			<td> <label for="startmonth">Dari</label> </td>
			<td><input type="text" id="startmonth" name="startmonth" style="display: inline;"></td>
			<td> <label for="endmonth">Sampai</label> </td>
			<td><input type="text" id="endmonth" name="endmonth" style="display: inline;"></td>
		</tr>
		<tr  class="hidden">
			<td> <label for="half">Pertengahan bulan</label> </td>
			<td colspan="3">
				<input type="radio" id="half1" name="half" value="1" style="display: inline; width: 20px" checked="checked"> Pertama
				<input type="radio" id="half2" name="half" value="2" style="display: inline; width: 20px"> Kedua
			</td>
		</tr>
		<tr>
			<td> <label for="rice">Padi</label> </td>
			<td colspan="3"><input type="text" id="rice" name="rice" value="<?php echo set_value('rice', '') ?>"> <?php echo form_error('rice'); ?>Ha</td>
		</tr>
		<tr>
			<td> <label for="palawija">Palawija</label> </td>
			<td colspan="3"><input type="text" id="palawija" name="palawija" value="<?php echo set_value('palawija', '') ?>"> <?php echo form_error('palawija'); ?>Ha</td>
		</tr>
		<tr>
			<td> <label for="sugar">Tebu</label> </td>
			<td colspan="3"><input type="text" id="sugar" name="sugar" value="<?php echo set_value('sugar', '') ?>"> <?php echo form_error('sugar'); ?>Ha</td>
		</tr>
		<tr>
			<td> <label for="sugar">Bero</label> </td>
			<td colspan="3"><input type="text" id="bero" name="bero" value="<?php echo set_value('bero', '') ?>"> <?php echo form_error('bero'); ?>Ha</td>
		</tr>
		<tr>
			<td colspan="4"><br><button type="submit">Submit</button><br></td>
		</tr>
	</table>
	<?php echo form_close(); ?>
	<br><br>
</div>