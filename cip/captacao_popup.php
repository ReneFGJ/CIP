<?
$include = '../';
require("../db.php");
require('../_class/_class_language.php');
require($include.'sisdoc_form2.php');
require($include.'cp2_gravar.php');
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_data.php');

require('../_class/_class_captacao.php');
$cap = new captacao;

$chk = checkpost($dd[0]);
if ($chk == $dd[90])
{
?><head>
	<title>::CIP::</title>
	<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
	<link rel="shortcut icon" type="image/x-icon" href="http://cip.pucpr.br/favicon.ico" />
	<link rel="STYLESHEET" type="text/css" href="../css/letras.css">	
</head><?
?>
<h2>Captação</h2>

<?

$cp = $cap->cp_editar();

	$http_edit = 'captacao_popup.php?dd90='.$dd[90];
	$http_redirect = '';
	$tit = msg("titulo");
	$tabela = 'captacao';

	/** Comandos de Edição */
	?><TABLE width="98%" align="center" bgcolor="<?=$tab_color;?>"><TR><TD><?
	editar();
	?></TD></TR></TABLE><?	
	
	if ($saved > 0)
		{
			echo 'FIM';
			require('../close.php');
		}
}
?>