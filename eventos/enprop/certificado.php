<?php
require("cab.php");
require($include.'sisdoc_email.php');
$cp = $evento->cp_email();
//$evento->structure();
//echo 'Criado';
/* Formulario de registro */

$email = $dd[2];

$tabela = '';
$tela = $form->editar($cp,$tabela);

if ($form->saved > 0)
	{
		$id =$evento->certificado_valida_email($email);
		$idp = $evento->line['id_ev'];
		switch ($id)
			{
			case 1:
				$link = '<A HREF="certificado_emissao.php?dd0='.$idp.'&dd1=T&dd90='.checkpost($idp).'" class="bottom_submit" target="new">';
				$link .= 'Imprimir Certificado';
				$link .= '</A>';

				$linkb = '<A HREF="certificado_emissao.php?dd0='.$idp.'&dd1=E&dd90='.checkpost($idp).'" class="bottom_submit">';
				$linkb .= 'Enviar por e-mail';
				$linkb .= '</A>';
				
				echo '<BR>';
				echo 'Escolha a opção do certificado:';
				echo '<BR><BR>';
				echo $link;
				echo '&nbsp';
				echo $linkb;

				break;
			case 2:
				echo '<font color="red">Não foi confirmado presença no evento deste e-mail</font>';
				echo '<BR><BR>';
				echo 'Verifique se e-mail informado foi o utilizado na inscrição, em caso de dúvida entre em contato com enprop2013@pucpr.br';
				echo '<BR>';
				echo $tela;
				break;
			default:
				echo 'e-mail não cadastrado no sistema.';
				echo $tela;
				
			}
	} else {
		echo $tela;
	}

?>
