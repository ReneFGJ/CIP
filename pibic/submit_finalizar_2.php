<?
require("cab.php");
require("cab_main.php");
require($include."sisdoc_editor.php");
require($include."sisdoc_search.php");
require($include."sisdoc_autor.php");
require($include."sisdoc_colunas.php");
require($include."sisdoc_data.php");
require($include."sisdoc_email.php");
require($include."sisdoc_windows.php");
$ed_acao = False;

$protocolo = read_cookie("prj_proto");
$email_admin = $emailadmin;
if (strlen($protocolo) == 0)
	{
	redirecina("submit_phase_2.php");
	exit;
	}
	
/////////////////////////////// CONFIRMA GRAVAçÂO E DECLARAçÂO	
if ($dd[0] == 'SIM')
	{
	$sql = "select * from ".$tdoc." ";
	$sql .= "where doc_protocolo = '".$protocolo."' ";
	$rlt = db_query($sql);	
	if ($line = db_read($rlt))
		{
		if (trim($line['doc_status']) != '@')
			{ redirecina("main.php"); }
		
		if ($line['doc_tipo'] == '00015')
			{
			$titulo = trim($line['doc_1_titulo']);
			$subt   = trim($line['doc_1_subtitulo']);
			$titulo = trim($line['doc_1_subtitulo']);
			$data_submit = stodbr($line['doc_dt_atualizado']);
			$subt   = '';
			if (strlen($subt) > 0) { $titulo .= ': '.$subt; }
			}
		}
	/////////////////////////////
		require("submit_pibic_resumo.php");
		$sresumo = $sr;;
	/////////////////////////////
		$sql = "select * from ".$ic_noticia." where nw_ref = '".$id_ic."_FIM_1'";
		$sql .= "and nw_journal = ".$jid;
		$rrr = db_query($sql);
		if ($eline = db_read($rrr))
		{
			$sC = $eline['nw_titulo'];
			$texto = $eline['nw_descricao'];
			echo '</form>';
			echo '<TABLE width="'.$tab_max.'" align="center" class="lt1">';
			echo '<TR><TD class="lt0">Controle';
			echo '<TR><TD class="lt2"><B>';
			echo $protocolo;
			echo '<TR><TD class="lt0">Título do projeto';
			echo '<TR><TD class="lt2"><B>';
			echo $titulo;
			echo '<TR><TD>';
			
			//////////////////////// TROCA
			$texto = troca($texto,'dd/mm/yyyy',date("d/m/Y"));
			$texto = troca($texto,'hh:mm',date("H:i"));
			
			echo mst($texto);
			$texto_proto = $texto;
			
			echo '<TR><TD>';
			echo $sresumo;
			echo '</TABLE>';
		} else {
			echo $id_ic."_FIM_1";
		}
	////////////////////////qq e-mail
	//	$sql = "select * from ".$ic_noticia." where nw_ref = '".$id_ic."_FIM_1'";
	//	$rrr = db_query($sql);
	//	if ($eline = db_read($rrr))
	//		{
	//		$sC = $eline['nw_titulo'];
	//		$texto = $eline['nw_descricao'];
	//
	//////////////////////////qq e-mail
		$autor = strzero($id_pesq,7);
		$list_email = array();
		$sql = "select * from pibic_professor where pp_cracha = '".$autor."' ";
		$rlt = db_query($sql);
		$email_admin = "pibicpr@pucpr.br";
		array_push($list_email,'monitoramento@sisdoc.com.br');
		array_push($list_email,$email_admin);
		while ($line = db_read($rlt))
			{
				$email1 = trim($line['pp_email']);
				$email2 = trim($line['pp_email_1']);
				if (strlen($email1) > 0) { array_push($list_email,$email1); }
				if (strlen($email2) > 0) { array_push($list_email,$email2); }
			}
		$email = $email_admin;

		$texto2 = '<BR>Titulo:'.$titulo;
		$texto2 .= '<BR>Controle:'.$protocolo;
		$texto .= $sresumo;
		$texto = $texto2 .'<BR><BR>'.chr(13).chr(13). $texto;

//		echo '<font class="lt2">Foi enviado um e-mail para :<B>';
		for ($k=0;$k < count($list_email);$k++)
			{
				enviaremail($list_email[$k],$email_admin,'[Projeto PIBIC enviado]',$texto);
//				echo $list_email[$k].' ';
			}
		echo '</B>';
			
		$sql = "update ".$tdoc." set doc_status='A', doc_edital = 'PIBIC' ";
		$sql .= "where ((doc_protocolo = '".$protocolo."') ";
		$sql .= "or doc_protocolo_mae = '".$protocolo."') and doc_status='@' ";
		/////////////////// GRAVA E ATUALIZA BASE
		$rlt = db_query($sql);
				
		require("foot.php");
	///////////////////////////////// 		
	} else {
		redirecina("submit_phase_2.php");
	}
?>