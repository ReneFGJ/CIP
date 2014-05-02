<?
if (trim($dd[61]) == 'del')
	{
	$chk = md5(trim($dd[60]).trim($secu));
	if ($dd[62] == $chk)
		{
		$xsql = "select * from ".$ged_files." where id_pl = ".$dd[60];
		$xrlt = db_query($xsql);
		if ($xline = db_read($xrlt))
			{
			$xdir = $xline['pl_data'];
			$xdir = '/nep/public/cep_submit/'.substr($xdir,0,4).'/'.substr($xdir,4,2).'/';
			$xarq = $xline['pl_filename'];
			$xfile = trim($dir).trim($xdir).trim($xarq);
			if (file_exists($xfile))
				{ 
				unlink($xfile);
				}
			$xsql = "delete from ".$ged_files." where id_pl = ".$dd[60];
			$xrlt = db_query($xsql);
			}
		}
	}
///////////////////////// Total de arquivos anexados
$sql = "select count(*) as total from ".$ged_files." ";
$sql .= " where pl_codigo = '".trim($protocolo)."' ";

$rlt = db_query($sql);
if ($line = db_read($rlt))
	{
	$tota = $line['total'];
	}
//////////////////////////////////////////////////

$sql = "select * from ".$tdoco." ";
$sql .= " left join (select * from ".$ged_files." ";
$sql .= " where pl_codigo = '".trim($protocolo)."') as ged on pl_tp_doc = sdo_codigo ";
$sql .= " where sdo_journal_id = ".$jid;
$sql .= " and sdo_ativo = 1 ";
$sql .= " and sdo_tipodoc = '".$prj_tp."' ";
$sql .= " order by sdo_ordem, sdo_descricao";

$rlt = db_query($sql);
//////////////// Obrigatoriedade
$obrig = array();
for ($or=0;$or <= 20;$or++) { array_push($obrig,0); }
//////////////////////////////// Marca documentos já baixados
while ($line = db_read($rlt))
	{
	$ordem = intval('0'.$line['sdo_ordem']);
	$file = trim($line['pl_texto']);
	if (strlen($file) > 0) { $obrig[$ordem] = 1; }
	}
////////////////////////////////
$obr = 0;
$ane = 0;
$cab = 'x';
$rlt = db_query($sql);

