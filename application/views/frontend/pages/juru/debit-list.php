<div id="main"> 
    <a name="SampleTags"></a>
    <h1>Tabel informasi irigasi</h1>
    <?php echo form_open( current_url(), '', array('id' => $this->uri->segment(2))); ?>
    <?php 
    
    $options = array();

    foreach ($regions as $key => $item) {
        $options[$item->id] = $item->region_name;
    }

    echo form_dropdown('region-id', $options, $_POST ? $_POST['region-id'] : '', 'class="form-control" id="region-id"');
                        
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

    echo form_dropdown('month', $monthOption, $_POST ? $_POST['month'] : '', 'class="form-control"');

    $yearOption = array();

    foreach ($years as $key => $year) {
        if ($year->tahun > 1000) {
            $yearOption[$year->tahun] = $year->tahun;
        }
    }
    echo form_dropdown('year', $yearOption,  $_POST ? $_POST['year'] : '', 'class="form-control" id="year"');
    
    ?>
    <input type="submit" value="&nbsp;Cari&nbsp;">

    <?php echo form_close(); ?>
    <?php 
    $message = $this->session->flashdata('message')['notification'];

    if ($message) echo '<div class="success">' . $message . "</div>";
    ?>
    
    <a href="<?php echo site_url('pimpinan-debit-add') ?>"><button>Tambah</button></a>

    <div class="table-wrapper">
        <h1>Setengah bulan pertama</h1>
        <table>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Kanan <b>(liter/det)</b></th>
                <th>Kiri <b>(liter/det)</b></th>
                <th>Limpas <b>(liter/det)</b></th>
                <th colspan="2">Action</th>
            </tr>
            <?php foreach ($table as $key => $data): ?>
                <?php if ($key > 14) continue ?>
                <tr>
                    <td style="width: 30px;"><?php echo $key + 1 ?></td>
                    <td style="width: 95px;"><a href="<?php echo site_url('data-detail/' . $data->id) ?>"><?php echo date('d-M-Y', strtotime( $data->date)) ?></a></td>
                    <td style="width: 95px;" class="right"><?php echo $data->right ?></td>
                    <td style="width: 95px;" class="right"><?php echo $data->left ?></td>
                    <td style="width: 95px;" class="right"><?php echo $data->limpas ?></td>
                    <td><a href="<?php echo site_url('pimpinan-debit-edit/' . $data->id) ?>"><button>Edit</button></a></td>
                    <td><a class="delete-row" href="<?php echo site_url('pimpinan-debit-delete-action/' . $data->id) ?>"><button style="background: red;">Delete</button></a></td>
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
                <th>Kanan <b>(liter/det)</b></th>
                <th>Kiri <b>(liter/det)</b></th>
                <th>Limpas <b>(liter/det)</b></th>
                <th>Action</th>
            </tr>
            <?php foreach ($table as $key => $data): ?>
                <?php if ($key <= 14) continue ?>
                <tr>
                    <td style="width: 30px;"><?php echo $key + 1 ?></td>
                    <td style="width: 95px;"><a href="<?php echo site_url('data-detail/' . $data->id) ?>"><?php echo date('d-M-Y', strtotime( $data->date)) ?></a></td>
                    <td style="width: 95px;" class="right"><?php echo $data->right ?></td>
                    <td style="width: 95px;" class="right"><?php echo $data->left ?></td>
                    <td style="width: 95px;" class="right"><?php echo $data->limpas ?></td>
                    <td><a href="<?php echo site_url('pimpinan-debit-edit/' . $data->id) ?>"><button>Edit</button></a></td>
                    <td><a class="delete-row"  href="<?php echo site_url('pimpinan-debit-delete-action/' . $data->id) ?>"><button style="background: red;">Delete</button></a></td>
                </tr>
            <?php endforeach ?>
        </table>
    </div>
</div>
<script>
    $(document)
        .off('click', '.delete-row')
        .on('click', '.delete-row', function(e) {
            var conf = confirm('apa anda benar ingin menghapus data ini?');
            if(!conf) e.preventDefault();
        });
    $(document)
        .off('change', '#region-id')
        .on('change', '#region-id', function() {
            var regionID = $(this).val();
            updateYear(regionID);
        });

    function updateYear (regionID) {
        $.ajax({
            url: $('#site_url').val() + '/get-year-ajax',
            type: 'POST',
            dataType: 'json',
            data: {'region-id': regionID},
        })
        .done(function(response) {
            var options = '';
            $.each(response, function(index, val) {
                options += '<option value="' + val.tahun + '">' + val.tahun + '</option>';
            });
            $('#year').html(options);
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });
        
    }
</script>