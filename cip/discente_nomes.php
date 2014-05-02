<?php
require('cab.php');
$ln = new message;

global $acao,$dd,$cp,$tabela;
require($include.'cp2_gravar.php');
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_form2.php');
require($include.'sisdoc_data.php');
require($include.'sisdoc_debug.php');

require("../_class/_class_discentes.php");

	$cl = new discentes;
	
	$sql = "select * from docente_orientacao 
			left join pibic_aluno on od_aluno = pa_cracha
			where pa_nome isnull
			limit 250";
	$rlt = db_query($sql);
	$tot = 0;
	while ($line = db_read($rlt))
	{
		$tot++;
		$cracha = trim($line['od_aluno']);
		if (strlen($cracha) == 8)
			{
				$tot++;
				echo $cracha.'<BR>';
				$cl->consulta_pucpr($cracha);
			}
	}
	
	echo 'Processado '.$tot.' nomes';
	echo '<BR>'.date("d/m/Y H:i:s");
	
	$sql = "select count(*) as total from docente_orientacao 
			left join pibic_aluno on od_aluno = pa_cracha
			where pa_nome isnull
			";
	$rlt = db_query($sql);
	$line = db_read($rlt);
	echo '<BR>'.$line['total'].' faltam processar';
	
require("../foot.php");	
?>

