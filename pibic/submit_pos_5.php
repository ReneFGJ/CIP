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
require("../_class/_class_pibic_submit_documento.php");
require($include.'sisdoc_email.php');
$pb = new projetos;

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
$sa .= $pb->mostra_projeto();
$sa .= '<BR><BR><HR><CENTER><h5>Planos de Alunos</h5><CENTER></HR>';
$sa .= $pb->mostra_plano();

echo $sa;
$ok = $dd[50];

if ($ok==1)
	{
		/* Alterar os Status */
		$sql = "update ".$pb->tabela." set pj_status = 'B' where pj_codigo = '$proto' ";
		$rlt = db_query($sql);
		
		$sql = "update pibic_submit_documento set doc_status = 'B' where doc_protocolo_mae = '$proto' and doc_status <> 'X' ";
		$rlt = db_query($sql);
		
		
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
			
		echo '<center>';
		echo '<font class="lt4">';
		echo '<font color="green">Projeto e Planos enviados com sucesso!';
		echo '</font>';
		echo '</font>';
		echo '<BR><BR>';
		echo 'Comprovante de submissão enviado pelo correio eletronico';
		echo '<BR><BR>';
		echo '<form action="submit_project.php"><input type="submit" value="voltar >>>"></form>';		
	} else {
		//$pb->valida_arquivo();
		
		
		
		$ok = 1;
		if ($pb->submit_projeto_valida($proto)==0) { $ok = 0; $err .= '<BR>'.msg('erro_pb_01').' no protocolo '.$proto; }
		if ($pb->valida_arquivo('PROJ',$proto)==0) { $ok = 0; $err .= '<BR>'.msg('erro_pb_04').' no protocolo '.$proto; }
		
		/* Planos */
		$sql = "select * from pibic_submit_documento
				left join pibic_aluno on pa_cracha = doc_aluno 
				where doc_protocolo_mae = '".$proto."' 
				and doc_status <> 'X' ";
		$xrlt = db_query($sql);
		
		while ($xline = db_read($xrlt))
			{
				$proto = $xline['doc_protocolo'];
				$tipo = trim($xline['doc_edital']);
				$codigo = trim($xline['doc_aluno']);
				
				if (($tipo == 'PIBIC') or ($tipo == 'PIBITI'))
					{
					if (strlen($codigo) < 8)
 						{ $ok = 0; $err .= '<BR>Código do aluno inválido no protocolo '.$proto; }					
					if ($pb->submit_plano_valida($proto)==0) { $ok = 0; $err .= '<BR>'.msg('erro_pb_03').' no protocolo '.$proto; }
					if ($pb->valida_arquivo_plano('PLANO',$proto)==0) { $ok = 0; $err .= '<BR>'.msg('erro_pb_02').' no protocolo '.$proto; }

					}
				if ($tipo == 'PIBICE')
					{					
					if ($pb->submit_plano_jr_valida($proto)==0) { $ok = 0; $err .= '<BR>'.msg('erro_pb_04').' no protocolo '.$proto; }
					if ($pb->valida_arquivo_plano('PLANO',$proto)==0) { $ok = 0; $err .= '<BR>'.msg('erro_pb_02').' no protocolo '.$proto; }
					}
			}		
		if (strlen($err) > 0)
			{
				echo '<table width="100%">';
				echo '<TR valign="top"><TD width="50">';
				echo '<img src="../img/icone_alert.jpg" width="50">';
				echo '<TD class="lt2"><font color="red">';
				echo $err;
				echo '</table>';
				
				echo '<BR><BR>';
				
				echo '<form action="submit_project.php">';
				echo '<input type="submit" value="Voltar >>" class="botao-confirmar">';
				echo '</form>';
			}
		if ($ok == 1)
		{	
			echo '<center>';
			echo '<font class="lt4">';
			echo '<font color="green">Confirmação do projeto e plano(s) de aluno(s)';
			echo '</font>';
			echo '</font>';
			echo '<BR><BR>';
			echo '<BR><BR>';
			echo '<form action="submit_pos_5.php">
					<input type="hidden" value="1" name="dd50">
					<input type="submit" value="Confirmar envio do projeto e do plano >>>" class="botao-confirmar">
					</form>';
		}			
	}
} else {	
}
echo '</fieldset>';
?>