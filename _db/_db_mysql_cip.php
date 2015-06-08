<?php
$base_user=$vars['base_user'];
$base_port = '8130';
$base_host="canopus.cwb.pucpr.br";
$base_host = '10.100.4.24';
$base_host = '10.96.155.106';
$base_name="cip";
$base_user="cip";
$base_pass="cipdes2015!";
$base = 'mysql';
$base_port = '3306';

echo 'Conectando...';
echo '<BR>';
echo '<BR>Host:'.$base_host;
echo '<BR>Name:'.$base_name;
echo '<BR>User:'.$base_user;
echo '<BR>Pass:'.$base_pass;
echo '<BR>Port:'.$base_port;

$link = mysql_connect($base_host.':'.$base_port, $base_user, $base_pass);
if (!$link) {
    die('<BR><BR>Não foi possível conectar: ' . mysql_error());
}
echo 'Conexão bem sucedida';
mysql_close($link);

//$ok = db_connect();
?>
<BR><BR>OK!

