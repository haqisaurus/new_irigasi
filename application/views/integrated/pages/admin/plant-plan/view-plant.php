<script src="<?php echo base_url('assets/integrated/bower_components/raphael/raphael-min.js') ?>"></script>
<script src="<?php echo base_url('assets/integrated/bower_components/morrisjs/morris.min.js') ?>"></script>
<link href="<?php echo base_url('assets/integrated/bower_components/morrisjs/morris.css'); ?>" rel="stylesheet" type="text/css">

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Grafik Rencana Pola Tanam Usul</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Grafik Pola tanam <b><?php echo $current_reg ?></b>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <table class="highchart" data-graph-container-before="1" data-graph-type="line" style="display:none" data-graph-line-width="2">
                        <thead>
                            <tr>
                                <th>Data</th>
                                <th>Debit Andalan</th>
                                <th>Kebutuhan Air</th>
                                <th>Neraca Air</th>
                            </tr>
                        </thead>
                        <tbody>


                            <?php 
                            foreach ($andalan as $key => $value) {
                                echo "<tr>";
                                echo "<td>" . $value['month_string'] . "</td>";
                                echo "<td>" . $value['debit'] . "</td>";
                                echo "<td>" . $value['demand'] . "</td>";
                                echo "<td>" . $value['neraca'] . "</td>";
                                echo "</tr>";
                            }
                            ?>    
                        </tbody>
                    </table> 
                    <div class="row">
                        <div class="col-md-12">
                        <?php if (isset($data['region-id'])): ?>
                            
                            <?php echo form_open('save-plan') ?>
                            <input type="hidden" name="region-id" value="<?php echo $data['region-id'] ?>">
                            <input type="hidden" name="year" value="<?php echo $data['year'] ?>">
                            <input type="hidden" name="month" value="<?php echo $data['month'] ?>">
                            <input type="hidden" name="range" value="<?php echo $data['range'] ?>">
                            <input type="hidden" name="rice" value="<?php print_r( implode(",", $data['rice']) ) ?>">
                            <input type="hidden" name="palawija" value="<?php print_r( implode(",", $data['palawija']) ) ?>">
                            <input type="hidden" name="sugar" value="<?php print_r( implode(",", $data['sugar']) ) ?>">
                            <input type="hidden" name="bero" value="<?php print_r( implode(",", $data['bero']) ) ?>">
                            <button type="submit" class="btn btn-info"><span class="fa fa-save"></span> Simpan</button>
                            <?php echo form_close() ?>
                            
                        <?php endif ?>
                        </div>
                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
    </div>
    <!-- /.row -->
</div>


<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharttable.org/master/jquery.highchartTable-min.js"></script> 

<script>
    $(function() {
        $(document).ready(function() {
          $('table.highchart').highchartTable();
        });

    });

</script>