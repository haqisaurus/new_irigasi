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
        <a href="<?php echo site_url('user') ?>" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
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
        $attributes = array('class' => 'form-horizontal', 'id' => 'user-update');

        echo form_open('user/update-action', $attributes);
        ?>
            <div class="form-group">
                <label for="username" class="col-sm-2 control-label">Username</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="<?php echo set_value('username', $update->username); ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="fisrt_name" class="col-sm-2 control-label">Nama depan</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="fisrt_name" name="first_name" placeholder="Nama depan" value="<?php echo set_value('first_name', $update->first_name); ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="last_name" class="col-sm-2 control-label">Nama belakang</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Nama belakang" value="<?php echo set_value('last_name', $update->last_name); ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="access" class="col-sm-2 control-label">Hak akses</label>
                <div class="col-sm-3">
                    <?php 
                    $options = array(
                                      '1' => 'Admin',
                                      '2' => 'Juru',
                                      '3' => 'Pengamat',
                                      '4' => 'Boss',
                                    );

                    echo form_dropdown('role_id', $options, $update->role_id, 'class="form-control"');
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-sm-2 control-label">Password</label>
                <div class="col-sm-3">
                    <input type="password" class="form-control" id="password" placeholder="Password" value="<?php echo set_value('password', ''); ?>">
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