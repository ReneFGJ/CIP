<?
$sql = "delete from pibic_aluno where pa_cracha = '$cracha'";
//$rlt = db_query($sql);
//exit;
			
if (strlen($dd[$dx]) == 8)
	{
		$cracha = $dd[$dx];
		if ($cracha != '00000000') { 
			$codigo = $cracha;
			$aluno = $cracha;
			require('../pibicpr/pucpr_soap_pesquisaAluno.php');

			$sql = "select * from pibic_aluno where pa_cracha = '$cracha' ";
			$rlt = db_query($sql);
			
			if ($line = db_read($rlt))
				{
					$rst = True;
				} else {
					$rst = False;
				}
				
			
			if ($rst == True)
				{
					$msg = '';
					$asql = "select * from pibic_bolsa_contempladas ";
					$asql .= " where pb_aluno = '".$aluno."' ";
					$asql .= " and pb_ano = '".date("Y")."' ";
					$asql .= " and pb_protocolo <> '".$protocolo."' ";
					$asql .= " and (pb_status <> 'X' and pb_status <> 'C')";
					$arlt = db_query($asql);
					if ($aline = db_read($arlt))
						{
						$cracha = '';
						$dd[$dx] = '';
						$msg .= '<BR><img src="img/icone_stop.png" width="64" height="64" alt="" border="0" align="left">';
						$msg .= '<font color="red"><B>Aluno já está inscrito em outro plano de aluno</B></font><BR>';
						}
						
					$msg .= '<TT>Nome:<B>'.$rline['pa_nome'].'</B>';
					$msg .= '<BR>Cracha:'.$rline['pa_cracha'];
					$msg .= '<BR>CPF:'.$rline['pa_cpf'];
					$msg .= '<BR>e-mail:'.$rline['pa_email'];
					$msg .= ' '.$rline['pa_email_1'];
				} else {
					$msg = "<font color=red>Código <B>".$cracha."</B> inválido, ou aluno não matriculado</FONT>";
					$CP1 = '$S8';
					$dd[$dx] = '';
				}
			}
	} else {
		if (strlen($dd[$dx]) > 0)
		{
		$msg = "<font color=red>Código inválido</font>";
		}
		$dd[$dx] = '';
	}
if (strlen($msg) > 0)
	{
	$sp .= '<TR><TD></TD><TD class="lt2">'.$msg.'</TD></TR>';
	$sp .= '<TR><TD>&nbsp;</TD></TR>';
	}
$CP1 = '$S8';
?>
