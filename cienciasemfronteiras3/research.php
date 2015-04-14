<?php
require("cab.php");
require("_class/_class_cep_submit.php");
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_data.php');
$proj = new submit;
$proj->doc_autor_principal = $nw->user_codigo;
$pta = $proj->protocolos_todos($dd[1]);  
$proj_1 = $proj->protocolos_mostrar($pta);
echo '<div id="content">';

if (strlen($proj_1) > 0)
	{
		echo '<Table width="'.$tab_max.'" class="lt1" align="center" >';
		echo '<TR><TD>';
		echo '<fieldset><legend>'.msg('protocols').'</legend>';
		echo '<Table width="100%" class="lt1" >';
		/* Protocolo em Submissao */
		echo $proj_1;
		echo '</table>';
		echo '</fieldset>';
		echo '</table>';
	}
echo '</div>';
require("foot.php");	
?>
<script>
	$("#content").corner();
</script>


