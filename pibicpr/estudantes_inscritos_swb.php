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
$cp = 's_nome, s_curso, s_universidade, s_pais, 
	   s_p01, 
       s_s01, 
       s_p02, 
       s_s03, 
       s_p03, 
       s_s04, 
s_p04, 
s_s06, s_p05, s_s08, s_s09, s_s10, s_data';

$sql = "select ".$cp." 
		from scf_evento 
		order by s_nome";

		$sx = '<h2>Inscritos no SWB '.date('Y').'</h2>';
		$sx .= '<table class="tabela01">';
		$sx .= '<TR><TH align=left >Nome';
		$sx .=     '<TH align=left >Curso';
		$sx .=     '<TH align=left >Universidade';
		$sx .=     '<TH width="10%"	 align=left >País';
		$sx .=     '<TH width="5%"	 align=left >Estágio?';
			$sx .=     '<TH width="8%"	 align=center >Onde?';
		$sx .=     '<TH width="5%"	 align=left >Pesquisa';
			$sx .=     '<TH width="8%"	 align=center >Onde?';
		$sx .=     '<TH width="5%"	 align=left >Trabalhando';
			$sx .=     '<TH width="8%"	 align=center >Onde?';
		$sx .=     '<TH width="5%"	 align=left >Prog. Mestrado';
			$sx .=     '<TH width="8%"	 align=center >Onde?';
		$sx .=     '<TH width="5%"	 align=left >Prog. Doutorado';
			$sx .=     '<TH width="8%"	 align=center >Onde?';
		$sx .=     '<TH width="8%"	 align=center >Início bolsa';
		$sx .=     '<TH width="8%"	 align=center >Término bolsa';
		$sx .=     '<TH width="8%"	 align=center >Retorno a PUCPR';
		
		
		$rlt = db_query($sql);
		$total = 0;
		
		$respo = array('0'=>'Não','1'=>'Sim','2'=>'Em processo');
		
		while ($line = db_read($rlt)) {
			
			$tot ++; 
			//dados do aluno		
			$a = tratar_nome($line['s_nome']);
			$b = tratar_nome($line['s_curso']);
			$c = tratar_nome($line['s_universidade']);
			$d = $line['s_pais'];
			
			//Perguntas//
			//estagio?
			$e = trim($line['s_p01']);
			$e = $respo[$e];
			$f = $line['s_s01'];
			
			//pesquisa?
			$g = trim($line['s_p02']);
			$g = $respo[$g];
			$h = $line['s_s03'];
			
			//trabalhando?
			$i = trim($line['s_p03']);
			$i = $respo[$i];
			$j = $line['s_s04'];
			
			//mestrado?
			$k = trim($line['s_p04']);
			$k = $respo[$k];
			$l = $line['s_s06'];
			
			//doutorado?
			$m = trim($line['s_p05']);
			$m = $respo[$m];
			$n = $line['s_s08'];
						
			//Datas
			$o = $line['s_s09'];
			$p = $line['s_s10'];
			$q = $line['s_data'];
			
			$sx .= '<TR>';
			$sx .= '<TD class="tabela01" width="15%">'.$a;
			$sx .= '<TD class="tabela01" width="15%">'.$b;
			$sx .= '<TD class="tabela01" width="15%">'.$c;
			$sx .= '<TD class="tabela01" align=center>'.$d;
			$sx .= '<TD class="tabela01" align=center>'.$e;
			$sx .= '<TD class="tabela01">'.$f;
			$sx .= '<TD class="tabela01">'.$g;
			$sx .= '<TD class="tabela01">'.$h;
			$sx .= '<TD class="tabela01">'.$i;
			$sx .= '<TD class="tabela01">'.$j; 	
			$sx .= '<TD class="tabela01">'.$k;
			$sx .= '<TD class="tabela01">'.$l;
			$sx .= '<TD class="tabela01">'.$m;
			$sx .= '<TD class="tabela01">'.$n;
			$sx .= '<TD class="tabela01">'.$o;
			$sx .= '<TD class="tabela01">'.$p;
			$sx .= '<TD class="tabela01">'.$q;
			
		}
		
		$sx .= '<TR><TD colspan=17 align=right><font color: important;><b> Total de '.$tot.' inscritos</b></font>';
		$sx .= '</table>';
		
		echo($sx);
		echo '</br>';
		//Botao para retorna a pag anterior
		echo '<form>
		    	<input type="button" value="Voltar"onClick="JavaScript: window.history.back();">
			</form>';
				
require("../foot.php");			
?>
