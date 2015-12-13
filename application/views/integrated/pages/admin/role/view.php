<link href="<?php echo base_url('assets/integrated/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css'); ?>" rel="stylesheet">

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Daftar user</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
       
        <?php echo $this->session->flashdata('message')['notification']; ?>
       
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <a href="<?php echo site_url('user-add'); ?>" class="btn btn-primary"><span class="fa fa-plus-square"></span> Tambah</a>
                <br>
                <br>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Data Daftar User
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
                                        <th>Username</th>
                                        <th>Nama Depan</th>
                                        <th>Nama Belakang</th>
                                        <th>Hak akses</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ( $table as $key => $item ): ?>
                                        <?php if ( $key % 2 == 0 ): ?>
                                            <tr class="odd" data-id="<?php echo $item->id ?>">
                                                <td><?php echo $key + 1 ?></td>
                                                <td class="center"><?php echo $item->username ?></td>
                                                <td><?php echo $item->first_name ?></td>
                                                <td><?php echo $item->last_name ?></td>
                                                <td class="center"><b><?php echo $item->role ?></b></td>
                                                <td>
                                                    <a href="<?php echo site_url('user-edit/' . $item->id) ?>" class="btn btn-info btn-xs"><span class="fa fa-edit"></span> Edit</a> | 
                                                    <button class="btn btn-danger btn-xs" data-url="<?php echo site_url('user-delete/' . $item->id) ?>" data-toggle="modal" data-target="#confirm-delete"><span class="fa fa-trash-o"></span> Edit</button>
                                                </td>
                                            </tr>
                                        <?php else: ?>
                                            <tr class="even">
                                                <td><?php echo $key + 1 ?></td>
                                                <td class="center"><?php echo $item->username ?></td>
                                                <td><?php echo $item->first_name ?></td>
                                                <td><?php echo $item->last_name ?></td>
                                                <td class="center"><b><?php echo $item->role ?></b></td>
                                                <td>
                                                    <a href="<?php echo site_url('user-edit/' . $item->id) ?>" class="btn btn-info btn-xs"><span class="fa fa-edit"></span> Edit</a> | 
                                                    <button class="btn btn-danger btn-xs" data-url="<?php echo site_url('user-delete/' . $item->id) ?>" data-toggle="modal" data-target="#confirm-delete"><span class="fa fa-trash-o"></span> Edit</button>
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
