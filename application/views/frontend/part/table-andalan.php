<div>
    <span>debit andalan</span>
    <strong>
        <?php 
        $m = count($years);
        $andalan = 0.8 * ($m + 1);
        echo $andalan;
        ?>
    </strong>
</div>
<br>
<table>
    <tr>
        <th>No</th>
        <th>Tanggal</th>
        <th>Debit andalan</th>
    </tr>
    <?php $n = 1 ?>
    <?php 
        foreach ($table as $key => $value) {
            $date = $value[0] ? $value[0]->date : '';
            $month = date('d-F-Y', strtotime($date));
            $match = explode('-', $month);
            $string = '';
            if (is_array($match)) {
                $string = $match[1] . ' ' . ($match[0] == '01' ? '1' : '2') ;
            }

            echo  ($n == (int) $andalan) ? '<tr style="background-color: red; color: red" >' : '</tr>';
                echo '<td>' . ($n ++) . '</td>';
                echo '<td>' . $string . '</td>';
                $intakeCollection = array();
                echo '<td>';
                foreach ($years as $key => $year) {
                    if (isset($value[$key]->rentang)) {
                            $round = round($value[$key]->intake, 4);
                            array_push($intakeCollection, $round);
                    }
                }
                echo min($intakeCollection);
                echo '</td>';
            echo '</tr>';
        } 
    ?>
</table>
<br>
