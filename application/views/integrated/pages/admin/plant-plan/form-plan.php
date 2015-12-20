
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Masukan Data rencana</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <?php 
            $attributes = array('class' => 'form-horizontal', 'id' => 'user-create');

            echo form_open('user-add-action', $attributes);
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
                <div class="form-group">
                    <label for="access" class="col-sm-2 control-label">Tahun</label>
                    <div class="col-sm-3">
                        <?php 
                        $options = array();
                        for ($i=2014; $i < 2026; $i++) { 
                            $options[$i] = $i;
                        }

                        echo form_dropdown('role-id', $options, set_value('role-id'), 'class="form-control"');
                        ?>
                    </div>
                </div>
                <div class="form-group <?php echo form_error('username') ? 'has-error' : ''; ?>">
                    <label for="access" class="col-sm-2 control-label">Rentang</label>

                    <div class="col-sm-9">
                        <input type="range" min="0" max="12" step="1" id="username" name="username" placeholder="Username" value="<?php echo set_value('username', ''); ?>">
                        <?php echo form_error('username'); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-10 col-xs-offset-1">
                        <table class="table">
                            <tr>
                                <th>#</th>
                                <th>MT 1</th>
                                <th>MT 2</th>
                                <th>MT 3</th>
                            </tr>
                            <tr>
                                <td><label for="">Padi</label></td>
                                <td><input type="text"></td>
                                <td><input type="text"></td>
                                <td><input type="text"></td>
                            </tr>
                            <tr>
                                <td><label for="">Palawija</label></td>
                                <td><input type="text"></td>
                                <td><input type="text"></td>
                                <td><input type="text"></td>
                            </tr>
                            <tr>
                                <td><label for="">Tebu</label></td>
                                <td><input type="text"></td>
                                <td><input type="text"></td>
                                <td><input type="text"></td>
                            </tr>
                            <tr>
                                <td><label for="">Bero</label></td>
                                <td><input type="text"></td>
                                <td><input type="text"></td>
                                <td><input type="text"></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-5 col-sm-7">
                        <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span> Kalkulasi</button>
                    </div>
                </div>
            <?php 
            echo form_close();
            ?>

        </div>
    </div>
    <!-- /.row -->
</div>