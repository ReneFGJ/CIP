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
$ttt = $ic->ic('SEMIC_AVALIADOR_EMAI');
$texto = $ttt['nw_descricao'];
$assunto = $ttt['nw_titulo'];

$link = 'http://www2.pucpr.br/reol/pibicpr2/semic_fichas_avaliacao.php?dd0='.$dd[0];

echo '<BR>'.$email;
echo '<BR>'.$email1;
echo '<BR>'.$link;

$texto = troca($texto,'$avaliador',$aval_nome);
$texto = troca($texto,'$link',$link);

$semic->comunitar_avaliador_externo_enviar($dd[0],$assunto,$texto);

//enviaremail('renefgj@gmail.com','',$assunto,$texto);
echo 'e-mail enviado com sucesso!';
?>
