<?
///////////////////////////////////////// Parte III - Arquivos Anexos
	$sql = "select * from submit_files 
				where doc_dd0 = '$protocolo'	
				and doc_all = '1'
							
			";
	/*
	$sql .= " where doc_codigo = '".$protocolo."' and doc_all = 1";
	$sql .= " order by id_pl desc ";
	$sql .= " limit 100 ";
	$rlt = db_query($sql);
	$s = '<A name="arq"></A>';
	*/
	$s .= '<TABLE width="100%" class="tabela20">';
	$s .= '<TR class="tabela_title"><Th colspan=8 class="tabela_title">Arquivos dispositivo';
	$s .= '<TR class="tabela10">
				<TH>arquivo</TH>
				<Th>data</Th>
				<Th>tipo</th>
				<Th>tamanho</Th>
				<TH>cod.arq.</TH>
				</TR>';
	$rlt = db_query($sql);
	$livre = 0;
	$arq=0;
	while ($line = db_read($rlt))
		{
		$arq++;
		$lv = $line['doc_all'];
		$la = $line['doc_autor'];
		
		$file = trim($line['doc_arquivo']);
		$file = troca($file,'/pucpr/httpd/htdocs/www2.pucpr.br/reol/','../');

		$chk = md5($secu.$line['id_pl'].date("Hmi"));
		$link = '<A HREF="javascript:newxy(\''.$file.'\',300,150);">';
		
		$s .= '<TR '.coluna().'>';
		$s .= '<TD>'.$link.trim($line['doc_filename']).'</A></TD>';
		$s .= '<TD align="center">'.stodbr($line['doc_data']).' '.trim($line['doc_hora']).'</TD>';
		$s .= '<TD align="center">'.trim($line['doc_type']).'</TD>';
		$s .= '<TD align="center">'.trim($line['doc_size']).'k</TD>';
		$s .= '<TD align="center">'.strzero(trim($line['id_pl']),7,0).'</TD>';
		$s .= '</TR>';
		$txt = trim($line['spc_content']);
		}
	$s .= '</TABLE>';
	
	/* Botao */
	$ycod = trim($xline['sdo_codigo']);
	$xcod = $protocolo;
	$mcod = md5($xcod.$ycod.'448545');
	if (strlen($ycod) > 0)
		{
		$on = ' onclick="newxy2('.chr(39).'ged_reol_upload.php?dd0='.$xcod.'&dd1='.$ycod.'&dd2='.$mcod.chr(39).',650,250);" '; 
		$s .= '<input type="button" value="anexar novo arquivo" class="botao-finalizar" '.$on.'>';
		}
	
	
	if ($arq ==0) { $livre = 1; $s = '';}
	else {
		echo '<fieldset>';
		echo $s;
		echo '</fieldset>';
	} 
?>