
<div id="page-wrapper">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Alokasi Air <small>edit</small>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-users"></i>  <a href="index.html">Debit air</a>
                </li>
                <li class="active">
                    <i class="fa fa-edit"></i> Constant edit
                </li>
            </ol>
        </div> 
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
            <a href="<?php echo site_url('allocation') ?>" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
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
            echo 'Debit rencana periode ' .$options[$_POST['periode']]. ' :  <b>' . $result['debit'] . '</b> liter/detik<br>Faktor K : ' . $result['k_factor']; 
        }
        ?>
        <div class="col-lg-12">
            <?php 
            $attributes = array('class' => 'form-horizontal', 'id' => 'region-create');
            
            echo form_open('integrated/admin_page/allocationCalc', $attributes);
            ?>
            <div class="form-group">
                <label for="access" class="col-sm-3 control-label">Periode</label>

                <div class="col-sm-4">
                    <?php 
                    
                    if (date('d') < 16) {
                        $now = ((int) date('m') * 2) - 2;
                    } else {
                        $now = ((int) date('m') * 2);
                    }

                    echo form_dropdown('periode', $options, isset($_POST['periode'])?$_POST['periode']:$now, 'class="form-control" id="periode" ');
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label for="access" class="col-sm-3 control-label">Daerah</label>

                <div class="col-sm-4">
                    <?php 
                    
                    $options = array();

                    foreach ($regions as $key => $item) {
                        $options[$item->id] = $item->region_name;
                    }

                    echo form_dropdown('region-id', $options, isset($_POST['region-id'])?$_POST['region-id']:'', 'class="form-control" id="region-id" ');
                    ?>
                </div>
            </div>
            <div class="form-group <?php echo form_error('growth') ? 'has-error' : ''; ?>">
                <label for="access" class="col-sm-3 control-label">Padi Fase Pertumbuhan</label>
                <div class="col-sm-5">
                    <input type="text" name="growth" class="form-control col-xs-4" value="<?php echo isset($post['growth'])?$post['growth']:0 ?>">
                </div>
            </div>
            <div class="form-group <?php echo form_error('mature') ? 'has-error' : ''; ?>">
                <label for="access" class="col-sm-3 control-label">Padi Fase Pemasakan</label>
                <div class="col-sm-5">
                    <input type="text" name="mature" class="form-control col-xs-4" value="<?php echo isset($post['mature'])?$post['mature']:0 ?>">
                </div>
            </div>
            <div class="form-group <?php echo form_error('harvest') ? 'has-error' : ''; ?>">
                <label for="access" class="col-sm-3 control-label">Padi Fase Panen</label>
                <div class="col-sm-5">
                    <input type="text" name="harvest" class="form-control col-xs-4" value="<?php echo isset($post['harvest'])?$post['harvest']:0 ?>">
                </div>
            </div>
            <div class="form-group <?php echo form_error('palawija') ? 'has-error' : ''; ?>">
                <label for="access" class="col-sm-3 control-label">Palawija</label>
                <div class="col-sm-5">
                    <input type="text" name="palawija" class="form-control col-xs-4" value="<?php echo isset($post['palawija'])?$post['palawija']:0 ?>">
                </div>
            </div>
            <div class="form-group <?php echo form_error('sugar') ? 'has-error' : ''; ?>">
                <label for="access" class="col-sm-3 control-label">Tebu</label>
                <div class="col-sm-5">
                    <input type="text" name="sugar" class="form-control col-xs-4" value="<?php echo isset($post['sugar'])?$post['sugar']:0 ?>">
                </div>
            </div>
            <div class="form-group <?php echo form_error('bero') ? 'has-error' : ''; ?>">
                <label for="access" class="col-sm-3 control-label">Bero</label>
                <div class="col-sm-5">
                    <input type="text" name="bero" class="form-control col-xs-4" value="<?php echo isset($post['bero'])?$post['bero']:0 ?>">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-7">
                    <br>
                    <button type="submit" class="btn btn-primary" id="calculate"><span class="glyphicon glyphicon-floppy-disk"></span> Save</button>
                </div>
            </div>
            <?php 
            echo form_close();
            ?>

        </div>
    </div>
    <!-- /.row -->
</div>