<?php
$dados = '';

foreach ($dado as $key => $value) {
	$dados .= "['$key',   $value],";
}
?>

<!-- Grafico HighChart--->
<script type="text/javascript">
		$(function () {
	$('#<?php  echo $div_name;?>
		').highcharts({
			chart: {
		type: 'column'
		},
		title: {
			text: '<?php  echo $title;?>',
			fontSize: '13px'
		},
		subtitle: {
		text: '<?php  echo $title2;?>'
		},
		xAxis: {
		type: 'category',
		labels: {
		rotation: -45,
		style: {
		fontSize: '11px',
		fontFamily: 'Verdana, sans-serif'
		}
		}
		},
		yAxis: {
		min: 0,
		style: {
		fontSize: '8px',
		fontFamily: 'Verdana, sans-serif'
		},		
		title: {
		text: '<?php  echo $ybar;?>'
		}
		},
		legend: {
		enabled: false
		},
		tooltip: {
		pointFormat: '<?php  echo $ybar;?>: <b>{point.y:.0f}</b>'
		},
		series: [{
		name: '<?php  echo $xbar;?>',
		data: [ <?php echo "$dados";?> ],
	dataLabels: {
		enabled: true,
		rotation: -45,
		color: '#222222',
		align: 'center',
		format: '{point.y:.0f}', // one decimal
		y: 5, // 10 pixels down from the top
		style: {
			fontSize: '15px',
			fontFamily: 'Verdana, sans-serif'
			}
	}
	}]
	});
	});</script>
</head>
<div id="<?php echo $div_name;?>" style="width: 300px; height: 250px; margin: 0 auto"></div>
