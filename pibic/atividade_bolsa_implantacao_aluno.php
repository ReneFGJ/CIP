<?
$lk = http.'pibic/ativacao_bolsa_aluno.php?dd0='.$proto.'&dd90='.checkpost($proto);
$link = '<A HREF="'.$lk.'">';

require_once('../_class/_class_discentes.php');
$disc = new discentes;
$disc->le('',$aluno_codigo);

$email_1 = trim($disc->line['pa_email']);
$email_2 = trim($disc->line['pa_email_1']);

echo '-->'.$email_1;
echo '-->'.$email_2;

$texto2 = 
'Prezado aluno,
<BR>
<BR>Você foi indicado como aluno de iniciação científica da PUCPR.
<BR>
<BR>Para validar esta ação é necessário que acesse o link abaixo e informe seu login de rede.
<BR>
<BR>'.$link.$lk.'</A>
<BR>
<BR>Atenciosamente,
<BR>
<BR>Coordenação IC
<BR><BR>Protocolo: '.$proto.'';

$e3 = '[IC] - Link de ativação';

	if (strlen($email_1) > 0) 	
		{
			enviaremail($email_1,'',$e3, $texto2); echo '<BR>enviado para o aluno - '.$email_1;
		}
		
	if (strlen($email_2) > 0) 	
		{
			enviaremail($email_2,'',$e3, $texto2); echo '<BR>enviado para o aluno - '.$email_2;
		}



?>