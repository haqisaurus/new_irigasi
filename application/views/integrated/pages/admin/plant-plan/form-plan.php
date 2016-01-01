<link href="<?php echo base_url('assets/integrated/style/ion.rangeSlider.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('assets/integrated/style/ion.rangeSlider.skinNice.css'); ?>" rel="stylesheet">

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Masukan Data rencana</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-xs-2 col-xs-offset-10">
            <a href="<?php echo site_url('list-plan') ?>" class="btn btn-info"><span class="fa fa-info"></span> List rencana</a>
            <br><br>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">

            <?php 
            $attributes = array('class' => 'form-horizontal', 'id' => 'user-create');

            echo form_open('get-plan-calc', $attributes);
            ?>
                
                <div class="form-group <?php echo form_error('region-id') ? 'has-error' : ''; ?>">
                    <label for="access" class="col-sm-2 control-label">Daerah Irigasi</label>
                    <div class="col-sm-3">
                        <?php 
                        $options = array();

                        foreach ($regions as $key => $item) {
                            $options[$item->id] = $item->region_name;
                        }

                        echo form_dropdown('region-id', $options, set_value('region-id'), 'class="form-control" id="region-id"');
                        echo form_error('region-id');
                        ?>
                    </div>
                    <label for="access" class="col-sm-2 control-label">Luas Daerah</label>
                    <span class="col-sm-2 control-label" ><i id="total-wide"><?php echo 90; ?></i> <b>ha</b></span>
                    
                </div>
                <div class="form-group">
                    <label for="access" class="col-sm-2 control-label">Tahun</label>
                    <div class="col-sm-3">
                        <?php 
                        $options = array();
                        for ($i=2014; $i < 2026; $i++) { 
                            $options[$i] = $i;
                        }

                        echo form_dropdown('year', $options, set_value('role-id'), 'class="form-control"');
                        ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="access" class="col-sm-2 control-label">Bulan Mulai</label>
                    <div class="col-sm-3">
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
                    </div>
                </div>
               
                <div class="form-group <?php echo form_error('username') ? 'has-error' : ''; ?>">
                    <label for="access" class="col-sm-2 control-label">Rentang</label>

                    <div class="col-sm-9">
                        <input type="text" id="range-ui" name="">
                        <input type="hidden" name="range" id="range">
                        <?php echo form_error('range'); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-10 col-xs-offset-1">
                        <table class="table">
                            <tr>
                                <th>#</th>
                                <th>MT 1</th>
                                <th>MT 2</th>
                                <th>MT 3</th>
                            </tr>
                            <tr>
                                <td><label for="">Padi</label></td>
                                <td><input type="text" name="rice[]" value="150"></td>
                                <td><input type="text" name="rice[]" value="90"></td>
                                <td><input type="text" name="rice[]" value="170"></td>
                            </tr>
                            <tr>
                                <td><label for="">Palawija</label></td>
                                <td><input type="text" name="palawija[]" value="0"></td>
                                <td><input type="text" name="palawija[]" value="70"></td>
                                <td><input type="text" name="palawija[]" value="0"></td>
                            </tr>
                            <tr>
                                <td><label for="">Tebu</label></td>
                                <td><input type="text" name="sugar[]" value="10"></td>
                                <td><input type="text" name="sugar[]" value="10"></td>
                                <td><input type="text" name="sugar[]" value="10"></td>
                            </tr>
                            <tr>
                                <td><label for="">Bero</label></td>
                                <td><input type="text" name="bero[]" value="0"></td>
                                <td><input type="text" name="bero[]" value="0"></td>
                                <td><input type="text" name="bero[]" value="0"></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-5 col-sm-7">
                        <button type="submit" class="btn btn-primary" id="calculate"><span class="glyphicon glyphicon-floppy-disk"></span> Kalkulasi</button>
                    </div>
                </div>
            <?php 
            echo form_close();
            ?>

        </div>
    </div>
    <!-- /.row -->
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
        
        // console.log(parseFloat(rice1 + palawija1 + sugar1 + bero1), total)
        // if (parseFloat(rice1 + palawija1 + sugar1 + bero1) > total) {
        //     alert('Data Masa Tanam 1 Lebih Besar Dari Luas Lahan');
        //     $($('[name^=rice]')[0]).focus();
        //     return false;
        // };

        // if (parseFloat(rice2 + palawija2 + sugar2 + bero2) > total) {
        //     alert('Data Masa Tanam 2 Lebih Besar Dari Luas Lahan');
        //     $($('[name^=rice]')[1]).focus();
        //     return false;
        // };

        // if (parseFloat(rice3 + palawija3 + sugar3 + bero3) > total) {
        //     alert('Data Masa Tanam 3 Lebih Besar Dari Luas Lahan');
        //     $($('[name^=rice]')[2]).focus();
        //     return false;
        // };
    }
</script>