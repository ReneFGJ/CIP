<?
$breadcrumbs=array();
array_push($breadcrumbs, array('pos_graduacao.php','P�s-gradua��o'));

require("cab_cip.php");

	require('../_class/_class_lattes.php');
	$lattes = new lattes;
	
	require('../_class/_class_programa_pos.php');
	$clx = new programa_pos;	

	require('../_class/_class_pibic_bolsa_contempladas.php');
	$pibic = new pibic_bolsa_contempladas;
	
echo '<H1>Inicia��o Cient�fica</H3>';
echo '<h3>Tri�nio '.$dd[0].' - '.$dd[1].'</h3>';

	$ano1 = $dd[0];
	$ano2 = $dd[1];
	
$sql = "select * from programa_pos where pos_corrente = '1' order by pos_nome ";
$rlt = db_query($sql);
$sx = '<table width="100%" class="tabela0x0" border=1>';
while ($line = db_read($rlt))
	{
		$sx .= '<TR>';
		$sx .= '<TD class="tabela00 lt3">';
		$sx .= '<h3>'.$line['pos_nome'].'</h3>';
		$areas = array($line['pos_avaliacao_1']);
		$prog = $line['pos_codigo'];
		
		/* Recupera produ��o cient�fica pos */
		$sx .= '<TR><TD>';
		$sx .= $pibic->orientacao_pibic($prog,$areas,$ano1,$ano2);
		//$sx .= $pibic->orienacao_pibic_programa($prog,$areas,$ano1,$ano2);
		
		
	}
$sx .= '</table>';
echo $sx;
require("../foot.php");	
?>