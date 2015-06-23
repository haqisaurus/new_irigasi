<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Pengguna <small>perbarui</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-users"></i>  <a href="index.html">Pengguna</a>
            </li>
            <li class="active">
                <i class="fa fa-edit"></i> Perbarui data
            </li>
        </ol>
    </div>
</div>
<!-- /.row -->

<div class="row">
    <div class="col-lg-12">
        <a href="<?php echo site_url('region') ?>" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
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
    <div class="col-lg-12">
        <?php 
        $attributes = array('class' => 'form-horizontal', 'id' => 'region-update');

        echo form_open('region/update-action', $attributes);
        ?>
            <div class="form-group">
                <label for="region-name" class="col-sm-2 control-label">Username</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="region-name" name="region-name" placeholder="Nama daerah" value="<?php echo set_value('region-name', $update->region_name); ?>">
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <input type="hidden" name="id" value="<?php echo set_value('id', $update->id); ?>">
                    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-saved"></span> Perbarui</button>
                </div>
            </div>
        <?php 
        echo form_close();
        ?>

    </div>
</div>
<!-- /.row -->