<?
$breadcrumbs=array();
array_push($breadcrumbs, array('main.php','principal'));
array_push($breadcrumbs, array('relatorio.php','relatórios'));

require("cab_cip.php");
require($include."sisdoc_menus.php");
$estilo_admin = 'style="width: 200; height: 30; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';
$menu = array();
/////////////////////////////////////////////////// MANAGERS
array_push($menu,array('Discente','Discente',''));
array_push($menu,array('Discente','Cadastro de discente','discentes.php'));  
array_push($menu,array('Discente','__discente_orientacoes','discente_orientacao.php'));
if ($perfil->valid('#ADM'))
	{
	array_push($menu,array('Discente','__orientacoes_inport','discente_orientacao_inport.php'));
	array_push($menu,array('Discente','__processar_nomes','discente_nomes.php'));
	}
array_push($menu,array('Discente','__alunos sem genero','../admin/discente_genero.php'));	
?>
<TABLE width="710" align="center" border="0">
<TR>
<?
	$tela = menus($menu,"3");
?>
<? require("../foot.php");	?>