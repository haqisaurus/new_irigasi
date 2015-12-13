<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Buat Daerah Irigasi</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>

        <?php echo $this->session->flashdata('message'); ?>


        <div class="row">
            <div class="col-lg-12">
                <?php 
                $attributes = array('class' => 'form-horizontal', 'id' => 'region-create');

                echo form_open('region-add-action', $attributes);
                ?>
                    <div class="form-group <?php echo form_error('region-name') ? 'has-error' : ''; ?>">
                        <label for="region-name" class="col-sm-2 control-label">Nama Daerah</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="region-name" name="region-name" placeholder="Username" value="<?php echo set_value('region-name', ''); ?>">
                            <?php echo form_error('region-name'); ?>
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
    </div>
    <!-- /.container-fluid -->
</div>
