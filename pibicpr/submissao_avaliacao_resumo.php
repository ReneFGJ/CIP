<?php
require("cab.php");
require("../_class/_class_pibic_projetos.php");
$pj = new projetos;

$ano = date("Y");
$meta = 1100;

require($include.'_class_form.php');
$form = new form;

echo '<H3>Resumo das avaliações do projeto</h3>';

$sql = "select count(*) as total, pj_status from pibic_projetos
		inner join pibic_submit_documento on (pj_codigo =  doc_protocolo_mae) 
		where pj_ano = '".date("Y")."'
		group by pj_status
		 
		";
$rlt = db_query($sql);

while ($line = db_read($rlt))
{
	echo '<TR>';
	echo '<TD>';
	echo $line['pj_codigo'];
	echo '<TD>';
	echo $line['pj_titulo'];
	echo '<TD>';
	echo $line['pj_status'];
	echo '<TD>';
	print_r($line);

}
?>
