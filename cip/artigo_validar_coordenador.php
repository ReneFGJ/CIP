<?
$breadcrumbs=array();
array_push($breadcrumbs, array('main.php','principal'));
array_push($breadcrumbs, array('artigo.php','Artigo'));

require("cab_cip.php");
require("../_class/_class_artigo.php");
require("../_class/_class_docentes.php");
require("../_class/_class_bonificacao.php");

$doc = new docentes;
require($include.'sisdoc_debug.php');
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_windows.php');
require($include.'sisdoc_data.php');
require($include.'sisdoc_email.php');
require($include.'sisdoc_debug.php');
$art = new artigo;

$id = $dd[0];
$art->le($id);
?>
<fieldset><legend>Bonificação de Artigo</legend>
	<table width="100%" class="lt2">
		<TR><TD align="right">Protocolo: <B><?php echo $art->protocolo;?></B></TD></TR>		
	</table>
</fieldset>
<?

$doc = new docentes;
$doc->le($art->professor);

require("_ged_artigo_ged_documento.php");
$ged->protocol = $art->protocolo;

echo $art->mostra();


$link = 'http://www2.pucpr.br/reol/cip/artigo_ed.php?dd0='.$cap->id;
$link = '<A HREF="#" onclick="javascript:newxy2(\''.$link.'\',700,700);">';
$link .= 'editar</A>';
echo $link;

echo $art->validacao_pelo_coordenador();

echo $art->historico_mostrar($art->protocolo,$art->protocolo);

require("../foot.php");	?>