<?
require_once($include.'sisdoc_windows.php');
require("../_class/_class_submit.php");
$clx = new submit;

$clx->author_id(0);
if (strlen($clx->author_codigo) > 0)
	{ $login = 1; }

if ($login==0)
	{
		$page = http.'pb/index.php/'.$path.'?dd99=submit';
		echo '11';
		echo $clx->autor_login_form($page);
		echo '<img src="'.http.'/img/logo_reol_20_pt_BR.png">';
		echo 'xxxxxx';
	} else {
		echo '<h2>'.msg('submission').'</h2>';
		echo $clx->resume();
		
		$link = http.'pb/index.php/'.$path.'';
		echo $link;
		echo '<BR><BR>';
		echo '<center>';
		echo '<form method="get" action="'.$link.'">';
		echo '<input type="hidden" name="dd99" value="submit2">';
		echo '<input type="submit" value="'.msg('subm_new_project').'" style="width: 500px; height: 50px;">';
		echo '</form>';			
	}
?>