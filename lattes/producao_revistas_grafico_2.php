<?php

	$ano = 2013; //(40)
	$sg = '';
	$ri = $anoi - 1972;
	
	for ($r = $ri; $r <= 40;$r++)
	{
	if (strlen($sg) > 0) { $sg .= ', '.chr(13).chr(10); }
	$sg .= "['".(2013+$r-40)."' ";
					$sg .= ', '.($ar[$r][0]+$ar[$r][1]+$ar[$r][2]);
					$sg .= ', '.($ar[$r][3]+$ar[$r][4]+$ar[$r][5]+$ar[$r][6]+$ar[$r][7]);
			$ttt=0;
	$sg .= "]";
	}

?>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Ano', 'A1+A2+B1', 'B2+B3+B4+B5+C'],
          <?=$sg;?>
        ]);

        var options = {
          title: 'Produção Científica Qualificada',
          hAxis: {title: 'Ano',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div_AS'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="chart_div_AS" style="width: 900px; height: 400px;"></div>
  </body>