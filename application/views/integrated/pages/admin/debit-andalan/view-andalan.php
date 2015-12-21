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
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Debit Andalan
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div id="morris-area-chart"></div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
    </div>
    <!-- /.row -->
</div>

<script>
    $(function() {
        var dataAndalan = <?php echo json_encode($andalan) ?>;
        
        var months      = ['Jan1', 'Feb1', 'Mar1', 'Apr1', 'Mei1', 'Jun1', 'Jul1', 'Ags1', 'Sep1', 'Okt1', 'Nov1', 'Des1',
                        'Jan2', 'Feb2', 'Mar2', 'Apr2', 'Mei2', 'Jun2', 'Jul2', 'Ags2', 'Sep2', 'Okt2', 'Nov2', 'Des2',];
        var date        = new Date();
        var year        = date.getFullYear();
        var dataIndex   = 0;

        Morris.Line({
            element: 'morris-area-chart',
            data: dataAndalan,
            xkey: 'month',
            ykeys: ['debit'],
            labels: ['Debit'],
            pointSize: 2,
            hideHover: 'auto',
            resize: true,
            xLabelFormat: function(x) {

                dataIndex +=1;
                console.log(x, x.getMonth(), x.getFullYear(), dataIndex);
                return months[dataIndex];
            }
        });

    });

</script>