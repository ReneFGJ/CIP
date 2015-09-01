<?
$breadcrumbs=array();
array_push($breadcrumbs, array('pos_graduacao.php','Pós-graduação'));
require("cab_lattes.php");
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_debug.php');

	require('../_class/_class_programa_pos.php');
	$clx = new programa_pos;

	require('../_class/_class_lattes.php');
	$lattes = new lattes;
	
	//pos_avaliacao_1
	
	$ano = 2011;
	$areas = array('00001');
	$anoi = round($_SESSION['ano_ini']);
	$anof = round($_SESSION['ano_fim']);
	$anoi = 1990;
	
	echo '<h1>Produção em Periódicos Científicos / Qualis - Pós-Graduação</h1>';
	echo '<h3>Período de '.$anoi.' até '.$anof;
	
	
	
	echo $lattes->resumo_qualis_ss_geral(1,$areas,$anoi,$anof);	
	$ar = $lattes->matrix;
	
	require("producao_revistas_grafico_2.php");
	require("producao_revistas_grafico_3.php");
	require("producao_revistas_grafico.php");
	
	
	
	echo '<Table>';
	echo '<TR>';
	//echo '<TD>';
	/* Agrupa Produção */
	$mx = array(0,0,0,0,0,0,0,0,0);
	for ($r=0;$r < count($ar);$r++)
		{
			for ($y=0;$y < count($ar[$r]);$y++)
				{
					$mx[$y] = $mx[$y] + $ar[$r][$y];
				}
		}
	//echo $lattes->grafico_qualis($mx,'div_36',300);
	
	echo '<TD>';
	$mx = array(0,0,0,0,0,0,0,0,0);
	$r = 40;
	for ($y=0;$y < count($ar[$r]);$y++)
		{
			$mx[$y] = $mx[$y] + $ar[$r][$y];
		}
	echo $lattes->grafico_qualis($mx,'div_37',300);
	
	
	echo '<TD>';
	$mx = array(0,0,0,0,0,0,0,0,0);
	$r = 39;
	for ($y=0;$y < count($ar[$r]);$y++)
		{
			$mx[$y] = $mx[$y] + $ar[$r][$y];
		}
	echo $lattes->grafico_qualis($mx,'div_38',300);	
	
	echo '<TD>';
	$mx = array(0,0,0,0,0,0,0,0,0);
	$r = 38;
	for ($y=0;$y < count($ar[$r]);$y++)
		{
			$mx[$y] = $mx[$y] + $ar[$r][$y];
		}
	echo $lattes->grafico_qualis($mx,'div_39',300);
	
	echo '<TR align="center"><TD>'.(date("Y")).'<TD>'.(date("Y")-1).'<TD>'.(date("Y")-2);
	
/* */
	echo '<TR>';
	echo '<TD>';
	$mx = array(0,0,0,0,0,0,0,0,0);
	$r = 37;
	for ($y=0;$y < count($ar[$r]);$y++)
		{
			$mx[$y] = $mx[$y] + $ar[$r][$y];
		}
	echo $lattes->grafico_qualis($mx,'div_40',300);
	
	
	echo '<TD>';
	$mx = array(0,0,0,0,0,0,0,0,0);
	$r = 36;
	for ($y=0;$y < count($ar[$r]);$y++)
		{
			$mx[$y] = $mx[$y] + $ar[$r][$y];
		}
	echo $lattes->grafico_qualis($mx,'div_41',300);	
	
	echo '<TD>';
	$mx = array(0,0,0,0,0,0,0,0,0);
	$r = 35;
	for ($y=0;$y < count($ar[$r]);$y++)
		{
			$mx[$y] = $mx[$y] + $ar[$r][$y];
		}
	echo $lattes->grafico_qualis($mx,'div_42',300);	
	
	echo '<TR align="center"><TD>'.(date("Y")-3).'<TD>'.(date("Y")-4).'<TD>'.(date("Y")-5);
		
?>
<? require("../foot.php");	?>