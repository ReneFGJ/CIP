<?php
/*** Modelo ****/
require("cab_bi.php");
global $acao,$dd,$cp,$tabela;
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_form2.php');
require($include.'sisdoc_debug.php');
require($include.'cp2_gravar.php');

		$programa_nome = $_SESSION['pos_nome'];
		$programa_pos = $_SESSION['pos_codigo'];
		$programa_pos_anoi = $_SESSION['pos_anoi'];
		$programa_pos_anof = $_SESSION['pos_anof'];
		if ((strlen($programa_pos_anoi)==0) and ($dd[2]=='')) { $dd[2] = 1996; }
		if ((strlen($programa_pos_anof)==0) and ($dd[3]=='')) { $dd[3] = date("Y"); }
		if ((strlen($programa_pos_anoi) > 0) and ($dd[2]=='')) { $dd[2] = $programa_pos_anoi; }
		if ((strlen($programa_pos_anof) > 0) and ($dd[3]=='')) { $dd[3] = $programa_pos_anof; }


		$cp = array();
		array_push($cp,array('$H8','','',False,True));
		array_push($cp,array('${','','Delimitação da análise',False,True));
		array_push($cp,array('$[1996-'.date("Y").']','','Delimitação entre',False,True));
		array_push($cp,array('$[1996-'.date("Y").']','','ate',False,True));
		array_push($cp,array('$}','','Delimitação da análise',False,True));
		echo '<table width="740">';
		editar();
		echo '</table>';


		if ($saved > 0)
			{
				$_SESSION['pos_anoi'] = $dd[2];
				$_SESSION['pos_anof'] = $dd[3];
				redirecina('pos_graduacao.php');
			}
require("../foot.php");		
?> 