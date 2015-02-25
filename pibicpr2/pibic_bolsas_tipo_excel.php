<?
require("cab.php");
	require($include.'sisdoc_form2.php');
	require($include.'sisdoc_debug.php');	
	require($include.'cp2_gravar.php');

$tabela = "";
$cp = array();
array_push($cp,array('$H4','','',False,True,''));
array_push($cp,array('$A8','','Exportação de dados para Excel',False,True,''));
if (strlen($dd[3]) == 0)
	{
	array_push($cp,array('$Q pbt_descricao:pbt_codigo:select * from pibic_bolsa_tipo','','Tipo de Bosa',True,True,''));
	} else {
	array_push($cp,array('$HV','','',False,True,''));
	}
array_push($cp,array('$H4','','',False,True,''));
array_push($cp,array('$[2009-'.date("Y").']','','Ano',True,True,''));
//////////////////
if (strlen($dd[4]) == 0) { $dd[4] = (date("Y")-1); }
	echo '<CENTER><font class=lt5>Dados</font></CENTER>';
	?>
	<a href="pibic_bolsas_tipo_excel_xls.php?dd2=<?=$dd[2];?>&dd4=<?=$dd[4];?>">Excel</a>
	<TABLE width="<?=$tab_max?>" align="center"><TR><TD><?
	editar();
	?></TD></TR></TABLE><?	
	if ($saved > 0)
		{
		$id = 0;
		$sql = "select * from pibic_bolsa_contempladas ";
		$sql .= " left join pibic_aluno on pa_cracha = pb_aluno ";
		$sql .= " left join pibic_professor on pp_cracha = pb_professor ";
		$sql .= " where (pb_status <> 'C' and pb_status <> '@') ";
		if (strlen(trim($dd[4])) > 0)
			{ $sql .= " and (pb_ano = '".$dd[4]."') "; }
		if (strlen(trim($dd[2])) > 0)
			{ $sql .= " and (pb_tipo = '".$dd[2]."') "; }
		$rlt = db_query($sql);
		if (strlen($dd[2]) > 0) 
			{
			$xsql = "select * from pibic_bolsa_tipo where pbt_codigo = '".$dd[2]."' ";
			$xrlt = db_query($xsql);
			$xline = db_read($xrlt);
			$bolsa = trim($xline['pbt_descricao']);
			}
		echo '<table width="'.$tab_max.'" align="center" border="1" cellpadding="4" cellspacing="0">';
		echo '<TR><TD align="center">Critérios - Ano:'.$dd[4].' <B>'.$bolsa.'</B>';

		echo '<TR><TD>';
		while ($line = db_read($rlt))
			{
			$id++;
			$em1 = trim($line['pp_email']);
			$em2 = trim($line['pp_email_1']);
			if (strlen($em1) > 0) { echo $em1.'; '; }
			if (strlen($em2) > 0) { echo $em2.'; '; }
			}
		echo '</table>';
		echo '<BR><BR>Total >> '.$id;
		}
	
require("foot.php");	
?>