<div id="main"> 
	<a name="SampleTags"></a>
	<h1>Data pola tanam usulan</h1>
	<br>
	<a href="javascript:window.history.go(-1);"><button>Kembali</button></a>
	<a href="<?php echo site_url('plant-entry') ?>"><button>Input</button></a>

	
	<?php 

	if(!$table) echo '<span class="error">Data tidak ditemukan <span>	<br>' ;

	
    $yearOption = array();
    for ($i=1998; $i <= 2020; $i++) { 
        $yearOption[$i] = $i;
    }

    echo form_dropdown('year', $yearOption,  date('Y'), 'class="form-control"');
    ?>
	<br>
	<br>
	<br>
    <h3>Tabel pola tanam usulan</h3>
    <!-- pink -->
    <!-- <div style="background-color: rgba(216,177,187,1);width: 17px; height: 17px; display: inline-block;margin: 5px 0;">&nbsp;</div>
    <label style="display: inline-block">Kebutuhan air tanaman </label> -->
    <!-- kuning -->
    <div style="background-color: rgba(216,171,87,1);width: 17px; height: 17px; display: inline-block;margin: 5px 0;">&nbsp;</div>
    <label style="display: inline-block">Kebutuhan air irigasi </label>
    <!-- biru -->
    <div style="background-color: rgba(151,187,205,1);width: 17px; height: 17px; display: inline-block;margin: 5px 0;">&nbsp;</div>
    <label style="display: inline-block">Debit andalan</label>
    <!-- hijo -->
    <div style="background-color: rgba(97,137,115,1);width: 17px; height: 17px; display: inline-block;margin: 5px 0;">&nbsp;</div>
    <label style="display: inline-block">Neraca air</label>
    <canvas id="myChart" width="540" height="400"></canvas>
	
	<table width="468" height="221" border="0">
		<tbody>
			<tr>
				<th width="83">#</th>
				<th width="83">Tanggal</th>
				<th width=""> Padi </th>
				<th width=""> Palawija </th>
				<th width=""> Tebu </th>
				<th width=""> Bero </th>
                <th width=""> Total </th>
                <th width=""> Keb Tanaman </th>
				<th width=""> Keb Irigasi </th>
			</tr>
			<?php 
			foreach ($table as $key => $value) {
				?>
				<tr>
					<td><?php echo $key + 1 ?></td>
					<td><a href="<?php echo site_url('plant-edit/' . $value->id) ?>"><?php echo $value->start ?></a></td>
					<td><?php echo ($value->rice * 0.75) ?> ha</td>
					<td><?php echo $value->palawija * 0.3 ?> ha</td>
					<td><?php echo $value->sugar * 0.85 ?> ha</td>
					<td><?php echo $value->bero ?> ha</td>
                    <td><?php echo ( $value->rice + $value->palawija + $value->sugar + $value->bero) ?> ha</td>
                    <td><?php echo ( $value->rice * 0.75 + $value->palawija * 0.3 + $value->sugar * 0.85) ?> ha</td>
                    <td><?php echo ( $value->rice * 0.75 + $value->palawija * 0.3 + $value->sugar * 0.85) * 1.2 ?> ha</td>
				</tr>
				<?php
			}
			 ?>
		</tbody>
	</table>
	<br><br>
