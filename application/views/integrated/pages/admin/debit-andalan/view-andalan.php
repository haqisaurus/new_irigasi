<script src="<?php echo base_url('assets/integrated/bower_components/raphael/raphael-min.js') ?>"></script>
<script src="<?php echo base_url('assets/integrated/bower_components/morrisjs/morris.min.js') ?>"></script>
<link href="<?php echo base_url('assets/integrated/bower_components/morrisjs/morris.css'); ?>" rel="stylesheet" type="text/css">

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Grafik Debit Andalan</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="form-group">
                <div class="col-sm-7 col-sm-offset-5">
                    <?php 
                    $attributes = array('class' => 'form-horizontal', 'id' => 'search-table');
                    
                    echo form_open('view-debit-andalan', $attributes);
                    ?>
                    <div class="col-xs-4 col-xs-offset-3">
                        <label for="access" class="col-sm-12 control-label">Daerah Irigasi</label>
                    </div>
                    <div class="col-xs-4 form-group">
                        <div class="col-sm-12">
                            <?php 
                            
                            $options = array();

                            foreach ($regions as $key => $item) {
                                $options[$item->id] = $item->region_name;
                            }

                            echo form_dropdown('region-id', $options, isset($_POST['region-id'])?$_POST['region-id']:'', 'class="form-control" id="region-id" ');
                            ?>
                        </div>
                    </div>
                    <div class="col-xs-1">
                        <button type="submit" class="btn btn-info"><span class="fa fa-search"></span> Lihat</button>
                    </div>
                    <?php echo form_close(); ?>
                </div>
                
            </div>
            
            <br>
            <br>
        </div>
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Debit Andalan <b><?php echo $current_reg; ?></b>
                </div>
                
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <!-- <div id="morris-area-chart"></div> -->
                    <table class="highchart" data-graph-container-before="1" data-graph-type="line" style="display: none; " data-graph-line-width="2">
                        <thead>
                            <tr>
                                <th>Data</th>
                                <th>Debit Andalan</th>
                            </tr>
                        </thead>
                        <tbody>


                            <?php 
                            foreach ($andalan as $key => $value) {
                                echo "<tr>";
                                echo "<td>" . $value['month'] . "</td>";
                                echo "<td>" . $value['debit'] . "</td>";
                                
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

<script>
    // $(function() {
    //     var dataAndalan = <?php echo json_encode($andalan) ?>;
        
    //     var months      = ['Jan1', 'Feb1', 'Mar1', 'Apr1', 'Mei1', 'Jun1', 'Jul1', 'Ags1', 'Sep1', 'Okt1', 'Nov1', 'Des1',
    //                     'Jan2', 'Feb2', 'Mar2', 'Apr2', 'Mei2', 'Jun2', 'Jul2', 'Ags2', 'Sep2', 'Okt2', 'Nov2', 'Des2',];
    //     var date        = new Date();
    //     var year        = date.getFullYear();
    //     var dataIndex   = 0;

    //     Morris.Line({
    //         element: 'morris-area-chart',
    //         data: dataAndalan,
    //         xkey: 'month',
    //         ykeys: ['debit'],
    //         labels: ['Debit'],
    //         pointSize: 2,
    //         hideHover: 'auto',
    //         resize: true,
    //         xLabelFormat: function(x) {

    //             dataIndex +=1;
    //             console.log(x, x.getMonth(), x.getFullYear(), dataIndex);
    //             return months[dataIndex];
    //         }
    //     });

    //     $(document)
    //         .off('change', '#region-id')
    //         .on('change', '#region-id', function(e) {
    //             console.log($(this).val())
    //         });

    // });

</script>


<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharttable.org/master/jquery.highchartTable-min.js"></script> 

<script>
    $(function() {
        $(document).ready(function() {
          $('table.highchart').highchartTable();
        });

    });

</script>