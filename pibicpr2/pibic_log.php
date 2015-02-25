<?
if (count($log_protos) > 0)
	{
	
	$sql = "select * from pibic_log ";
	$sql .= " where ";
	for ($rq = 0; $rq < count($log_protos); $rq++)
		{
		if ($rq > 0) { $sql .= ' or '; }
		$sql .= " (log_projeto = '".$log_protos[$rq]."') ";
		}
	$sql .= " order by log_data desc, log_hora desc ";
	$sql .= " limit 100";

	$rll = db_query($sql);
	$sl = '';
	$sl .= '<TR><TH>data</TH><TH>hora</TH><TH>página</TH><TH>IP</TH><TH>dd1</TH><TH>Protocolo</TH></TR>';
	while ($line = db_read($rll))
		{
		$sl .= '<TR>';
		$sl .= '<TD>';
		$sl .= stodbr($line['log_data']);
		$sl .= '<TD>';
		$sl .= $line['log_hora'];
		$sl .= '<TD>';
		$sl .= $line['log_pagina'];
		$sl .= '<TD>';
		$sl .= $line['log_ip'];
		$sl .= '<TD>';
		$sl .= $line['log_dd1'];
		$sl .= '<TD>';
		$sl .= $line['log_projeto'];
		}
	}

?>