<?
$breadcrumbs=array();
array_push($breadcrumbs, array('pos_graduacao.php','P�s-gradua��o'));

require("cab_bi.php");

	require('../_class/_class_lattes.php');
	$lattes = new lattes;
	
	require('../_class/_class_programa_pos.php');
	$clx = new programa_pos;	

echo '<H1>Produ��o Cient�fica</H3>';
echo '<h3>Tri�nio '.$dd[0].' - '.$dd[1].'</h3>';

	$ano1 = $dd[0];
	$ano2 = $dd[1];
	
$sql = "select * from programa_pos where pos_corrente = '1' order by pos_nome ";
$rlt = db_query($sql);
$sx = '<table width="100%" class="tabela00">';
while ($line = db_read($rlt))
	{
		$sx .= '<TR>';
		$sx .= '<TD class="tabela00 lt3">';
		$sx .= '<h3>'.$line['pos_nome'].'</h3>';
		$area = array($line['pos_avaliacao_1']);
		$prog = $line['pos_codigo'];
		
		/* Recupera produ��o cient�fica pos */
		$sx .= '<TR><TD>Produ��o em Artigos';
		$sx .= $lattes->resumo_qualis_ss($prog,$area,$ano1,$ano2,'3');
		
		/* Recupera produ��o de eventos */
		$sx .= '<TR><TD>Produ��o em Eventos';
		$sx .= $lattes->resumo_qualis_ss($prog,$area,$ano1,$ano2,'3','E');

		/* Recupera produ��o de livros */
		$sx .= '<TR><TD>Produ��o em Livros e Livros Organizados';
		$sx .= $lattes->resumo_qualis_ss($prog,$area,$ano1,$ano2,'3',"L' or la_tipo = 'O");
		
		/* Recupera produ��o de livros */
		$sx .= '<TR><TD>Produ��o em Cap�tulos de Livros';
		$sx .= $lattes->resumo_qualis_ss($prog,$area,$ano1,$ano2,'3','C');
		
	}
$sx .= '</table>';
echo $sx;
require("../foot.php");	
?>