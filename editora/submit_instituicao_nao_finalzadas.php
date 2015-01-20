<?
require("cab.php");

require($include.'sisdoc_data.php');
require($include.'sisdoc_windows.php');

require("_class/_class_submit_article.php");
$ar = new submit;

echo $hd->menu();
echo '<div id="conteudo">';
	echo $hd->main_content('Submissão não finalizadas (Instituição)');

echo $ar->lista_submissoes_instituicoes_email();
echo '<HR>';
exit;
echo $ar->lista_submissoes_instituicoes_nao_finalizada();


require("foot.php");
?>
