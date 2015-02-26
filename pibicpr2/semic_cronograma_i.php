<?
require("cab.php");
require($include."sisdoc_debug.php");
require($include."sisdoc_cookie.php");
require($include."sisdoc_debug.php");
require($include."sisdoc_email.php");
require("../_class/_class_ic.php");
require("../_class/_class_semic.php");
$semic = new semic;

			$semic->evento = 'SEMIC20';
			$semic->mostra = 'MP14';			

/////////////////////////////////////////////// AVALIADOR
$ic = new ic;
$jid = 0;

$semic->cronograma_avaliacao();

//enviaremail('renefgj@gmail.com','',$assunto,$texto);
echo 'e-mail enviado com sucesso!';
?>
