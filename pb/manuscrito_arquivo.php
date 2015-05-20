<?


$doc = '0000063';
$chksun = md5($protocolo.$doc.'448545');

///////////////////////////////////////// Parte III - Arquivos Anexos
	$sql = "select * from submit_files 
				inner join submit_files_tipo on doc_tipo = doct_codigo";
	$sql .= " where doc_dd0 = '".$protocolo."' ";
	$sql .= " order by id_doc desc ";
	$sql .= " limit 100 ";
	
	$rlt = db_query($sql);
	$s = '<A name="arq"></A>';
	$s .= '<TABLE width="100%" class="tabela20">';
	$s .= '<TR class="tabela_title"><Th colspan=8 class="tabela_title">Arquivos dispositivo';
	$s .= '<TR class="tabela10"><TH>arquivo</TH><Th>data</Th><Th>tipo</th><Th>tamanho</Th><TH>cod.arq.</TH></TR>';
	
	////////q TIPO DE ARQUIVO

	$livre = 0;
	$arq=0;
	while ($line = db_read($rlt))
		{
		$arq++;
		
		$lv = $line['pl_all'];
		$la = $line['pl_autor'];

		if ($lv == 0) { 
			$vlv = '<font color="red">bloqueado</font>'; 
			$linkx = '<A HREF="#arq" onclick="newxy2('.chr(39).'ged_file_block.php?dd0='.$line['id_pl'].'&dd1=1'.chr(39).',20,10);">';
			}
		if ($lv == -1) { 
			$vlv = '<font color="red">bloqueado</font>'; 
			$linkx = '<A HREF="#arq" onclick="newxy2('.chr(39).'ged_file_block.php?dd0='.$line['id_pl'].'&dd1=1'.chr(39).',20,10);">';
			}
		if ($lv == 1) { 
			$vlv = '<font color="green">livre</font>'; 
			$linkx = '<A HREF="#arq" onclick="newxy2('.chr(39).'ged_file_block.php?dd0='.$line['id_pl'].'&dd1=0'.chr(39).',20,10);">';
			$livre++;
			}
		if ($lv == 2) { 
			$vlv = '<font color="green">avaliador</font>'; 
			$linkx = '<A HREF="#arq" onclick="newxy2('.chr(39).'ged_file_block.php?dd0='.$line['id_pl'].'&dd1=0'.chr(39).',20,10);">';
//			$lonkx = '';
			}
		// pl_filename
		// id_pl
		
		/* Visualizar aquivos para o autor */
		if ($la == 0) { 
			$vlva = '<font color="red">bloqueado</font>'; 
			$linka = '<A HREF="#arq" onclick="newxy2('.chr(39).'ged_file_block_a.php?dd0='.$line['id_pl'].'&dd1=1'.chr(39).',20,10);">';
			}
		if ($la == -1) { 
			$vlva = '<font color="red">bloqueado</font>'; 
			$linka = '<A HREF="#arq" onclick="newxy2('.chr(39).'ged_file_block_a.php?dd0='.$line['id_pl'].'&dd1=1'.chr(39).',20,10);">';
			}
		if ($la == 1) { 
			$vlva = '<font color="green">livre</font>'; 
			$linka = '<A HREF="#arq" onclick="newxy2('.chr(39).'ged_file_block_a.php?dd0='.$line['id_pl'].'&dd1=0'.chr(39).',20,10);">';
			$livre++;
			}
		if ($la == 2) { 
			$vlva = '<font color="green">avaliador</font>'; 
			$linkx = '<A HREF="#arq" onclick="newxy2('.chr(39).'ged_file_block.php?dd0='.$line['id_pl'].'&dd1=0'.chr(39).',20,10);">';
//			$lonkx = '';
			}
		$chk = md5($secu.$line['id_pl'].date("Hmi"));
		//$link = '<A HREF="javascript:newxy(\'/reol/pb/download_submit.php?dd0='.$line['id_pl'].'&dd1=download&dd2='.$chk.'&dd3='.date("Hmi").'\',300,150);">';
		
		$s .= '<TR '.coluna().'>';
		$s .= '<TD>'.$link.trim($line['doct_nome']).'</A></TD>';
		$s .= '<TD>'.$link.trim($line['doc_filename']).'</A></TD>';
		
		$s .= '<TD align="center">'.stodbr($line['doc_data']).' '.trim($line['pl_hora']).'</TD>';
		$s .= '<TD align="center">'.trim($line['doc_extensao']).'</TD>';
		$s .= '<TD align="center">'.trim($line['doc_size']).'k</TD>';
		$s .= '<TD align="center">'.strzero(trim($line['id_doc']),7,0).'</TD>';
		$s .= '</TR>';
		$txt = trim($line['spc_content']);
		
		

		}
	$s .= '</TABLE>';
	
	/* Botao */
	$ycod = trim($xline['sdo_codigo']);
	$xcod = $protocolo;
	$mcod = md5($xcod.$ycod.'448545');

		$on = ' onclick="newxy2('.chr(39).$http.'ged_upload.php?dd0='.$xcod.'&dd1='.$xcod.'&dd2='.$mcod.chr(39).',650,250);" '; 
		$s .= '<input type="button" value="anexar novo arquivo" class="botao-finalizar" '.$on.'>';
	
	echo $s;	

?>
