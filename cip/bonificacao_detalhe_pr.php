<?
$breadcrumbs=array();
array_push($breadcrumbs, array('main.php','principal'));
array_push($breadcrumbs, array('captacao.php','Captação'));

require("cab_db.php");
require($include.'sisdoc_windows.php');
require("../_class/_class_user_perfil.php");
$perfil = new user_perfil; 
/* Imprimir */
require($include.'sisdoc_email.php');
echo emailcab($page.'?dd0='.$dd[0].'&dd90='.$dd[90]);

/* Classses */
require("../_class/_class_bonificacao.php");
$bon = new bonificacao;

require("../_class/_class_captacao.php");
$cap = new captacao;

require("../_class/_class_docentes.php");
$doc = new docentes;

require("../_class/_class_assintaturas.php");
$ass = new assintaturas;

require($include.'sisdoc_colunas.php');

require($include.'sisdoc_data.php');
require($include.'sisdoc_email.php');

$bon->le($dd[0]);


/*
 * Mostar Cabeçalho de Impressão * 
 */
require("cab_pr.php");
echo '<TABLE width="100%" class="lt2"><TR><TD><B>Bonificação de pesquisador';
echo '<TD align="right">Protocolo: '.$bon->protocolo;
echo '</table>';


$bon->le($dd[0]);
$doc->le($bon->professor);
echo $doc->mostra();
ini_set('display_errors', 255);
ini_set('error_reporting', 255);
if ($bon->origem_tipo=='PRJ')
	{
		$id = $bon->origem_protocolo;
		$cap->le($id);
		echo $cap->mostra();
	}
echo $bon->mostar_bonificacao();
echo $ass->mostra_dir_pesquisa($bon->descricao);
?>