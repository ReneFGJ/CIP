<?
	require($include.'sisdoc_form2.php');
	require($include.'sisdoc_debug.php');	
	require($include.'cp2_gravar.php');
$tabela = "";
$cp = array();
$msc = '<DIV class=lt2 style="background-color : White; 
border : 0px;" >
<font class=lt1>
Para identificar o código do aluno, utilizam-se 
os oito dígitos de sua carteira de estudante da 
PUCPR, ignorando os três primeiros dígitos e o 
último.
<BR>
Ex:<B><font color=red>101</font><font color=blue>88113456</font><font color=red>-3</Font></B> (somente o que está em azul)
<BR><BR>
O sistema irá resgatar algumas informações 
básicas do aluno no SIGA e será preenchido na 
próxima tela. </DIV>';

array_push($cp,array('$H4','','',False,True,''));
array_push($cp,array('$H4','','',False,True,''));
array_push($cp,array('$H4','','',False,True,''));
array_push($cp,array('$H4','','',False,True,''));
array_push($cp,array('$H4','','',False,True,''));
if (!((strlen($dd[5]) == 8) and (strlen($dd[6]) > 0)))
	{
	array_push($cp,array('$S8','','Cracha no estudante',True,True,''));
	array_push($cp,array('$O : &S:SIM&N:Não','','Aluno só pode concorrer a Iniciação Científica/Tecnológica Voluntária (ICV/ICT)?',True,True,''));
	} else {
		/* Verifica se o aluno já não esta inscrito em outro plano */
		$sql = "select * from pibic_submit_documento ";
		$sql .= " where doc_aluno = '".$dd[5]."' ";
		$sql .= " and doc_ano = '".date("Y")."' ";
		$sql .= " and (doc_status <> 'X' and doc_status <> '@') ";

		$rlt = db_query($sql);
		$err = 0;
		if ($line = db_read($rlt))
			{
			$err = 1;
			$mst = 'Este aluno já esta inscrito no plano '.$line['doc_protocolo'];
			}
		
		/* Mostra se tem erro */
		if ($err > 0)
			{
				$dd[5] = '';
				$dd[6] = '';
				array_push($cp,array('$S8','','Cracha no estudante',True,True,''));
				array_push($cp,array('$O : &S:SIM&N:Não','','Aluno só pode concorrer a Iniciação Científica/Tecnológica Voluntária (ICV/ICT)?',True,True,''));
			} else {
			/* Checa dados com a PUCPR */
			$dx = 5;
			$debug == False;
			$protocolo = $dd[1];
			$aluno = $dd[5];
			require("pucpr_aluno.php");
			
			/* Dados OK */
			if (strlen($cracha) == 0)
				{
					echo 'X>>>>'.$cracha;
					$dd[4] = '';
					$dd[5] = '';
					array_push($cp,array('$S8','','Cracha no estudante',True,True,''));
					array_push($cp,array('$O : &S:SIM&N:Não','','Aluno só pode concorrer a Iniciação Científica/Tecnológica Voluntária (ICV/ICT)?',True,True,''));
					array_push($cp,array('$M2','','Dados do Aluno<HR>'.$msg,False,True,''));
				} else {
					array_push($cp,array('$H4','','',False,True,''));
					array_push($cp,array('$H4','','',False,True,''));
					array_push($cp,array('$M2','','Dados do Aluno<HR>'.$msg,False,True,''));
					array_push($cp,array('$O : &S:SIM','','Confirma indicação?',True,True,''));
				}
			}
	}
echo '<CENTER><font class=lt5>Indicação de Estudante</font></CENTER>';
array_push($cp,array('$B8','','Enviar dados >>>',False,True,''));

?><TABLE width="98%" align="center" border="1">
<TR><TD>
<?
echo $msc;
echo '<TR><TD>';
editar();
?></TD></TR></TABLE><?	

/* GRAVA ALTERACAO */
if ($saved > 0)
	{
	require("submissao_indicar_aluno_acao_save.php");
	}

if (strlen($mst) > 0)
	{
	echo "<script>alert('".$mst."');</script>";
	}
?>