<?
require("cab.php");
global $prj_tp;

setcookie("prj_nr",'',time()+60*60*60);
if (strlen($dd[0]) > 0)
	{
	setcookie("prj_tipo",$dd[0],time()+60*60*60);
	}
	
if (strlen($dd[98]) > 0)
	{
	setcookie("prj_page",$dd[98],time()+60*60*60);
	$prj_pg = $dd[98];
	}
	
if (strlen($dd[1]) > 0)
	{
	$sql = "select * from ".$tdoc." ";
	$sql .= " where doc_protocolo = '".$dd[1]."' ";
	$rlt = db_query($sql);
	if ($line = db_read($rlt))
		{
		setcookie("prj_nr",$line['doc_id'],time()+60*60*60);
		setcookie("prj_proto",$dd[1],time()+60*60*60);
		$protocolo = $dd[1];	
		}
	}
redirecina("submit_phase_2_pibic.php");
?>