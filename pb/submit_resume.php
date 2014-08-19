<?
require_once($include.'sisdoc_windows.php');
require("_class/_class_submit.php");
$clx = new submit;

$clx->author_id(0);
if (strlen($clx->author_codigo) > 0)
	{ $login = 1; }

echo '<BR>';
echo '<font class="menu_title">'.msg('list_submissions').'</font>';
echo '<BR><font class="submit_text">'.msg('list_information').'</font>';
echo '<BR><BR>';
echo $clx->resume_list($dd[1]);
echo '<BR><BR><BR><BR>';
echo '<BR><BR><BR><BR>';
echo '<BR><BR><BR><BR>';
?>