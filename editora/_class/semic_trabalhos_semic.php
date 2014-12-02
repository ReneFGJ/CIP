<?php
require("cab_semic.php");
require("../_class/_class_semic.php");
require($include.'sisdoc_data.php');
$semic = new semic;

$sql = "insert into semic_local(sl_codigo,sl_nome,sl_descricao,sl_ativa,sl_ano) values ('00014','Sala Paulo Leminski','','1','2014');";
$rlt = db_query($sql);
$sql = "insert into semic_local(sl_codigo,sl_nome,sl_descricao,sl_ativa,sl_ano) values ('00015','Sala (Reserva)','','1','2014');";
$rlt = db_query($sql);
echo '<HR>';
exit;

$jid = $semic->recupera_jid_do_semic();
echo '-->'.$jid;
echo $semic->page_index_create();
echo $semic->lista_de_trabalhos_to_site();
?>
