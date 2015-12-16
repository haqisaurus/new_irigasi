<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Masukan Data Debit</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>

        <?php echo $this->session->flashdata('message'); ?>


        <div class="row">
            <div class="col-lg-12">
                <?php 
                $attributes = array('class' => 'form-horizontal', 'id' => 'water-create');

                echo form_open('water-add-action', $attributes);
                ?>
                    <div class="form-group <?php echo form_error('region-id') ? 'has-error' : ''; ?>">
                        <label for="access" class="col-sm-2 control-label">Daerah Irigasi</label>
                        <div class="col-sm-3">
                            <?php 
                            $options = array();

                            foreach ($regions as $key => $item) {
                                $options[$item->id] = $item->region_name;
                            }

                            echo form_dropdown('region-id', $options, set_value('region-id'), 'class="form-control"');
                            echo form_error('region-id');
                            ?>
                        </div>
                    </div>
                    <div class="form-group <?php echo form_error('date') ? 'has-error' : ''; ?>">
                        <label for="date" class="col-sm-2 control-label">Tanggal</label>
                        <div class="col-sm-4">
                            <div class="input-group">
                                <input type="text" class="form-control" id="date" name="date" placeholder="Tanggal" value="<?php echo set_value('date', ''); ?>">
                                <label for="date-picker-2" class="input-group-addon btn"><span class="glyphicon glyphicon-calendar"></span>

                                </label>
                            </div>
                            <?php echo form_error('date'); ?>
                        </div>
                    </div>
                    <div class="form-group <?php echo form_error('right') ? 'has-error' : ''; ?>">
                        <label for="right" class="col-sm-2 control-label">Saluran Kanan</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control js-debit-field" id="right" name="right" placeholder="Kanan" value="<?php echo set_value('right', ''); ?>">
                            <?php echo form_error('right'); ?>

                        </div>
                        <div class="col-sm-1">dm<sup>3</sup></div>
                    </div>
                    <div class="form-group <?php echo form_error('left') ? 'has-error' : ''; ?>">
                        <label for="left" class="col-sm-2 control-label">Saluran Kiri</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control js-debit-field" id="left" name="left" placeholder="Kiri" value="<?php echo set_value('left', ''); ?>">
                            <?php echo form_error('left'); ?>

                        </div>
                        <div class="col-sm-1">dm<sup>3</sup></div>
                    </div>
                    <div class="form-group <?php echo form_error('limpas') ? 'has-error' : ''; ?>">
                        <label for="limpas" class="col-sm-2 control-label">Saluran Limpas</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control js-debit-field" id="limpas" name="limpas" placeholder="Limpas" value="<?php echo set_value('limpas', ''); ?>">
                            <?php echo form_error('limpas'); ?>
                        </div>
                        <div class="col-sm-1">dm<sup>3</sup></div>
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
<script src="<?php echo base_url('assets/integrated/js/jquery.maskedinput.min.js') ?>" type="text/javascript"></script>

<script>
    $.mask.definitions['h'] = ['[0-9]'];
    $(".js-debit-field").mask("999.9999", { placeholder: '', autoclear: false});
</script>
