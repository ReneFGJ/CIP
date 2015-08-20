<?php

	$ano = 2013; //(40)
	$sg = '';
	$ri = $anoi - 1972;
	
	for ($r = $ri; $r <= 40;$r++)
	{
	if (strlen($sg) > 0) { $sg .= ', '.chr(13).chr(10); }
	$sg .= "['".(2013+$r-40)."' ";
			//for ($y=0;$y < (count($ar[$r])-1);$y++)
			for ($y=0;$y <= 4;$y++)
				{
					$sg .= ', '.$ar[$r][$y];
				}
			$ttt=0;
	$sg .= "]";
	}
//google.load("visualization", "1", {packages:["corechart"]});
//var chart = new google.visualization.AreaChart(document.getElementById('chart_div_3'));
?>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["imageareachart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Ano', 'A1', 'A2', 'B1', 'B2', 'B3'],
          <?=$sg;?>
        ]);

        var options = {
          title: 'Produção Científica por estrato',
          hAxis: {title: 'Ano',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0},
          colors: { 'blue', 'blue', 'blue', 'blue' }
        };

        var chart = new google.visualization.ImageAreaChart(document.getElementById('chart_div_3'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="chart_div_3" style="width: 900px; height: 400px;"></div>
  </body>