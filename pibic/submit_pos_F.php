<?
require("cab_pibic.php");
require("../_class/_class_position.php");
$pos = new posicao;
echo $pos->show(5,5,array());

echo '<fieldset>';
if (strlen($ss->user_cracha)==0)
	{ redirecina('index.php'); }
	
if (strlen($dd[89]) > 0)
	{
		$proto = $dd[89];
		$_SESSION['protocolo'] = $proto;
	} else {
		$proto = $_SESSION['protocolo'];
	}	

/*
 * Submissão aberta
 */
$submit_open = 1;

require("../_class/_class_ged.php");
$ged = new ged;

require($include."sisdoc_colunas.php");
require($include."sisdoc_windows.php");

require("../_class/_class_pibic_projetos.php");
$pb = new pibic_projetos;
require("../_class/_class_pibic_submit_documento.php");
require($include.'sisdoc_email.php');


//main_submit.php?dd1=1000021&dd90=f3b90cd488//
$proto = $_SESSION['protocolo'];
$pb->protocolo = $proto;

if (strlen($proto) == 0)
	{ redirecina('main.php'); }
	
$sql = "select * from ".$pb->tabela." where pj_codigo = '".$proto."' ";
$rlt = db_query($sql);

if ($line = db_read($rlt))
	{
		$status = $line['pj_status'];
	} else {
		echo 'Protocolo não localizado!';
		exit;
	}
	
if (($status == 'A') or ($status == '@') or ($status == '!')) 
{
echo '<center>';
echo '<font class="lt4">';
echo '<font color="green">Projeto e Planos enviados com sucesso!';
echo '</font>';
echo '</font>';
echo '<BR><BR>';
echo 'Comprovante de submissão enviado pelo correio eletronico';
echo '<BR><BR>';
echo '<form action="main.php"><input type="submit" value="voltar >>>"></form>';

$sql = "update ".$pb->tabela." set pj_status = 'B' where pj_codigo = '$proto' ";
$rlt = db_query($sql);

$sql = "update pibic_submit_documento set doc_status = 'B' where doc_protocolo_mae = '$proto' ";
$rlt = db_query($sql);

$sa .= $pb->mostra_projeto();
$sa .= '<BR><BR><HR><CENTER>Planos de Alunos<CENTER></HR>';
$sa .= $pb->mostra_plano();
enviaremail('renefgj@gmail.com','','Comprovante de submissão - '.$dd[1],$sa);

$sql = "select * from ".$pb->tabela." where pj_codigo = '$proto' ";
$rlt = db_query($sql);
$line = db_read($rlt);
$pj_professor = $line['pj_professor'];

$sql = "select * from pibic_professor where pp_cracha = '".$pj_professor."' ";
$rlt = db_query($sql);
$line = db_read($rlt);

$email = trim($line['pp_email']);
if (strlen($email) > 0)
	{ enviaremail($email,'','Comprovante de submissão - '.$proto. ' - ',$sa); }

$email = trim($line['pp_email_1']);
if (strlen($email) > 0)
	{ enviaremail($email,'','Comprovante de submissão - '.$proto,$sa); }

$email = "pibicpr@pucpr.br";
if (strlen($email) > 0)
	{ enviaremail($email,'','Comprovante de submissão - '.$proto,$sa); }
} else {

	
}
echo '</fieldset>';
?>