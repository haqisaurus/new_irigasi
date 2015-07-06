<div id="main"> 
    <a name="SampleTags"></a>
    <h1>Tabel informasi irigasi</h1>
    <?php echo form_open( current_url(), '', array('id' => $this->uri->segment(2))); ?>
    <?php 
    $regionOption = array();
    foreach ($regions as $key => $region) {
        $regionOption[$region->id] = $region->region_name;
    }

    echo form_dropdown('region', $regionOption, $qRegion, 'class="form-control"');

    $monthOption = array(
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

    echo form_dropdown('month', $monthOption, $qMonth, 'class="form-control"');

    // $yearOption = array();
    // foreach ($years as $key => $year) {
    //     if ($year->tahun > 1000) {
    //         $yearOption[$year->tahun] = $year->tahun;
    //     }
    // }

    // echo form_dropdown('year', $yearOption,  $qYear, 'class="form-control"');

    ?>
    <input type="submit" value="&nbsp;Cari&nbsp;">
    <?php 
    ?>
    <?php echo form_close(); ?>
    <!-- <div class="table-wrapper">
        <h1>Setengah bulan pertama</h1>
        <table>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Kanan</th>
                <th>Kiri</th>
                <th>Limpas</th>
                <th>Action</th>
            </tr>
            <?php foreach ($table as $key => $data): ?>
                <?php if ($key > 14) continue ?>
                <tr>
                    <td><?php echo $key + 1 ?></td>
                    <td><a href="<?php echo site_url('data-detail/' . $data->id) ?>"><?php echo date('d-F-Y', strtotime( $data->date)) ?></a></td>
                    <td><?php echo $data->right ?> dm<sup>3</sup></td>
                    <td><?php echo $data->left ?> dm<sup>3</sup></td>
                    <td><?php echo $data->limpas ?> dm<sup>3</sup></td>
                    <td><a href="<?php echo site_url('edit-water/' . $data->id) ?>"><button>Edit</button></a></td>
                </tr>
            <?php endforeach ?>
        </table>
        <br>
        <br>
        <h1>Setengah bulan kedua</h1>
        <table>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Kanan</th>
                <th>Kiri</th>
                <th>Limpas</th>
                <th>Action</th>
            </tr>
            <?php foreach ($table as $key => $data): ?>
                <?php if ($key < 14) continue ?>
                <tr>
                    <td><?php echo $key + 1 ?></td>
                    <td><a href="<?php echo site_url('data-detail/' . $data->id) ?>"><?php echo date('d-F-Y', strtotime( $data->date)) ?></a></td>
                    <td><?php echo $data->right ?> dm<sup>3</sup></td>
                    <td><?php echo $data->left ?> dm<sup>3</sup></td>
                    <td><?php echo $data->limpas ?> dm<sup>3</sup></td>
                    <td><a href="<?php echo site_url('edit-water/' . $data->id) ?>"><button>Edit</button></a></td>
                </tr>
            <?php endforeach ?>
        </table>
        <br>
        <br>
    </div> -->

    <div class="table-wrapper">
        <?php echo $table ?>
    </div>
</div>
