<?
require("cab.php");
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_debug.php');
require($include.'sisdoc_form2.php');
require($include.'cp2_gravar.php');

require('../_class/_class_pareceristas.php');
$par = new parecerista;

echo '<h2>Cadastro de Avaliadores</h2>';
$cp = $par->cp();
$tabela = $par->tabela;
	$http_edit = 'pareceristas_editar.php';
	$http_redirect = '';
	$http_ver = 'parecerista_detalhes.php';

echo '<table width="100%"><TR><TD>';
editar();
echo '</table>';

if ($saved > 0)
	{
		$par->updatex();
		redirecina('pareceristas_cadastro.php');
	}

require("../foot.php");
?>