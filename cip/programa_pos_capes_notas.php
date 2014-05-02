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
$tabela = $posp->tabela_nota;

$cp = $posp->cp_avaliacao();

$tela = $form->editar($cp, $tabela);
if ($form->saved > 0)
	{
		redirecina("programa_pos_capes.php");
	} else {
		echo $tela;
	}

require("../foot.php");	
?>