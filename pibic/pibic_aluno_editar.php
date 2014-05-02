<?
$debug = true;
require("db.php");
	$cpn = 'pibic_aluno';
	require($include.'sisdoc_colunas.php');
	require($include.'sisdoc_form2.php');
	require($include.'sisdoc_data.php');
	require($include.'sisdoc_debug.php');	
	require('cp/cp_'.$cpn.'.php');
	require($include.'cp2_gravar.php');
	$http_edit = 'pibic_aluno_editar.php';
	$http_redirect = 'close.php';
	$tit = strtolower(troca($dd[99],'_',' '));
	$tit = strtoupper(substr($tit,0,1)).substr($tit,1,strlen($tit));
?>
<html>
<head>
	<title>::Portal PIBIC - PUC-PR::</title>
	<link rel="STYLESHEET" type="text/css" href="css/letras.css">	
</head>
<?
	echo '<CENTER><font class=lt5>Dados do Aluno</font></CENTER>';
	?><TABLE width="<?=$tab_max?>" align="center"><TR><TD><?
	editar();
	?></TD></TR></TABLE><?	
?>