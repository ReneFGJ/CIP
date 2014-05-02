<?
$xcab = 1;
$breadcrumbs=array();
array_push($breadcrumbs, array('main.php','principal'));
array_push($breadcrumbs, array('captacao.php','Captação'));


require("cab_cip.php");

require("../_class/_class_captacao.php");
$cap = new captacao;

require("../_class/_class_artigo.php");
$art = new artigo;

require("../_class/_class_atividades.php");
$ati = new atividades;


require($include."sisdoc_menus.php");
$estilo_admin = 'style="width: 200; height: 30; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';

$professor = trim($ss->user_cracha);

$total = $ati->total_isencoes($professor);

$total2 = $ati->total_captacoes_validar($professor);
$total3 = $ati->total_artigos_validar($professor);

$menu = array();
/////////////////////////////////////////////////// MANAGERS
array_push($menu,array('Artigos para bonificação','Meus artigos cadastrados','artigos_my.php'));
//array_push($menu,array('Captação de Recursos','Cadastrar novo projeto','artigo_novo.php'));

if (($total3 > 0) and (date("Ymd") > 20140116))
	{
	array_push($menu,array('Bonificação de artigos','<B>Validar bonificação de artigos</B>','artigos_validar.php'));
	}
	
?>
<TABLE width="710" align="center" border="0">
<TR>
<?
	$tela = menus($menu,"3");
?>
<? require("../foot.php");	?>