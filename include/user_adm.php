<?
require("include/sisdoc_cookie.php");

$id_user = $user_id = read_cookie($secu."_user_adm");
$id_user_2 = read_cookie($secu."_userid_adm");
$id_ok = read_cookie($secu."_jid".$jid);

echo $id_user;
echo '==';
echo $id_user_2;
echo '==';
echo $id_ok;
echo '==';

$ok = 0;
if ($dd[98] == 'docs')
	{$ok = 1; require("useradmin/useradm_artigos.php"); }
if ($dd[98] == 'articleedit')
	{$ok = 1; require("useradmin/useradm_artigos_edit.php"); }
if ($dd[98] == 'articledelete')
	{$ok = 1; require("useradmin/useradm_artigos_del.php"); }
if ($dd[98] == 'articlefile')
	{$ok = 1; require("useradmin/useradm_artigos_file.php"); }	
if ($ok == 0)
	{ require("user_menu.php"); }
?>						