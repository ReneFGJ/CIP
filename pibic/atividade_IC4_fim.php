<?
require("cab_pibic.php");
require($include.'sisdoc_email.php');

require('../_class/_class_atividades.php');
$ati = new atividades;

require('../_class/_class_docentes.php');
$doc = new docentes;

require('../_class/_class_pibic_bolsa_contempladas.php');
$pb = new pibic_bolsa_contempladas;

require('../_class/_class_ic_relatorio_parcial.php');
$rp = new ic_relatorio_parcial;

require('_ged_config.php');


$pb->postar_resumo($dd[0]);
$jid = '';

$ati->remover_artividade($dd[0],'IC4');

require('../_class/_class_ic.php');
$icm = new ic;
$ms = $icm->ic('IC_RESUMO_POSTED');
$titulo = '[IC] '.$dd[0].' '.$ms['nw_titulo'];	
$ged->protocol = $dd[0];
$pb->le('',$dd[0]);

$professor = $pb->pb_professor;
$doc->le($professor);

$email1 = $doc->pp_email;
$email2 = $doc->pp_email_1;
$nome = $doc->pp_nome;
$titulo .= ' '.$nome;

$txt = $ms['nw_descricao'];
$txt .= 'postado em '.date("d/m/Y H:m:s").'<BR>';
$txt .= $pb->mostar_dados();
$txt .= $ged->filelist();

//$email = 'renefgj@gmail.com';
//enviaremail($email,'',$titulo.' (copia)',$txt);
$email = 'pibicpr@pucpr.br';
enviaremail($email,'',$titulo.' (copia)',$txt);

if (strlen($email1) > 0) { enviaremail($email1,'',$titulo,$txt); }
if (strlen($email2) > 0) { enviaremail($email2,'',$titulo,$txt); }

echo '<center>';
echo '<H1>Entrega realizada com sucesso!</H1>';
echo 'email enviado';
require("../foot.php");
?>