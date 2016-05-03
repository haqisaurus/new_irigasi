
<div id="page-wrapper">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Kinerja <small>Hasil</small>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-users"></i>  <a href="<?php echo site_url('admin') ?>">Dashboard</a>
                </li>
                <li class="active">
                    <i class="fa fa-edit"></i> kinerja
                </li>
            </ol>
        </div> 
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
            <a href="<?php echo site_url('water') ?>" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
            <br>
            <br>
            <?php if(validation_errors() != false): ?>
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="fa fa-info-circle"></i>  <strong>Terdapat kesalahan</strong> Cek ulang data anda!
                <?php echo validation_errors() ?>
            </div>
            <?php endif ?>
        </div>
    </div>
    <!-- /.row -->

    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Data Hasil Kinerja Tampilan Pengamat
                </div>
                
                <!-- /.panel-heading -->
                <div class="panel-body">

                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="data-table">
                            <thead>
                                <tr>
                                    <th>Data</th>
                                    <th>Nilai</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="odd">
                                    <td>Masa Tanam</td>
                                    <td class="center"><?php echo $pengamat['mt'] ?></td>
                                </tr>
                                <tr class="odd">
                                    <td>Indeks Pertanaman</td>
                                    <td class="center"><?php echo $pengamat['data'][0] ?></td>
                                </tr>
                                <tr class="odd">
                                    <td>Indeks Pertanaman Padi</td>
                                    <td class="center"><?php echo $pengamat['data'][1] ?></td>
                                </tr>
                                <tr class="odd">
                                    <td>Intensitas tanam</td>
                                    <td class="center"><?php echo $pengamat['data'][2] ?></td>
                                </tr>
                                <tr class="odd">
                                    <td>Index Debit</td>
                                    <td class="center"><?php echo $pengamat['index_debit'] ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
        </div>
    </div>

    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Data Hasil Kinerja Tampilan Boss
                </div>

                <!-- /.panel-heading -->
                <div class="panel-body">

                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="data-table">
                            <thead>
                                <tr>
                                    <th>Data</th>
                                    <th>MT 1</th>
                                    <th>MT 2</th>
                                    <th>MT 3</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="odd">
                                    <td>Indeks Pertanaman</td>
                                    <td class="center"><?php echo $result[0][0] ?></td>
                                    <td><?php echo $result[1][0] ?></td>
                                    <td><?php echo $result[2][0] ?></td>
                                </tr>
                                <tr class="odd">
                                    <td>Indeks Pertanaman Padi</td>
                                    <td class="center"><?php echo $result[0][1] ?></td>
                                    <td><?php echo $result[1][1] ?></td>
                                    <td><?php echo $result[2][1] ?></td>
                                </tr>
                                <tr class="odd">
                                    <td>Intensitas tanam</td>
                                    <td class="center"><?php echo $result[0][2] ?></td>
                                    <td><?php echo $result[1][2] ?></td>
                                    <td><?php echo $result[2][2] ?></td>
                                </tr>
                          
                                <?php foreach ( $current_index as $key => $item ): ?>
                                    <tr class="odd">
                                        <td><?php echo $key ?></td>
                                        <td class="center"><?php echo $item[0] ?></td>
                                        <td><?php echo $item[1] ?></td>
                                        <td><?php echo $item[2] ?></td>
                                    </tr>
                                <?php endforeach ?>
                                <tr class="odd">
                                    <td>Indeks debit</td>
                                    <td class="center"><?php echo $current_index['actual'][0] / $current_index['rencana'][0] ?></td>
                                    <td class="center"><?php echo $current_index['actual'][1] / $current_index['rencana'][1] ?></td>
                                    <td class="center"><?php echo $current_index['actual'][2] / $current_index['rencana'][2] ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $(document)
            .off('change', '#region') 
            .on('change', '#region', function(e) {
                var regionID = $(this).val();
                console.log(regionID)
                $.ajax({
                    url: "<?php echo site_url('get-year-ajax') ?>",
                    type: 'POST',
                    dataType: 'json',
                    data: {'region-id': regionID},
                })
                .done(function(response) {
                    
                    $('#year').empty();
                    
                    $.each(response, function(index, val) {
                        var option = '<option value="'+val.tahun+'">'+val.tahun+'</option>';
                        $('#year').append(option);
                    });
                })
                .fail(function() {
                    alert("get year error");
                })
                .always(function() {
                    console.log("complete");
                });
                
            });
    });
</script>