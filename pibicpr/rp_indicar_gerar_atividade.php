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

$sql = "delete from atividade where act_codigo ='ICA' ";
$rlt = db_query($sql);

$tabela = "pibic_parecer_".date("Y");

			$sql= "
				select * from ".$tabela." as indicacao
				inner join pibic_professor as avaliadores on indicacao.pp_avaliador = avaliadores.pp_cracha
				where pp_tipo = 'RPAR' 
				order by pp_nome					
			";
$rlt = db_query($sql);
$tot = 0;
$totc = 0;
while ($line = db_read($rlt))
{
	$tot++;
	$rpar = $line['pb_relatorio_parcial'];
	if (round($rpar) < 20100101)
		{
		$totc++;	
		$docente = $line['pb_professor'];
		$discente= $line['pb_aluno'];
		$limite = 20130220;
		$protocolo = $line['pb_protocolo'];
		echo '<BR>'.$docente;
		//$at->inserir_atividade('ICA',substr('Entrega de relatório parcial '.$line['pbt_descricao'],0,60),$docente,$discente,$limite,$protocolo);
		}
}
echo $tot.'/'.$totc;
require("../foot.php");	
?>