<div id="main"> 
    <a name="SampleTags"></a>
    <h1>Tabel rencana tersimpan</h1>
    <br>
    <a href="javascript:window.history.go(-1);"><button>Kembali</button></a>
    <br>
    <div class="table-wrapper">
        <h1>List rencana</h1>
        <table>
            <tr>
                <th>No</th>
                <th>Tahun Rencana</th>
                <th>Daerah</th>
                <th>Tanggal Simpan</th>
                <th>Aksi</th>
            </tr>
            <?php foreach ($table as $key => $data): ?> 
                <?php 
                $dateObj   = DateTime::createFromFormat('!m', $data->start_month);
                $monthName = $dateObj->format('F'); // March 
                ?>
                
                <tr>
                    <td style="width: 30px;"><?php echo $key + 1 ?></td>
                    <td class="center"><?php echo $monthName . ' ' . $data->year . ' - ' . ($data->year + 1) ?></td>
                    <td><?php echo $data->region_name ?></td>
                    <td><?php echo $data->updated_at ?></td>
                    <td>
                        <a href="<?php echo site_url('pengamat-rencana-view/' . $data->id) ?>" class="btn btn-info btn-xs"><span class="fa fa-edit"></span> Kalkulasi</a> 
                    </td>
                    
                </tr>
            <?php endforeach ?>
        </table>
        
    </div>
</div>
<script>
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