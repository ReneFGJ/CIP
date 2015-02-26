<?
require("cab.php");
require($include."sisdoc_colunas.php");

$sql = "select * from pareceristas_area ";
$sql .= "inner join pareceristas on us_codigo = pa_parecerista ";
$sql .= "inner join ajax_areadoconhecimento on a_codigo = pa_area ";
$sql .= "inner join instituicoes on us_instituicao = inst_codigo ";
$sql .= " where us_journal_id = ".intval($journal_id);
$sql .= " and us_ativo = 1 ";
$sql .= "order by a_cnpq ";
$rlt = db_query($sql);
$are = "X";
$total = 0;
$aa = array('Não informado','NÃO','SIM','Aguardando','','','','','','','Enviar convite');
//-1:Não informado&1:SIM&0:NÃO&9:Enviar convite&2:Aguardando aceite do convite
while ($line = db_read($rlt))
	{
	$inst = trim($line['inst_abreviatura']);
	$area = $line['a_cnpq'];
	if ($area != $are)
		{
		$total = $total + 1;
		$s .= '<TR><TD class="lt3" colspan="3"><HR><B>';
		$s .= trim($line['a_cnpq']).' ';
		$s .= trim($line['a_descricao']);
		$are = $area;
		}
	$s .= '<TR '.coluna().'>';
	$s .= '<TD>';
	$s .= $aa[$line['us_aceito']+1];
//	$s .= '=='.$line['us_aceito'];
	$s .= '<TD>';
	$s .= trim($line['us_nome']);
	$s .= ' ';
	$s .= '('.trim($line['inst_abreviatura']).')';
	if ($inst == 'PUCPR') { $s .= ' ** local ** '; }

	}
?>
<BR><BR>
<font class="lt4">Área do conhecimento / Parecerista</font>
<TABLE width="<?=$tab_max;?>" class="lt1">
<?=$s;?>
</TABLE>
<?
echo 'total de '.$total.' áreas cadastradas';
?>
<? require("foot.php");	?>