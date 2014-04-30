<?php
require("cab.php");
require("../_class/_class_pibic_projetos.php");
$pj = new projetos;

$ano = date("Y");
$meta = 1100;

require($include.'_class_form.php');
$form = new form;

echo '<H3>Projetos por áreas estratégicas</h3>';

$cp = array();
$sql = "select a_cnpq || ' ' || a_descricao as a_descricao, a_cnpq from ajax_areadoconhecimento where a_semic = 1 order by a_cnpq";

array_push($cp,array('$H8','','',False,False));
array_push($cp,array('$Q a_descricao:a_cnpq:'.$sql,'','',False,False));
array_push($cp,array('$O 2013:2013','','',False,False));

echo $form->editar($cp,'');

if ($form->saved > 0)
	{
		echo $pj->projetos_area($dd[1],date("Y"));
		echo '<BR><BR>';
	}
?>
