<?
$xcab = 1;
$breadcrumbs=array();
array_push($breadcrumbs, array('main.php','principal'));
array_push($breadcrumbs, array('captacao.php','Capta��o'));


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
array_push($menu,array('Capta��o de Recursos','Meus projetos cadastrados','captacao_my.php'));

/* Trabalhos para Corre��o */
$total4 = $ati->total_captacao_correcao($professor);
if ($total4 > 0)
	{ 
		array_push($menu,array('Capta��o de Recursos','<font color="red">Captaca��es para corre��o (devolvido pela diretoria)</font>','captacao_list.php?dd9=1'));
	}

array_push($menu,array('Capta��o de Recursos','Cadastrar novo projeto','captacao_novo.php?pag=1'));

if ($total > 0)
	{
	array_push($menu,array('Isen��es','Indicar isen��es','../atividades.php'));
	}

if (($total2 > 0) and (date("Ymd") > 20140116))
	{
	array_push($menu,array('Capta��o de Recursos','<B>Validar capta��es de pesquisadores</B>','captacaoes_validar.php'));
	}
if (($total3 > 0) and (date("Ymd") > 20140116))
	{
	array_push($menu,array('Bonifica��o de artigos','<B>Validar bonifica��o de artigos</B>','artigos_validar.php'));
	}
	
?>
<TABLE width="710" align="center" border="0">
<TR>
<?
	$tela = menus($menu,"3");
?>
<? require("../foot.php");	?>