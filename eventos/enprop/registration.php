<?php
require("cab.php");
require($include.'sisdoc_email.php');
$cp = $evento->cp();
//$evento->structure();
//echo 'Criado';
/* Formulario de registro */

$email = $dd[10];
if (strlen($email) > 0)
	{
		$ok = $evento->recupera_email($email);
		if ($ok > 1)
			{
				$img = '<IMG src="http://www2.pucpr.br/reol//img/icone_alert.png" height="20">';
				$cp[11][2] = $img.' e-mail já cadastrado';
				$cp[11][3] = true;	
			}
	}
$tabela = $evento->tabela;
$tela = $form->editar($cp,$tabela);
if ($form->saved > 0)
	{
		$id = $evento->recupera_email($dd[10]);
		$evento->le($id);
		$email = trim($evento->line['ev_email']);
		$_SESSION['id'] = $id;
		$link = "http://www2.pucpr.br/reol/eventos/enprop/registration_edit.php?dd0=".$id.'&dd90='.checkpost($id);
		$linka = '<A HREF="'.$link.'">';
		$txt = '<IMG SRC="http://www2.pucpr.br/reol/eventos/enprop/img/logo_enprop.png"><BR>';
		$txt .= 'Prezado(a) '.trim($evento->line['ev_nome']).',';
		$txt .= '<BR><br><p>Sua inscrição foi realizada com sucesso!<p>
		<BR>
		<p>Para realizar alterações em seus dados de hospedagem ou transfer, acesso o link abaixo:</p>
		<BR>
		'.$linka.$link.'</A>
		<p>Agradecemos sua inscrição</p>
		<p>Comissão organizadora</p>
		<BR><BR>'.date("d/m/Y H:i:s").' '.$_SERVER['REMOTE_ADDRESS'];
		
		/* Enviar e-mail */
		enviaremail($email,'','ENPROP 2013 - Confirmação de Inscrição',$txt);
		enviaremail('enprop2013@pucpr.br','','ENPROP 2013 - Confirmação de Inscrição',$txt);
		enviaremail('renefgj@gmail.com','','ENPROP 2013 - Confirmação de Inscrição',$txt);
		/* */
		redirecina($link);
	} else {
		echo $tela;
	}

?>
