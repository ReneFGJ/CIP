<?
require("cab.php");
	require($include.'sisdoc_form2.php');
	require($include.'sisdoc_debug.php');	
	require($include.'cp2_gravar.php');

$tabela = "";
$cp = array();
array_push($cp,array('$H4','','',False,True,''));
array_push($cp,array('$S8','','Cracha',False,True,''));
array_push($cp,array('$C1','','Atualizar dados',False,True,''));

	echo '<CENTER><font class=lt5>Cadastro de Alunos PUCPR</font></CENTER>';
	?><TABLE width="<?=$tab_max?>" align="center"><TR><TD><?
	editar();
	?></TD></TR></TABLE><?	
	
	if ($saved > 0)
		{
		$cracha = trim(round(substr($dd[1],0,8)));
		$reativar = $dd[2];
		if (strlen($cracha) != 8)
			{
				echo 'Código inválido '.$cracha;
			} else {
				require('pucpr_soap_pesquisaAluno.php');
			}
		}
	
require("foot.php");	
?>