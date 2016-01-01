<div id="main"> 
    <a name="SampleTags"></a>
    <h1>Edit data irigasi</h1>
    <br>
    <a href="<?php echo site_url('pimpinan-debit-view') ?>"><button>Kembali</button></a>
    <br>
    <br>
    <?php 
    $message = $this->session->flashdata('message')['notification'];

    if ($message) echo '<div class="success">' . $message . "</div>";
    ?>
    <?php echo form_open('pimpinan-debit-add-action', ''); ?>
    <table class="table-form">
        <tr>
            <td>Lokasi</td>
            <td >
                <?php 
                $regionOption = array();
                foreach ($regions as $key => $region) {
                    $regionOption[$region->id] = $region->region_name;
                }

                echo form_dropdown('region-id', $regionOption, '', 'class="form-control"');
                ?>
                <?php echo form_error('region'); ?>
            </td>
        </tr>
        <tr>
            <td>Tanggal</td>
            <td class="<?php echo form_error('date') ? 'has-error' : ''; ?>">
                <input type="text" id="date" name="date" value="<?php echo set_value('date', '') ?>"> 
                <?php echo '<br>' . form_error('date'); ?>
            </td>
        </tr>
        <tr>
            <td>Kanan</td>
            <td class="<?php echo form_error('right') ? 'has-error' : ''; ?>">
                <input type="number" step="any" name="right" value="<?php echo set_value('right', '') ?>">
                <?php echo '<br>' . form_error('right'); ?>
            </td>
        </tr>
        <tr>
            <td>Kiri</td>
            <td class="<?php echo form_error('left') ? 'has-error' : ''; ?>">
                <input type="number" step="any" name="left" value="<?php echo set_value('left', '') ?>">
                <?php echo '<br>' . form_error('left'); ?>
            </td>
        </tr>
        <tr>
            <td>Limpas</td>
            <td class="<?php echo form_error('limpas') ? 'has-error' : ''; ?>">
                <input type="number" step="any" name="limpas" value="<?php echo set_value('limpas', '') ?>">
                <?php echo '<br>' . form_error('limpas'); ?>
            </td>
        </tr>
        <tr>
            <td colspan="2"><button type="submit">Update</button></td>
        </tr>
    </table>
    <?php echo form_close(); ?>
</div>
