<?
require("cab.php");
require($include."sisdoc_windows.php");
require($include."sisdoc_form2.php");
require($include."cp2_gravar.php");
global $bgc;

		$tabela = '';
		$cp = array();
		array_push($cp,array('$H8','','',False,True,''));
		array_push($cp,array('$S30','','Login de rede',True,True,''));
		array_push($cp,array('$P30','','Senha',True,True,''));
		echo '<TABLE width="'.$tab_max.'">';
		echo '<TR><TD>';
		editar();
		echo '</TABLE>';	

if ($saved > 0)
{
	$tipo_nome = "Integração de Login de Rede";
	$codigo = $dd[1];
	$senha = $dd[2];
	require("pucpr_soap_autenticarUsuario.php");
}
require("foot.php");
?>