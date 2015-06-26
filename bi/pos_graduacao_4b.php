<?php
/*** Modelo ****/
require ("cab_bi.php");
global $acao, $dd, $cp, $tabela;
require ($include . 'sisdoc_colunas.php');
require ($include . 'sisdoc_form2.php');
require ($include . 'sisdoc_debug.php');
require ($include . 'sisdoc_autor.php');

$programa_nome = $_SESSION['pos_nome'];
$programa_pos = $_SESSION['pos_codigo'];
$programa_pos_anoi = $_SESSION['pos_anoi'];
$programa_pos_anof = $_SESSION['pos_anof'];
if (strlen($programa_pos_anoi) == 0) { $dd[2] = 1996;
}
if (strlen($programa_pos_anof) == 0) { $dd[3] = date("Y");
}

$title = 'Produção qualificada por professor de Pós-Graduação ('.$programa_pos_anoi.'-'.$programa_pos_anof.')';

require ('../_class/_class_lattes.php');
$lattes = new lattes;

/* Dados da Classe */
require ('../_class/_class_programa_pos.php');
$clx = new programa_pos;
echo $clx -> le($programa_pos);
echo $clx -> mostra();

$areas = array($clx -> area_avaliacao_codigo);
$rst = $lattes->resumo_qualis_discente_ss_array($programa_pos,$areas,$programa_pos_anoi,$programa_pos_anof);
$keys = array_keys($rst);
echo '<BR>';
$data = "'Apples', 'Oranges', 'Pears', 'Grapes', 'Bananas'";
$data = '';
for ($r=0;$r < count($keys);$r++)
	{
		$au = $keys[$r];
		$ln = $rst[$au];
		
		$autor = nbr_autor($keys[$r],5);
		if (strlen($data) > 0) 
			{
			 $data .= ', ';
			 $a1 .= ', ';
			 $a2 .= ', ';
			 $b1 .= ', ';
			 $b2 .= ', ';
			 $b3 .= ', ';
			 $b4 .= ', ';
			 $b5 .= ', ';
			 $c .= ', ';
			 $na .= ', '; 
			}
		$a1 .= round($ln['A1']);
		$a2 .= round($ln['A2']);
		$b1 .= round($ln['B1']);
		$b2 .= round($ln['B2']);
		$b3 .= round($ln['B3']);
		$b4 .= round($ln['B4']);
		$b5 .= round($ln['B5']);
		$c .= round($ln['C']);
		$nc .= round($ln['']);
		$data .= "'$autor'";
	}
?>
<!DOCTYPE html>
		<script type='text/javascript'>
			$(function() {
				$('#container-1').highcharts({

					chart : {
						type : 'column'
					},

					title : {
						text : '<?php echo $title;?>',
					},

					xAxis : {
						categories : [<?php echo $data;?>]
					},

					yAxis : {
						allowDecimals : false,
						min : 0,
						title : {
							text : 'Number of fruits'
						}
					},

					tooltip : {
						formatter : function() {
							return '<b>' + this.x + '</b><br/>' + this.series.name + ': ' + this.y + '<br/>' + 'Total: ' + this.point.stackTotal;
						}
					},

					plotOptions : {
						column : {
							stacking : 'normal'
						}
					},

					series : [{
						name : 'A1',
						data : [<?php echo $a1;?>],
						stack : 'A',
						color: '#3333FF'
					}, {
						name : 'A2',
						data : [<?php echo $a2;?>],
						stack : 'A',
						color: '#3333DF'
					}, {
						name : 'B1',
						data : [<?php echo $b1;?>],
						stack : 'A',
						color: '#3333BF'
					}, {
						name : 'B2',
						data : [<?php echo $b2;?>],
						stack : 'B',
						color: '#33E033'
					}, {
						name : 'B3',
						data : [<?php echo $b3;?>],
						stack : 'B',
						color: '#33C033'
					}, {
						name : 'B4',
						data : [<?php echo $b4;?>],
						stack : 'B',
						color: '#33A033'
					}, {
						name : 'B5',
						data : [<?php echo $b5;?>],
						stack : 'B',
						color: '#338033'																		
					}]
				});
			});
			//]]>
		</script>
		<script type='text/javascript'>
			$(function() {
				$('#container-2').highcharts({
					chart : {
						type : 'column'
					},
					title : {
						text : '<?php echo $title;?>',
					},
					xAxis : {
						categories : [<?php echo $data;?>]
					},
					yAxis : {
						allowDecimals : false,
						min : 0,
						title : {
							text : 'Number of fruits'
						}
					},
					tooltip : {
						formatter : function() {
							return '<b>' + this.x + '</b><br/>' + this.series.name + ': ' + this.y + '<br/>' + 'Total: ' + this.point.stackTotal;
						}
					},
					plotOptions : {
						column : {
							stacking : 'normal'
						}
					},

					series : [{
						name : 'A1',
						data : [<?php echo $a1;?>],
						stack : 'A',
						color: '#FF3333'
					}, {
						name : 'A2',
						data : [<?php echo $a2;?>],
						stack : 'A',
						color: '#33FF33'
					}, {
						name : 'B1',
						data : [<?php echo $b1;?>],
						stack : 'A',
						color: '#3333FF'
					}]
				});
			});
			//]]>
		</script>

		<script src="http://code.highcharts.com/highcharts.js"></script>
		<script src="http://code.highcharts.com/modules/exporting.js"></script>
		<div id="container-2" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

		<div id="container-1" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

		<?php
		require ("../foot.php");
		?>
