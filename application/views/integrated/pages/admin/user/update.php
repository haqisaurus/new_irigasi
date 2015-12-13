
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Edit user</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>

        <?php echo $this->session->flashdata('message'); ?>


        <div class="row">
            <div class="col-lg-12">
                <?php 
                $attributes = array('class' => 'form-horizontal', 'id' => 'user-update');

                echo form_open('user-edit-action', $attributes);
                ?>
                    <div class="form-group <?php echo form_error('username') ? 'has-error' : ''; ?>">
                        <label for="username" class="col-sm-2 control-label">Username</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="<?php echo set_value('username', $user->username); ?>">
                            <?php echo form_error('username'); ?>
                        </div>
                    </div>
                    <div class="form-group <?php echo form_error('first-name') ? 'has-error' : ''; ?>">
                        <label for="fisrt_name" class="col-sm-2 control-label">Nama depan</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="fisrt_name" name="first-name" placeholder="Nama depan" value="<?php echo set_value('first_name', $user->first_name); ?>">
                            <?php echo form_error('first-name'); ?>
                        </div>
                    </div>
                    <div class="form-group <?php echo form_error('last-name') ? 'has-error' : ''; ?>">
                        <label for="last_name" class="col-sm-2 control-label">Nama belakang</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="last_name" name="last-name" placeholder="Nama belakang" value="<?php echo set_value('last_name', $user->last_name); ?>">
                            <?php echo form_error('last-name'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="access" class="col-sm-2 control-label">Hak akses</label>
                        <div class="col-sm-3">
                            <?php 
                            $options = array(
                                              '2' => 'Juru',
                                              '1' => 'Admin',
                                              '3' => 'Pengamat',
                                              '4' => 'Boss',
                                            );

                            echo form_dropdown('role-id', $options, $user->role_id, 'class="form-control"');
                            ?>
                        </div>
                    </div>
                    <div class="form-group <?php echo form_error('password') ? 'has-error' : ''; ?>">
                        <label for="password" class="col-sm-2 control-label">Password</label>
                        <div class="col-sm-3">
                            <input type="password" class="form-control" id="password" placeholder="Password" value="<?php echo set_value('password', ''); ?>">
                            <?php echo form_error('password'); ?>
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
