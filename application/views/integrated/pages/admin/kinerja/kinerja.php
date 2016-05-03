
<div id="page-wrapper">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Kinerja <small>laporan</small>
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

    <div class="row">
        <?php 
        $options = array(
                    'Januari 1',
                    'Januari 2',
                    'February 1',
                    'February 2',
                    'Maret 1',
                    'Maret 2',
                    'April 1',
                    'April 2',
                    'Mei 1',
                    'Mei 2',
                    'Juni 1',
                    'Juni 2',
                    'Juli 1',
                    'Juli 2',
                    'Agustus 1',
                    'Agustus 2',
                    'September 1',
                    'September 2',
                    'Oktober 1',
                    'Oktober 2',
                    'November 1',
                    'November 2',
                    'Desember 1',
                    'Desember 2',
                    );

        if(isset($result)) {
            echo 'Debit rencana periode ' .$options[$_POST['periode']]. ' :  <b>' . $result . '</b> liter/detik'; 
        }
        ?>
        <div class="col-lg-12">
            <?php 
            $attributes = array('class' => 'form-horizontal', 'id' => 'region-create');
            
            echo form_open('integrated/admin_page/allocationCalc', $attributes);
            ?>
            <div class="form-group">
                <label for="access" class="col-sm-3 control-label">Tahun</label>

                <div class="col-sm-4">
                    <?php 
                    $options = [];

                    foreach ($regions as $key => $value) {
                        $options[$value->id] = $value->region_name;
                    }
                    echo form_dropdown('region', $options, isset($_POST['periode'])?$_POST['periode']:'', 'class="form-control" id="region" ');
                    ?>
                </div>
            </div>
            <div class="form-group region-year">
                <label for="access" class="col-sm-3 control-label">Tahun</label>

                <div class="col-sm-4">
                    <?php 
                    $now = date('Y');
                    $options = [];
                    foreach ($years as $key => $value) {
                        array_push($options, $value->tahun);
                    }

                    echo form_dropdown('year', $options, isset($_POST['periode'])?$_POST['periode']:$now, 'class="form-control" id="year" ');
                    ?>
                </div>
            </div>
            
            <?php 
            echo form_close();
             ?>
        </div>    
    </div>

    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Data Daftar Rencana Tanam
                </div>
                <?php if ( $table ): ?>
                    
                <?php endif ?>
                <!-- /.panel-heading -->
                <div class="panel-body">

                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="data-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tahun Rencana</th>
                                    <th>Daerah</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ( $table as $key => $item ): ?>
                                    <?php if ( $key % 2 == 0 ): ?>
                                        <tr class="odd" data-id="<?php echo $item->id ?>">
                                            <td><?php echo $key + 1 ?></td>
                                            <td class="center"><?php echo $item->year ?></td>
                                            <td><?php echo $item->region_name ?></td>
                                            <td>
                                                <a href="<?php echo site_url('kinerja-calc/' . $item->id) ?>" class="btn btn-info btn-xs"><span class="fa fa-edit"></span> Kinerja</a> 
                                            </td>
                                        </tr>
                                    <?php else: ?>
                                        <tr class="even">
                                            <td><?php echo $key + 1 ?></td>
                                            <td class="center"><?php echo $item->year ?></td>
                                            <td><?php echo $item->region_name ?></td>
                                            <td>
                                                <a href="<?php echo site_url('kinerja-calc/' . $item->id) ?>" class="btn btn-info btn-xs"><span class="fa fa-edit"></span> Kinerja</a> 
                                            </td>
                                        </tr>
                                    <?php endif ?>
                                <?php endforeach ?>
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