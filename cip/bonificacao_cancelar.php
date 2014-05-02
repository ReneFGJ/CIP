<?
$breadcrumbs=array();
array_push($breadcrumbs, array('main.php','principal'));
array_push($breadcrumbs, array('captacao.php','Captação'));

require("cab_cip.php");
require("../_class/_class_captacao.php");
require("../_class/_class_docentes.php");
require("../_class/_class_bonificacao.php");
$bon = new bonificacao;
$bon->le($dd[0]);
$id = $bon->origem_protocolo;
$doc = new docentes;
require($include.'sisdoc_debug.php');
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_windows.php');
require($include.'sisdoc_data.php');
require($include.'cp2_gravar.php');
require($include.'sisdoc_form2.php');
$cap = new captacao;

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

require("_ged_bonificacao_ged_documento.php");

$bon = new bonificacao;
echo $bon->mostra_bonificacoes_por_projeto($cap->protocolo);
require("_ged_bonificacao_ged_documento.php");
echo $cap->historico_mostrar($cap->protocolo,$cap->protocolo);

if (($perfil->valid('#CPS')) and ($cap->status != 9))
	{
		
	$bon->cancelar_form();	
	}

require("../foot.php");	?>