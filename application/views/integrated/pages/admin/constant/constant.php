
<div id="page-wrapper">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Constant <small>edit</small>
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
            $attributes = array('class' => 'form-horizontal', 'id' => 'region-create');
            
            echo form_open('constant-save', $attributes);
            ?>
            <div class="row">
                <div class="col-xs-10 col-xs-offset-1 table-responsive">

                    <table class="table">
                        <tr>
                            <th>Periode</th>
                            <th>1</th>
                            <th>2</th>
                            <th>3</th>
                            <th>4</th>
                            <th>5</th>
                            <th>6</th>
                            <th>7</th>
                            <th>8</th>
                        </tr>
                        <tr>
                            <td><label for="">Padi</label></td>
                            <td><input type="text" name="rice[]" value="<?php echo $constant['rice'][0]?:0 ?>"></td>
                            <td><input type="text" name="rice[]" value="<?php echo $constant['rice'][1]?:0 ?>"></td>
                            <td><input type="text" name="rice[]" value="<?php echo $constant['rice'][2]?:0 ?>"></td>
                            <td><input type="text" name="rice[]" value="<?php echo $constant['rice'][3]?:0 ?>"></td>
                            <td><input type="text" name="rice[]" value="<?php echo $constant['rice'][4]?:0 ?>"></td>
                            <td><input type="text" name="rice[]" value="<?php echo $constant['rice'][5]?:0 ?>"></td>
                            <td><input type="text" name="rice[]" value="<?php echo $constant['rice'][6]?:0 ?>"></td>
                            <td><input type="text" name="rice[]" value="<?php echo $constant['rice'][7]?:0 ?>"></td>
                        </tr>
                        <tr>
                            <td><label for="">Palawija</label></td>
                            <td><input type="text" name="palawija[]" value="<?php echo $constant['palawija'][0]?:0 ?>"></td>
                            <td><input type="text" name="palawija[]" value="<?php echo $constant['palawija'][1]?:0 ?>"></td>
                            <td><input type="text" name="palawija[]" value="<?php echo $constant['palawija'][2]?:0 ?>"></td>
                            <td><input type="text" name="palawija[]" value="<?php echo $constant['palawija'][3]?:0 ?>"></td>
                            <td><input type="text" name="palawija[]" value="<?php echo $constant['palawija'][4]?:0 ?>"></td>
                            <td><input type="text" name="palawija[]" value="<?php echo $constant['palawija'][5]?:0 ?>"></td>
                            <td><input type="text" name="palawija[]" value="<?php echo $constant['palawija'][6]?:0 ?>"></td>
                            <td><input type="text" name="palawija[]" value="<?php echo $constant['palawija'][7]?:0 ?>"></td>
                        </tr>
                        <tr>
                            <td><label for="">Tebu</label></td>
                            <td><input type="text" name="sugar[]" value="<?php echo $constant['sugar'][0]?:0 ?>"></td>
                            <td><input type="text" name="sugar[]" value="<?php echo $constant['sugar'][1]?:0 ?>"></td>
                            <td><input type="text" name="sugar[]" value="<?php echo $constant['sugar'][2]?:0 ?>"></td>
                            <td><input type="text" name="sugar[]" value="<?php echo $constant['sugar'][3]?:0 ?>"></td>
                            <td><input type="text" name="sugar[]" value="<?php echo $constant['sugar'][4]?:0 ?>"></td>
                            <td><input type="text" name="sugar[]" value="<?php echo $constant['sugar'][5]?:0 ?>"></td>
                            <td><input type="text" name="sugar[]" value="<?php echo $constant['sugar'][6]?:0 ?>"></td>
                            <td><input type="text" name="sugar[]" value="<?php echo $constant['sugar'][7]?:0 ?>"></td>
                        </tr>
                        <tr>
                            <td><label for="">Bero</label></td>
                            <td><input type="text" name="bero[]" value="<?php echo $constant['bero'][0]?:0 ?>"></td>
                            <td><input type="text" name="bero[]" value="<?php echo $constant['bero'][1]?:0 ?>"></td>
                            <td><input type="text" name="bero[]" value="<?php echo $constant['bero'][2]?:0 ?>"></td>
                            <td><input type="text" name="bero[]" value="<?php echo $constant['bero'][3]?:0 ?>"></td>
                            <td><input type="text" name="bero[]" value="<?php echo $constant['bero'][4]?:0 ?>"></td>
                            <td><input type="text" name="bero[]" value="<?php echo $constant['bero'][5]?:0 ?>"></td>
                            <td><input type="text" name="bero[]" value="<?php echo $constant['bero'][6]?:0 ?>"></td>
                            <td><input type="text" name="bero[]" value="<?php echo $constant['bero'][7]?:0 ?>"></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-5 col-sm-7">
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