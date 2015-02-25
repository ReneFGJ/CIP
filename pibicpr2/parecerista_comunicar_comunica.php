<?php
require("db.php");
require($include.'sisdoc_windows.php');
require($include.'sisdoc_email.php');
require("../_class/_class_semic.php");
$semic = new semic;
$jid = '';
require("../_class/_class_ic.php");
$ic = new ic;
$icr = $ic->ic('SEMIC_AVAL');
$assunto = $icr['nw_titulo'];
$texto = $icr['nw_descricao'];

echo $semic->comunitar_avaliador_externo_enviar($avaliador,$assunto,$texto);

?>
