<?
require('db.php');
require($include.'sisdoc_email.php');
// To send HTML mail, the Content-type header must be set
$texto = 'Teste<BR><I>de e-mail</I>';
enviaremail('renefgj@gmail.com',$emailadmin,'AVALIAÇÃO - PIBIC PUCPR',($texto));
enviaremail('pibicpr@pucpr.br',$emailadmin,'AVALIAÇÃO - PIBIC PUCPR',($texto));


echo 'Enviado e-mail';
?>