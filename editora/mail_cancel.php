<?
require("cab.php");
require("_class/_class_journal.php");

	$sql = "update mail set ";
	$sql .= "mail_rp_data = ".date("Ymd");
	$sql .= ", mail_rp_hora = '".date("H:i")."'";
	$sql .= ", mail_assunto = 'RE: ' || trim(mail_assunto)";
	$sql .= ", mail_rp_user = ".$user_id;
	$sql .= ", mail_rp_content = '**CANCELADO**' ";
	$sql .= ', mail_out_del = 1 ';
	$sql .= " where id_mail = ".$dd[0];
	$rrr = db_query($sql);
	redirecina("mail.php");
	
require("foot.php");
?>
