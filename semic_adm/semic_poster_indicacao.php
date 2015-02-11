<?php
require("cab_semic.php");
$jid = 85;
$bb1 = "INDICAR >>";
$bb2 = "INDICAR #1# SUPLENTE >>";
$bb3 = "INDICAR #2# SUPLENTE >>";
require("../editora/_class/_class_pareceristas.php");
$par = new parecerista;

if ($dd[10]=='DEL')
	{
		$sql = "update semic_trabalhos set st_avaliador_1 = '' where st_codigo = '".$dd[3]."'";
		$rlt = db_query($sql);		
	}
if ($dd[10]=='DEL2')
	{
		$sql = "update semic_trabalhos set st_avaliador_2 = '' where st_codigo = '".$dd[3]."'";
		//echo $sql;
		$rlt = db_query($sql);		
	}
if ($dd[10]=='DEL3')
	{
		$sql = "update semic_trabalhos set st_avaliador_3 = '' where st_codigo = '".$dd[3]."'";
		$rlt = db_query($sql);		
	}
	

if ($acao == $bb1)
	{
		$sql = "update semic_trabalhos set st_avaliador_1 = '".$dd[2]."' where st_codigo = '".$dd[4]."'";
		$rlt = db_query($sql);
	}
if ($acao == $bb2)
	{
		$sql = "update semic_trabalhos set st_avaliador_2 = '".$dd[2]."' where st_codigo = '".$dd[8]."'";
		echo $sql;
		$rlt = db_query($sql);
	}	
if ($acao == $bb3)
	{
		$sql = "update semic_trabalhos set st_avaliador_3 = '".$dd[2]."' where st_codigo = '".$dd[11]."'";
		echo $sql;
		$rlt = db_query($sql);
	}	

/* Mostra indicacoes */
$sql = "select * from semic_trabalhos
		inner join semic_blocos on st_bloco = blk_codigo 
		where st_avaliador_1 = '".$dd[2]."'
		order by st_codigo
";
$rlt = db_query($sql);
$ss = '';
while ($line = db_read($rlt))
	{
		$link = '<A HREF="'.page().'?dd1='.$dd[1].'&dd2='.$dd[2].'&dd3='.trim($line['st_codigo']).'&dd10=DEL">';
		$ss .= $line['st_codigo'].' '.$link.'[Remover]</A><BR>';
	}


$par->le($dd[2]);
echo $par->mostra_dados();

echo '<form action="'.page().'" method="post">';

echo '<table width="100%">';
echo '<TR valign="top">';
echo '<TD>==AVALIADOR==<BR>';
$sql = "select * from semic_trabalhos where st_bloco = '".$dd[1]."' ";
$sql .= " and (st_avaliador_1 = '' or st_avaliador_1 isnull) ";
$sql .= " order by st_codigo ";

$rlt = db_query($sql);
echo '<input type="hidden" name="dd1" value="'.$dd[1].'">';
echo '<input type="hidden" name="dd2" value="'.$dd[2].'">';

$sx = '<select name="dd4" size=10>';
while ($line = db_read($rlt))
	{
		$sx .= '<option value="'.$line['st_codigo'].'">'.$line['st_codigo'].'</option>';
	}
$sx .= '</select>';
echo $sx;
echo '<BR><input type="submit" name="acao" value="'.$bb1.'">';
echo '<TD>==TRABALHOS INDICADOS==<BR>'.$ss;

echo '<TD>==SUPLENTE #1==<BR>';

/* SUPLENTE */
$sql = "select * from semic_trabalhos where st_bloco = '".$dd[1]."' ";
$sql .= " and (st_avaliador_2 = '' or st_avaliador_2 isnull) ";
$sql .= " order by st_codigo ";
$sx = '<select name="dd8" size=10>';
$rlt = db_query($sql);
while ($line = db_read($rlt))
	{
		$sx .= '<option value="'.$line['st_codigo'].'">'.$line['st_codigo'].'</option>';
	}
$sx .= '</select>';
echo $sx;
echo '<BR><input type="submit" name="acao" value="'.$bb2.'">';
/* Mostra indicacoes -2 */
$sql = "select * from semic_trabalhos
		inner join semic_blocos on st_bloco = blk_codigo 
		where st_avaliador_2 = '".$dd[2]."'
		order by st_codigo
";
$rlt = db_query($sql);
$ss = '';

while ($line = db_read($rlt))
	{
		$link = '<A HREF="'.page().'?dd1='.$dd[1].'&dd2='.$dd[2].'&dd3='.trim($line['st_codigo']).'&dd10=DEL2">';
		$ss .= $line['st_codigo'].' '.$link.'[Remover]</A><BR>';
	}
echo '<TD>==TRABALHOS INDICADOS==<BR>'.$ss;	


echo '<TD>==SUPLENTE #1==<BR>';

/* SUPLENTE */
$sql = "select * from semic_trabalhos where st_bloco = '".$dd[1]."' ";
$sql .= " and (st_avaliador_3 = '' or st_avaliador_3 isnull) ";
$sql .= " order by st_codigo ";
$sx = '<select name="dd11" size=10>';
$rlt = db_query($sql);
while ($line = db_read($rlt))
	{
		$sx .= '<option value="'.$line['st_codigo'].'">'.$line['st_codigo'].'</option>';
	}
$sx .= '</select>';
echo $sx;
echo '<BR><input type="submit" name="acao" value="'.$bb3.'">';
/* Mostra indicacoes -3 */
$sql = "select * from semic_trabalhos
		inner join semic_blocos on st_bloco = blk_codigo 
		where st_avaliador_3 = '".$dd[2]."'
		order by st_codigo
";
$rlt = db_query($sql);
$ss = '';

while ($line = db_read($rlt))
	{
		$link = '<A HREF="'.page().'?dd1='.$dd[1].'&dd2='.$dd[2].'&dd3='.trim($line['st_codigo']).'&dd10=DEL3">';
		$ss .= $line['st_codigo'].' '.$link.'[Remover]</A><BR>';
	}
echo '<TD>==TRABALHOS INDICADOS==<BR>'.$ss;	

echo '</table>';
echo '</form>';

require("../foot.php");	
?>