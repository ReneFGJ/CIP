<?
$include = '../';
require("../db.php");
require('../_class/_class_language.php');
$LANG = 'pt_BR';
$file = '../messages/msg_'.$LANG.'.php';
$jid = 0;
?><head>
<META HTTP-EQUIV=Refresh CONTENT="3600; URL=http://www2.pucpr.br/reol/logout.php">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /><meta name="description" content="">
<link rel="shortcut icon" type="image/x-icon" href="http://www2.pucpr.br/reol/favicon.ico" />
<link rel="stylesheet" href="http://www2.pucpr.br/reol/css/style_cabecalho.css">
<link rel="stylesheet" href="http://www2.pucpr.br/reol/css/style_midias.css">
<link rel="stylesheet" href="http://www2.pucpr.br/reol/css/style_body.css">
<link rel="stylesheet" href="http://www2.pucpr.br/reol/css/style_fonts.css">
<link rel="stylesheet" href="http://www2.pucpr.br/reol/css/style_botao.css">
<link rel="stylesheet" href="http://www2.pucpr.br/reol/css/style_table.css">
<link rel="stylesheet" href="http://www2.pucpr.br/reol/css/style_font_roboto.css">
<link rel="stylesheet" href="http://www2.pucpr.br/reol/css/style_font-awesome.css">
<link rel="stylesheet" href="http://www2.pucpr.br/reol/css/style_form.css">
<script language="JavaScript" type="text/javascript" src="http://www2.pucpr.br/reol/js/jquery-1.7.1.js"></script>
<script language="JavaScript" type="text/javascript" src="http://www2.pucpr.br/reol/js/jquery.corner.js"></script>
<script language="JavaScript" type="text/javascript" src="http://www2.pucpr.br/reol/js/jquery-ui.js"></script>
<title>CIP | Centro Integrado de Pesquisa | PUCPR</title>
</head>
<?

require($include.'sisdoc_debug.php');
require($include.'sisdoc_data.php');

require('../_include/_class_form.php');
$form = new form;

/* Segurança */
require('../security.php');
$user = new usuario;
$tela = $user->Security();
$ss = $user;

require("../_class/_class_user_perfil.php");
$perfil = new user_perfil; 

if (!($perfil->valid('#SCR#ADM')))
	{
		echo 'Não autorizado!';
		exit;
	}

require("../_class/_class_bonificacao.php");
$bon = new bonificacao;
$tabela = $bon->tabela;

if (strlen($dd[0])>0)
	{
	$bon->le($dd[0]);
	$status2 = $bon->status;
	}

$cp = $bon->cp_editar();

$tela = $form->editar($cp,$tabela);

if ($form->saved > 0)
	{
		$status = trim($dd[4]);
		$sta = $bon->status_isencao();
		$status_nome = $sta[$status];

		if ((strlen($status2) > 0) and ($status != $status2))
			{
				$protocolo = $bon->origem_protocolo;
				$ope = 'BO'.$status;
				$historico = 'Alteração de Status para <B>'.$status_nome.'</B>';
				if ($status=='X') { $historico = 'Cancelamento de indicação '; }
				$historico .= ' por '.$ss->user_login;
				//echo $protocolo.'-'.$ope.'-'.$historico;
				//exit;
				$bon->historico_inserir($protocolo,$ope,$historico);
			}
		require("../close.php");		
	} else {
		echo $tela;
	}
?>
