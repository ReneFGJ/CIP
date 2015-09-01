<?
$breadcrumbs=array();
array_push($breadcrumbs, array('pos_graduacao.php','P�s-gradua��o'));
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
	
	echo '<h1>Publica��o de livros organizados pelos docentes da P�s-Gradua��o</h1>';
	echo '<h3>Per�odo de '.$anoi.' at� '.$anof;
	$sr = $lattes->resumo_qualis_ss_tipo_geral(0,$areas,$anoi,$anof,'O');	
	
	
	$ar = $lattes->matrix;

	/* Agrupa Produ��o */
	$mx = array();
	$anos = 40;
	$z = 0;
	for ($ano=$anoi;$ano <= ($anof+1);$ano++)
		{
			$y = ($ano-(date("Y"))+$anos);
			array_push($mx,array($ano,$ar[$y]));
			$z++;
		}
	$titulo = 'Livros Organizados';
	echo $lattes->st;
	echo $lattes->grafico_mostra($mx,'div_36',900,$titulo,$xarc,$yarc);
	
	echo $sr;
?>
<? require("../foot.php");	?>