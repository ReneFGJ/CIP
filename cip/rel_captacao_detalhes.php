<?
$breadcrumbs=array();
array_push($breadcrumbs, array('main.php','principal'));
array_push($breadcrumbs, array('relatorio.php','relatórios'));

require("cab_cip.php");

require("../_class/_class_captacao.php");
$cap = new captacao;

require($include.'_class_form.php');
$form = new form;

$cp = array();
array_push($cp,array('$H8','','',False,False));
array_push($cp,array('$O N:Não&S:SIM','','Internacional',False,False));

$tela = $form->editar($cp,'');

echo $tela;


$wh = "ca_internacional =  '1' ";

$sql = "select * from captacao 
		inner join pibic_professor on ca_professor = pp_cracha
		where ca_status <> 9 and $wh
		order by pp_nome		
		limit 6";
$rlt = db_query($sql);

while ($line = db_read($rlt))
	{
		echo '<h3>'.$line['pp_nome'].'</h3>';
		$cap->le($line['id_ca']);
		echo $cap->mostra();
	}
require("../foot.php");	
?>