while ($line = db_read($rlt))
	{
	$tota = 0;	
	$dd0 = $protocolo;
	$dd1 = $line['sdo_codigo'];
	$ordem = intval('0'.$line['sdo_ordem']);
	$modelo = trim($line['sdo_modelo']);
	$chksun = md5($dd0.$dd1.'448545');
	$ob = $line['sdo_obrigatorio'];
	$file = trim($line['pl_texto']);
	
//	echo '==>'.trim($line['sdo_descricao']).'<BR>';

	$link = '<A HREF="javascript:newxy('.chr(39).'ged_upload.php?dd0='.$dd0.'&dd1='.$dd1.'&dd2='.$chksun.chr(39).',500,300);">';
	$linkb = 'onclick="newxy('.chr(39).'ged_upload.php?dd0='.$dd0.'&dd1='.$dd1.'&dd2='.$chksun.chr(39).',500,300);"';
//	if ($ob != 0)
		{
		$cab2 = trim($line['sdo_descricao']);
		if ($cab != $cab2)
			{
			$cab = $cab2;
			$tbo = '';
			$sfl .= '<TR>';
			$sfl .= '<TD class="lt3"><B><font color="black">';
			$sfl .= $line['sdo_descricao'];
			
			if (($ob == 1) or (($ob==(-2)) and ($obrig[$ordem] == 0)))
				{ $tbo = "<FONT COLOR=red ><B>(obrigatório)</B></FONT>"; $obr++; }
			if ($ob == -1)
				{ $tbo = "(opcional)"; $tbo = ""; }
			if ($ob == 0)
				{ $tbo = "não requerido"; }
			$sfl .= '<TD align="center">';
			/////////////////////////////////////// Documento OK!
			if ($obrig[$ordem] == 1)
				{ 
				if (strlen($file) > 0) 
					{ $tbo = "<FONT COLOR=green ><B>documento ok</B></FONT>"; } 
					else { $tbo = ''; }	
				}
//			$tbo .= '('.$obrig[$ordem].')'.$ordem;
				
			$sfl .=  $tbo;
		//	$sfl .= '('.$ob.')';
			//////////////// modelo de documento
			$sfl .= '<TD align="center" rowspan="2" bgcolor="#ffffff">';
			$mod = trim($line['sdo_modelo']);
			if (strlen($mod) > 0)
				{ 
//				$sfl .= '<A HREF="'.$mod.'" target="download" title="baixe o modelo de documento" alt="baixe o modelo de documento">';
//				$sfl .= '<font class="lt0"></B></strong>';
//				$sfl .= 'baixe o<BR>modelo deste<BR>documento</A>'; 
				
				$sfl .= '<input type="submit" name="ddz" value="baixe o'.chr(13).chr(10).'modelo deste'.chr(13).chr(10).'documento" style="width:100; height:80;" ';
				$sfl .= 'onclick="newxy2(\''.$mod.'\',700,600);">';
//				$sfl .= '<font class="lt0"></B></strong>';
//				$sfl .= 'baixe o<BR>modelo deste<BR>documento</A>'; 				
				}
				else { $sfl .= ' - '; }
			$sfl .= '<TD align="center" rowspan="2" bgcolor="#ffffff">';

			if ($tota == 0)
				{
				$sfl .= '<input type="button" name="acao" value="Anexar'.chr(13).chr(10).'novo arquivo" '.$linkb.' style="width:100; height:80;" >';
				$sfl .= '</A>';
				}
			
			$iinf = trim($line['sdo_info']);
			$info = trim($line['sdo_content']);
			if (strlen($info) > 0)
				{
				$sfl .= '<TR><TD colspan="2">';
				if (strlen($iinf) > 0)
					{
					$sfl .= tips('<img src="img/icone_information_mini.png" align="left" alt="" border="0">',$iinf);
					}
				$sfl .= $info;
				$sfl .= '</TD></TR>';
				}
			}
		
		if (strlen($file) > 0)
			{
			$dd2 = md5(trim($line['id_pl']).trim($secu));
			$linkd = '<A HREF="submit_phase_2_'.$tpp.'.php?dd60='.trim($line['id_pl']).'&dd61=del&dd62='.$dd2.'" class="link_lt0">';
			if ($ob == 1) { $ane++; }
			///////////////////////////////////////////
			$chksun = md5($line['id_pl'].$line['pl_tp_doc'].'448545');
			///////////////////////////////////////////
			$chave = 
			$link = 'download.php?dd1='.$line['pl_tp_doc'].'&dd0='.$line['id_pl'].'&dd2='.$chksun;
			$sfl .= '<TR bgcolor="#F0F0F0" ><TD colspan="3">&nbsp;&nbsp;&nbsp;';
			$sfl .= '<A HREF="#" onclick="newxy2('.chr(39).$link.chr(39).',600,400);">';
			$sfl .= '<font color="blue">';
			$sfl .= trim($line['pl_texto']);
			$sfl .= '&nbsp;('.trim($line['pl_type']).')';
			$sfl .= '<TD align="right">';
			$sfl .= $linkd;
			$sfl .= '<font class="link_lt0">';
			$sfl .= '<NOBR>[Excluir arquivo]';
			$sfl .= '</A>';
			}
		$sfl .= '<TR><TD bgcolor="#c0c0c0" height="1" colspan="5"></TD></TR>';
		}
	}
if (strlen($sfl) > 0)
	{
	echo '<CENTER><Font class="lt5">Documentos Anexos</FONT></CENTER>';
	echo '<TABLE width="'.$tab_max.'"  class="lt1" border="0">';
//	echo '<TR>';
//	echo '<TH>Tipo Documento';
//	echo '<TH>Classe';
//	echo '<TH>Modelo';
//	echo '<TH>Ação';
	echo '<BR><BR>';
	echo $sfl;
	if ($obr != $ane)
		{
		echo '<TR><TD colspan="10"><font color="red">Existe documentos que são obrigatórios anexar, '.$ane.' anexados de '.$obr;
		$erro = true;
		}
	echo '</TABLE>';
	}
$sfl = '';
?>

