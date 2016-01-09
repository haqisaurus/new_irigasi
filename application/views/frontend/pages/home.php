<div id="main"> 
    <a name="SampleTags"></a>
    <h1>Daerah Irigasi</h1>
    <br>
    <br>
    <?php $regionTmp = '' ?>
    <?php $regionNames = array(); ?>
    <?php 
    foreach ($regions as $key => $region): 
        array_push($regionNames, $region->region_name);
    endforeach;
    $regionNames = array_unique($regionNames);
    ?>

    <?php foreach ($regionNames as $key => $regionName): ?>
    <h1>Daerah Irigasi <?php echo $regionName ?></h1>
        <table class="table-detail">
            <tr>
                <th>Area</th>
                <th>Luas area</th>
            </tr>
            <?php $totalWide = 0 ?>
            <?php foreach ($regions as $key => $region): ?>
                <?php if ($regionName == $region->region_name): ?>
                <?php $totalWide += $region->wide ?>
                <tr>
                    
                    <td><?php echo $region->area_name ?></td>
                    <td><?php echo $region->wide ?> ha</td>
                </tr>
                <?php endif ?>
            <?php endforeach ?>
            <tr>
                <td><strong>Total luas </strong></td>
                <td><strong><?php echo $totalWide ?> ha</strong></td>
            </tr>
        </table>
    <?php endforeach ?>

    <br>
</div>
