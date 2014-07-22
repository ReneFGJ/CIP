<?php
require("cab_no.php");

require_once('_ged_submit_files.php');

require("_class/_class_dtd_mark.php");
$dtd = new dtd_mark;
$id = $dd[0];

if (strlen($acao) == 0)
	{
		$dtd->recupera_file($ged->tabela, $id);
		$dd[1] = $dtd->conteudo;
	}

require($include.'_class_form.php');
$form = new form;

$cp = array();
array_push($cp,array('$H8','','',False,False));
array_push($cp,array('$t80:20','','',True,False));
array_push($cp,array('$O : &S:Salvar em UTF8','','UTF8',False,False));

$tela = $form->editar($cp,'');

if ($form->saved > 0)
	{
		$tx = $dd[1];
		$dtd->recupera_file($ged->tabela, $id);
		$file = $dtd->file;
		$tx = troca($tx,'´',"'");
		$tx = troca($tx,'&#61650;','&reg');
		$tx = troca($tx,'&#61617;','&plusmn;');
		$tx = troca($tx,'&#61666;','&reg');
		$tx = troca($tx,'1st','1[sup]st[/sup]');
		$tx = troca($tx,'2nd','2[sup]nd[/sup]');
		$tx = troca($tx,'3th','3[sup]th[/sup]');
		$tx = troca($tx,'Pimax','Pi[sub]max[/sub]');
		$tx = troca($tx,'Pemax','Pe[sub]max[/sub]');
		$tx = troca($tx,'SaO2','SaO[sub]2[/sub]');
		
				
		if ($dd[2]=='S') { $tx = utf8_encode($tx); }
		//$txt = troca($txt,chr(177),'&#177;');
		$rlt = fopen($file,'w+');
		fwrite($rlt,$tx);
		fclose($rlt);
		require("close.php");
	} else {
		echo $tela;		
	}
?>
