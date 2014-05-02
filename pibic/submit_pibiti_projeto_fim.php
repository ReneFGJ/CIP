<?
require("cab.php");
require("cab_main.php");
require($include."sisdoc_editor.php");
require($include."sisdoc_search.php");
require($include."sisdoc_autor.php");
require($include."sisdoc_data.php");
require($include."sisdoc_email.php");
require($include."sisdoc_windows.php");

$protocolo = read_cookie("prj_proto");
$email_admin = $emailadmin;
if (strlen($protocolo) == 0)
	{
	redirecina("submit_phase_2_pibiti.php");
	exit;
	}
if ($dd[0] == 'SIM')
	{
	$sql = "select * from ".$tdoc." ";
	$sql .= "where doc_protocolo = '".$protocolo."' ";
	$rlt = db_query($sql);	
	if ($line = db_read($rlt))
		{
		if (trim($line['doc_status']) != '@')
			{ redirecina("resume.php"); }
		
		$titulo = trim($line['doc_1_titulo']);
		$subt   = trim($line['doc_1_subtitulo']);
		$titulo = trim($line['doc_1_subtitulo']);
		$mae   = trim($line['doc_protocolo_mae']);
		$tipo = trim($line['doc_tipo']);
		
		$data_submit = stodbr($line['doc_dt_atualizado']);
		$subt   = '';
		if (strlen($subt) > 0) { $titulo .= ': '.$subt; }
		
		$sql = "update ".$tdoc." set doc_status='@' ";
		$sql .= "where doc_protocolo = '".$protocolo."' ";
		$rlt = db_query($sql);
		}
		if (strlen($mae) > 0)
			{
			setcookie("prj_proto",$mae);
			if ($tipo = '00042') { $redi = 'submit_phase_1_pibiti_sel.php?dd0=00041&dd1='.$mae.'&dd98=3'; }
			if ($tipo = '00043') { $redi = 'submit_phase_1_pibiti_sel.php?dd0=00041&dd1='.$mae.'&dd98=3'; }
			if (strlen($redi) > 0)
				{ redirecina($redi); } else 
				{ echo 'Redirecionamento não localizado '.$tipo; exit; }
			exit;
			}
		redirecina("resume.php");
/////////////////////////////
		require("foot.php");
///////////////////////////////// 		
	} else {
		redirecina("submit_phase_2_pibiti.php");
	}
?>