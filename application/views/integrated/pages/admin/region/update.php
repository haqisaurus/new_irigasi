
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Edit Daerah Irigasi</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>

        <?php echo $this->session->flashdata('message')['notification']; ?>


        <div class="row">
            <div class="col-lg-12">
                <?php 
                $attributes = array('class' => 'form-horizontal', 'id' => 'region-update');

                echo form_open('region-edit-action', $attributes);
                ?>
                    <div class="form-group <?php echo form_error('region-name') ? 'has-error' : ''; ?>">
                        <label for="region-name" class="col-sm-2 control-label">Nama Daerah</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="region-name" name="region-name" placeholder="Nama Daerah" value="<?php echo set_value('region-name', $region->region_name); ?>">
                            <?php echo form_error('region-name'); ?>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <input type="hidden" name="id" value="<?php echo set_value('id', $region->id); ?>">
                            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-saved"></span> Perbarui</button>
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
