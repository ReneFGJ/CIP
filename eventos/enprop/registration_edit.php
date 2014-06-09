<?php
require("cab.php");
require($include.'sisdoc_email.php');

if (strlen($dd[90]) >0)
	{ $_SESSION['check'] = $dd[90]; } 
else 
	{ $dd[90] = $_SESSION['check']; }

$id = $dd[0];
$chk = $dd[90];
if ($chk != checkpost($id))
	{
		echo 'ERRO NO LINK DE ACESSO';
		echo '<BR>';
		echo 'Comunicando adminstrador';
		$txt .= '<HR>';
		$txt .= '<BR>dd0='.$dd[0];
		$txt .= '<BR>dd90='.$dd[90];
		enviaremail('renefgj@gmail.com','','Enprop - erro de acesso',$txt);
		exit;
	}
$cp = $evento->cp_dados();
$evento->le($dd[0]);
$nome = $evento->line['ev_nome'];

/* Formulario de registro */
echo '<BR>';
$tela = $form->editar($cp,$evento->tabela);
if ($form->saved > 0)
	{
		echo '<br><p>Sua inscrição foi realizada com sucesso!<p>
		<BR>
		<p>Foram enviados para seu e-mail a confirmação e instruções sobre o evento.</p>
		<BR>
		<p>Agradecemos sua inscrição</p>
		<p>Comissão organizadora</p>';
		exit;
	} else {
		echo '<P>';
		echo 'Bem vindo, <B>'.$nome.'</B>';
		echo '</P>';
		echo $tela;
	}

?>
