<?php
require("db.php");
 
 /*
 * Incluir Classes para a página
 */
require("_class/_class_semic_layout.php");
$site = new layout;
require("../_class/_class_semic.php");
$semic = new semic;
$jid = $semic->recupera_jid_do_semic();

/* 
 * BB - Header Site 
 */
echo $site->header_site();

/*
 * BBM - Foot Site
 */
if ($LANG == 'en')
	{
		echo $site->abre_secao('Summary');
	} else {
		echo $site->abre_secao('Sumário Geral');		
	}


echo $semic->sumario_geral();
/*
 * echo $semic->lista_de_trabalhos();
 */

 $tp = '';
 if ($LANG == 'en') { $tp = '_en'; }
 
 echo '<A NAME="PIBIC"><A>';
 require("sumario_01".$tp.".php");
 echo '<A NAME="PIBITI"><A>';
 require("sumario_02".$tp.".php");
 echo '<A NAME="PIBIC_EM"><A>';
 require("sumario_03".$tp.".php");
 echo '<A NAME="POS-G"><A>';
 require("sumario_04".$tp.".php");
 echo '<A NAME="CSF"><A>';
 require("sumario_05".$tp.".php");
 
 echo '<A NAME="iPIBIC"><A>';
 require("sumario_11".$tp.".php");
 echo '<A NAME="iPIBITI"><A>';
 require("sumario_12".$tp.".php");
 echo '<A NAME="iPIBIC_EM"><A>';
 require("sumario_13".$tp.".php");
 

echo $site->fecha_secao();

/*
 * BBM - Foot Site
 */
echo $site->foot_site();
?>
