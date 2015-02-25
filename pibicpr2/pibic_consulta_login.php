<?
require("cab.php");
	require($include.'sisdoc_colunas.php');
	require($include.'sisdoc_form2.php');
	require($include.'sisdoc_data.php');
	require($include.'sisdoc_debug.php');	
	require($include.'cp2_gravar.php');

$tabela = "";
$cp = array();
array_push($cp,array('$H4','','',False,True,''));
array_push($cp,array('$S40','','Login de rede',False,True,''));
array_push($cp,array('$P20','','Senha',False,True,''));

	echo '<CENTER><font class=lt5>Login de rede</font></CENTER>';
	?><TABLE width="<?=$tab_max?>" align="center"><TR><TD><?
	editar();
	?></TD></TR></TABLE><?	
	
	if ($saved > 0)
		{
		$codigo = trim($dd[1]);
		$senha = trim($dd[2]);
		
		if (strlen($codigo) == 0)
			{
				echo 'Código inválido';
			} else {
				require('pucpr_soap_autenticarUsuario.php');
				echo $result;
			}
		}
	
require("foot.php");	
?>