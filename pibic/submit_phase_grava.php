<?
$prj_nr = read_cookie("prj_nr");

if (strlen($prj_nr) == 0)
	{
		$novo = true;
	} else {
	$sql = "select * from ".$tdoc." where doc_id = '".$prj_nr."' ";
	$rlt = db_query($sql);
	if (!($line = db_read($rlt)))
		{ $novo = true; } 
	}
	
if ($prj_pg==1)
	{
	if ($novo)
		{
//		echo 'ops...novo';
//		exit;
		$doc_id = strtoupper(substr(md5(date("Ymdhis")),0,20));
		$sql = "insert into ".$tdoc." (";
		$sql .= "doc_1_titulo,doc_1_subtitulo,doc_1_idioma,";
		$sql .= "doc_protocolo,doc_data,doc_hora,";
		$sql .= "doc_editor,doc_relator,doc_revisor,";
		$sql .= "doc_diagramador,doc_dt_atualizado,doc_dt_prazo,";
		$sql .= "doc_autor_principal,doc_status,doc_atual,";
		$sql .= "doc_id,doc_tipo,doc_journal_id";
		$sql .= ",doc_protocolo_mae,doc_aluno,doc_ano";
		$sql .= ") values (";
		$sql .= "'".substr($tit,0,200)."','".$subtit."','pt_BR',";
		$sql .= "'',".date("Ymd").",'".date("H:i")."',";
		$sql .= "'','','',";
		$sql .= "'',".date("Ymd").",19000101,";
		$sql .= "'".strzero($id_pesq,7)."','@','".strzero($id_pesq,7)."',";
		$sql .= "'".$doc_id."','".$prj_tp."','".strzero($jid,7)."'";
		$sql .= ",'".$nrproj."','".$aluno."','".date("Y")."'";
		$sql .= ");";
		echo $sql;
		$rlt = db_query($sql);
		
		$sql = "update ".$tdoc." set doc_protocolo=trim(to_char(id_doc,'".strzero(0,7)."')) ";
		$sql .= " where (length(trim(doc_protocolo)) < 7) or (doc_protocolo isnull);";
		$rlt = db_query($sql);	
	
		setcookie("prj_nr",$doc_id,time()+60*60*60);
		
		$prj_nr = $doc_id;
		/////////////////////////////qq incluir em todos ##00##
		} else {
			if (strlen($tit) > 0)
				{
				$sql = "update ".$tdoc." set doc_1_titulo = '".substr($tit,0,200)."' ";
				$sql .= ", doc_journal_id ='".strzero($jid,7)."'";
				$sql .= ", doc_protocolo_mae ='".$nrproj."'";
				$sql .= ", doc_aluno ='".$aluno."'";
				$sql .= " where doc_protocolo = '".$protocolo."'";
				$rlt = db_query($sql);	
				}
		}
		if (strlen($autores) > 0)
			{
			require("submit_phase_author_save.php");
			}
	}
	///////////////////////////////////////////////////////////////////////////////
	$sql = "select * from ".$tdoc." where doc_id = '".$prj_nr."' ";
	$rlt = db_query($sql);
	if ($line = db_read($rlt))
		{ $protocolo = $line['doc_protocolo']; }	
	setcookie("prj_proto",$protocolo,time()+60*60*60);

	////////////////////////////////////////////////////////////////////////////////qq
	$sql = "delete from ".$tdov." where spc_pagina = '".strzero($prj_pg,3)."' ";
	$sql .= " and spc_projeto = '".$protocolo."' ";
	$sql .= " and spc_autor = '".strzero($id_pesq,7)."' ";
	$rlt = db_query($sql);
	
	$xsql = '';
	for ($k=0;$k < count($cops);$k++)
		{
		$xsql .= "insert into ".$tdov." ";
		$xsql .= "(spc_codigo,spc_projeto,spc_content,";
		$xsql .= "spc_pagina,spc_autor,spc_ativo) ";
		$xsql .= " values ";
		$xsql .= "('".$cops[$k][0]."','".$protocolo."','".$dd[$k]."',";
		$xsql .= "'".strzero($prj_pg,3)."','".strzero($id_pesq,7)."','1');".chr(13).chr(10);
		}

	if (strlen($xsql) > 0)
		{
		$rlt = db_query($xsql);
		}
	$sql .= '';
?>