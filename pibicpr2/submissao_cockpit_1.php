<?php
require("cab.php");

	/* Dados da Classe */
	require('../_class/_class_pibic_projetos.php');	
	
	$prj = new pibic_projetos;

$sql = "select *  
	from pibic_projetos 
	inner join pibic_submit_documento on doc_protocolo_mae = pj_codigo
	inner join pibic_aluno on doc_aluno = pa_cracha 
	inner join pibic_professor on doc_autor_principal = pp_cracha
	
	where pj_ano = '".date("Y")."'
	and pj_status = 'B' 
	and doc_edital = '".$dd[0]."' 
	order by doc_protocolo_mae
";
$rlt = db_query($sql);

$tot = 0;
while ($line = db_read($rlt))
	{
		$tot++;
		$sx .= $prj->planos_mostra_mini($line);
	} 
	
echo '<table class="lt0" width=95% cellpadding=4 cellspacing=0 border=1 >';
echo $sx;
echo '<TR><TD colspan=5><B>total '.$tot;
echo '</table>';
?>

