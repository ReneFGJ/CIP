<?
require("cab.php");
	require($include.'sisdoc_form2.php');
	require($include.'sisdoc_debug.php');	
	require($include.'cp2_gravar.php');

$tabela = "";
$cp = array();
array_push($cp,array('$H4','','',False,True,''));
array_push($cp,array('$A8','','E-mail dos professores',False,True,''));
if (strlen($dd[3]) == 0)
	{
	array_push($cp,array('$Q pbt_descricao:pbt_codigo:select * from pibic_bolsa_tipo','','Tipo de Bosa',True,True,''));
	} else {
	array_push($cp,array('$HV','','',False,True,''));
	}
array_push($cp,array('$H4','','',False,True,''));
array_push($cp,array('$[2009-'.date("Y").']','','Ano',True,True,''));
array_push($cp,array('$O 1:Só e-mail&2:e-mail e nome&3:protocolo, e-mail e nome&4:protocolo, e-mail, nome do professor e do aluno','','Formato',True,True,''));
array_push($cp,array('$S20','','Campus',False,True,''));
//////////////////
if (strlen($dd[4]) == 0) { $dd[4] = (date("Y")-1); }
	echo '<CENTER><font class=lt5>E-mail de professores</font></CENTER>';
	?><TABLE width="<?=$tab_max?>" align="center"><TR><TD><?
	editar();
	?></TD></TR></TABLE><?	
	if ($saved > 0)
		{
		$id = 0;
		$sql = "select pp_email, pp_email_1, pp_nome, pp_centro";
		if ($dd[5] == '3')
			{ $sql = " select * "; }
		if ($dd[5] == '4')
			{ $sql = " select pp_email, pp_email_1, pp_nome, pp_centro, pa_nome "; }			
		$sql .= " from pibic_bolsa ";
		$sql .= " left join pibic_professor on pp_cracha = pb_professor ";
		if ($dd[5] == '4')
			{ $sql .= " left join pibic_aluno on pa_cracha = pb_aluno "; }
		$sql .= " where (pb_ativo = 1 ) ";
		if (strlen(trim($dd[4])) > 0)
			{ $sql .= " and (pp_ano = '".$dd[4]."') "; }
		if (strlen(trim($dd[2])) > 0)
			{ $sql .= " and (pb_tipo = '".$dd[2]."') "; }
		if (strlen($dd[6]) > 0)
			{ $sql .= " and pp_centro like '%".uppercase($dd[6])."%' "; }
		if ($dd[5] == '1')
			{
			$sql .= " group by pp_email, pp_email_1, pp_nome, pp_centro ";
			}
		if ($dd[5] == '4')
			{
			$sql .= " group by pp_email, pp_email_1, pp_nome, pp_centro, pa_nome ";
			}
		$sql .= " order by pp_nome ";
		
		$rlt = db_query($sql);
		echo '<table width="'.$tab_max.'" align="center" border="1" cellpadding="4" cellspacing="0">';
		echo '<TR><TD align="center">Critérios - Ano:'.$dd[4].' <B>'.$bolsa.'</B>';

		echo '<TR><TD>';
		while ($line = db_read($rlt))
			{
			$id++;
			if (($dd[5] == '3') or ($dd[5] == '2') or ($dd[5] == '4'))
				{ echo '<BR> '.$line['pp_nome'].' '; }
			$em1 = trim($line['pp_email']);
			$em2 = trim($line['pp_email_1']);
			if (strlen($em1) > 0) { echo $em1.'; '; }
			if (strlen($em2) > 0) { echo $em2.'; '; }
			if ($dd[5] == '3')
				{ echo '('.$line['pb_protocolo'].') '; }
			if ($dd[5] == '4')
				{ echo ''.$line['pa_nome'].''; }				
			
			}
		echo '</table>';
		echo '<BR><BR>Total >> '.$id;
		}
	
require("foot.php");	
?>