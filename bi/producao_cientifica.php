<?
$breadcrumbs=array();
array_push($breadcrumbs, array('pos_graduacao.php','Pós-graduação'));

require("cab_bi.php");

	require('../_class/_class_lattes.php');
	$lattes = new lattes;
	
	require('../_class/_class_programa_pos.php');
	$clx = new programa_pos;	

echo '<H1>Produção Científica</H3>';
echo '<h3>Triênio '.$dd[0].' - '.$dd[1].'</h3>';

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
		
		/* Recupera produção científica pos */
		$sx .= '<TR><TD>Produção em Artigos';
		$sx .= $lattes->resumo_qualis_ss($prog,$area,$ano1,$ano2,'3');
		
		/* Recupera produção de eventos */
		$sx .= '<TR><TD>Produção em Eventos';
		$sx .= $lattes->resumo_qualis_ss($prog,$area,$ano1,$ano2,'3','E');

		/* Recupera produção de livros */
		$sx .= '<TR><TD>Produção em Livros e Livros Organizados';
		$sx .= $lattes->resumo_qualis_ss($prog,$area,$ano1,$ano2,'3',"L' or la_tipo = 'O");
		
		/* Recupera produção de livros */
		$sx .= '<TR><TD>Produção em Capítulos de Livros';
		$sx .= $lattes->resumo_qualis_ss($prog,$area,$ano1,$ano2,'3','C');
		
	}
$sx .= '</table>';
echo $sx;
require("../foot.php");	
?>