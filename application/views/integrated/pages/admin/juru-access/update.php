
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Hak Akses Juru</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>

        <?php echo $this->session->flashdata('message'); ?>


        <div class="row">
            <div class="col-lg-12">
                <?php 
                $attributes = array('class' => 'form-horizontal', 'id' => 'user-update');

                echo form_open('juru-access-edit-action', $attributes);
                ?>
                    <div class="form-group <?php echo form_error('username') ? 'has-error' : ''; ?>">
                        <label for="username" class="col-sm-2 control-label">Username</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="<?php echo set_value('username', $user->username); ?>" disabled>
                            <?php echo form_error('username'); ?>
                        </div>
                    </div>
                    <div class="form-group <?php echo form_error('first-name') ? 'has-error' : ''; ?>">
                        <label for="fisrt_name" class="col-sm-2 control-label">Nama depan</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="fisrt_name" name="first-name" placeholder="Nama depan" value="<?php echo set_value('first_name', $user->first_name); ?>" disabled>
                            <?php echo form_error('first-name'); ?>
                        </div>
                    </div>
                    <div class="form-group <?php echo form_error('last-name') ? 'has-error' : ''; ?>">
                        <label for="last_name" class="col-sm-2 control-label">Nama belakang</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="last_name" name="last-name" placeholder="Nama belakang" value="<?php echo set_value('last_name', $user->last_name); ?>" disabled>
                            <?php echo form_error('last-name'); ?>
                        </div>
                    </div>
                    <div class="form-group <?php echo form_error('regions[]') ? 'has-error' : ''; ?>">
                        <label for="last_name" class="col-sm-2 control-label">Daerah akses</label>
                        <div class="col-sm-6">
                            <?php 
                                $selected = [];
                                foreach ($regions_selected as $value) {
                                    array_push($selected, $value->id);
                                }
                             ?>
                            <?php foreach ($regions as $key => $region): ?>
                                
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="regions[]" value="<?php echo $region->id ?>" <?php echo in_array($region->id, $selected) ? 'checked' : ''; ?>><?php echo $region->region_name; ?>
                                    </label>
                                </div>
                            <?php endforeach ?>
                          
                            <?php echo form_error('regions[]'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <input type="hidden" name="id" value="<?php echo set_value('id', $user->id); ?>">
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
