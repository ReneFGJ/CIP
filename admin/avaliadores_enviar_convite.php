<?php
require("cab.php");

require("../_class/_class_pareceristas.php");
$par = new parecerista;
$jid = 20;
echo '</center>';
echo '<h1>Resumo dos pareceristas externos</h1>';
echo $par->resumo_avaliadore_externos();

$status = $par->status();
print_r($status);

$ops = ' : ';
$ops .= '&1:Convite aceito';
$ops .= '&2:Aguardando resposta';
$ops .= '&3:Recusado temporariamente';
$ops .= '&9:Enviar convite';
$ops .= '&0:N�o, convite n�o aceito';
$ops .= '&-1:Excluir';
$ops .= '&19:Convite n�o aceito';
$ops .= '&10:SIM, Convite Novo Aceito';
$ops .= '&11:Convite aceito via CNPq';

$cp = array();
array_push($cp,array('$H8','','',False,True));
array_push($cp,array('$O '.$ops,'','De:',True,True));
array_push($cp,array('$O '.$ops,'','Para:',True,True));


require($include.'_class_form.php');
$form = new form;

$tela = $form->editar($cp,'');

if ($form->saved > 0)
	{
		print_r($dd);
	} else {
		echo $tela;
	}


require("../foot.php");	
?>