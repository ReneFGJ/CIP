<?
require("cab.php");
	require($include.'_class_form.php');
	$form = new form;
	
	require($include.'sisdoc_debug.php');	

$tabela = "";
$cp = array();
array_push($cp,array('$H4','','',False,True,''));
array_push($cp,array('$S8','','Cracha',False,True,''));
array_push($cp,array('$O 1:SIM&0:NÃO','','Atualizar dados',False,True,''));

	echo '<h1>Consulta de discente - Integração com o SGA</h1>';
	$tela = $form->editar($cp,'');	
	if ($form->saved > 0)
		{
		$cracha = trim(round(substr($dd[1],0,8)));
		$reativar = $dd[2];
		if (strlen($cracha) != 8)
			{
				echo 'Código inválido '.$cracha;
			} else {
				require('pucpr_soap_pesquisaAluno.php');
			}
		} else {
			echo $tela;
		}
	
require("../foot.php");	
?>