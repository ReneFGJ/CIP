<?php
require("cab_no.php");

require("_class/_class_dtd_mark.php");
$dtd = new dtd_mark;

$tabela = $dd[3];
$id = $dd[0];
$tipo = $dd[2];
$paragrafo = $dd[1];
$issue = $dd[4];

require($include.'_class_form.php');
$form = new form;
echo '['.$tipo.']';

			$dtd->recupera_file($tabela,$id);
			$cp = $dtd->cp_03();
			$tela = $form->editar($cp, '');
			if ($form->saved > 0)
				{
					echo '--->'.$dd[10]; 
					$dtd->phase_insere($paragrafo,$dd[10]);
					echo $dtd->conteudo;
					$dtd->save_file();
				} else { echo $tela; exit; }

require("close.php");
?>
