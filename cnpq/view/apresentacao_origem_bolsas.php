<?php


/* PIBITI */
/*
 $dado = array('CNPq' => 94, 'FA' => 145, 'PUCPR' => 350, 'ICV' => 448);
 $title = 'Origem das bolsas PIBITI';
 $title2 = '';
 $ybar = 'Distribuição';
 */

$dados = '';
foreach ($dado as $key => $value) {
	$dados .= "['$key',   $value],";
}
?>
<!-- Grafico HighChart--->
<script type="text/javascript">
	$(function () {
	// Radialize the colors
	Highcharts.getOptions().colors = Highcharts.map(Highcharts.getOptions().colors, function (color) {
	return {
	radialGradient: { cx: 0.5, cy: 0.3, r: 0.7 },
	stops: [
	[0, color],
	[1, Highcharts.Color(color).brighten(-0.3).get('rgb')] // darken
	]
	};
	});

	// Build the chart
	$('#<?php echo $div_name;?>').highcharts({
		chart: {
		plotBackgroundColor: null,
		plotBorderWidth: null,
		plotShadow: false
		},
	title: {
		text: '<?php echo $title;?>'
	},
	tooltip: {
		pointFormat: '{series.name}: <b>{point.y} bolsas</b>'
	},
	plotOptions: {
		pie: {
		allowPointSelect: true,
		cursor: 'pointer',
		dataLabels: {
		enabled: true,
		format: '<b>{point.name}</b>: {point.percentage:.1f} %',
		style: {
		color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
		},
		connectorColor: 'silver'
		}
		}
	},
	series: [{
	type: 'pie',
	name: 'Quantidade',
	data: [<?php echo $dados;?>]
	}]
	});
	});
	</script>
</head>
<div id="<?php echo $div_name;?>" style="width: 300px; height: 250px; margin: 1px; auto"></div>
