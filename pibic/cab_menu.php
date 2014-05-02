<?
$menu = array();
array_push($menu,array('inicial','main.php'));
//array_push($menu,array('bolsas','bolsas.php'));
//array_push($menu,array('notícias','news.php'));


?>
<table width="100%" cellpadding="0" cellspacing="0" align="center">
<TR class="cabmenu" bgcolor="#C1A448">
<?
//////// Mostra opções do menu
for ($r = 0;$r < count($menu);$r++)
	{
	echo '<TD width="1%">';
	echo '<nobr>&nbsp;';
	echo '<A HREF="'.$menu[$r][1].'" class="cabmenu">';
	echo msg($menu[$r][0]);
	echo '</A>';
	echo '&nbsp;|';
	}
?><TD align="right"><nobr>|&nbsp;<A HREF="logout.php" class="cabmenu">sair</A>&nbsp;</TD>
</table>