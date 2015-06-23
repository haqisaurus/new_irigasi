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
    <div class="col-lg-12">
        <?php 
        $attributes = array('class' => 'form-horizontal', 'id' => 'water-update');

        echo form_open('water/update-action', $attributes);
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
                <label for="date" class="col-sm-2 control-label">Tanggal</label>
                <div class="col-sm-3">
                    <div class="input-group">
                        <input type="text" class="form-control" id="date" name="date" placeholder="Tanggal" value="<?php echo set_value('date', $update->date); ?>">
                        <label for="date-picker-2" class="input-group-addon btn"><span class="glyphicon glyphicon-calendar"></span>

                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="right" class="col-sm-2 control-label">Saluran Kanan</label>
                <div class="col-sm-2">
                    <input type="text" class="form-control" id="right" name="right" placeholder="Kanan" value="<?php echo set_value('right', $update->right); ?>">
                </div>
                <div class="col-sm-1">dm<sup>3</sup></div>
            </div>
            <div class="form-group">
                <label for="left" class="col-sm-2 control-label">Saluran Kiri</label>
                <div class="col-sm-2">
                    <input type="text" class="form-control" id="left" name="left" placeholder="Kiri" value="<?php echo set_value('left', $update->left); ?>">
                </div>
                <div class="col-sm-1">dm<sup>3</sup></div>
            </div>
            <div class="form-group">
                <label for="limpas" class="col-sm-2 control-label">Saluran Limpas</label>
                <div class="col-sm-2">
                    <input type="text" class="form-control" id="limpas" name="limpas" placeholder="Limpas" value="<?php echo set_value('limpas', $update->limpas); ?>">
                </div>
                <div class="col-sm-1">dm<sup>3</sup></div>
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