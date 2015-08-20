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
	
	echo '<h1>Produ��o em Peri�dicos Cient�ficos / Qualis - P�s-Gradua��o</h1>';
	echo '<h3>Per�odo de '.$anoi.' at� '.$anof;
	$sql = "select * from programa_pos_docentes
				 inner join programa_pos on pdce_programa = pos_codigo
				 inner join pibic_professor on pdce_docente = pp_cracha
			where pdce_ativo = 1
			order by pos_nome, pp_nome
	";
	$rlt = db_query($sql);
	$xprog = '';
	while ($line = db_read($rlt))
		{
			$programa = $line['pdce_programa'];
			if ($programa != $xprog)
				{
					echo '<h3 class="tabela01">'.$line['pos_nome'].'</h3>';
					$xprog = $programa;
				}
			$professor = $line['pp_cracha'];
			$areas = array($line['pos_avaliacao_1']);
			//echo $lattes->resumo_qualis_discente_ss($programa,$areas,$anoi,$anof);
			echo '<H5>'.$line['pp_nome'].'( '.$professor.') </h5>';	
			echo $lattes->resumo_qualis($professor,$areas,2);
		}
	
		

?>
<? require("../foot.php");	?>