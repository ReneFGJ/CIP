<?
require("db.php");
require($include."sisdoc_cookie.php");
require("ro8_cab.php");
$bb1 = "setar >>>";
$bb2 = "verbo";
$bb3 = "formato";
$bb4 = "setar tabela >>>";
$bb5 = "offset >>>";
$bb6 = "limit >>>";
$bb7 = "date >>>";

$http_host = read_cookie("host");
$verbo = read_cookie("verbo");
$tabela = read_cookie("tabela");
$format = read_cookie("format");
$offset = read_cookie("offset");
$limit = read_cookie("limit");
$date = read_cookie("limit");
$enddate = read_cookie("limit");
$base = read_cookie("base");

$basex = strtolower($vars['dd13']);
if (strlen($basex) > 0) { $base = $basex; }

if (strlen($limit) == 0) { $limit = 100; }

if ($acao == $bb1) { $http_host = $dd[0]; }
if ($acao == $bb2) { $verbo = $dd[0]; }
if ($acao == $bb3) { $format = $dd[0]; }
if ($acao == $bb4) { $tabela = $dd[0]; }
if ($acao == $bb5) { $offset = $dd[0]; }
if ($acao == $bb6) { $limit = $dd[0]; }
if ($acao == $bb7) { $date = $dd[0]; }
if ($acao == $bb7) { $enddate = $dd[1]; }

if (strlen($date) != 8) { $date = 19000101; }
if (strlen($enddate) != 8) { $enddate = date("Ymd"); }
		
setcookie('host',$http_host,time()+7200);
setcookie('verbo',$verbo,time()+7200);
setcookie('format',$format,time()+7200);
setcookie('tabela',$tabela,time()+7200);
setcookie('offset',$offset,time()+7200);
setcookie('limit',$limit,time()+7200);
setcookie('date',$date,time()+7200);
setcookie('enddate',$enddate,time()+7200);
setcookie('base',$base,time()+7200);
$html = '';
?>
<TABLE width="100%" class="lt0">
<TR><TD colspan="10">
<DIV><img src="img/ro8.logo.gif" width="64" height="32" alt="" border="0"></DIV></TD></TR>

<TR valign="top"><TD class="lt0">
<DIV class="lt1">
<CENTER><B>Verbs</B></CENTER><BR>
<A HREF="ro8.php?acao=<?=$bb2?>&dd0=Tables">Tables</A><BR>
<A HREF="ro8.php?acao=<?=$bb2?>&dd0=tablestruture">TableStruture</A><BR>
<A HREF="ro8.php?acao=<?=$bb2?>&dd0=TotalRecord">TotalRecord</A><BR>
<A HREF="ro8.php?acao=<?=$bb2?>&dd0=ListRecord">ListRecord</A><BR>
</DIV><BR><DIV class="lt1">
<CENTER><B>Format</B></CENTER><BR>
<A HREF="ro8.php?acao=<?=$bb3?>&dd0=">XML (default)</A><BR>
<A HREF="ro8.php?acao=<?=$bb3?>&dd0=HTML">HTML</A><BR>
<A HREF="ro8.php?acao=<?=$bb3?>&dd0=TXT">Text</A><BR>
<A HREF="ro8.php?acao=<?=$bb3?>&dd0=CVA">Text CVA</A><BR>
<A HREF="ro8.php?acao=<?=$bb3?>&dd0=SQL">SQL</A><BR>
<A HREF="ro8.php?acao=<?=$bb3?>&dd0=DOC">Documentação</A><BR>
<A HREF="ro8.php?acao=<?=$bb3?>&dd0=CP">Format CP</A><BR>
</DIV>
<BR>
<DIV class="lt1">
Verbo:&nbsp;<B><?=$verbo?></B>
</DIV>
<BR>
<DIV class="lt1">
<TABLE width="100%" class="lt1" border="0" cellpadding="0" cellspacing="0">
<TR valign="middle">
<TD><form method="post" action="ro8.php"></TD>
<TD>Tabela:&nbsp;</TD>
<TD><input type="text" name="dd0" value="<?=$tabela?>" size="40" maxlength="40" style="width: 130;"></TD>
<TR valign="middle">
<TD><form method="post" action="ro8.php"></TD>
<TD>Base:&nbsp;</TD>
<TD><input type="text" name="dd13" value="<?=$dd[13]?>" size="40" maxlength="40" style="width: 130;"></TD>
<TR><TD colspan="3" align="right">
<input type="submit" name="acao" value="<?=$bb4?>"></form></TD>
</TR>
</TABLE>
</DIV>

