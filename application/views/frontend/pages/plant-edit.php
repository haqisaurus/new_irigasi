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
	
	$splited = explode(' ', $update->year);
	$default = set_value('year', $splited[0]);
	echo form_label('Tahun usulan', 'year', array('style' => 'display:inline'));
	echo '&nbsp;&nbsp;&nbsp;';
    echo form_dropdown('year', $years, $default, 'class="form-control" style="display:inline"');
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
	$default = set_value('month', $splited[1]);

    echo "&nbsp;";
    echo form_dropdown('month', $monthOption, $default, 'class="form-control" style="display:inline"');
	?>
	<div style="display:inline">
		<input type="radio" id="first" name="period" value="1" style="display:inline" <?php echo ($splited[2] == '1') ? 'checked' : '' ; ?>>
		<label for="first" style="display:inline">Pertama</label>
		<input type="radio" id="second" name="period" value="2" style="display:inline" <?php echo ($splited[2] == '2') ? 'checked' : '' ; ?>>
		<label for="second" style="display:inline">Kedua</label>
	</div>
	<br>
	<br>
	<table class="table-form form-plant" style="">
		<tr>
			<th> Padi </th>
			<th> Palawija </th>
			<th> Tebu </th>
		</tr>
		<tr>
			<td><input type="text" id="rice" name="rice" value="<?php echo set_value('rice', $update->rice) ?>"> <?php echo form_error('rice'); ?></td>
			<td><input type="text" id="palawija" name="palawija" value="<?php echo set_value('palawija', $update->palawija) ?>"> <?php echo form_error('palawija'); ?></td>
			<td><input type="text" id="sugar" name="sugar" value="<?php echo set_value('sugar', $update->sugar) ?>"> <?php echo form_error('sugar'); ?></td>
		</tr>
		
		<tr>
			<td colspan="4"><br><button type="submit">Update</button><br></td>
		</tr>
	</table>
	<?php echo form_close(); ?>
	<br><br>
</div>