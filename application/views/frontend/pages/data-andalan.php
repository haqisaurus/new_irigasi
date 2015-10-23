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

    // echo form_dropdown('month', $monthOption, $qMonth, 'class="form-control"');

    $yearOption = array();
    foreach ($years as $key => $year) {
        if ($year->tahun > 1000) {
            $yearOption[$year->tahun] = $year->tahun;
        }
    }

    // echo form_dropdown('year', $yearOption,  $qYear, 'class="form-control"');

    ?>
    <input type="submit" value="&nbsp;Cari&nbsp;">
    <?php 
    ?>
    <br>
    <br>
    <h3>Tabel debit andalan</h3>
    <canvas id="myChart" width="540" height="400"></canvas>

    <?php echo form_close(); ?>
   

    <div class="table-wrapper">
        <?php echo $table ?>
    </div>
    <script type="text/javascript">
        var data = {
            labels: [
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
                "November 1", 
                "November 2", 
                "Desember 1",
                "Desember 2"
                ],
            datasets: [
                // {
                //     label: "Limpas",
                    // fillColor: "rgba(216,177,187,0.2)",
                    // strokeColor: "rgba(216,177,187,1)",
                    // pointColor: "rgba(216,177,187,1)",
                    // pointStrokeColor: "#fff",
                    // pointHighlightFill: "#fff",
                    // pointHighlightStroke: "rgba(216,177,187,1)",
                //     data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ]
                // },
                {
                    label: "Left",
                    fillColor: "rgba(151,187,205,0.2)",
                    strokeColor: "rgba(151,187,205,1)",
                    pointColor: "rgba(151,187,205,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(151,187,205,1)",
                    data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ]
                },
                // {
                //     label: "Right",
                //     fillColor: "rgba(97,137,115,0.2)",
                //     strokeColor: "rgba(97,137,115,1)",
                //     pointColor: "rgba(97,137,115,1)",
                //     pointStrokeColor: "#fff",
                //     pointHighlightFill: "#fff",
                //     pointHighlightStroke: "rgba(97,137,115,1)",
                //     data: [28, 48, 40, 19, 86, 27, 90, 33.3, 44.5, 55, 11]
                // },
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
                datasetFill : true,

                // Interpolated JS string - can access value
                scaleLabel: "<%=value%>",

                //String - A legend template
                legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].strokeColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",

            };
            
        // Get context with jQuery - using jQuery's .get() method.
        var ctx = $("#myChart").get(0).getContext("2d");
        // This will get the first returned node in the jQuery collection.
        // var myNewChart = new Chart(ctx);
        Chart.defaults.global.responsive = true;
        var myLineChart = new Chart(ctx).Line(data, options);


        $.ajax({
            url: $('#site_url').val() + '/get-andalan',
            type: 'POST',
            dataType: 'json',
            data: {param1: 'value1'},
        })
        .done(function(response) {

            console.log(response);
            $.each(response, function(index, value) {
                myLineChart.datasets[0].points[index].value = value;
                
                myLineChart.update();
            });
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });
        
    </script>
</div>
