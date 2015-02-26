<? ob_start(); ?>
<?
global $nocab;
require('db.php');
require($include.'sisdoc_cookie.php');
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_security_post.php');
require($include.'sisdoc_email.php');	
require($include.'sisdoc_data.php');	
require($include.'sisdoc_debug.php');

//$zsql = "update pibic_parecer set pp_protocolo_mae = 'XX00052', pp_protocolo  = 'XX00052', pp_avaliador = 'xx00211' where ";
//$zsql .= "pp_protocolo_mae = '0000117' and pp_avaliador = '0000137'";
//$zsql = "update pibic_parecer_enviado set pp_protocolo_mae = 'xxxxxxx', pp_protocolo  = 'xxxxxxx', pp_avaliador = 'xx00211' where ";
//$zsql .= "pp_protocolo = '0000052' and pp_avaliador = '0000211'";
//echo $zsql;
// $rlt = db_query($zsql);

$sql = '';
$bloqueado = false;
$parecer = true;
$acao = $vars['acao'];
$nr = 20;
$id = $dd[0];
if (strlen($dd[0]) == 0) { $id = 1042; }
$protocolo = strzero($id,7);
$secp = $dd[1];
$rela = $dd[2];
$seca = p($id.$rela);
$ok_parecer = true;
?>
<head>
<title>PUCPR - PIBIC/PIBITI <?=date("Y");?></title>
<link rel="STYLESHEET" type="text/css" href="letras.css">
</head>
<?
if ($secp != $seca)
	{
	echo '<CENTER><FONT CLASS="lt5">Tentativa de visualização de projeto não indicado</FONT>';
	echo '<BR><BR>';
	echo '<font class="lt1">Se estiver com problemas para acessar o projeto, encaminhe um e-mail para rene@sisdoc.com.br</font>';
	exit;
	}
if (strlen($acao) > 0)
	{ $acr = 'G'; } else
	{ $acr = "V"; }
	
$tabela = "pibic_submit_documento";
$sql = "select * from ".$tabela." where doc_protocolo = '".$protocolo."' ";
$rlt = db_query($sql);
$line = db_read($rlt);
$edital = lowercase(trim($line['doc_edital']));
$sql = '';

$sql .= "insert into pibic_log ";
$sql .= "(log_data,log_hora,log_pagina,";
$sql .= "log_origem,log_ip,log_dd1,";
$sql .= "log_dd2,log_user,log_acao,";
$sql .= "log_projeto,log_nucleo,journal_id) ";
$sql .= " values ";
$sql .= "('".date("Ymd")."','".date("H:i")."',9999,";
$sql .= "9999,'".$_SERVER['REMOTE_ADDR']."','".substr($dd[2],0,10)."',";
$sql .= "'".substr($dd[2],0,10)."','','".$acr."',";
$sql .= "'".substr($protocolo,0,10)."','PIBIC',22";
$sql .= ");";
$rlt = db_query($sql);

if (strlen($acao) == 0)
	{	
	$sql = "select * from ";
	$sql .= "pibic_parecer ";
	$sql .= " where pp_protocolo_mae = '".$protocolo."' ";	
	$sql .= " and pp_avaliador = '".$dd[2]."' ";
	$sql .= " order by pp_protocolo ";
	$rlt = db_query($sql);
	$rsp = array();
	while ($line = db_read($rlt))
		{
		if ((trim($line['pp_status']) == 'B') or (trim($line['pp_status']) == 'X')) { $parecer = false; $bloqueado = True; }
		array_push($rsp,array($line['pp_protocolo'],$line['pp_status'],$line['pp_p01'],$line['pp_p02'],$line['pp_p03'],$line['pp_p04'],$line['pp_p05'],$line['pp_abe_1']));
		}
	}
?>


<body bgcolor="#FFFFFF">
<TABLE width="<?=$tab_max;?>" align="center">
<TR>
<TD><A HREF="http://www.pucpr.br/"><img src="http://www2.pucpr.br/nep/img/logo_puc.jpg" border="0"></TD>
<TD><A HREF="http://www2.pucpr.br/reol/index.php/SEMIC18"><img src="http://www2.pucpr.br/reol/<?=$edital;?>/img/homeHeaderLogoImage.jpg" border=0></A></TD>
</TR>
</TABLE>

<TABLE width="<?=$tab_max;?>" align="center" border=0>
<TR>
<TD>

<?
//////////////// Busca mensagem de entrada
$sql = "select * from ic_noticia where nw_ref = 'PAR_INDEX' and nw_idioma = 'pt_BR' ";
$sql .= " and (nw_journal = 20)";

$rrr = db_query($sql);
$texto = 'PAR_INDEX';
while ($eline = db_read($rrr))
	{
	$sC = $eline['nw_titulo'];
	$texto = $eline['nw_descricao'];
	}
$sd = '<font class="lt2">';
$sd .= ($texto);
echo $sd;

/////////////////////////////////////// Pareceres Gravados
echo '<TR><TD>';
//require("pibic_parecer_gravado.php");
//echo $sq;

require("pibic_projeto_resumo.php");
echo $sr;
?>