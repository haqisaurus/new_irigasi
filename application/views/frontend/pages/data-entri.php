<div id="main"> 
    <a name="SampleTags"></a>
    <h1>Entery data irigasi</h1>
    <br>
    <a href="javascript:window.history.go(-1);"><button>Kembali</button></a>
    <br>
    <br>
    <?php 
    $message = $this->session->flashdata('message');

    if ($message) echo '<div class="success">' . $message['msg'] . "</div>";
    ?>
    <?php echo form_open('action-entri-water', ''); ?>
    <table class="table-form">
        <tr>
            <td>Lokasi</td>
            <td >
                <?php 
                $regionOption = array();
                foreach ($regions as $key => $region) {
                    $regionOption[$region->id] = $region->region_name;
                }

                echo form_dropdown('region-id', $regionOption, $region, 'class="form-control"');
                ?>
                <?php echo form_error('region'); ?>
            </td>
        </tr>
        <tr>
            <td>Tanggal</td>
            <td><input type="text" id="date" name="date" value="<?php echo set_value('date') ?>"> <?php echo form_error('date'); ?></td>
        </tr>
        <tr>
            <td>Kanan</td>
            <td><input type="text" id="right" name="right" value="<?php echo set_value('right') ?>"><?php echo form_error('right'); ?></td>
        </tr>
        <tr>
            <td>Kiri</td>
            <td><input type="text" id="left" name="left" value="<?php echo set_value('left') ?>"><?php echo form_error('left'); ?></td>
        </tr>
        <tr>
            <td>Limpas</td>
            <td><input type="text" id="limpas" name="limpas" value="<?php echo set_value('limpas') ?>"><?php echo form_error('limpas'); ?></td>
        </tr>
        <tr>
            <td colspan="2"><button type="submit">Input</button></td>
        </tr>
    </table>
    <?php echo form_close(); ?>
</div>