</div>
<script type="text/javascript">
        var data = {
            labels: [
                "November 1", 
                "November 2", 
                "Desember 1",
                "Desember 2",
                "January 1", 
                "January 2", 
                "February 1", 
                "February 2", 
                "March 1", 
                "March 2", 
                "April 1", 
                "April 2", 
                "May 1", 
                "May 2", 
                "June 1", 
                "June 2", 
                "July 1", 
                "July 2", 
                "Agustus 1", 
                "Agustus 2", 
                "September 1", 
                "September 2", 
                "Oktober 1", 
                "Oktober 2", 
                ],
            datasets: [
                {
                    label: "Debit andalan",
                    // biru
                    fillColor: "rgba(151,187,205,0.2)",
                    strokeColor: "rgba(151,187,205,1)",
                    pointColor: "rgba(151,187,205,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(151,187,205,1)",
                    data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ]
                },
                {
                    label: "Kebutuhan air tanaman",
                    // pink
                    fillColor: "rgba(216,177,187,0)",
                    strokeColor: "rgba(216,177,187,0)",
                    pointColor: "rgba(216,177,187,0)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(216,177,187,0)",
                    data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ]
                },
                {
                    label: "Kebutuhan air irigasi",
                    // kuning
                    fillColor: "rgba(216,171,87,0.2)",
                    strokeColor: "rgba(216,171,87,1)",
                    pointColor: "rgba(216,171,87,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(216,177,187,1)",
                    data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ]
                },
                {
                    label: "Neraca air",
                    // hijo
                    fillColor: "rgba(97,137,115,0.2)",
                    strokeColor: "rgba(97,137,115,1)",
                    pointColor: "rgba(97,137,115,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(97,137,115,1)",
                    data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ]
                },
            ]
        };

        var options = {

                ///Boolean - Whether grid lines are shown across the chart
                scaleShowGridLines : true,

                //String - Colour of the grid lines
                scaleGridLineColor : "rgba(0,0,0,.05)",

                //Number - Width of the grid lines
                scaleGridLineWidth : 1,

                //Boolean - Whether to show horizontal lines (except X axis)
                scaleShowHorizontalLines: true,

                //Boolean - Whether to show vertical lines (except Y axis)
                scaleShowVerticalLines: true,

                //Boolean - Whether the line is curved between points
                bezierCurve : true,

                //Number - Tension of the bezier curve between points
                bezierCurveTension : 0.4,

                //Boolean - Whether to show a dot for each point
                pointDot : true,

                //Number - Radius of each point dot in pixels
                pointDotRadius : 4,

                //Number - Pixel width of point dot stroke
                pointDotStrokeWidth : 1,

                //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
                pointHitDetectionRadius : 20,

                //Boolean - Whether to show a stroke for datasets
                datasetStroke : true,

                //Number - Pixel width of dataset stroke
                datasetStrokeWidth : 2,

                //Boolean - Whether to fill the dataset with a colour
                // datasetFill : true,
                datasetFill : false,

                // Interpolated JS string - can access value
                scaleLabel: "<%=value%>",

                //String - A legend template
                legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\">" +
                                    "<% for (var i=0; i<datasets.length; i++){%>" + 
                                        "<li><span style=\"background-color:<%=datasets[i].strokeColor%>\"></span>" + 
                                        "<%if(datasets[i].label){%>" + 
                                            "<%=datasets[i].label%>" + 
                                        "<%}%>" + 
                                        "</li>" + 
                                    "<%}%>" + 
                                "</ul>",
            };
        // Get context with jQuery - using jQuery's .get() method.
        var ctx = $("#myChart").get(0).getContext("2d");
        // This will get the first returned node in the jQuery collection.
        // var myNewChart = new Chart(ctx);
        Chart.defaults.global.responsive = true;
        var myLineChart = new Chart(ctx).Line(data, options);
        var demandOnPlant = [];
        var demandOnIrigasi = [];
        var andalan = [];

        getWaterDemand();
        getDataAndalan();

        

        function getWaterDemand(year) {

            year = year - 1 || new Date().getFullYear() - 1;

            $.ajax({
                url: $('#site_url').val() + '/get-water-demand',
                type: 'POST',
                dataType: 'json',
                data: {year: year, month : 11},
            })
            .done(function(response) {

                demandOnPlant = $.map(response, function(value, index) {
                    return value.demand || 0;
                });

                demandOnIrigasi = $.map(response, function(value, index) {
                    return value.irigasi || 0;
                });

                $.each(demandOnPlant, function(index, value) {
                    myLineChart.datasets[1].points[index].value = value;

                });

                $.each(demandOnIrigasi, function(index, value) {
                    myLineChart.datasets[2].points[index].value = value;

                });
                myLineChart.update();
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                console.log("complete");
            });
        }

        function getDataAndalan(year) {

            year = year - 1 || new Date().getFullYear() - 1;

            $.ajax({
                url: $('#site_url').val() + '/get-andalan',
                type: 'POST',
                dataType: 'json',
                data: {year: year, month : 11},
            })
            .done(function(response) {
                
                andalan = response;

                $.each(response, function(index, andalan) {
                    myLineChart.datasets[0].points[index].value = andalan || 0;

                    var neraca = (andalan - demandOnIrigasi[index]) || 0;
                    myLineChart.datasets[3].points[index].value = neraca;
                    
                });
                myLineChart.update();
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                console.log("complete");
            });
        }

        $(document)
            .off('change', 'select[name=year]')
            .on('change', 'select[name=year]', function(e) {
                var value = $(this).val();
                getWaterDemand(value);
                getDataAndalan(value);
            })

        
    </script>