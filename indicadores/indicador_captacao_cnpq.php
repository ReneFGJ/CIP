<?php
require ("cab.php");

echo $hd -> hr('Indicador de captação / Editais CNPq');

require ("_class/_class_cnpq_editais.php");
$cnpq = new cnpq_editais;

require ("_class/_class_instituicoes.php");
$inst = new instituicao;

require ($include . "_class_form.php");
$form = new form;

$cp = array();
array_push($cp, array('$H8', '', '', False, False));
array_push($cp, array('$Q inst_nome:inst_codigo:select * from instituicao order by inst_ordem, inst_nome', '', '', True, True));
array_push($cp, array('$O 1:Projetos&2:Valor Captado (teto)', '', '', True, True));
array_push($cp, array('$B8', '', 'Seleciona >>>', False, False));

$tela = $form -> editar($cp, '');
echo $tela;

if (strlen($dd[1]) > 0) {
	$inst->prioriza($dd[1]);
	$inst->le($dd[1]);
	$instituicao_nome = $inst->nome;
	$jsh = $cnpq -> projetos_por_instituicao($dd[1],$dd[2]);
}

?>
<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>

<div id="container" style="min-width: 310px; height: 600px; margin: 0 auto"></div>

<script>
	$(function() {
		$('#container').highcharts({
			chart : {
				type : 'column'
			},
			title : {
				text : 'Captações CNPq / Edital  - <?php echo $instituicao_nome; ?>'
			},
			subtitle : {
				text : 'Fonte: CNPq'
			},
			xAxis : {
				categories : [<?php echo $cnpq->xAxis; ?>]
			},
			yAxis : {
				min : 0,
				title : {
					text : 'Projetos Aprovados'
				}
			},
			tooltip2 : {
				headerFormat : '<span style="font-size:10px">{point.key}</span><table width="400">',
				pointFormat : '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' + '<td style="padding:0"><b>{point.y:.2f}</b></td></tr>',
				footerFormat : '</table>',
				shared : true,
				useHTML : true
			},
			plotOptions : {
				column : {
					stacking : 'normal',
					dataLabels : {
						enabled : true,
						color : (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
						style : {
							textShadow : '0 0 3px black, 0 0 3px black'
						}
					}
				}
			},
			series : [<?php echo $cnpq->xData; ?>]
		});
	}); 
</script>
<?php
require ("foot.php");
?>

