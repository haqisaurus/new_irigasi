<div id="main"> 
    <a name="SampleTags"></a>
    <h1>Template Info</h1>
    <?php form_open('url', ''); ?>
    <?php 
    $options = array(
                      '1' => 'January',
                      '2' => 'February',
                      '3' => 'Maret',
                      '4' => 'April',
                      '5' => 'Mei',
                      '6' => 'Juni',
                      '7' => 'Juli',
                      '8' => 'Agustus',
                      '9' => 'September',
                      '10' => 'Oktober',
                      '11' => 'November',
                      '12' => 'Desember',
                    );

    echo form_dropdown('month', $options, '', 'class="form-control"');

    $options = array();
    foreach ($years as $key => $year) {
        $options[$year->tahun] = $year->tahun;
    }

    echo form_dropdown('year', $options, '', 'class="form-control"');
    ?>
    <?php form_close(); ?>
    <div class="table-wrapper">
        <?php echo $table ?>
    </div>
</div>
