<?
require("cab_cip.php");
require($include.'sisdoc_debug.php');
require($include.'sisdoc_data.php');
require($include.'sisdoc_windows.php');
require($include.'sisdoc_colunas.php');
require('../_class/_class_grupo_de_pesquisa.php');
require('../_class/_class_linha_de_pesquisa.php');

	/* Arquivos GED */
	require('_ged_config.php');
	
$gp = new grupo_de_pesquisa;
$gp->le($dd[0]);
$li = new linha_de_pesquisa;
$status = $gp->gp_status;
if ($status = '@') { $status = 'A'; }
$img_status = '../img/status_icone_'.$status.'.png';

$gp->grupo_lattes_importar();

echo $gp->mostra_dados();
echo $gp->mostra_lider();
echo $gp->linhas_de_pesquisa_listar();		

//$ged->structure();
$ged->protocol = $gp->gp_codigo;
echo '<table width='.$tab_max.' cellpadding=0 cellspacing=0 class="lt3"><TR><TD>';
echo '<fieldset><legend>'.msg('file_list').'</legend>';
echo $ged->file_list();
echo '<a href="#" onclick="newxy2('.chr(39).'ged_upload.php?dd1='.$gp->gp_codigo.'&dd90='.checkpost($gp->gp_codigo).chr(39).',600,300);">';
echo 'upload</A>';
echo '</fieldlist>';
echo '</table>';	

echo '<table width='.$tab_max.' cellpadding=0 cellspacing=0><TR><TD>';
echo $gp->grupo_de_pesquisa_membros_listar();
echo '</table>';

//$gp->grupo_lattes_importar();
?>

