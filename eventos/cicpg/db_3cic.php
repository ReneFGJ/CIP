<?
global $cnn;
		$base = "mysql";
		$base_user="root";
		$base_port = '5432';
		$base_host="localhost";
		$base_name="cryogene";
		$base_pass="448545ct";
		$ftp_img  = 'www.cryogene.inf.br/ic.php?dd99=upload&';
		$ftp_host = 'ftp.cryogene.org.br';
//		$ftp_user = 'cryogene';
//		$ftp_pass = 'qqp775';
		$ftp_user = 'root';
		$ftp_pass = '448545ct';
		$ftp_path = 'httpdocs/img/ic';

$base = "pgsql";
$base_user=$vars['base_user'];
$base_port = '8130';
$base_host="10.100.1.131";
$base_name="ojsbr";
if (strlen($base_user)==0) { $base_user="ojsbr"; }
$base_pass="ojsbr-2006";


$ok = db_connect();		

//$ok = db_connect();
?>
