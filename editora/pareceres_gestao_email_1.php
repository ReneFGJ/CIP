<? ob_start(); ?>
<?
global $nocab;
require('db.php');
require($include.'sisdoc_security.php');
require($include."sisdoc_colunas.php");
require($include."sisdoc_form2.php");
require($include."sisdoc_windows.php");
require($include."sisdoc_email.php");
require($include."sisdoc_data.php");
require($include."cp2_gravar.php");
require($include."sisdoc_security_post.php");
security();

$journal_id = read_cookie("journal_id");
$journal_title = read_cookie("journal_title");
$jid = intval($journal_id);
		
	$sql = "select * from reol_parecer_enviado ";
	$sql .= "left join pareceristas on pp_avaliador = us_codigo ";
	$sql .= "inner join submit_documento on pp_protocolo = doc_protocolo ";
	$sql .= "where doc_journal_id = '".strzero($dd[1],7)."' ";
	$sql .= " and us_codigo = '".$dd[0]."' ";
	$sql .= " and pp_status = 'I' ";
	$sql .= " order by us_nome ";
	$rlt = db_query($sql);
	$to = 0;
	$linkp = '';
	$http_site = 'http://www2.pucpr.br/reol/editora/';
	while ($line = db_read($rlt))
		{
		$to++;
//		print_r($line);
//		echo '<HR>';
		$links = '';
		$autor_email = trim($line['us_email']);
		$autor_email_alt = trim($line['us_email']);
		$nome = trim($line['us_nome']);
		$linkp .= '<TT>Protocolo '.$line['pp_protocolo'].'</B>, indicado em '.stodbr($line['pp_data']).'<BR>';
		$linkp .= trim($line['doc_1_titulo']);
		$linkp .= '<BR>Link para avaliação:';
		
				$parecer = $line['id_pp'];
				$id_par = $line['us_codigo'];
				/////////////////////////////////////////////////////////////////////////////////////////////////	
				$lk = $http_site.'avaliador_parecer.php?dd0='.$parecer.'&dd1='.p($parecer.$id_par).'&dd2='.$id_par;
				$linkp .= '<A HREF="'.$lk.'" target="newx">';
				$linkp .= '<font class="lt1"><B>';
				$linkp .= $lk;
				$linkp .= '</B></A>'.$nl;
				
		$linkp .= '</TT><BR><HR>';
		}

		
///////
if ((strlen($dd[6]) == 0) and (strlen($dd[5]) > 0))
	{
		$textoa = $dd[5];
		$sql = "select * from ic_noticia where nw_ref = '".$dd[5]."' ";
		$sql .= " and nw_journal = ".$jid;
		$rrlt = db_query($sql);
		if ($rline = db_read($rrlt))
			{
				$textoa = $rline['nw_descricao'];
			} else {
				$sql = "select * from ic_noticia where nw_ref = '".$dd[5]."' order by nw_journal ";
				$rrlt = db_query($sql);
				if ($rline = db_read($rrlt))
					{
						$textoa = $rline['nw_descricao'];
					}
			}
		$dd[6] = $textoa;
	}

$cp = array();
$opc .= '&AVA_MSG1:Aviso de avaliações (aviso)';
$opc .= '&AVA_MSG2:Aviso de avaliações (mensagem moderada)';
$opc .= '&AVA_MSG3:Aviso de avaliações (mensagem rigida)';
$opc .= '&AVA_MSG4:Aviso de avaliações (mensagem intimidatória)';

array_push($cp,array('$H4','','',False,True,''));
array_push($cp,array('$H4','','',False,True,''));
array_push($cp,array('$H4','','',False,True,''));
array_push($cp,array('$H4','','',False,True,''));
array_push($cp,array('$A8','','Indicaçções não avaliadas ('.$to.')',False,False,''));
array_push($cp,array('$O : '.$opc,'','Mensagem padrão',True,False,''));
array_push($cp,array('$T40:5','','Texto',True,False,''));
array_push($cp,array('$O : &SIM:SIM','','Confirmar envio',True,False,''));

	?><TABLE width="<?=$tab_max?>" align="center"><TR><TD><?
	editar();
	?></TD></TR></TABLE><?	
	

////////////////////////////////// Enviar o e-mail
if ($saved > 0)
	{
	$sql = "select * from journals where journal_id = ".$jid;
	$rlt = db_query($sql);
	$line = db_read($rlt);
	$jid_titulo = $line['title'];
	$jid_editor = $line['assinatura'];
	$admin_nome = $line['title'];
	$email_adm = $line['jn_email]'];

	$textoa = $dd[6];
	require('subm_email_2.php');
	echo '<HR>Mensagem enviada<HR>';
	echo $textoa;
	}
?>