<?
$sql = "select * from pibic_bolsa_historico ";
$sql .= " where bh_protocolo = '".$protocolo."' ";

$sx = '';
$rlt = db_query($sql);
while ($line = db_read($rlt))
	{
	$sx .= '<TR '.coluna().'>';
	$sx .= '<TD>';
	$sx .= stodbr($line['bh_data']);
	
	$sx .= '<TD>';
	$sx .= $line['bh_hora'];
	
	$sx .= '<TD>';
	$sx .= strzero($line['bh_acao'],3);

	$sx .= '<TD>';
	$sx .= $line['bh_historico'];
	
	$sx .= '<TD>';
	$sx .= $line['bh_log'];
	
	$sx .= '</TR>';
	}
?>
<TABLE width="<?=$tab_max;?>" class="lt1">
<TR><TH>data</TH><TH>hora</TH><TH>ope</TH><TH>historico</TH></TR>
	<?=$sx;?>
</TABLE>