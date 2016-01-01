<div id="main"> 
    <a name="SampleTags"></a>
    <h1>Luas daerah irigasi</h1>
    <br>
    <a href="javascript:window.history.go(-1);"><button>Kembali</button></a>
    <br>
    <br>
    <?php var_dump($regions) ?>
    <table class="table-detail">
        <tr>
            <th>Nama daerah</th>
            <th>Luas daerah</th>
        </tr>
        <?php foreach ($wides as $key => $wide): ?>
            <tr>
                <td><?php echo $wide->area_name ?></td>
                <td><?php echo $wide->wide ?> ha</td>
            </tr>
        <?php endforeach ?>
        <tr>
            <td><strong>Total luas </strong></td>
            <td><strong><?php echo $totalWide->total_wide ?> ha</strong></td>
        </tr>
    </table>
</div>