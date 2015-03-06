<?
require("cab.php");
?>
<H2>Vacuum</H2>
<TABLE width="98%" align="center" border="1">
<TR><TD>
<?
$sql = "";
$rlt = fopen('http://www2.pucpr.br/reol/ro8_index.php?verbo=Tables&table=pibic_submit_documento&format=TXT&limit=100','r');
$s = '';
while ($sx = fread($rlt,1024))
	{
	$s .= $sx;
	}
fclose($rlt);

$s = troca($s,'"','');
$ln = split(chr(13),$s);
echo '<DIV>';
for ($n=$dd[0];$n < count($ln);$n++)
	{
	$sp = $ln[$n];
	$sc = split(',',$sp);
	if (strlen($sc[0]) > 0)
		{
		$sql = "vacuum FREEZE ".$sc[0].' ';
		echo '<TT><font style="font-size: 30px;"> '.date("Y-m-d H:i:s").' '.$sql;
		$rlt = db_query($sql);
		echo '<BR>'.date("Y-m-d H:i:s");
		}
	$n=9999;
	}
echo '</DIV>';

if ($dd[0] < count($ln))
	{
		echo '<META http-equiv="refresh" content="5;URL='.page().'?dd0='.($dd[0]+1).'">';
	}
require("foot.php");	?>
