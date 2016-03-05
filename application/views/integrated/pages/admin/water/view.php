<link href="<?php echo base_url('assets/integrated/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css'); ?>" rel="stylesheet">

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Daftar Debit Air</h1>
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
                    
                    <div class="col-sm-9 ">
                        <?php 
                        $attributes = array('class' => 'form-horizontal', 'id' => 'search-table');
                        
                        echo form_open('', $attributes);
                        ?>
                        <div class="col-xs-3">
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
                            <label for="access" class="control-label">Thn</label>
                        </div>
                        <div class="col-xs-3 form-group">
                            <div class="col-sm-12">
                                <?php 
                                
                                $options = array();

                                foreach ($years as $key => $item) {
                                    $options[$item->tahun] = $item->tahun;
                                }

                                echo form_dropdown('year', $options, set_value('year'), 'class="form-control"');
                                ?>
                            </div>
                        </div>
                        <div class="col-xs-1">
                            <label for="access" class="control-label">Bln</label>
                        </div>
                        <div class="col-xs-3 form-group">
                            <!-- <label for="access" class="col-sm-5 control-label">Bulan</label> -->
                            <div class="col-sm-12">
                                <?php 
                                
                                $options = array(
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
                                    '11'    => 'November',
                                    '12'    => 'Desember',
                                    );

                                

                                echo form_dropdown('month', $options, set_value('month'), 'class="form-control"');
                                ?>
                            </div>
                        </div>
                        
                        <div class="col-xs-1">
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
                                        <th>Kanan (lit/det)</th>
                                        <th>Kiri (lit/det)</th>
                                        <th>Limpas (lit/det)</th>
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
                                                <td class="text-right"><?php echo $item->right ?> </td>
                                                <td class="text-right"><?php echo $item->left ?> </td>
                                                <td class="text-right"><?php echo $item->limpas ?> </td>
                                                <td>
                                                    <a href="<?php echo site_url('water-edit/' . $item->id) ?>" class="btn btn-info btn-xs"><span class="fa fa-edit"></span> Edit</a> | 
                                                    <button class="btn btn-danger btn-xs" data-url="<?php echo site_url('water-delete/' . $item->id) ?>" data-toggle="modal" data-target="#confirm-delete"><span class="fa fa-trash-o"></span> Edit</button>
                                                </td>
                                            </tr>
                                        <?php else: ?>
                                            <tr class="even">
                                                <td><?php echo $key + 1 ?></td>
                                                <td><?php echo $item->region_name ?></td>
                                                <td><?php echo $item->date ?></td>
                                                <td class="text-right"><?php echo $item->right ?> </td>
                                                <td class="text-right"><?php echo $item->left ?> </td>
                                                <td class="text-right"><?php echo $item->limpas ?> </td>
                                                <td>
                                                    <a href="<?php echo site_url('water-edit/' . $item->id) ?>" class="btn btn-info btn-xs"><span class="fa fa-edit"></span> Edit</a> | 
                                                    <button class="btn btn-danger btn-xs" data-url="<?php echo site_url('water-delete/' . $item->id) ?>" data-toggle="modal" data-target="#confirm-delete"><span class="fa fa-trash-o"></span> Edit</button>
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
