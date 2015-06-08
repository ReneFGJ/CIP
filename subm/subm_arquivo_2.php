<?
$doc = '0000063';
$chksun = md5($protocolo.$doc.'448545');

///////////////////////////////////////// Parte III - Arquivos Anexos
	$sql = "select * from submit_files ";
	$sql .= " where doc_dd0 = '".$protocolo."' and doc_autor = '1'";
	$sql .= " order by id_doc desc ";
	$sql .= " limit 100 ";
	$rlt = db_query($sql);
	
	$s = '<A name="arq"></A>';
	$s .= '<TABLE width="100%" class="tabela20">';
	$s .= '<TR class="tabela_title"><Th colspan=8 class="tabela_title">Arquivos dispositivo';
	$s .= '<TR class="tabela10"><TH>arquivo</TH><Th>data</Th><Th>tipo</th><Th>tamanho</Th><TH>cod.arq.</TH></TR>';
	
	////////q TIPO DE ARQUIVO
	$xsql = "select * from submit_documentos_obrigatorio ";
	$xsql .= " where sdo_journal_id = ".$jid;

	$xrlt = db_query($xsql);
	if ($xline = db_read($xrlt)) { }
//		{ print_r($xline); echo '<HR>'; }

	$livre = 0;
	$arq=0;
	while ($line = db_read($rlt))
		{
		$arq++;
		$lv = $line['doc_all'];
		$la = $line['doc_autor'];

		$chk = md5($secu.$line['id_doc'].date("Hmi"));
		$link = '<A HREF="javascript:newxy(\'download_submit_2.php?dd0='.$line['id_doc'].'&dd1=download&dd2='.$chk.'&dd3='.date("Hmi").'\',300,150);">';
		
		$s .= '<TR '.coluna().'>';
		$s .= '<TD>'.$link.trim($line['doc_filename']).'</A></TD>';
		$s .= '<TD align="center">'.stodbr($line['doc_data']).' '.trim($line['doc_hora']).'</TD>';
		$s .= '<TD align="center">'.trim($line['doc_extensao']).'</TD>';
		$s .= '<TD align="center">'.trim($line['doc_size']).'k</TD>';
		$s .= '<TD align="center">'.strzero(trim($line['id_doc']),7,0).'</TD>';
		$s .= '</TR>';
		$txt = trim($line['spc_content']);
		}
	$s .= '</TABLE>';

	
	echo $s;	

?>
