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
require($include.'sisdoc_colunas.php');

require($include.'sisdoc_form2.php');
require($include.'cp2_gravar.php');

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

$cp = $bon->cp_frase();

echo '<table>';
editar();
echo '</table>';

if ($saved > 0)
	{
		$status = $dd[7];
		if ((strlen($status2) > 0) and ($status != $status2))
			{
				$protocolo = $bon->origem_protocolo;
				$ope = 'CRS';
				$historico = 'Alteração de CR ou Frase';
				$historico .= ' por '.$ss->user_login;
				//echo $protocolo.'-'.$ope.'-'.$historico;
				//exit;
				$bon->historico_inserir($protocolo,$ope,$historico);
			}
		require("../close.php");		
	}


?>