<?
if (($verbo=='ListRecord') or ($verbo=='TotalRecord'))
	{
	?>
	<BR>
	<DIV class="lt1">
	<TABLE width="100%" class="lt1" border="0" cellpadding="0" cellspacing="0">
	<?	
	if ($verbo=='ListRecord')
		{
		?>
		<TR valign="middle">
		<TD><form method="post" action="ro8.php"></TD>
		<TD>Offset (<?=$offset?>):&nbsp;</TD>
		<TD><select name="dd0" size="1">
		<? for ($k=0;$k < 1000;$k++)
			{ $sel = ''; if ((intval($offset/100)+intval($limit/100)) == $k) { $sel = 'selected'; }
			echo '<option values="'.($k*100).'" '.$sel.'>'.($k*100).'</option>'; } ?>
		</select></TD>
		<TR><TD colspan="3" align="right">
		<input type="submit" name="acao" value="<?=$bb5?>"></form></TD>
		</TR>
		<TR>
		<TD><form method="post" action="ro8.php"></TD>
		<TD>Limit (<?=$limit?>):&nbsp;</TD>
		<TD><select name="dd0" size="1">
		<? for ($k=1;$k < 100;$k++)
			{ $sel = ''; if ((intval($limit/100)) == $k) { $sel = 'selected'; }
			echo '<option values="'.($k*100).'" '.$sel.'>'.($k*100).'</option>'; } ?>
		</select></TD>
		<TR><TD colspan="3" align="right">
		<input type="submit" name="acao" value="<?=$bb6?>"></form></TD>
		</TR>	
		<? 
		} 
		?>
		<TR class="lt1">
		<TD><form method="post" action="ro8.php"></TD>
		<TD>Date (yyyymmdd):&nbsp<BR><input type="text" name="dd0" value="<?=$date?>" size="8" maxlength="8" style="width: 70;"></TD>
		<TD></TD>
		<TR class="lt1">
		<TD></TD>
		<TD>EndDate (yyyymmdd):&nbsp<BR><input type="text" name="dd1" value="<?=$enddate?>" size="8" maxlength="8" style="width: 70;"></TD>
		<TD></TD>
		<TR><TD colspan="3" align="right">
		<input type="submit" name="acao" value="<?=$bb7?>"></form></TD>
		</TR>	
		</TABLE>	
		</DIV>
	<?
	}
?>
<TD width="80%">
<DIV>
<TABLE width="100%" class="lt1">
<TR>
<TD><form method="post" action="ro8.php"></TD>
<TD width="50">http://</TD>
<TD><input type="text" name="dd0" value="<?=$http_host?>" size="40" maxlength="100" style="width: 400;"></TD>
<TD>(local de coleta para RO8)</TD>
<TD><input type="submit" name="acao" value="<?=$bb1?>"></TD>
<TD></form></TD>
</TR>
</TABLE>
</DIV>
<BR><DIV class="lt1">
http://<?=$http_host?>
<? 
if (strlen($verbo) > 0) { echo '?verbo='.$verbo.''; $html .= '&verbo='.$verbo; } 
if (strlen($tabela) > 0) { echo '&table='.$tabela.''; $html .= '&table='.$tabela; } 
if (strlen($format) > 0) { echo '&format='.$format.''; $html .= '&format='.$format; } 
if (strlen($offset) > 0) { echo '&offset='.$offset.''; $html .= '&offset='.$offset; } 
if (strlen($limit) > 0) { echo '&limit='.$limit.''; $html .= '&limit='.$limit; } 
if (strlen($base) > 0) { echo '&base='.$base.''; $html .= '&base='.$base; } 

?>
</DIV>
<BR>
<DIV>
<?
if (strlen($http_host) == 0)
	{ $link = 'about:blank'; }
	else
	{
		if (substr($http_host,0,7) == 'http://')
		{
			$link = $http_host.'?verbo='.$verbo.$html;
		} else {
			$link = 'http://'.$http_host.'?verbo='.$verbo.$html;
		}
	}
?>
<IFRAME width="100%" height="500" src="<?=$link;?>"></IFRAME>
</DIV>
</TD>
</TABLE>



</body>
</html>
