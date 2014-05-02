<?
$breadcrumbs=array();
array_push($breadcrumbs, array('/fonzaghi/finan/index.php','Financeiro'));

require("cab_cip.php");

require($include."_class_form.php");
require("../_class/_class_programa_pos.php");
require("../_class/_class_form_extend_ajax.php");
$form = new ajax;


$posp = new programa_pos;
$programa = '';

echo $posp->rel_programas_pos_historico_notas($programa);

echo $form->div();
//echo $form->botao_novo($http.'ajax_form.php',$posp->tabela_nota,'');
echo '<A HREF="programa_pos_capes_notas.php" class="submit-geral">NOVA AVALIAÇÃO</A>';

require("../foot.php");	
?>