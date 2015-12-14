<link href="<?php echo base_url('assets/integrated/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css'); ?>" rel="stylesheet">

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Daftar Luas Daerah Irigasi</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
       
        <?php echo $this->session->flashdata('message')['notification']; ?>
       
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                    <div class="col-sm-3">
                        <a href="<?php echo site_url('water-add'); ?>" class="btn btn-primary"><span class="fa fa-plus-square"></span> Tambah</a>
                    </div>
                    
                    <div class="col-sm-5 col-sm-offset-4">
                        <?php echo form_open('') ?>
                        <div class="input-group col-xs-7" style="float: left;">
                            <input type="text" class="form-control" id="year" name="date" placeholder="Tahun Bulan" value="<?php echo isset($_POST['date']) ? $_POST['date'] : ''; ?>">
                            <label for="date-picker-2" class="input-group-addon btn"><span class="glyphicon glyphicon-calendar"></span>

                            </label>
                        </div>
                        <div class="col-xs-3">
                            <button type="submit" class="btn btn-info"><span class="fa fa-search"></span> Cari</button>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                    
                </div>
                
                <br>
                <br>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Luas Daerah Irigasi
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
                                        <th>Nama daerah</th>
                                        <th>Tanggal</th>
                                        <th>Kanan</th>
                                        <th>Kiri</th>
                                        <th>Limpas</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ( $table as $key => $item ): ?>
                                        <?php if ( $key % 2 == 0 ): ?>
                                            <tr class="odd" data-id="<?php echo $item->id ?>">
                                                <td><?php echo $key + 1 ?></td>
                                                <td><?php echo $item->region_name ?></td>
                                                <td><?php echo $item->date ?></td>
                                                <td><?php echo $item->right ?> dm<sup>3</sup></td>
                                                <td><?php echo $item->left ?> dm<sup>3</sup></td>
                                                <td><?php echo $item->limpas ?> dm<sup>3</sup></td>
                                                <td>
                                                    <a href="<?php echo site_url('wide-edit/' . $item->id) ?>" class="btn btn-info btn-xs"><span class="fa fa-edit"></span> Edit</a> | 
                                                    <button class="btn btn-danger btn-xs" data-url="<?php echo site_url('wide-delete/' . $item->id) ?>" data-toggle="modal" data-target="#confirm-delete"><span class="fa fa-trash-o"></span> Edit</button>
                                                </td>
                                            </tr>
                                        <?php else: ?>
                                            <tr class="even">
                                                <td><?php echo $key + 1 ?></td>
                                                <td><?php echo $item->region_name ?></td>
                                                <td><?php echo $item->date ?></td>
                                                <td><?php echo $item->right ?> dm<sup>3</sup></td>
                                                <td><?php echo $item->left ?> dm<sup>3</sup></td>
                                                <td><?php echo $item->limpas ?> dm<sup>3</sup></td>
                                                <td>
                                                    <a href="<?php echo site_url('wide-edit/' . $item->id) ?>" class="btn btn-info btn-xs"><span class="fa fa-edit"></span> Edit</a> | 
                                                    <button class="btn btn-danger btn-xs" data-url="<?php echo site_url('wide-delete/' . $item->id) ?>" data-toggle="modal" data-target="#confirm-delete"><span class="fa fa-trash-o"></span> Edit</button>
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
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<script type="text/javascript" src="<?php echo base_url('assets/integrated/bower_components/datatables/media/js/jquery.dataTables.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/integrated/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js') ?>"></script>
<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script>
$(document).ready(function() {
    $('#data-table').DataTable({
            responsive: true
    });
    $('body')
        .off('show.bs.modal', '#confirm-delete')
        .on('show.bs.modal', '#confirm-delete', function (event) {
          var button = $(event.relatedTarget);
          var url = button.data('url');
          var modal = $(this);

          modal.find('.modal-footer').find('a').attr('href', url);
          
        })
});
</script>
<style>
    .ui-datepicker-calendar {
        display: none;
    }
</style>
