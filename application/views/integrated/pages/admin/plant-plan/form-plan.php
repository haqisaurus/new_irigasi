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
        <div class="col-lg-12">
            <?php 
            $attributes = array('class' => 'form-horizontal', 'id' => 'user-create');

            echo form_open('user-add-action', $attributes);
            ?>
                
                <div class="form-group <?php echo form_error('region-id') ? 'has-error' : ''; ?>">
                    <label for="access" class="col-sm-2 control-label">Daerah Irigasi</label>
                    <div class="col-sm-3">
                        <?php 
                        $options = array();

                        foreach ($regions as $key => $item) {
                            $options[$item->id] = $item->region_name;
                        }

                        echo form_dropdown('region-id', $options, set_value('region-id'), 'class="form-control"');
                        echo form_error('region-id');
                        ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="access" class="col-sm-2 control-label">Tahun</label>
                    <div class="col-sm-3">
                        <?php 
                        $options = array();
                        for ($i=2014; $i < 2026; $i++) { 
                            $options[$i] = $i;
                        }

                        echo form_dropdown('role-id', $options, set_value('role-id'), 'class="form-control"');
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

                        

                        echo form_dropdown('month', $options, set_value('month'), 'class="form-control"');
                        ?>
                    </div>
                </div>
               
                <div class="form-group <?php echo form_error('username') ? 'has-error' : ''; ?>">
                    <label for="access" class="col-sm-2 control-label">Rentang</label>

                    <div class="col-sm-9">
                        <input type="text" id="range" name="ranget">
                        <?php echo form_error('username'); ?>
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
                                <td><input type="text"></td>
                                <td><input type="text"></td>
                                <td><input type="text"></td>
                            </tr>
                            <tr>
                                <td><label for="">Palawija</label></td>
                                <td><input type="text"></td>
                                <td><input type="text"></td>
                                <td><input type="text"></td>
                            </tr>
                            <tr>
                                <td><label for="">Tebu</label></td>
                                <td><input type="text"></td>
                                <td><input type="text"></td>
                                <td><input type="text"></td>
                            </tr>
                            <tr>
                                <td><label for="">Bero</label></td>
                                <td><input type="text"></td>
                                <td><input type="text"></td>
                                <td><input type="text"></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-5 col-sm-7">
                        <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span> Kalkulasi</button>
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
    var months = [, 'November', 'Desember', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober'];

    $("#range").ionRangeSlider({
            
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

    var slider = $("#range").data("ionRangeSlider");

    function rotate( array , times ){
      while( times-- ){
        var temp = array.shift();
        array.push( temp )
      }
    }

    slider.update({
        values: [
            "one", "two", "three",
            "four", "five", "six", "seven"
        ]
    });
</script>