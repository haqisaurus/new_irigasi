<div id="main"> 
    <a name="SampleTags"></a>
    <h1>Tabel informasi irigasi</h1>
    
    <br>
    <a href="javascript:window.history.go(-1);"><button>Kembali</button></a>
    <br>
    <h3>Grafik perbandingan data <b><?php echo $current_reg ?></b></h3>
    <div id="spinner" style="position: relative"></div>
    <canvas id="myChart" width="535" height="400"></canvas>

    <!-- biru -->
    <div style="background-color: rgba(151,187,205,1);width: 17px; height: 17px; display: inline-block;margin: 5px 0;">&nbsp;</div>
    <label style="display: inline-block">Debit andalan</label>
    <!-- pink -->
    <div style="background-color: rgba(216,177,187,1);width: 17px; height: 17px; display: inline-block;margin: 5px 0;">&nbsp;</div>
    <label style="display: inline-block">Kebutuhan irigasi </label>
    <!-- hijo -->
    <div style="background-color: rgba(97,137,115,1);width: 17px; height: 17px; display: inline-block;margin: 5px 0;">&nbsp;</div>
    <label style="display: inline-block">Neraca air</label>
    <br>
                            
        <?php echo form_open('pimpinan-rencana-save', array('style' => 'text-align: center;')) ?>
        <input type="hidden" name="year" value="<?php echo $data['year'] ?>">
        <input type="hidden" name="month" value="<?php echo $data['month'] ?>">
        <input type="hidden" name="range" value="<?php echo $data['range'] ?>">
        <input type="hidden" name="rice" value="<?php print_r( implode(",", $data['rice']) ) ?>">
        <input type="hidden" name="palawija" value="<?php print_r( implode(",", $data['palawija']) ) ?>">
        <input type="hidden" name="sugar" value="<?php print_r( implode(",", $data['sugar']) ) ?>">
        <input type="hidden" name="bero" value="<?php print_r( implode(",", $data['bero']) ) ?>">
        
        <?php if (isset($data['region-id'])): ?>
        <input type="hidden" name="region-id" value="<?php echo $data['region-id'] ?>">
        <button type="submit" class="btn btn-info" style="margin: 20px;"><span class="fa fa-save"></span> Simpan</button>
        <?php elseif (isset($data['id'])): ?>
        <input type="hidden" name="region-id" value="<?php echo $data['region_id'] ?>">
        <?php endif ?>
        <?php echo form_close() ?>
        
    <?php echo form_close(); ?>
    <script type="text/javascript" src="http://fgnass.github.io/spin.js/spin.min.js"></script>
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
                    fillColor: "rgba(216,177,187,0.2)",
                    strokeColor: "rgba(216,177,187,1)",
                    pointColor: "rgba(216,177,187,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(216,177,187,0)",
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
        var data = {
            'region-id': $('input[name=region-id]').val(),
            'year': $('input[name=year]').val(),
            'month': $('input[name=month]').val(),
            'range': $('input[name=range]').val(),
            'rice': $('input[name=rice]').val(),
            'palawija': $('input[name=palawija]').val(),
            'sugar': $('input[name=sugar]').val(),
            'bero': $('input[name=bero]').val(),
        }

        updateChart(data);

        $(document)
            .off('change', '#region-id')
            .on('change', '#region-id', function() {
                var regionID = $(this).val();
                updateChart(data);
            });

        function updateChart (data) {
            var target = $('#spinner').get(0);
            var spinner = new Spinner({color:'#30899F', lines: 12});

            $.ajax({
                url: $('#site_url').val() + '/pimpinan-kalkulasi-rencana-ajax',
                type: 'POST',
                dataType: 'json',
                data: data,
                beforeSend: function() {
                    spinner.spin(target);
                }
            })
            .done(function(response) {
                
                var months = [];

                $.each(response, function(index, value) {
                    myLineChart.datasets[0].points[index].value = response[index].debit;
                    myLineChart.datasets[1].points[index].value = response[index].demand;
                    myLineChart.datasets[2].points[index].value = response[index].neraca;
                    months.push(response[index].month_string);
                });
                myLineChart.scale.xLabels = months;

                myLineChart.update();
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
