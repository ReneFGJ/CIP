<style>
#reuniao {
	border : 1px dashed Black;
	color : Gray;
	padding-bottom : 12px;
	padding-left : 12px;
	padding-right : 6px;
	padding-top : 6px;
}
</style>
<?
$sql = "select * from ".$pp." where cep_reuniao >= ".date("Ymd")." limit 1 ";
$rlt = db_query($sql);
$line = db_read($rlt);
$data_reuniao = $line['cep_reuniao'];

$sql = "select cep_grupo, cep_versao, count(*) as total from ".$pp." ";
$sql .= " where cep_status <> 'X' ";
$sql .= " and cep_reuniao = ".round("0".$data_reuniao)." ";
$sql .= " group by cep_grupo, cep_versao ";
$rlt = db_query($sql);

$gr = array(0,0,0,0,0,0);
$gt = array('Grupo I','Grupo II','Grupo III','Gestão de pesquisa','Recursos');
if ($pp == 'ceua')
	{
	$gt = array("Grupo A","Grupo B","Grupo C","Grupo D","Recursos");
	}

while ($line = db_read($rlt))
	{
	$gg = trim($line['cep_grupo']);
	$ver = trim($line['cep_versao']);
	$total = trim($line['total']);
	if ($ver == '9') 
		{ 
			$gr[4] = $gr[4] + $total; 
		} else {
			if ($gg == '') 		{ $gr[3] = $gr[3] + $total; }
			if ($gg == 'III') 	{ $gr[3] = $gr[3] + $total; }
			if ($gg == 'II') 	{ $gr[2] = $gr[2] + $total; }
			if ($gg == 'I') 	{ $gr[1] = $gr[1] + $total; }
			if ($gg == 'A') 	{ $gr[1] = $gr[1] + $total; }
			if ($gg == 'B') 	{ $gr[2] = $gr[2] + $total; }
			if ($gg == 'C') 	{ $gr[3] = $gr[3] + $total; }
			if ($gg == 'D') 	{ $gr[4] = $gr[4] + $total; }
		}
	}
for ($r=0;$r < count($gr);$r++)
	{ if ($gr[$r] == 0) { $gr[$r] = '-'; } }
?>

<table width="100%" cellpadding="3" cellspacing="0" class="lt1" border="0">
<TR><TD>
<div id="reuniao">
<font class="lt1_sub">
<img src="img/marcado_setas.png" width="27" height="12" alt="" border="0" align="absmiddle"><B>Pauta da próxima reunião</B>
</font>
<BR>&nbsp;
<table width="100%" cellpadding="0" cellspacing="0" border="0">
<TR class="lt0" align="center">
	<TD bgcolor="#F8F8F8" width="20%"><?=$gt[0];?></TD>
	<TD bgcolor="#EFEFEF" width="20%"><?=$gt[1];?></TD>
	<TD bgcolor="#E8E8E8" width="20%"><?=$gt[2];?></TD>
	<TD bgcolor="#DFDFDF" width="20%"><?=$gt[3];?></TD>
	<TD bgcolor="#DFDFDF" width="20%"><?=$gt[4];?></TD>
</TR>
<TR align="center" class="lt1">
	<TD bgcolor="#F8F8F8"><B><?=$gr[1];?></B></TD>
	<TD bgcolor="#EFEFEF"><B><?=$gr[2];?></B></TD>
	<TD bgcolor="#E8E8E8"><B><?=$gr[3];?></B></TD>
	<TD bgcolor="#DFDFDF"><B><?=$gr[4];?></B></TD>
	<TD bgcolor="#DFDFDF"><B><?=$gr[5];?></B></TD>
</TR>
<tr><td><br></td></tr>
<TR class="lt0" align="left">
	<TD bgcolor="#FFFFFF">prox.reunião</TD>
	<TD bgcolor="#FFFFFF" colspan="4">local</TD>
<TR class="lt1" align="left">
	<TD bgcolor="#FFFFFF"><B><?=stodbr($data_reuniao);?></B></TD>
	<TD bgcolor="#F0F0F0" colspan="4"><B>Bloco CCBS - Sala 24 - 2º andar</B></TD>

</table>
</div>
</TD></TR>
</TABLE>