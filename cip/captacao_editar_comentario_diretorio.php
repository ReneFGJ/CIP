<?php
require('cab.php');
require($include.'sisdoc_data.php');
global $acao,$dd,$cp,$tabela;
require($include.'cp2_gravar.php');
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_form2.php');
require($include.'sisdoc_debug.php');


require("../_class/_class_captacao.php");
	$cl = new captacao;
	$cp=$cl->cp_obs_diretoria();
	$tabela = $cl->tabela;
	
	$http_edit = page();
	$http_redirect = '';
	$tit = msg("tit_captacao");

	/** Comandos de Ediçãoo */
	echo '<CENTER><font class=lt5>'.$tit.'</font></CENTER>';
	?><TABLE width="<?=$tab_max;?>" align="center" bgcolor="<?=$tab_color;?>"><TR><TD><?
	editar();
	?></TD></TR></TABLE><?	
	
	/** Caso o registro seja validado */
	if ($saved > 0)
		{
			echo 'Salvo';
			$cl->updatex();
			require("../close.php");
		}
		
?>


