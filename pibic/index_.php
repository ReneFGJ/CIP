<?
$debug = true;
ini_set('display_errors', 255);
ini_set('error_reporting', 7);

require("cab.php");
session_start();

$msg_erro = '&nbsp;';

if ((strlen($dd[1]) > 0) and (strlen($dd[2]) > 0) and (strlen($dd[3]) == 0))
	{
	$msg_erro = "necessário código do cracha";
	}

if ((strlen($dd[1]) > 0) and (strlen($dd[2]) > 0) and (strlen($dd[3]) > 0))
	{
	$msg_erro = '';
	$pcra = sonumero($dd[3]); // código do cracha somente em numeros
	if (strlen($pcra) == 12)
		{ $pcra = substr($pcra,3,8); }
	if (strlen($pcra) != 8)
		{ $msg_erro = 'código do crachá inválido, deve conter os 12 números'; }
		
	if (strlen($msg_erro) == 0) ///// pula se já conter erros
		{
		//////////////////// inicia validação
		$codigo = $dd[1];
		$senha  = $dd[2];
		$logon  = $dd[1];
		//////////////////// Autentica pela PUCPR
		require("pucpr_soap_autenticarUsuario.php");
		if ($result == 'Autenticado') { $autentica = 1; }
		if ($autentica != 1)
			{ $msg_erro = 'login ou senha está(ão) incorreto(s)'; }
		
			if (strlen($msg_erro) == 0) ///// pula se já conter erros
				{
				$sql= "select * from pibic_professor ";
				$sql .= " where pp_cracha = '".$pcra."' ";
				$sql .= " limit 1 ";
				$rlt = db_query($sql);
			
				if ($line = db_read($rlt))
				{
					print_r($line);
					$pcra = trim($line['pp_cracha']);
					$nome = trim($line['pp_nome']);
//					if ($pcra == '88958022') { $pcra = '70004381'; }
				}

			$_SESSION['nome'] = $nome;
			$_SESSION['codigo'] = $pcra;
			$_SESSION['id'] = $line['id_pp'];
			redirecina("main.php");
			}
		}
	}

?>
<TR valign="top"><TD bgcolor="#ffffff"><? require("ic.php"); ?></TD></TR>
<TR><TD bgcolor="#ffffff" height="4"><img src="img/bg_table.png" width="4" height="4" alt=""></TD></TR>
<BR><? require("foot.php");?>