<?php
/* Chama cabecalho institucional no topo da p�gina */
//require($include.'sisdoc_security_pucpr.php');
//$file = $include.'js/jquery.js';
//if (!(file_exists($file))) { echo 'nao localizado jquery.js na pasta do Include'; exit; }

/* Mensagens do sistema */
$msg = array(	'login_cab' => 'login de acesso ao sistema',
				'login' => 'login',
				'password' => 'senha',
				'submit' => 'acessar',
				'erro1' => 'login nao localizado',
				'erro2' => 'senha invalida',
				'erro3' => 'login ou senha em branco'
								
);

/* Valida login */
$nw = new usuario;
if (strlen($acao) > 0)
	{
	$rst = $nw->login($dd[1],$dd[2]);
	$rst = $nw->user_erro;
	$msg_erro = 'Erro:'.abs($rst);
	/* recupera mensagem */	
	if ($rst < 0)
		{
			$rst = abs($rst);
			$msg_erro = $msg['erro'.$rst]; 
		} else {
			if ($rst == 1)
				{
					require('_class/_class_docentes.php');
					$doc = new docentes;
					$doc->le($nw->user_cracha);
					$nw->user_ss = $doc->line['pp_ss'];
					$nw->LiberarUsuario();
					redirecina('main.php'); 
				}
		}
			
	}
?>