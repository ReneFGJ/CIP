<?
$estilo_admin = 'style="width: 200; height: 30; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';

$menu = array();
////////////////////////////////////////////////// Servicos
array_push($menu,array('Documentos','Documentos',$path.'?dd99=useradm&dd98=docs'));
array_push($menu,array('Serviços','Seções Notícias',$path.'?dd99=useradm&dd98=news_secoes'));

/////////////////////////////////////////////////// Sair
array_push($menu,array('Sair','Sair',$path.'?dd99=admin&dd98=sair'));

//$menu[4] = array('Usuarios',$path.'?dd99=admin&dd98=user');

if ((isset($dd[1])) and (strlen($dd[1]) > 0))
	{
	$col=0;
	for ($k=0;$k <= count($menu);$k++)
		{
		 if ($dd[1]==CharE($menu[$k][1])) {	header("Location: ".$menu[$k][2]); } 
		}
	}
$col=0;

?>

<TABLE width="640" align="center" border="0">
<TR><TD colspan="4">
<FONT class="lt3">
</FONT>[<?=$sge?>]<FORM method="post" action="<?=$path?>?dd99=useradm">
</TD></TR>
</TABLE>
<TABLE width="640" align="center" border="0">
<TR>
<?
$xcol=0;
$seto = "X";
for ($x=0;$x <= count($menu); $x++)
	{
	if (isset($menu[$x][2]))
		{
			
			{
			$xseto = $menu[$x][0];
			if (!($seto == $xseto))
				{
				echo '<TR><TD colspan="10">';
				echo '<TABLE width="100%" cellpadding="0" cellspacing="0">';
				echo '<TR><TD class="lt3" width="1%"><NOBR><B><font color="#C0C0C0">'.$xseto.'&nbsp;</TD>';
				echo '<TD><HR width="100%" size="2"></TD></TR>';
				echo '</TABLE>';
				echo '<TR class="lt3">';
				$seto = $xseto;
				$xcol=0;
				}
			}
		if ($xcol >= 3) { echo '<TR><TD><img src="'.$img_dir.'nada.gif" width="1" height="5" alt="" border="0"></TD><TR>'; $xcol=0; }
		echo '<TD align="center">';
		echo '<input type="submit" name="dd1" value="'.CharE($menu[$x][1]).'" '.$estilo_admin.'>';
		echo '</TD>';
		$xcol = $xcol + 1;
		}
	}
?>
</TABLE></FORM>