<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Daerah irigasi <small>baru</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-users"></i>  <a href="index.html">Daerah irigasi</a>
            </li>
            <li class="active">
                <i class="fa fa-edit"></i> Buat baru
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
        $attributes = array('class' => 'form-horizontal', 'id' => 'region-create');

        echo form_open('backend/region/docreate', $attributes);
        ?>
            <div class="form-group">
                <label for="region-name" class="col-sm-2 control-label">Nama daerah</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="region-name" name="region-name" placeholder="Nama daerah" value="<?php echo set_value('region-name', ''); ?>">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span> Simpan</button>
                </div>
            </div>
        <?php 
        echo form_close();
        ?>

    </div>
</div>
<!-- /.row -->