<?
$breadcrumbs=array();
array_push($breadcrumbs, array('main.php','principal'));
array_push($breadcrumbs, array('captacao.php','Captação'));

require("cab_cip.php");
require("../_class/_class_captacao.php");
require("../_class/_class_docentes.php");
require("../_class/_class_bonificacao.php");

$doc = new docentes;
require($include.'sisdoc_debug.php');
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_windows.php');
require($include.'sisdoc_data.php');
require($include.'sisdoc_email.php');
require($include.'sisdoc_debug.php');
$cap = new captacao;

$id = $dd[0];
$cap->le($id);
?>
<fieldset><legend>Projetos / Captação de Recursos</legend>
	<table width="100%" class="lt2">
		<TR><TD align="right">Projeto: <B><?php echo $cap->protocolo;?></B></TD></TR>		
	</table>
</fieldset>
<?

$doc = new docentes;
$doc->le($cap->professor);
echo $doc->mostra_dados();


$link = 'http://www2.pucpr.br/reol/cip/captacao_ed.php?dd0='.$cap->id;
$link = '<A HREF="#" onclick="javascript:newxy2(\''.$link.'\',700,700);">';
$link .= 'editar</A>';
echo $link;

echo $cap->mostra();

require("_ged_captacao_ged_documento.php");
$ged->protocol = $cap->protocolo;
echo $ged->filelist();

echo $cap->validacao_pelo_coordenador();

echo $cap->historico_mostrar($cap->protocolo,$cap->protocolo);

require("../foot.php");	?>