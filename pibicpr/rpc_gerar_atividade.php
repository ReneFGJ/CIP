<?php
require("cab.php");

require("../_class/_class_atividades.php");
$at = new atividades;
/*
 * $breadcrumbs
 */
$breadcrumbs = array();
array_push($breadcrumbs,array(http.'admin/index.php',msg('principal')));
array_push($breadcrumbs,array(http.'admin/index.php',msg('menu')));
echo '<div id="breadcrumbs">'.breadcrumbs().'</div>';

$sql = "delete from atividade where act_codigo ='IC1' ";
$rlt = db_query($sql);

$sql = "select * from pibic_bolsa_contempladas
		inner join pibic_bolsa_tipo on pbt_codigo = pb_tipo 
		where pb_ano = '".(date("Y")-1)."'  
		and (pbt_edital = 'IS' or pbt_edital = 'PIBIC' or pbt_edital = 'PIBITI' )
		and (pb_status <> 'C' and pb_status <> 'S')
		";
//$sql .= "and pb_professor = '88958022' ";
$rlt = db_query($sql);
$tot = 0;
$totc = 0;
while ($line = db_read($rlt))
{
	$tot++;
	$rpar = $line['pb_relatorio_parcial_correcao'];
	$nota = $line['pb_relatorio_parcial_nota'];
	if ((round($rpar) < 20100101) and ($nota == '2'))
		{
		$totc++;	
		$docente = $line['pb_professor'];
		$discente= $line['pb_aluno'];
		$limite = 20130220;
		$protocolo = $line['pb_protocolo'];
		echo '<BR>'.$docente;
		$at->inserir_atividade('IC7',substr('Entrega da correção relatório parcial '.$line['pbt_descricao'],0,60),$docente,$discente,$limite,$protocolo);
		}
}
echo $tot.'/'.$totc;
require("../foot.php");	
?>