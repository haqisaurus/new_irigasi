<link href="<?php echo base_url('assets/integrated/style/ion.rangeSlider.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('assets/integrated/style/ion.rangeSlider.skinNice.css'); ?>" rel="stylesheet">

<div id="main"> 
	<a name="SampleTags"></a>
	<h1>Pola tanam usulan pertahun</h1>
	<br>
	<a href="javascript:window.history.go(-1);"><button>Kembali</button></a>
	<a href="<?php echo site_url('pimpinan-rencana-list') ?>" style="float: right;"><button><span class="fa fa-info"></span> List rencana</button></a>
	<br>
	<br>
	<?php echo form_open('pimpinan-kalkulasi-rencana', '' ); ?>
	<?php 
	$regionOption = array();
    foreach ($regions as $key => $region) {
        $regionOption[$region->id] = $region->region_name;
    }
	?>
	<table class="table-form form-plant" style="">
		<tr>
			<th colspan="4">Pola tanam usulan </th>
		</tr>
		<tr>
			<td> <label for="region-id">Region</label> </td>
			<td colspan="3"><?php echo form_dropdown('region-id', $regionOption, $region, 'class="form-control" id="region-id"'); ?> &nbsp;&nbsp;&nbsp;&nbsp;<i id="total-wide">4.1700</i> ha</td>
		</tr>
		<tr>
			<td> <label for="region-id">Tahun</label> </td>
			<td colspan="3">
				<?php 
                $options = array();
                for ($i=2014; $i < 2026; $i++) { 
                    $options[$i] = $i;
                }

                echo form_dropdown('year', $options, set_value('role-id'), 'class="form-control"');
                ?>
			</td>
		</tr>
		<tr>
			<td> <label for="region-id">Bulan Mulai</label> </td>
			<td colspan="3">
				<?php 
                                
                $options = array(
                    '11'    => 'November',
                    '12'    => 'Desember',
                    '01'    => 'Januari',
                    '02'    => 'Februari',
                    '03'    => 'Maret',
                    '04'    => 'April',
                    '05'    => 'Mei',
                    '06'    => 'Juni',
                    '07'    => 'Juli',
                    '08'    => 'Agustus',
                    '09'    => 'September',
                    '10'    => 'Oktober',
                    );

                

                echo form_dropdown('month', $options, set_value('month'), 'class="form-control" id="month"');
                ?>
			</td>
		</tr>
		<tr>
			<td> <label for="rice">Padi</label> </td>
			<td colspan="3">
				<input type="text" id="range-ui" name="">
                <input type="hidden" name="range" id="range">
                <?php echo form_error('range'); ?>
			</td>
		</tr>
		<tr>
			<td>#</td>
			<td>MT 1</td>
			<td>MT 2</td>
			<td>MT 3</td>
		</tr>
		<tr>
			<td> <label for="rice">Padi</label> </td>
			<td><input type="text" name="rice[]" value="<?php echo set_value('rice', '0') ?>"> <?php echo form_error('rice'); ?></td>
			<td><input type="text" name="rice[]" value="<?php echo set_value('rice', '0') ?>"> <?php echo form_error('rice'); ?></td>
			<td><input type="text" name="rice[]" value="<?php echo set_value('rice', '0') ?>"> <?php echo form_error('rice'); ?></td>
		</tr>
		<tr>
			<td> <label for="palawija">Palawija</label> </td>
			<td><input type="text" name="palawija[]" value="<?php echo set_value('palawija', '0') ?>"> <?php echo form_error('palawija'); ?></td>
			<td><input type="text" name="palawija[]" value="<?php echo set_value('palawija', '0') ?>"> <?php echo form_error('palawija'); ?></td>
			<td><input type="text" name="palawija[]" value="<?php echo set_value('palawija', '0') ?>"> <?php echo form_error('palawija'); ?></td>
		</tr>
		<tr>
			<td> <label for="sugar">Tebu</label> </td>
			<td><input type="text" name="sugar[]" value="<?php echo set_value('sugar', '0') ?>"> <?php echo form_error('sugar'); ?></td>
			<td><input type="text" name="sugar[]" value="<?php echo set_value('sugar', '0') ?>"> <?php echo form_error('sugar'); ?></td>
			<td><input type="text" name="sugar[]" value="<?php echo set_value('sugar', '0') ?>"> <?php echo form_error('sugar'); ?></td>
		</tr>
		<tr>
			<td> <label for="sugar">Bero</label> </td>
			<td><input type="text" name="bero[]" value="<?php echo set_value('bero', '0') ?>"> <?php echo form_error('bero'); ?></td>
			<td><input type="text" name="bero[]" value="<?php echo set_value('bero', '0') ?>"> <?php echo form_error('bero'); ?></td>
			<td><input type="text" name="bero[]" value="<?php echo set_value('bero', '0') ?>"> <?php echo form_error('bero'); ?></td>
		</tr>
		<tr>
			<td colspan="4"><br><button type="submit" id="calculate">Kalkulasi</button><br></td>
		</tr>
	</table>
	<?php echo form_close(); ?>
	<br><br>
