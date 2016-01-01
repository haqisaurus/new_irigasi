<div id="main"> 
    <a name="SampleTags"></a>
    <h1>Daerah Irigasi</h1>
    <br>
    <br>
    <?php $totalWide = 0 ?>
    <table class="table-detail">
        <tr>
            <th>Nama daerah</th>
            <th>Area</th>
            <th>Luas daerah</th>
        </tr>
        <?php foreach ($regions as $key => $region): ?>
        	<?php $totalWide += $region->wide ?>
            <tr>
                <td><?php echo $region->region_name ?></td>
                <td><?php echo $region->area_name ?></td>
                <td><?php echo $region->wide ?> ha</td>
            </tr>
        <?php endforeach ?>
        <tr>
            <td colspan="2"><strong>Total luas </strong></td>
            <td><strong><?php echo $totalWide ?> ha</strong></td>
        </tr>
    </table>
    <br>
</div>