<?
require("cab.php");




$dta = array();
for ($r=1;$r <= 12;$r++)
	{ array_push($dta,$dt); }

$dt = array();
for ($y=2009;$y <= date("Y");$y++) { array_push($dt,$dta); }


$sql = "select count(*) as total, mr_ano, mr_mes from pibic_mirror group by mr_ano, mr_mes ";
$rlt = db_query($sql);

while ($line = db_read($rlt))
	{
		$ano = ($line['mr_ano']-2009);
		$mes = ($line['mr_mes']);
		$total = ($line['total']);
		if ($ano >= 0)
			{ $dt[$mes][$ano] = $total; }
	}
print_r($dt);
?>

<html>
  <head>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Year');
        data.addColumn('number', 'Sales');
        data.addColumn('number', 'Expenses');
        data.addColumn('number', 'Expenses');
        data.addColumn('number', 'Expenses');
        data.addRows([
        	<?
        	for ($r=0;$r < count($dt);$r++)
				$cs = ',';
				if ($r==0) { $cs = ''; }
				echo "['".($r+2009)."',".$dt[$r][0].",".$dt[$r][1].",".$dt[$r][2].",".$dt[$r][3]."]".$cs.chr(13);				

//          ['2004', 1000, 400],
//          ['2005', 1170, 460],
//          ['2006', 660, 1120],
//          ['2007', 1030, 540]
			?>
        ]);

        var options = {
          width: 800, height: 400,
          title: 'Company Performance',
          vAxis: {title: 'Year',  titleTextStyle: {color: 'red'}}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="chart_div"></div>
  </body>
</html>
