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
        <a href="<?php echo site_url('wide') ?>" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
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
        $attributes = array('class' => 'form-horizontal', 'id' => 'wide-update');

        echo form_open('wide/update-action', $attributes);
        ?>
            <div class="form-group">
                <label for="region-id" class="col-sm-2 control-label">Nama daerah irigasi</label>
                <div class="col-sm-6">
                    <?php   
                    foreach ($region as $key => $item) {
                    ?>
                        <label class="radio-inline">
                            <input type="radio" name="region-id" id="region-id-<?php echo $key?>" value="<?php  echo $item->id ?>" <?php echo set_checkbox('region-id', $item->id, ($item->id == $update->region_id)); ?>><?php  echo $item->region_name ?>
                        </label>
                    <?php   
                    }
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label for="wide-location" class="col-sm-2 control-label">lokasi</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="wide-location" name="wide-location" placeholder="Nama lokasi" value="<?php echo set_value('wide-location', $update->area_name); ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="wide" class="col-sm-2 control-label">Luas daerah</label>
                <div class="col-sm-2">
                    <input type="text" class="form-control" id="wide" name="wide" placeholder="Luas daerah" value="<?php echo set_value('wide', $update->wide); ?>">
                </div>
                <div class="col-sm-1">ha
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