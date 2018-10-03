<?php

$dataPoints = array(
  array("x"=> 10, "y"=> 41),
  array("x"=> 20, "y"=> 35, "indexLabel"=> "Lowest"),
  array("x"=> 30, "y"=> 50),
  array("x"=> 40, "y"=> 45),
  array("x"=> 50, "y"=> 52),
  array("x"=> 60, "y"=> 68),
  array("x"=> 70, "y"=> 38),
  array("x"=> 80, "y"=> 71, "indexLabel"=> "Highest"),
  array("x"=> 90, "y"=> 52),
  array("x"=> 100, "y"=> 60),
  array("x"=> 110, "y"=> 36),
  array("x"=> 120, "y"=> 49),
  array("x"=> 130, "y"=> 41)
);

?>
<!DOCTYPE HTML>
<html>
<head>
  <script>
  $(document).ready(function(){
    $.ajax({
      url: "<?php echo site_url('arsips/get_load_data'); ?>",
      method: "GET",
      success: function(data) {
        console.log(data);
        var player = [];
        var score = [];

        for(var i in data) {
          player.push("Player " + data[i].playerid);
          score.push(data[i].score);
        }

        var chartdata = {
          labels: player,
          datasets : [
            {
              label: 'Player Score',
              backgroundColor: 'rgba(200, 200, 200, 0.75)',
              borderColor: 'rgba(200, 200, 200, 0.75)',
              hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
              hoverBorderColor: 'rgba(200, 200, 200, 1)',
              data: score
            }
          ]
        };

        var ctx = $("#mycanvas");

        var barGraph = new Chart(ctx, {
          type: 'bar',
          data: chartdata
        });
      },
      error: function(data) {
        console.log(data);
      }
    });
  });
  </script>
</head>
<body>
  <div id="chart-container">
    <canvas id="mycanvas"></canvas>
  </div>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  <script src="<?php echo base_url('assets/plugins/chartjs/Chart.min.js'); ?>"></script>

</body>
</html>
