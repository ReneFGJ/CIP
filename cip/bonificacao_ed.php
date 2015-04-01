<?
$include = '../';
require("../db.php");
require('../_class/_class_language.php');
$LANG = 'pt_BR';
$file = '../messages/msg_'.$LANG.'.php';
$jid = 0;
?><head>
	<title>::CIP::</title>
	<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
	<link rel="shortcut icon" type="image/x-icon" href="http://cip.pucpr.br/favicon.ico" />
	<link rel="STYLESHEET" type="text/css" href="../css/letras.css">
	<script  type="text/javascript" src="../js/jquery.js"></script>
	<script  type="text/javascript" src="../js/jquery.corner.js"></script>
	<script  type="text/javascript" src="../js/jquery.example.js"></script>
</head><?

require($include.'sisdoc_debug.php');
require($include.'sisdoc_data.php');

require($include.'_class_form.php');
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
