<?
require("cab.php");
	require($include.'sisdoc_colunas.php');
	require($include.'sisdoc_form2.php');
	require($include.'sisdoc_data.php');
	require($include.'sisdoc_email.php');	
	require($include.'sisdoc_debug.php');
	require($include.'cp2_gravar.php');
	
	
//$sql = "update pareceristas set us_aceito = 9 where (us_aceito= 2 or us_aceito = 3)";
//$rlt = db_query($sql);

	$tabela = "";
	$cp = array();
	//$dd[4] = '19000101';
	if (strlen($dd[1]) == 0) { $dd[1] = 'PAR_CONVITE_EXT'; }
	array_push($cp,array('$H4','','',False,False,''));
	array_push($cp,array('$S12','','Ref. do texto',True,True,''));
	array_push($cp,array('$O 0:Teste na tela (não envia para os parecerista)&2:Teste para o e-mail abaixo (não envia para os parecerista)&1:Confirmar envio','','Tipo',True,True,''));
	array_push($cp,array('$S100','','e-mail para teste',False,True,''));
	?><TABLE width="<?=$tab_max?>" align="center"><TR><TD><?
	editar();
	?></TD></TR></TABLE><?
	if ($saved > 0)
		{
		$sql = "update pareceristas set us_aceito = 9 where ";
		$sql .= " us_journal_id = '".$jid."' ";
		$sql .= " and (us_aceito =0 ) ";
		//echo 'HR>'.$sql.'<HR>';
		//$rlt = db_query($sql);			
			
		$sql = "select * from ic_noticia ";
		$sql .= " where nw_journal = '".intval($jid)."' ";
		$sql .= " and nw_ref = '".trim($dd[1])."' ";

		$rlt = db_query($sql);
		if ($line = db_read($rlt))
			{
			$titulo = $line['nw_titulo'];
			$texto = troca($line['nw_descricao'],chr(13),'¢');
			$texto_original = troca($texto,'¢','<BR>'.chr(13));		
			
			$sql = "select * from pareceristas  ";
			$sql .= "inner join instituicoes on us_instituicao = inst_codigo ";
			$sql .= " and us_journal_id = '".intval($jid)."' ";
			$sql .= " where us_aceito = 9 ";
			$sql .= " and us_ativo = 1 ";
			$rlt = db_query($sql);
			while ($line = db_read($rlt))
				{
				$nome = trim($line['us_titulacao'].' '.$line['us_nome']);
				$instituicao = trim($line['inst_nome']).' ('.trim($line['inst_abreviatura']).')';
				$email_1 = trim($line['us_email']);
				$email_2 = trim($line['us_email_alternativo']);

				$isql = "select * from pareceristas_area ";
				$isql .= "inner join pareceristas on us_codigo = pa_parecerista ";
				$isql .= "inner join ajax_areadoconhecimento on a_codigo = pa_area ";
				$isql .= " where id_us = ".$line['id_us'];
				$isql .= " and us_ativo = 1 ";
				$irlt = db_query($isql);
				$area = '';
				while ($iline = db_read($irlt))
					{
					$area .= $iline['a_cnpq'];
					$area .= '<B>';
					$area .= $iline['a_descricao'];
					$area .= '</B><BR>'.chr(13).chr(10);
					}
//				$link = '<A HREF="http://www2.pucpr.br/reol/pibicpr/parecerista_resposta.php?dd0='.$line['id_us'];
//				$link .= '&dd1='.substr(md5($line['id_us'].$secu),0,8);
//				$link .= '" target="new"><font color=blue>Link para responder este e-mail</A>'.chr(13).chr(10).'<BR>';
//				$link .= 'http://www2.pucpr.br/reol/pibicpr/parecerista_resposta.php?dd0='.$line['id_us'];
//				$link .= '&dd1='.substr(md5($line['id_us'].$secu),0,8);
//				$link .= '</font></A>';
				
				$http = 'http://'.$_SERVER['HTTP_HOST'];
				$chk = substr(md5('pibic'.date("Y").$line['us_codigo']),0,10);
				$link = $http.'/reol/avaliador/acesso.php?dd0='.$line['us_codigo'].'&dd1=1&dd90='.$chk;
				$link = '<A HREF="'.$link.'" target="new">'.$link."</A>";
				
				
				$texto = troca($texto_original,'$nome',$nome);
				$texto = troca($texto,'$instituicao',$instituicao);
				$texto = troca($texto,'$area',''.$area);
				$texto = troca($texto,'$http',$link);
				
				echo mst($texto);
				exit;
				
				//require("parecerista_enviar_email.php");
				}
			if ($dd[2] == '1')
			{
				$sql = "update pareceristas set us_aceito = 19 where us_aceito = 9 ";
				$rlt = db_query($sql);
			}
			} else {
				echo $sql;
				echo '<font color="red">Nenhum nome localizado para envio</font>';
			}
		
		}
?>
</TABLE></FORM>
<? require("foot.php");	?>