<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Luas daerah irigasi <small>daftar</small>
        </h1>
        <ol class="breadcrumb">
            <li class="active">
                <i class="fa fa-users"></i> Luas daerah irigasi
            </li>
            <li>
                <i class="fa fa-file"></i> Data list
            </li>
        </ol>
    </div>
</div>
<!-- /.row -->

<div class="row">
    <div class="col-lg-12">
        <a href="<?php echo site_url('wide/create') ?>" class="btn btn-primary"><span class="glyphicon glyphicon-file"></span> Baru</a>
        <button class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Hapus masal</button>
        <br>
        <br>
        <?php 
        $message = $this->session->flashdata('message');

        if ($message): 
        ?>
        <div class="alert alert-dismissable <?php echo ($message['status']) ? 'alert-info' : 'alert-danger' ; ?>">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <i class="fa fa-info-circle"></i>  <?php echo $message['msg'] ?>
        </div>
        <?php endif ?>
    </div>
</div>
<!-- /.row -->

<div class="row">
    <div class="col-lg-12">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama daerah</th>
                        <th>Nama lokasi</th>
                        <th>Luas daerah</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    foreach ($table as $key => $wide) {
                    ?>
                    <tr>
                        <td><?php echo $this->uri->segment(2) + $key + 1 ?></td>
                        <td><?php echo $wide->region_name ?></td>
                        <td><?php echo $wide->area_name ?></td>
                        <td><?php echo $wide->wide ?> M<sup>2</sup></td>
                        <td>
                            <a href="<?php echo site_url('wide/update/' . $wide->id); ?>" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-text-width"></span> Edit</a> | 
                            <a href="#" data-href="<?php echo site_url('wide/delete-action/' . $wide->id); ?>" class="btn btn-danger btn-xs delete-row" data-toggle="modal" data-target="#confirm-delete"><span class="glyphicon glyphicon-trash"></span> Hapus</a>
                        </td>
                    </tr>
                    <?php 
                    }
                    ?>
                </tbody>
            </table>
            <?php echo $pagination ?>
        </div>
    </div>
</div>