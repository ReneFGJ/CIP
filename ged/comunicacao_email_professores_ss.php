<?
require("cab.php");
	require($include.'sisdoc_form2.php');
	require($include.'sisdoc_debug.php');	
	require($include.'cp2_gravar.php');

	echo '<CENTER><font class=lt5>E-mail de professores</font></CENTER>';

		{
		$id = 0;
		$sql = "select pp_email, pp_email_1, pp_nome, pp_ss, pp_ativo ";
		$sql .= " from pibic_professor  ";
		$sql .= " where (pp_ativo = 1 ) and (pp_ss = 'S') ";
		echo $sql;
		$rlt = db_query($sql);

		echo '<table class="lt0" width="'.$tab_max.'" align="center" border="1" cellpadding="4" cellspacing="0">';
		echo '<TR><TD align="center">Critérios - Ano:'.$dd[4].' <B>'.$bolsa.'</B>';

		echo '<TR><TD>';
		while ($line = db_read($rlt))
			{
			$id++;
			if (($dd[5] == '3') or ($dd[5] == '2'))
				{ echo '<BR> '.$line['pp_nome'].' '; }
			$em1 = trim($line['pp_email']);
			$em2 = trim($line['pp_email_1']);
			if (strlen($em1) > 0) { echo $em1.'; '; }
			if (strlen($em2) > 0) { echo $em2.'; '; }
			if ($dd[5] == '3')
				{ echo '('.$line['pb_protocolo'].') '; }
			
			}
		echo '</table>';
		echo '<BR><BR>Total >> '.$id;
		}
	
require("../foot.php");	
?>