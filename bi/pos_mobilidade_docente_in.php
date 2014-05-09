<?
$breadcrumbs=array();
require("cab_bi.php");

require("../_class/_class_mobilidade.php");
$mb = new mobilidade;

require($include.'_class_form.php');
$form = new form;

echo '<h3>Mobilidade Docente - Incoming</H3>';

if (strlen($acao) == 0)
	{
		$dd[2] = date("Y")-2;
		$dd[3] = date("Y");
	}
$cp = array();
array_push($cp,array('$H8','','',False,True));
array_push($cp,array('$A','','Delimitação temporal (data saída)',False,True));
array_push($cp,array('$[1990-'.date("Y").']D','','Início do recorte',True,True));
array_push($cp,array('$[1990-'.date("Y").']D','','Final do recorte',True,True));

$tela = $form->editar($cp,'');

if ($form->saved == 0)
	{
		echo $tela;	
	} else {
		$ano1 = $dd[2];
		$ano2 = $dd[3];
		echo '<h4>Ano de apuração '.$ano1.'-'.$ano2.'</h4>';

		echo $mb->lista_visitante("V",$ano1,$ano2,0);
	}	
require("../foot.php");	
?>