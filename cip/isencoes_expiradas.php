<?
$breadcrumbs=array();
array_push($breadcrumbs, array('main.php','principal'));
array_push($breadcrumbs, array('captacao.php','Captação'));

require("cab_cip.php");


echo '<h1>Isenções a expirar / expiradas</h1>';

require("../_class/_class_bonificacao.php");
$bon = new bonificacao;

	$rlt = $bon->indentifica_isencao('!');
	echo $bon->isencao_proj_mostra_F($rlt);

require("../foot.php");	?>