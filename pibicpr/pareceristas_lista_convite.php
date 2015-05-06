<?php
require("cab.php");
require($include.'sisdoc_email.php');
require('../_class/_class_pareceristas.php');
$par = new parecerista;

require('../_class/_class_ic.php');
$ic = new ic;

$txt = $ic->ic('PARIC_CONVITE_EXT');

$titulo = $txt['nw_titulo'];
$texto = $txt['nw_descricao'];

echo '<table width="700">';
echo '<TR><TD>'.$titulo;
echo '<TR><TD>'.mst($texto);

require($include.'_class_form.php');
$form = new form;
$cp = array();
array_push($cp,array('$H8','','',False,False));
array_push($cp,array('$O : &1:SIM','','Confirma envio',True,True));

$tela = $form->editar($cp,'');

$total = $par->enviar_convite_total();
echo '<h2>Total de convites para enviar '.$total.'</h2>';

if ($form->saved > 0)
	{	
		$par->enviar_convite(9,$titulo,$texto);
	} else {
		echo $tela;
	}

require("../foot.php");
?>
