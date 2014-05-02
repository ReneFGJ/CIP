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

if ($perfil->valid('#ADM#SPI#CPI'))
	{
	$link = 'http://www2.pucpr.br/reol/cip/captacao_ed.php?dd0='.$cap->id;
	$link = '<A HREF="#" onclick="javascript:newxy2(\''.$link.'\',700,700);">';
	$link .= 'editar</A>';
	echo $link;
	}

echo $cap->mostra();

require("_ged_captacao_ged_documento.php");
$ged->protocol = $cap->protocolo;
echo $ged->filelist();
if ($perfil->valid('#ADM#SCR#COO'))
			{
			echo $ged->upload_botton_with_type($cap->protocolo,'','');
			}

require("_ged_bonificacao_ged_documento.php");

$cap->lista_projetos_vinculados();

$bon = new bonificacao;
echo $bon->mostra_bonificacoes_por_projeto($cap->protocolo);
require("_ged_bonificacao_ged_documento.php");
echo $cap->historico_mostrar($cap->protocolo,$cap->protocolo);
if (($perfil->valid('#ADM#SCR#COO')) and ($cap->status != 9))
	{
	echo $cap->validacao_pela_diretoria();	
	}

require("../foot.php");	?>