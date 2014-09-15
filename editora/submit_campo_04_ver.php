<?
require("cab.php");

global $acao,$dd,$cp,$tabela;
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_form2.php');
require($include.'sisdoc_debug.php');
require($include.'sisdoc_windows.php');

echo $hd->menu();
echo '<div id="conteudo">';
echo $hd->main_content('Modelo de parecer');

	/* Dados da Classe */
	require("_class/_class_submit_cp4.php");
	$clx = new campo_04;
	//$clx->structure();
	$edit_mode = 1;
	echo $clx->show_parecer($dd[0]);
	
	echo '
	<input type="button" id="item_new" value="'.mst('novo_form_item').'" class="botao-geral">
	<script>
		$("#item_new").click(function() {
			var tela = newxy2(\'submit_campo_04_subfields_ed.php?dd1='.$clx->form_codigo.'\',800,600);
		});
	</script>
	';
echo '</div>';
require("foot.php");		
?> 