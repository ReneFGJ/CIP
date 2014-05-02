<?
$debug = true;
ini_set('display_errors', 255);
ini_set('error_reporting', 7);

session_start();
require("cab.php");

	/* Mensagens */
	$tabela = 'submissao';
	$link_msg = '../messages/msg_'.$tabela.'.php';
	if (file_exists($link_msg)) { require($link_msg); }

if (strlen($acao) > 0)
	{
		$rst = $user->login($dd[3],$dd[1],$dd[2]);
		$msg_erro = msg($user->erro);
	}
//echo '<center><H5><font color="red"><font style="font-size:20px;">Abertura para entrega do relatório parcial: 08/fev./2012.</font></h5>';

if (strlen($user->cracha) > 0)
	{ redirecina('main.php'); }


 require("index_login.php");
 
 $ms = trim(msg('cadastro_doutorando'));
 
 if (strlen($ms) > 20)
 	{
 		echo '
 		<center>
 		<style>
 			#doutorando
 				{
				width: 540px;
				border: 2px solid #E0A030;
				background-color: #E8F0E9;
				color: #000000;
				text-align: center;
				}
 		</style>
 		';
 		echo '<div id="doutorando">';
		echo '<h2>Cadastro de Doutorando</h2>';
 		echo '<font class="lt1">';
		echo $ms;
		echo '<BR><BR>';
		$link = '<A href="doutorando.php">';
		echo $link.'cadastre-se aqui';
		echo '</A>';
		echo '<BR>&nbsp;';
		echo '</div>';
 	}
 
 ?>