<?
$breadcrumbs=array();
require("cab_pos.php");

require("../_class/_class_mobilidade.php");
$mb = new mobilidade;

require($include.'_class_form.php');
$form = new form;

echo '<h3>Mobilidade Docente - Outgoing</H3>';

if (strlen($acao) == 0)
	{
		$dd[1] = date("Y")-2;
		$dd[2] = date("Y");
	}
$cp = array();
array_push($cp,array('$H8','','',False,True));
array_push($cp,array('$A','','Delimitação temporal (data saída)',False,True));
array_push($cp,array('$[1990-'.date("Y").']D','','Início do recorte',True,True));
array_push($cp,array('$[1990-'.date("Y").']D','','Final do recorte',True,True));

$tela = $form->editar($cp,'');

echo '<h3>Mobilidade Docente</H3>';
echo $mb->lista_visitante("V",$ano1,$ano2,0);
echo '<form method="get" action="mobilidade_visitante_ed.php">';
echo '<input type="submit" value="novo registro" class="botao-geral">';

require("../foot.php");	
?>