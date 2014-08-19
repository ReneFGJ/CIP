<?
require("cab.php");
require("_class/_class_journal.php");
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_data.php');
require($include.'sisdoc_email.php');
$jl = new journal;

echo $hd->menu();
echo '<div id="conteudo">';
echo $hd->main_content('Mensages');

global $email_adm, $admin_nome;

$cap[6] = 'Sua mensagem foi enviada';
$cap[7] = 'Clique aqui para voltar';
$cap[8] = 'Click aqui para responder esta mensagem';

if ($idioma == "2") 
	{ 
	$cap[6] = 'Your mensage was send';
	$cap[7] = 'Click here to return';
	}

if (strlen($dd[3]) > 0)
	{
	$sql = "select * from mail ";
	$sql .= " left join submit_autor on mail_from = sa_codigo ";
	$sql .= " left join journals on mail_journal_id = journals.journal_id ";
	$sql .= " where ";
	$sql .= " id_mail = ".$dd[0];
	$rlt = db_query($sql);
	$email = array();
	if ($line = db_read($rlt))
		{
		$rp = $line['mail_out_del'];
		$jid = $line['mail_journal_id'];
		if (strlen($line['sa_email']) > 0) { array_push($email,trim($line['sa_email'])); }
		if (strlen($line['sa_email_alt']) > 0) { array_push($email,trim($line['sa_email_alt'])); }
		if (strlen($line['jn_email']) > 0) { array_push($email,trim($line['jn_email'])); }

		$ass = $line['mail_assunto'];
		$admin_nome  = trim($line['title']);
		$email_adm  = trim($line['jn_email']);
		}

	$sql = "update mail set ";
	$sql .= "mail_rp_data = ".date("Ymd");
	$sql .= ", mail_rp_hora = '".date("H:i")."'";
	$sql .= ", mail_assunto = 'RE: ' || trim(mail_assunto)";
	$sql .= ", mail_rp_user = ".$user_id;
	$sql .= ", mail_rp_content = '".$dd[3]."' ";
	$sql .= ', mail_out_del = 1 ';
	$sql .= ", mail_reply=mail_from ";
	$sql .= " where id_mail = ".$dd[0];
	$rrr = db_query($sql);
	
	///////////////////////////////////////////////////////////////////////////////
	$texto = 'SUB_REPLMAIL';
	$sql = "select * from ic_noticia where nw_ref = 'SUB_REPLMAIL' ";
	$sql .= "and nw_idioma = 'pt_BR' ";
	$sql .= "and nw_journal = ".$jid;
	$rrr = db_query($sql);
	if ($eline = db_read($rrr))
	{ $texto = $eline['nw_descricao']; }
	///////////////////////////////////////////////////////////////////////////////
//	echo '<BR>>>'.$email;
//	echo '<BR>>>>'.$email_alt;
//	echo '<BR>>>>'.$email_rpl;	
	$headers .= "From: ".$admin_nome." <" .$email_adm. "> \n";
		
	for ($r=0;$r < count($email);$r++)
		{
			echo '<BR>Enviando para '.$email[$r];
			enviaremail($email[$r],'','Resposta',$texto. '<BR><BR>'.$dd[3]);		
		}
	
	
	echo '<CENTER><BR><BR><BR><font class="lt4">'.$cap[6].'</font></CENTER>';
	echo '<center><BR><BR>';
	echo '<form action="mail.php"><input type="submit" name="acao" value=" voltar a caixa de entrada "></form>';
	exit;
	}
?>
<font class="lt5">Mail - responder (reply)</font>
<?
$sql = "select * from mail ";
$sql .= " left join submit_autor on mail_from = sa_codigo ";
$sql .= " left join journals on mail_journal_id = journals.journal_id ";
//$sql .= " left join issue on doc_issue = id_issue ";
$sql .= " where ";
$sql .= " id_mail = ".$dd[0];
$rlt = db_query($sql);
$rev = "X";

