<?
require("cab.php");
require($include.'sisdoc_debug.php');

if (strlen($user->cracha)==0)
	{ redirecina('index.php'); }

/*
 * Submissão aberta
 */
$submit_open = 1;

require("../_class/_class_pibic_projetos.php");
require("../_class/_class_pibic_submit_documento.php");
require($include.'sisdoc_email.php');
$pb = new projetos;

//main_submit.php?dd1=1000021&dd90=f3b90cd488//

$chk1 = $dd[90];
$chk2 = checkpost($dd[1]);
if ($chk1 != $chk2)
	{
		echo '<center>erro de envio de dados';
		exit;
	}
echo '<center>';
echo '<font class="lt4">';
echo '<font color="green">Projeto e Planos enviados com sucesso!';
echo '</font>';
echo '</font>';
echo '<BR><BR>';
echo 'Comprovante de submissão enviado pelo correio eletronico';
echo '<BR><BR>';
echo '<form action="main.php"><input type="submit" value="voltar >>>"></form>';
$proto = $dd[1];

$sql = "update ".$pb->tabela." set pj_status = 'B' where pj_codigo = '$proto' ";
$rlt = db_query($sql);

$sql = "update pibic_submit_documento set doc_status = 'B' where doc_protocolo_mae = '$proto' ";
$rlt = db_query($sql);

$pb->protocolo = $dd[1];
$sa .= $pb->mostra_projeto();
$sa .= $pb->mostra_plano();
enviaremail('monitoramento@sisdoc.com.br','','Comprovante de submissão - '.$dd[1],$sa);

?>