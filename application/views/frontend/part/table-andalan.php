<table>
    <tr>
        <th>No</th>
        <th>Tanggal</th>
        <?php 
        foreach ($years as $key => $value) {
            echo '<th>' . $value->tahun . '</th>';
        }
        ?>
    </tr>
    <?php $n = 1 ?>
    <?php 
        foreach ($table as $key => $value) {
            echo '<tr>';
                echo '<td>' . ($n ++) . '</td>';
                echo '<td>' . (isset($value[0]->rentang)? $value[0]->rentang: (isset($value[1]->rentang) ? $value[1]->rentang : '-')) . '</td>';
                foreach ($years as $key => $year) {
                    if (isset($value[$key]->rentang)) {
                        echo '<td>' . round($value[$key]->intake, 4) . '</td>';
                    } else {
                        echo '<td>-</td>';
                    }
                }
            echo '</tr>';
        } 
    ?>
</table>
<br>
