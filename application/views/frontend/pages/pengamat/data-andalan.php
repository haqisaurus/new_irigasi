<div id="main"> 
    <a name="SampleTags"></a>
    <h1>Tabel informasi irigasi</h1>
    <?php echo form_open( current_url(), array('style' => 'padding: 10px;'), array('id' => $this->uri->segment(2))); ?>
    <?php 
    $regionOption = array();
    foreach ($regions as $key => $region) {
        $regionOption[$region->id] = $region->region_name;
    }

    echo form_dropdown('region', $regionOption, set_value('region'), 'class="form-control" id="region-id"');
    echo form_close();
    ?>
    <?php 
    ?>
    <br>
    <br>
    <h3>Tabel debit andalan</h3>
    <div id="spinner" style="position: relative"></div>
    <canvas id="myChart" width="535" height="400"></canvas>

    <?php echo form_close(); ?>
    <script type="text/javascript" src="http://fgnass.github.io/spin.js/spin.min.js"></script>
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
        
        var myLineChart = new Chart(ctx).Line(data, options);
        var regionID = $('#region-id').val();

        updateChart(regionID);

        $(document)
            .off('change', '#region-id')
            .on('change', '#region-id', function() {
                var regionID = $(this).val();
                updateChart(regionID);
            });

        function updateChart (regionID) {
            var target = $('#spinner').get(0);
            var spinner = new Spinner({color:'#30899F', lines: 12});

            $.ajax({
                url: $('#site_url').val() + '/pengamat-debit-andalan-ajax',
                type: 'POST',
                dataType: 'json',
                data: {'region-id': regionID},
                beforeSend: function() {
                    spinner.spin(target);
                }
            })
            .done(function(response) {

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
                spinner.stop();
            });
        }
        
    </script>
</div>
