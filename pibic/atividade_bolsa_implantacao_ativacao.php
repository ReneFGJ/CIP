<?
require("cab_pibic.php");
require($include."sisdoc_debug.php");
require($include."sisdoc_windows.php");
require($include."sisdoc_data.php");
require($include."sisdoc_email.php");
require($include."sisdoc_debug.php");
//$sql = "update pibic_bolsa set pb_ativacao = 19000101 where pb_protocolo = '0001383';";
//$sql = "CREATE TABLE pibic_motivos ( id_mt serial NOT NULL,mt_codigo char(3), mt_descricao char(90), mt_ativo int ); ALTER TABLE pibic_motivos ADD CONSTRAINT pibic_motivos_id_mt PRIMARY KEY(id_mt);";
//$rrr = db_query($sql);
//echo $sql;

//$sql = "delete from  pibic_motivos where id_mt > 9;";
//$rrr = db_query($sql);

?>
<TABLE align="center" width="<?=$tab_max;?>" border=0 >
<TR valign="top" width="<?=$tab_max;?>" align="center">
<TD align="left" class="lt2">
Bem vindo prof.(a) <B><?=$nw->user_nome;?></B>.<BR>Cod. funcional: <B><?=$nw->user_login;?></B><BR>
<BR>
<?
$digi = md5($dd[0].$secu);
//echo '<BR>dd0='.$dd[0];
//echo '<BR>dd1='.$dd[1];
//echo '<BR>dd2='.$dd[2];
//echo '<BR>dd3='.$dd[3];
//echo '<BR>chl='.$digi;
//echo '<BR>';
$erro = 0;
if ($dd[2] != $digi)
	{
	$erro = 1;
	$msg = 'Chave de segurança não confere para essa bolsa';
	}
	
if ($erro == 0)
	{
	$sql = "select * from pibic_bolsa ";
	$sql .= " inner join pibic_aluno on pa_cracha = pb_aluno ";
	$sql .= " inner join pibic_professor on pp_cracha = pb_professor ";
	$sql .= " inner join pibic_submit_documento on doc_protocolo = pb_protocolo ";
	$sql .= " where id_pb = ".$dd[0];
	$rlt = db_query($sql);

	while ($line = db_read($rlt))
		{
//		print_r($line);
		$aluno = $line['pb_aluno'];
		$aluno_nome = $line['pa_nome'];
		$profe = $line['pb_professor'];
		$profe_nome = $line['pp_nome'];
		$proto = $line['pb_protocolo'];
		$ativa = $line['pb_ativacao'];
		$tit_plano = $line['doc_1_titulo'];
		}
	if ($ativa > 20100101)
		{
		$erro = 2;
		$msg .= '<BR>Bolsa já ativada';
		}
	//////////////////////////////////////////////////////////////////////////////////////
	if ($erro == 0)
		{
		if (strlen($dd[5]) == 0)
			{ 
			require("atividade_bolsa_implantacao_ativacao_1.php"); 
			}
		/////////// phase I
		if ($dd[5] == '2')
			{ require("atividade_bolsa_implantacao_ativacao_2.php"); }
		if ($dd[5] == '3')
			{ require("atividade_bolsa_implantacao_ativacao_3.php"); }
		if ($dd[5] == '4')
			{ require("atividade_bolsa_implantacao_ativacao_4.php"); }
		if ($dd[5] == '5')
			{ require("atividade_bolsa_implantacao_ativacao_5.php"); }
		/////////// phase II
		/////////// pahse III
		}
	}


?>
<TD width="210">
<? 
/*require("resume_menu_left_projetos.php");
//require("resume_menu_left.php");
//require("resume_menu_left_3.php");
//require("resume_menu_left_2.php");
//require("resume_menu_left_mail.php");
 */
?>

</table>
<?
require("foot_body.php");
require("foot.php");
?>xx