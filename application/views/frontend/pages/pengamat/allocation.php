<div id="main"> 
    <a name="SampleTags"></a>
    <h1>Tabel Daftar Input Alokasi</h1>
    <?php echo form_open( current_url(), '', array('id' => $this->uri->segment(2))); ?>
    
    <?php 
    $message = $this->session->flashdata('message')['notification'];

    if ($message) echo '<div class="success">' . $message . "</div>";

    $months = array(
        'Januari 1',
        'Januari 2',
        'Februari 1',
        'Februari 2',
        'Maret 1',
        'Maret 2',
        'April 1',
        'April 2',
        'Mei 1',
        'Mei 2',
        'Juni 1',
        'Juni 2',
        'Juli 1',
        'Juli 2',
        'Agustus 1',
        'Agustus 2',
        'September 1',
        'September 2',
        'Oktober 1',
        'Oktober 2',
        'Novermber 1',
        'Novermber 2',
        'Desember 1',
        'Desember 2',
        );
    $year = date('Y');
    $month = date('n');
    $day = date('j');
    $showAlert = true;

    if($day < 16) {
        $month = ($month * 2) - 2;
    } else {
        $month = ($month * 2) - 1;
    }

    ?>
    
    <div class="table-wrapper">
        <h1>List Alokasi Yang Sudah Dimasukan</h1>
        <table>
            <tr>
                <th>No</th>
                <th style="text-align: center">Periode</th>
                <th style="text-align: center">Daerah Irigasi</th>
                <th style="text-align: center">Padi Fase Pertumbuhan (ha)</th>
                <th style="text-align: center">Padi Fase Pematangan (ha)</th>
                <th style="text-align: center">Padi Fase Panen (ha)</th>
                <th style="text-align: center">Palawija (ha)</th>
                <th style="text-align: center">Tebu (ha)</th>
                <th style="text-align: center">Bero (ha)</th>
            </tr>
            <?php foreach ($allocation as $key => $data): ?>
                <?php if ($key > 14) continue ?>
                <?php if($month == $data->periode && $year == $data->year) $showAlert = false;  ?>
                <tr>
                    <td style="width: 30px;"><?php echo $key + 1 ?></td>
                    <td style="width: 70px;"><?php echo $months[$data->periode]. ' ' . $data->year ?></a></td>
                    <td style="width: 40px;" class="right"><?php echo $data->region_name ?></td>
                    <td style="width: 40px;" class="right"><?php echo $data->rice_growth_fase ?></td>
                    <td style="width: 40px;" class="right"><?php echo $data->rice_mature_fase ?></td>
                    <td style="width: 40px;" class="right"><?php echo $data->rice_harvest_face ?></td>
                    <td style="width: 40px;" class="right"><?php echo $data->palawija ?></td>
                    <td style="width: 40px;" class="right"><?php echo $data->sugar ?></td>
                    <td style="width: 40px;" class="right"><?php echo $data->bero ?></td>
                </tr>
            <?php endforeach ?>
        </table>
        <br>
        
        
    </div>
</div>
<?php if ($showAlert): ?>
    <script>
        alert('Juru Belum Memasukan Data Luas Aktual Periode <?php echo $months[$month] . ' ' . $year ?>')
    </script>
<?php endif ?>
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