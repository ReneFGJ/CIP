<?
if (strlen($tplogin) == 0) {
$sql = "select count(*) as total, mail_read, 'B' as tipo ";
$sql .= " from mail where mail_from = '".strzero($id_pesq,7)."'";
$sql .= " group by mail_read ";
$sql .= " union ";
$sql .= "select count(*) as total, mail_read, 'A' as tipo ";
$sql .= " from mail where mail_reply = '".strzero($id_pesq,7)."' and mail_out_del = '1'";
$sql .= " group by mail_read ";

$rlt = db_query($sql);
$in = 0;
$in_r = 0;
$out = 0;
$out_r = 0;
while ($line = db_read($rlt))
	{
	if (($line['tipo'] == 'A') and ($line['mail_read'] == '0')) { $in_r = $in_r + $line['total']; }
	if (($line['tipo'] == 'A') and ($line['mail_read'] == '1')) { $in = $in + $line['total']; }
	if (($line['tipo'] == 'B') and ($line['mail_read'] == '0')) { $out_r = $out_r + $line['total']; }
	if (($line['tipo'] == 'B') and ($line['mail_read'] == '1')) { $out = $out + $line['total']; }
	}	
$msg_in = '('.($in+$in_r).'/'.$in_r.')';
$msg_out = '('.($out+$out_r).'/'.$out_r.')';
$bmenu = array();
array_push($bmenu,array('Enviar uma mensagem ','mail_send.php','Enviar uma mensagens'));
array_push($bmenu,array('Caixa de entrada '.$msg_in,'mail.php?dd1=IN','Mensagens recebidas'));
array_push($bmenu,array('Caixa de saída '.$msg_out,'mail.php?dd1=OUT','Mensagens enviadas'));
$tab_titulo = "Mensagens";

if ($idioma == 2)
	{
	$bmenu = array();
	array_push($bmenu,array('Send new mail ','mail_send.php','Send a new mensage'));
	array_push($bmenu,array('In box '.$msg_in,'mail.php?dd1=IN','In box mail'));
	array_push($bmenu,array('Out box '.$msg_out,'mail.php?dd1=OUT','Out box mail'));
	$tab_titulo = "Messages";

	}
?>
<table width="210" cellpadding="0" cellspacing="0" bgcolor="#EFEFEF">
<TR align="center"><TD colspan="3" height="24" background="img/menu_top.jpg"><font class="lt2"><font color="white"><B><?=$tab_titulo;?></TD></TR>
<TR><TD width="5">
	<TD width="200">
	<table width="200" cellpadding="2" cellspacing="0">
	<?
	for ($kq=0; $kq < count($bmenu); $kq++)
		{ ?>
		<TR><TD valign="middle"><A class="lt1" HREF="<?=$bmenu[$kq][1];?>" title="<?=$bmenu[$kq][2];?>" ><?=$bmenu[$kq][0];?></A>
		<? } ?>
	</table>
	</TD>
</TABLE>
<? } ?>
