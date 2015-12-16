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
        
        var months      = ['Nov1', 'Nov2', 'Des1', 'Des2', 'Jan1', 'Jan2', 'Feb1', 'Feb2', 'Mar1', 'Mar2', 'Apr1', 'Apr2', 'Mei1', 'Mei2', 'Jun1', 'Jun2', 'Jul1', 'Jul2', 'Ags1', 'Ags2', 'Sep1', 'Sep2', 'Okt1', 'Okt2'];
        var date        = new Date();
        var year        = date.getFullYear();
        var dataIndex   = 0;

        Morris.Line({
            element: 'morris-area-chart',
            data: dataAndalan,
            xkey: 'month',
            ykeys: ['debit', 'demand', 'neraca'],
            labels: ['Debit', 'Demand', 'Neraca'],
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