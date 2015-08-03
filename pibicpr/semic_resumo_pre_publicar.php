<?php
require("cab.php");
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_data.php');
require($include.'sisdoc_windows.php');
/*
 * $breadcrumbs
 */
$breadcrumbs = array();
array_push($breadcrumbs,array(http.'admin/index.php',msg('principal')));
array_push($breadcrumbs,array(http.'admin/index.php',msg('menu')));
echo '<div id="breadcrumbs">'.breadcrumbs().'</div>';

require("../_class/_class_issue.php");
require("../_class/_class_journal_sections.php");
require("../_class/_class_tesauro_editorial.php");
require("../editora/_class/_class_article.php");
$ts = new tesauro;
$art = new article;

require("../_class/_class_pibic_bolsa_contempladas.php");
$pb = new pibic_bolsa_contempladas;

require("../_class/_class_semic.php");
$semic = new semic;

$pb->le('',$dd[0]);
echo '<A HREF="http://www2.pucpr.br/reol/pibicpr2/ed_edit.php?dd0='.$pb->id_pb.'&dd99=pibic_bolsas_contempladas" target="new">';
echo '{editar}';
echo '</A>';
$ano = $pb->$line['pb_ano'];
$status = $pb->$line['pb_ano'];
$dt_semic = $pb->$line['pb_semic'];

echo $pb->mostar_dados();
echo $pb->mostra_autores_submetidos();
echo $pb->mostra_resumo();

if (strlen($dd[12]) > 0)
	{
		echo '<HR>';
		$semic->publica_resumo_semic_bolsa($dd[0]);
		echo '<HR>';
		echo '---';
		$semic->publica_semic($dd[0]);
	} else {
		$ts->padroniza_titulo($pb->pb_titulo_plano,0);	
		?>
		<form method="post" action="<?=page();?>">
			<input type="hidden" name="dd0" value="<?=$dd[0];?>">
			<input type="hidden" name="dd12" value="1">
			<input type="hidden" name="dd90" value="<?=$dd[90];?>">
			<input type="submit" value="publicar trabalho">
		</form>
		<?				
	}



require("../foot.php");	
?>