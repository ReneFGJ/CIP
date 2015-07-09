<?php
/* PIBIC */
$dado = array('2010'=>359,'2011'=>418,'2012'=>596,'2013'=>850,'2014'=>955,'2015'=>1058);
$title = 'Histórico dos projetos finalizados';
$title2 = 'Apresentação SEMIC - PIBIC';
$ybar = 'Total de projetos';
$xbar = 'Ano';
$div_name = 'pibic';


/* PIBITI model: bars*/
/*
$dado = array('2011'=>51,'2012'=>81,'2013'=>95,'2014'=>107,'2015'=>140);
$title = 'Histórico dos projetos finalizados';
$title2 = 'Apresentação SEMIC - PIBIC';
$ybar = 'Total de projetos';
$xbar = 'Ano';
*/

$dados = '';

foreach ($dado as $key => $value) {
		$dados  .= "['$key',   $value],";
}

?>

<!-- Grafico HighChart--->
<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Highcharts Example</title>

		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<style type="text/css">
${demo.css}
		</style>
		<script type="text/javascript">
$(function () {
    $('#<?php  echo $div_name; ?>').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'World\'s largest cities per 2014'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            type: 'category',
            labels: {
                rotation: -45,
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Population (millions)'
            }
        },
        legend: {
            enabled: false
        },
        tooltip: {
            pointFormat: 'Population in 2008: <b>{point.y:.1f} millions</b>'
        },
        series: [{
            name: 'Population',
            data: [
               <?php echo "$dados"; ?>
            ],
            dataLabels: {
                enabled: true,
                rotation: -90,
                color: '#FFFFFF',
                align: 'right',
                format: '{point.y:.1f}', // one decimal
                y: 10, // 10 pixels down from the top
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        }]
    });
});
		</script>
	</head>
	<body>
<script src="../../js/highcharts.js"></script>
<script src="../../js/modules/exporting.js"></script>

<div id="<?php echo $div_name; ?>" style="min-width: 300px; height: 400px; margin: 0 auto"></div>

	</body>
</html>




