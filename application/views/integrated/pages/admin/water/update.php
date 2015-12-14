
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
                $attributes = array('class' => 'form-horizontal', 'id' => 'wide-update');

                echo form_open('wide-edit-action', $attributes);
                ?>
                    <div class="form-group <?php echo form_error('region') ? 'has-error' : ''; ?>">
                        <label for="last_name" class="col-sm-2 control-label">Daerah</label>
                        <div class="col-sm-6">
                            <?php foreach ($regions as $key => $region): ?>
                                <?php $checked = ($region->id == $wide->region_id) ? 'checked' : '' ?>
                                <div class="checkbox">
                                    <label>
                                        <input type="radio" <?php echo $checked ?> name="region-id" value="<?php echo $region->id ?>"> <?php echo $region->region_name; ?>
                                    </label>
                                </div>
                            <?php endforeach ?>
                           
                            <?php echo form_error('region'); ?>
                        </div>
                    </div>
                    <div class="form-group <?php echo form_error('area-name') ? 'has-error' : ''; ?>">
                        <label for="area-name" class="col-sm-2 control-label">Nama Area</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" id="area-name" name="area-name" placeholder="Area" value="<?php echo set_value('region-name', $wide->area_name); ?>">
                            <?php echo form_error('area-name'); ?>
                        </div>
                    </div>
                    <div class="form-group <?php echo form_error('wide') ? 'has-error' : ''; ?>">
                        <label for="wide" class="col-sm-2 control-label">Luas</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" id="wide" name="wide" placeholder="Luas (hektar)" value="<?php echo set_value('wide', $wide->wide); ?>">
                            <?php echo form_error('wide'); ?>
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
