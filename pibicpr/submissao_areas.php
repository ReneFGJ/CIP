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


array_push($cp,array('$Q a_descricao:a_cnpq:'.$sql,'','',False,False));
//monta combo de anos com inicio em 1990 atï¿½ anobase atual
array_push($cp, array('$[2010-' . date("Y") . ']', '', 'Escolha o ano para busca', False, True, ''));
array_push($cp,array('$H8','','',False,False));

//Captura ano selecionado e armazena na variavel $dd[0]
if (strlen($dd[0]) == 0) {$dd[0] = (date("Y")-1);}

echo $form->editar($cp,'');

if ($form->saved > 0)
	{
		echo $pj->projetos_seleciona_area($dd[0],$dd[1]);
		echo '<BR><BR>';
	}
?>
