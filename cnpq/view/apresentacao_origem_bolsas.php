<?php
/* PIBIC  model: pizza */
$dado = array('CNPq' => 94, 'FA' => 145, 'PUCPR' => 350, 'ICV' => 448);
$title = 'Origem das bolsas PIBIC';
$title2 = '';
$ybar = 'Distribuição';
$div_name = 'pibic';

/* PIBITI */
/*
$dado = array('CNPq' => 94, 'FA' => 145, 'PUCPR' => 350, 'ICV' => 448);
$title = 'Origem das bolsas PIBITI';
$title2 = '';
$ybar = 'Distribuição';
*/

$dados = '';
foreach ($dado as $key => $value) {
	$dados  .= "['$key',   $value],";
}

?>
<!-- Grafico HighChart--->
<?
$sx .= '
		<!DOCTYPE HTML>
		<html>
			<head>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
				<title>'.$title.'</title>
		
				<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
				<style type="text/css">${demo.css}</style>
				
				<!--Gera o grafico -->
				<script type="text/javascript">
					$(function () {
					    // Radialize the colors
					    Highcharts.getOptions().colors = Highcharts.map(Highcharts.getOptions().colors, function (color) {
					        return {
					            radialGradient: { cx: 0.5, cy: 0.3, r: 0.7 },
					            stops: [
					                [0, color],
					                [1, Highcharts.Color(color).brighten(-0.3).get(\'rgb\')] // darken
					            ]
					        };
					    });
					
					    // Build the chart
					    $(\'#'.$div_name.'\').highcharts({
					        chart: {
					            plotBackgroundColor: null,
					            plotBorderWidth: null,
					            plotShadow: false
					        },
					        title: {
					            text: \''.$title.'\'
					        },
					        tooltip: {
					            pointFormat: \'{series.name}: <b>{point.y} bolsas</b>\'
					        },
					        plotOptions: {
					            pie: {
					                allowPointSelect: true,
					                cursor: \'pointer\',
					                dataLabels: {
							                    enabled: true,
							                    format: \'<b>{point.name}</b>: {point.percentage:.1f} %\',
							                    style: {
							                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || \'black\'
							                    },
							                    connectorColor: \'silver\'
					                }
					            }
					        },
					        series: [{
					            type: \'pie\',
					            name: \'Quantidade\',
					            data: ['.$dados.']
					        }]
					    });
					});
		</script>
			</head>
			<body>
				<script src="../../js/highcharts.js"></script>
				<script src="../../js/modules/exporting.js"></script>
				<div id="'.$div_name.'" style="min-width: 310px; height: 400px; max-width: 600px; margin: 1px; auto"></div>
			</body>
		</html>
			
';

echo "$sx";
?>
		