</div>

<script type="text/javascript" src="<?php echo base_url('assets/integrated/js/ion.rangeSlider.min.js') ?>"></script>

<script>
    var oriMonth = [ 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    var months = [ 'November', 'Desember', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober'];

    $("#range-ui").ionRangeSlider({
            
            keyboard: true,
            min: 1,
            max: 12,
            from: 3,
            to: 8,
            type: 'double',
            step: 1,
            prefix: "",
            grid: true,
            values : months,

        });

    var slider = $("#range-ui").data("ionRangeSlider");

    $(document)
        .off('change', '#month')
        .on('change', '#month', function(e) {
            var value = parseInt($(this).val()) + 1;
            rotate(months, value);

            slider.update({
                values: months
            });

            setValue();
        });

    function rotate( array , times ) {
        while( times-- ){
            var temp = array.shift();
            array.push( temp )
        }
    }

    function setValue () {
        var range = $('#range-ui').val();
        // search in index
        var val = range.split(';');
        var start = months.indexOf(val[0]);
        var end = months.indexOf(val[1]);
        $('#range').val('0,' + start + ',' + end);
    }

    setValue();  

    var regionID = $('#region-id').val();
    getWide(regionID);
    $('#region-id')
        .off('change')
        .on('change', function(e) {
            var _this = this;
            var value = $(_this).val();

            getWide(value);
        })
    
    function getWide(id) {
        $.ajax({
            url: "<?php echo site_url('region-wide-ajax') ?>",
            type: 'POST',
            dataType: 'json',
            data: {'region-id': id},
        })
        .done(function(response) {
            
            $('#total-wide').html(response.total_wide);
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });
    }

    $(document)
        .off('click', '#calculate')
        .on('click', '#calculate', function(e) {
            var valid = validationWide();
            if (valid == false) {
                e.preventDefault();
            };
        })
    function validationWide() {
        var total        = parseFloat($('#total-wide').text());

        var rice1        = parseFloat($($('[name^=rice]')[0]).val());
        var palawija1    = parseFloat($($('[name^=palawija]')[0]).val());
        var sugar1       = parseFloat($($('[name^=sugar]')[0]).val());
        var bero1        = parseFloat($($('[name^=bero]')[0]).val());

        var rice2        = parseFloat($($('[name^=rice]')[1]).val());
        var palawija2    = parseFloat($($('[name^=palawija]')[1]).val());
        var sugar2       = parseFloat($($('[name^=sugar]')[1]).val());
        var bero2        = parseFloat($($('[name^=bero]')[1]).val());

        var rice3        = parseFloat($($('[name^=rice]')[2]).val());
        var palawija3    = parseFloat($($('[name^=palawija]')[2]).val());
        var sugar3       = parseFloat($($('[name^=sugar]')[2]).val());
        var bero3        = parseFloat($($('[name^=bero]')[2]).val());
        
        console.log(parseFloat(rice1 + palawija1 + sugar1 + bero1), total)
        if (parseFloat(rice1 + palawija1 + sugar1 + bero1) >= total) {
            alert('Data Masa Tanam 1 Lebih Besar Dari Luas Lahan');
            $($('[name^=rice]')[0]).focus();
            return false;
        };

        if (parseFloat(rice2 + palawija2 + sugar2 + bero2) >= total) {
            alert('Data Masa Tanam 2 Lebih Besar Dari Luas Lahan');
            $($('[name^=rice]')[1]).focus();
            return false;
        };

        if (parseFloat(rice3 + palawija3 + sugar3 + bero3) >= total) {
            alert('Data Masa Tanam 3 Lebih Besar Dari Luas Lahan');
            $($('[name^=rice]')[2]).focus();
            return false;
        };
    }
</script>