$s = '<TR>';
$st = 'X';
echo '<BR><BR>';
while ($line = db_read($rlt))
	{
	$pesq_nome = trim($line['sa_nome']);
	$pesq_email = trim($line['sa_email']);
			
	$hora = substr(trim($line['mail_hora']),0,5);
	$joun = trim($line['journal_id']);
	$capa_img = '';
	$prazo = $line['ess_prazo'];
	$ncor = '';
	$setor = stodbr($line['mail_data']);
	//////////////////////// Titulo do manuscrito
	$link = '<A Href="producao_manuscrito.php?dd0='.$line['id_doc'].'&journal_id='.$line['journal_id'].'&dd1='.trim($line['title']).'">';

	$s .= '<TR '.$ncor.' valign="top">';
	$s .= '<TD rowspan="3">'.$hora;
	$s .= '<BR>';
	$chk = md5($line['id_mail'].$user_id);
	$slink .= '<A HREF="mail.php?dd0='.$line['id_mail'].'&dd50=replay&dd2='.$chk.'" title="Responder">';
//	$s .= $slink;
//	$s .= '<img src="img/mail_reply.png" width="16" height="16" alt="Responder" border="0"></A>';
	$s .= '<A HREF="mail.php?dd0='.$line['id_mail'].'&dd50=del&dd2='.$chk.'"  title="Excluir mensagem">';
	$s .= '<img src="img/mail_cut.png" width="16" height="16"  alt="Excluir" border="0"></A>';
	$s .= '</TD>';
	$s .= '<TD>';
	$s .= $slink;
	$s .= $pesq_nome;
	$s .= '</A>&nbsp;';
	$s .= '(<I>'.$line['title'].'</I>)';
	//////////////////////// Prazo
	$s .= '<TD class="lt5" rowspan="3" align="center">';
	$s .= '<font class="lt0">'.substr(stodbr($line['mail_data']),0,5).'</font><BR>';
	$dif = DateDif($line['mail_data'],date("Ymd"),'d');
	if ($dif <= ($prazo)) { $sc = '<font color="#ff8040">'; }
	if ($dif < ($prazo-3)) { $sc = '<font color="blue">'; }
	if ($dif > ($prazo)) { $sc = '<font color="#ff0000">'; }
	$s .= $sc . $dif;
	$s .= '</TD>';

	//// Linha 2
	$s .= '<TR><TD '.$ncor.' valign="top">';
	$s .= 'Assunto:&nbsp;<B>'.$line['mail_assunto'].'</B>';

	//// Linha 3
	$s .= '<TR><TD '.$ncor.' valign="top">';
	$s .= '<fieldset><legend><I><font class="lt0">mensagem postada em '.stodbr($line['mail_data']).' as '.$line['mail_hora'].'</font></I></legend>';
	$s .= mst($line['mail_content']).'.';
	$s .= '</fieldset>';
	//////////////////////// Título da revista
	$s .= '<TR><TD height="6"></TD></TR>';
	}

echo '<TABLE width="'.$tab_max.'" align="center" class="lt1" border="0" cellpadding="3" cellspacing="0">';
echo $s;
?>
<TR><TD colspan="3"><form method="post"></TD></TR>
<TR><TD colspan="3"><I>Resposta</I></TD></TR>
<TR><TD colspan="3">
<input type="hidden" name="dd0" value="<?=$dd[0];?>">
<input type="hidden" name="dd2" value="<?=$dd[2];?>">
<textarea cols="60" rows="8" name="dd3" style="width: <?=$tab_max;?>"><?=$dd[3];?></textarea>
</TD></TR>
<TR><TD colspan="3" align="right"><input type="submit" name="dd50" value="enviar >>"></TD></TR>
<TR><TD></form></TD></TR>
<?
echo '</TABLE>';

echo '<a href="mail_cancel.php?dd0='.$dd[0].'">Cancelar/Excluir Mensagem</A>';
require("foot.php");
?>
