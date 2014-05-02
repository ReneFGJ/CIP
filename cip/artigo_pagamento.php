<?php
require("cab_db.php");
require($include.'sisdoc_debug.php');
$user = trim($_SESSION['user_login']);

require("../_class/_class_artigo.php");
$ar = new artigo;

$id = $dd[0];
$dd90 = checkpost($id);

//if ($dd90 == $dd[90])
	{
		$ar->le($id);
		
		require($include.'_class_form.php');
		$form = new form;
		
		$tabela = $ar->tabela;
		
		$dd[6] = $ar->bon_A1 * round('0'.$dd[1]);
		$dd[7] = $ar->bon_A2 * round('0'.$dd[2]);
		$dd[8] = $ar->bon_Q1 * round('0'.$dd[3]);
		$dd[9] = $ar->bon_ExR * round('0'.$dd[4]);
		$dd[10] = $ar->bon_IC * round('0'.$dd[5]);
		
		/*
		 * 
		 */
		
		$cp = array();
		array_push($cp,array('$H8','id_ar','',False,True));
		array_push($cp,array('$C8','ar_c1','Artigo A1',False,True));
		array_push($cp,array('$C8','ar_c2','Artigo A2',False,True));
		array_push($cp,array('$C8','ar_c3','Artigo Q1',False,True));
		array_push($cp,array('$C8','ar_c4','Artigo ExR',False,True));
		array_push($cp,array('$C8','ar_c5','Colaboração Internacional',False,True));
		
		array_push($cp,array('$H8','ar_v1','',False,True));
		array_push($cp,array('$H8','ar_v2','',False,True));
		array_push($cp,array('$H8','ar_v3','',False,True));
		array_push($cp,array('$H8','ar_v4','',False,True));
		array_push($cp,array('$H8','ar_v5','',False,True));
		
		echo $form->editar($cp,$tabela);
		
		if ($form->saved > 0)
			{
			$tipos = '';
			if ($dd[1]=='1') { $tipos .= 'A1 ';}
			if ($dd[2]=='1') { $tipos .= 'A2 ';}
			if ($dd[3]=='1') { $tipos .= 'Q1 ';}
			if ($dd[4]=='1') { $tipos .= 'ExR ';}
			if ($dd[5]=='1') { $tipos .= 'Col. Inter.';}
			$sta = $ar->status();
			$action = 'A26';
			$historico = $sta['26'].' '.$tipos.' - '.$user;
			$ar->historico_inserir(strzero($dd[0],7),$action,$historico);		
				
			require("../close.php");
			}
	}

?>

