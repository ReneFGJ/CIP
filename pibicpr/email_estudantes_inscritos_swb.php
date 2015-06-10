<?php
require("cab.php");
require($include."sisdoc_debug.php");
require($include."sisdoc_menus.php");
/*
 * $breadcrumbs
 */ 
$breadcrumbs = array();
array_push($breadcrumbs,array(http.'pibicpr/index.php',msg('iniciação científica')));
array_push($breadcrumbs,array(http.'//main.php',msg('menu CIP')));
echo '<div id="breadcrumbs">'.breadcrumbs().'</div>';
$estilo_admin = 'style="width: 200; height: 30; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';
echo '<h1>Discentes</h1>';
echo '<div style="width:80%; height:1px; border-bottom:3px solid #757575;"></div>';

//////////////////// MANAGERS ///////////////////////////////
$cp = 's_email';

$sql = "select ".$cp." 
		from scf_evento 
		order by ".$cp."";

		$sx = '<h2>E-mail dos inscritos no SWB '.date('Y').'</h2>';
		$sx .= '<table>';
		
		$rlt = db_query($sql);
		$total = 0;
		
		while ($line = db_read($rlt)) {
			
			$tot ++; 
			//email do aluno		
			$a = trim($line['s_email']);
			
			$sx .= '<TR>'.$a.';';
			
		}
		
		$sx .= '<TR><TD colspan=1 align=right><font color: important;><b> Total de '.$tot.' inscritos</b></font>';
		$sx .= '</table>';
		
		echo($sx);
		echo '</br>';
		//Botao para retorna a pag anterior
		echo '<form>
		    	<input type="button" value="Voltar"onClick="JavaScript: window.history.back();">
			</form>';
				
require("../foot.php");			
?>
