<?php
class pibic_projetos
	{
		var $protocolo;
		var $status;
		var $titulo='';
		
		var $plano_pibic = 0;
		var $plano_pibiti = 0;
		var $plano_pibic_em = 0;
		
		var $ano;
		var $resumo;
		var $objetivo;
		var $keywords;
		var $area;
		var $update;
		var $data;
		var $ss_programa;
		
		var $rst;	
		
		var $erros;
		var $tabela = "pibic_projetos";
		
	function alterar_estatus_para_indicado()
		{
			$sql = "
						select * from ".$this->tabela." 
							inner join pibic_submit_documento on (pj_codigo =  doc_protocolo_mae) and (doc_status <> 'X' and doc_status <> 'X')
							where pj_ano = '".date("Y")."' and (pj_status <> 'X' and pj_status <> '@') 	
						";
			$rlt = db_query($sql);
			while ($line = db_read($rlt))
				{
					$sta = trim($line['pj_status']);
					$stb = trim($line['doc_status']);
					$proto = $line['doc_protocolo'];
					if ($sta != $stb)
						{
							$sql = "update pibic_submit_documento set doc_status = '".$sta."' where doc_protocolo = '".$proto."' ";
							$rrr = db_query($sql);
						}
					
					
				}
						
			$sql = "
					select * from ".$this->tabela." left join (
					select count(*) as total, pp_protocolo from pibic_parecer_".date("Y")." 
					where (pp_status <> 'D' and pp_status <> 'X') and (pp_tipo = 'SUBMI')
					group by pp_protocolo 
					) as tabela on pp_protocolo = pj_codigo
					where pj_status <> 'X' and pj_status <> '@'
					";
			//$sql = "select * from pibic_parecer_".date("Y")." limit 1";
			$rlt = db_query($sql);
			while ($line = db_read($rlt))
				{
					$total = $line['total'];
					$status = $line['pj_status'];
					$proto = $line['pj_codigo'];
					//echo '<BR>'.$protp.'-'.$status.'-'.$total;
					if (($status == 'C') and ($total >= 2))
						{
							$sql = "update ".$this->tabela." set pj_status ='D' where id_pj = ".$line['id_pj'];
							$rrr = db_query($sql);
						}					
					if (($status == 'D') and ($total < 2))
						{
							$sql = "update ".$this->tabela." set pj_status ='C' where id_pj = ".$line['id_pj'];
							$rrr = db_query($sql);
							echo '<BR>'.$sql;							
						}
				}
		}
		
	function razao_submissao_planos_indicar($data,$status='@')
		{
			if ($status == 'C')
				{
					/* Alterar no sistema para indicados */
					$this->alterar_estatus_para_indicado();
				}
				$wh = "
				where pj_ano = '".date("Y")."'
					and ((doc_status = '$status') 
					or (pj_status = '$status')) and doc_status <> 'X' ";

			/* pj_professor */
			$sql = "select * from pibic_submit_documento 
				left join ".$this->tabela." on pj_codigo = doc_protocolo_mae
				left join pibic_professor on doc_autor_principal = pp_cracha
				".$wh;
			if (strlen($edital) > 0) { $sql .= " and doc_edital = '$edital' "; }
			$sql .= "
				order by pp_centro, pp_nome, doc_edital, pj_codigo, doc_protocolo
			";
			$rlt = db_query($sql);
			$sx = '<table width="100%" class="tabela00">';
			$xcentro = "X";
			$xnome = "X";
			$idt = 0;
			$tot0 = 0;
			while ($line = db_read($rlt))
				{
					$idt++;
					$centro = trim($line['pp_centro']);
					$nome = trim($line['pp_nome']);
					$professor = trim($line['doc_autor_principal']);
					$prefessor_pj = trim($line['pj_professor']);
					$status = trim($line['doc_status']);
				
					if (strlen($professor)==0)
						{
							$sql = "update pibic_submit_documento set 
								doc_autor_principal = '".$prefessor_pj."'
								where id_doc = ".$line['id_doc'];
							//echo $sql;
							$rrr = db_query($sql);
							//print_r($line);
							//exit;
						}
					
					if ($centro != $xcentro)
						{
						if ($tot0 > 0)
							{
							$sx .= '<TR><TD colspan=10 class="lt0">';
							$sx .= 'Total no centro '.$tot0;		
							}
						$sx .= '<TR><TD colspan=10 class="lt4">';
						$sx .= trim($line['pp_centro']);
						$xcentro = $centro;
						$tot0 = 0;
						//print_r($line);
						}
					if ($nome != $xnome)
						{
						$sx .= '<TR>
									<TD>&nbsp;&nbsp;
									<TD colspan=9 class="lt3">';
						$sx .= $nome;
						$xnome = $nome;
						}
					if ($status == '@') { $cor = '<font color="green">'; $status = 'Em submiss�o'; }
					if ($status == 'B') { $cor = '<font color="black">'; $status = 'Conclu�do'; }
					if ($status == 'C') { $cor = '<font color="black">'; $status = 'Aceito'; }
					if ($status == 'D') { $cor = '<font color="black">'; $status = 'Finalizado'; }
					if ($status == 'P') { $cor = '<font color="red">'; $status = 'Problemas Coordena��o'; }
					if ($status == 'T') { $cor = '<font color="red">'; $status = 'Problemas com a TI'; }
					if ($status == 'X') { $cor = '<font color="red">'; $status = 'Cancelado'; }
					
					$id = $line['id_pj'];
					$link = '<A HREF="pibic_projetos_detalhes.php?dd0='.$id.'&dd90='.checkpost($id).'" target="_new" class="link2">';
					
					$sx .= '<TR>
							<TD colspan=2>&nbsp;&nbsp;&nbsp;&nbsp;';
					$sx .= '<TD class="tabela01">'.$cor.trim($line['doc_edital']).'</font>';
					$sx .= '<TD class="tabela01">'.$link.trim($line['pj_codigo']).'</A>';
					$sx .= '<TD class="tabela01">'.$cor.trim($line['doc_protocolo']).'</font>';
					$sx .= '<TD class="tabela01">'.$cor.trim($line['doc_1_titulo']).'</font>';
					$sx .= '<TD class="tabela01">'.$cor.$status.'</font>';
					$sx .= '<TD class="tabela01">'.$cor.stodbr($line['doc_data']).'</font>';
					$sx .= '<TD class="tabela01">'.$cor.trim($line['pj_professor']).'</font>';
					$tot0++;
					
				}
			if ($tot0 > 0)
				{
					$sx .= '<TR><TD colspan=10 class="lt0">';
					$sx .= 'Total no centro '.$tot0;		
				}
			$sx .= '<TR><TD colspan=10>'.$idt.' total de planos';
			$sx .= '</table>';
			return($sx);			
		}
		
	function resumo_planos_area($ano='2013',$edital = '',$status='B')
		{
			/* pj_professor */
			$ano = date("Y");
			$cp = 'pj_area, doc_edital, a_descricao';
			$sql = "select count(*) as total, $cp from ".$this->tabela.' ';
			$sql .= "left join pibic_professor on pj_professor = pp_cracha "; 

			$sql .= "inner join pibic_submit_documento on pj_codigo = doc_protocolo_mae
						left join centro on pp_escola = centro_codigo
						left join ajax_areadoconhecimento on a_cnpq = pj_area
				where (pj_ano = '".date("Y")."') 
					and (doc_status <> 'X' and doc_status <> '@') 
					";
			$sql .= "group by $cp
						order by pj_area, doc_edital ";
			$rlt = db_query($sql);
			
			$campi = array();
			$total = array(0,0,0,0);
			$result = array();
			
			while ($line = db_read($rlt))
			{
				$campus = trim($line['pj_area']). ' '.trim($line['a_descricao']);
				$modalidade = UpperCaseSql(trim($line['doc_edital']));
				$tot = $line['total'];
				if (!(in_array($campus,$campi)))
					{
						array_push($campi,$campus);
						array_push($result,$total);
						$pos = array_search($campus,$campi);		
					} else {
						$pos = array_search($campus,$campi);
					}
				$xpos = 0;
				if ($modalidade == 'PIBIC') { $xpos = 1; }
				if ($modalidade == 'PIBITI') { $xpos = 2; }
				if ($modalidade == 'PIBICE') { $xpos = 3; }
				
				$result[$pos][$xpos] = $result[$pos][$xpos] + $tot; 
			}
			$sx .= '<h1>Planos de Alunos</h1>';
			$sx .= '<table class="tabela00">';
			$sx .= '<TR><TH width="350">�rea do conhecimento
						<TH width="80">PIBIC
						<TH width="80">PIBITI
						<TH width="80">PIBIC_EM
						<TH width="80">Total';
			for ($r=0;$r < count($campi);$r++)
				{
					$sx .= '<TR>';
					$sx .= '<TD class="tabela01">'.$campi[$r];
					$toti = 0;
					for ($y=1;$y < count($result[$r]);$y++)
						{
							$toti = $toti + $result[$r][$y];
							$sx .= '<TD class="tabela01 lt3" align="center">';
							$sx .= $result[$r][$y];
							$total[$y] = $total[$y] + $result[$r][$y];
						}
					$total[4] = $total[4] + $toti;
					$sx .= '<TD class="tabela01 lt3" align="center">';
					$sx .= $toti;
				}
			$sx .= '<TR class="lt3"><TD align="right"><B>Totais</B>';
			$sx .= '<TD align="center"><B>'.$total[1].'</B>';
			$sx .= '<TD align="center"><B>'.$total[2].'</B>';
			$sx .= '<TD align="center"><B>'.$total[3].'</B>';
			$sx .= '<TD align="center"><B>'.$total[4].'</B>';
			$sx .= '</table>';
			return($sx);
		}
		
	function resumo_projetos_area($ano='2013',$edital = '',$status='B')
		{
			/* pj_professor */
			$ano = date("Y");
			$cp = 'pj_area, a_descricao';
			$sql = "select count(*) as total, $cp from ".$this->tabela.' ';
			$sql .= "left join pibic_professor on pj_professor = pp_cracha "; 
			$sql .= "left join centro on pp_escola = centro_codigo
					 left join ajax_areadoconhecimento on a_cnpq = pj_area
				where (pj_status <> 'X' and pj_status <> '@') and pj_ano = '$ano' ";
			$sql .= "group by $cp
						order by pj_area ";
			$rlt = db_query($sql);
			
			$campi = array();
			$total = array(0,0,0,0);
			$result = array();
			$xarea = 0;
			$xtotal = 0;
			while ($line = db_read($rlt))
			{
				$area = substr($line['a_cnpq'],0,1);
				$campus = trim($line['pj_area']). ' '.trim($line['a_descricao']);
				$modalidade = UpperCaseSql(trim($line['doc_edital']));
				$modalidade = 'PIBIC';
				$tot = $line['total'];
				if (!(in_array($campus,$campi)))
					{
						array_push($campi,$campus);
						array_push($result,$total);
						$pos = array_search($campus,$campi);		
					} else {
						$pos = array_search($campus,$campi);
					}
				$xpos = 0;
				if ($modalidade == 'PIBIC') { $xpos = 1; }
				if ($modalidade == 'PIBITI') { $xpos = 2; }
				if ($modalidade == 'PIBICE') { $xpos = 3; }
				
				$result[$pos][$xpos] = $result[$pos][$xpos] + $tot; 
			}
			$sx .= '<h1>Projetos do Professor</h1>';
			$sx .= '<table class="tabela00">';
			$sx .= '<TR><TH width="350">�rea do conhecimento
						<TH width="80">PIBIC
						<TH width="80">PIBITI
						<TH width="80">PIBIC_EM
						<TH width="80">Total';
			for ($r=0;$r < count($campi);$r++)
				{
					$sx .= '<TR>';
					$sx .= '<TD class="tabela01">'.$campi[$r];
					$toti = 0;
					for ($y=1;$y < count($result[$r]);$y++)
						{
							$toti = $toti + $result[$r][$y];
							$sx .= '<TD class="tabela01 lt3" align="center">';
							$sx .= $result[$r][$y];
							$total[$y] = $total[$y] + $result[$r][$y];
						}
					$total[4] = $total[4] + $toti;
					$sx .= '<TD class="tabela01 lt3" align="center">';
					$sx .= $toti;
				}
			$sx .= '<TR class="lt3"><TD align="right"><B>Totais</B>';
			$sx .= '<TD align="center"><B>'.$total[1].'</B>';
			$sx .= '<TD align="center"><B>'.$total[2].'</B>';
			$sx .= '<TD align="center"><B>'.$total[3].'</B>';
			$sx .= '<TD align="center"><B>'.$total[4].'</B>';
			$sx .= '</table>';
			return($sx);
		}

	function resumo_planos_area_estrategica($ano='2013',$edital = '',$status='B')
		{
			/* pj_professor */
			$ano = date("Y");
			$cp = 'pj_area_estra, doc_edital, a_descricao';
			$sql = "select count(*) as total, $cp from ".$this->tabela.' ';
			$sql .= "left join pibic_professor on pj_professor = pp_cracha "; 

			$sql .= "inner join pibic_submit_documento on pj_codigo = doc_protocolo_mae
						left join centro on pp_escola = centro_codigo
						left join ajax_areadoconhecimento on a_cnpq = pj_area_estra
				where (doc_ano = '".date("Y")."') 
					and (doc_status = 'B' or doc_status = 'C' or doc_status = 'D') 
					and (pj_status = 'B' or pj_status = 'C' or pj_status = 'D') ";
			$sql .= "group by $cp
						order by pj_area_estra, doc_edital ";
						
			$rlt = db_query($sql);
			
			$campi = array();
			$total = array(0,0,0,0);
			$result = array();
			
			while ($line = db_read($rlt))
			{
				$campus = trim($line['pj_area_estra']). ' '.trim($line['a_descricao']);
				$modalidade = UpperCaseSql(trim($line['doc_edital']));
				$tot = $line['total'];
				if (!(in_array($campus,$campi)))
					{
						array_push($campi,$campus);
						array_push($result,$total);
						$pos = array_search($campus,$campi);		
					} else {
						$pos = array_search($campus,$campi);
					}
				$xpos = 0;
				if ($modalidade == 'PIBIC') { $xpos = 1; }
				if ($modalidade == 'PIBITI') { $xpos = 2; }
				if ($modalidade == 'PIBICE') { $xpos = 3; }
				
				$result[$pos][$xpos] = $result[$pos][$xpos] + $tot; 
			}
			
			$sx .= '<table class="tabela00">';
			$sx .= '<TR><TH width="350">�rea do conhecimento
						<TH width="80">PIBIC
						<TH width="80">PIBITI
						<TH width="80">PIBIC_EM
						<TH width="80">Total';
			for ($r=0;$r < count($campi);$r++)
				{
					$sx .= '<TR>';
					$sx .= '<TD class="tabela01">'.$campi[$r];
					$toti = 0;
					for ($y=1;$y < count($result[$r]);$y++)
						{
							$toti = $toti + $result[$r][$y];
							$sx .= '<TD class="tabela01 lt3" align="center">';
							$sx .= $result[$r][$y];
							$total[$y] = $total[$y] + $result[$r][$y];
						}
					$total[4] = $total[4] + $toti;
					$sx .= '<TD class="tabela01 lt3" align="center">';
					$sx .= $toti;
				}
			$sx .= '<TR class="lt3"><TD align="right"><B>Totais</B>';
			$sx .= '<TD align="center"><B>'.$total[1].'</B>';
			$sx .= '<TD align="center"><B>'.$total[2].'</B>';
			$sx .= '<TD align="center"><B>'.$total[3].'</B>';
			$sx .= '<TD align="center"><B>'.$total[4].'</B>';
			$sx .= '</table>';
			return($sx);
		}
		
	function projeto_devolver_para_edicao()
		{
			
		}
		
	function razao_submissao_planos($ano,$edital = '',$status='B')
		{
			if ($status=='B')
			{
				$wh = "
				where pj_ano = '".date("Y")."'
					and (doc_status = 'B' or doc_status = 'C' or doc_status = 'D') 
					and (pj_status = 'B' or pj_status = 'C' or pj_status = 'D') ";
			}
			if ($status=='@')
			{
				$wh = "
				where pj_ano = '".date("Y")."'
					and (doc_status = '@' or doc_status = 'A') 
					and (pj_status = '@' or pj_status = 'A') ";
			}			
			/* pj_professor */
			$sql = "select * from pibic_submit_documento 
				left join ".$this->tabela." on pj_codigo = doc_protocolo_mae
				left join pibic_professor on doc_autor_principal = pp_cracha
				".$wh;
			if (strlen($edital) > 0) { $sql .= " and doc_edital = '$edital' "; }
			$sql .= "
				order by pp_centro, pp_nome, doc_edital, pj_codigo, doc_protocolo
			";
			$rlt = db_query($sql);
			
			$sx = '<table width="100%" class="tabela00">';
			$xcentro = "X";
			$xnome = "X";
			$id = 0;
			$tot0 = 0;
			while ($line = db_read($rlt))
				{
					$id++;
					$centro = trim($line['pp_centro']);
					$nome = trim($line['pp_nome']);
					$professor = trim($line['doc_autor_principal']);
					$prefessor_pj = trim($line['pj_professor']);
					$status = trim($line['doc_status']);
				
					if (strlen($professor)==0)
						{
							$sql = "update pibic_submit_documento set 
								doc_autor_principal = '".$prefessor_pj."'
								where id_doc = ".$line['id_doc'];
							//echo $sql;
							$rrr = db_query($sql);
							//print_r($line);
							//exit;
						}
					
					if ($centro != $xcentro)
						{
						if ($tot0 > 0)
							{
							$sx .= '<TR><TD colspan=10 class="lt0">';
							$sx .= 'Total no centro '.$tot0;		
							}
						$sx .= '<TR><TD colspan=10 class="lt4">';
						$sx .= trim($line['pp_centro']);
						$xcentro = $centro;
						$tot0 = 0;
						//print_r($line);
						}
					if ($nome != $xnome)
						{
						$sx .= '<TR>
									<TD>&nbsp;&nbsp;
									<TD colspan=9 class="lt3">';
						$sx .= $nome;
						$xnome = $nome;
						}
					if ($status == '@') { $cor = '<font color="green">'; $status = 'Em submiss�o'; }
					if ($status == 'B') { $cor = '<font color="black">'; $status = 'Conclu�do'; }
					if ($status == 'X') { $cor = '<font color="red">'; $status = 'Cancelado'; }
					
					$id = $line['id_pj'];
					$link = '<A HREF="pibic_projetos_detalhes.php?dd0='.$id.'&dd90='.checkpost($id).'" target="_new" class="link2">';
					$sx .= '<TR>
							<TD colspan=2>&nbsp;&nbsp;&nbsp;&nbsp;';
					$sx .= '<TD class="tabela01">'.$cor.trim($line['doc_edital']).'</font>';
					$sx .= '<TD class="tabela01">'.$cor.trim($line['pj_codigo']).'</font>';
					$sx .= '<TD class="tabela01">'.$link.$cor.trim($line['doc_protocolo']).'</A></font>';
					$sx .= '<TD class="tabela01">'.$cor.trim($line['doc_1_titulo']).'</font>';
					$sx .= '<TD class="tabela01">'.$cor.$status.'</font>';
					$sx .= '<TD class="tabela01">'.$cor.stodbr($line['doc_data']).'</font>';
					$sx .= '<TD class="tabela01">'.$cor.trim($line['pj_professor']).'</font>';
					$tot0++;
					
				}
			if ($tot0 > 0)
				{
					$sx .= '<TR><TD colspan=10 class="lt0">';
					$sx .= 'Total no centro '.$tot0;		
				}
			$sx .= '<TR><TD colspan=10>'.$id.' total de planos';
			$sx .= '</table>';
			return($sx);
		}
		
	function resumo_planos_campi()
		{ 
			/* pj_professor */
			$ano = date("Y");
			$cp = 'pp_centro, doc_edital';
			$sql = "select count(*) as total, $cp from ".$this->tabela.' ';
			$sql .= "left join pibic_professor on pj_professor = pp_cracha "; 

			$sql .= "inner join pibic_submit_documento on pj_codigo = doc_protocolo_mae
						left join centro on pp_escola = centro_codigo
				where (doc_ano = '".date("Y")."') 
					and (doc_status = 'B' or doc_status = 'C' or doc_status = 'D') 
					and (pj_status = 'B' or pj_status = 'C' or pj_status = 'D') ";
			$sql .= "group by $cp
						order by pp_centro ";
						
			$rlt = db_query($sql);
			
			$campi = array();
			$total = array(0,0,0,0);
			$result = array();
			
			while ($line = db_read($rlt))
			{
				$campus = trim($line['pp_centro']);
				$modalidade = UpperCaseSql(trim($line['doc_edital']));
				$tot = $line['total'];
				if (!(in_array($campus,$campi)))
					{
						array_push($campi,$campus);
						array_push($result,$total);
						$pos = array_search($campus,$campi);		
					} else {
						$pos = array_search($campus,$campi);
					}
				$xpos = 0;
				if ($modalidade == 'PIBIC') { $xpos = 1; }
				if ($modalidade == 'PIBITI') { $xpos = 2; }
				if ($modalidade == 'PIBICE') { $xpos = 3; }
				
				$result[$pos][$xpos] = $result[$pos][$xpos] + $tot; 
			}
			
			$sx .= '<table class="tabela00">';
			$sx .= '<TR><TH width="150">Campus
						<TH width="80">PIBIC
						<TH width="80">PIBITI
						<TH width="80">PIBIC_EM
						<TH width="80">Total';
			for ($r=0;$r < count($campi);$r++)
				{
					$sx .= '<TR>';
					$sx .= '<TD class="tabela01">'.$campi[$r];
					$toti = 0;
					for ($y=1;$y < count($result[$r]);$y++)
						{
							$toti = $toti + $result[$r][$y];
							$sx .= '<TD class="tabela01 lt3" align="center">';
							$sx .= $result[$r][$y];
							$total[$y] = $total[$y] + $result[$r][$y];
						}
					$total[4] = $total[4] + $toti;
					$sx .= '<TD class="tabela01 lt3" align="center">';
					$sx .= $toti;
				}
			$sx .= '<TR class="lt3"><TD align="right"><B>Totais</B>';
			$sx .= '<TD align="center"><B>'.$total[1].'</B>';
			$sx .= '<TD align="center"><B>'.$total[2].'</B>';
			$sx .= '<TD align="center"><B>'.$total[3].'</B>';
			$sx .= '<TD align="center"><B>'.$total[4].'</B>';
			$sx .= '</table>';
			return($sx);

		}
		
	function resumo($professor,$ano)
		{
			$stp = array(0,0,0,0,0,0,0,0,0,0,0,0);
			$sql = "select pj_status, count(*) as total from ".$this->tabela."
			where pj_professor = '$professor'
				and pj_ano = '$ano'  
				group by pj_status
				";
			//echo $sql;
			$rlt = db_query($sql);
			while ($line = db_read($rlt))
				{	
					$sta = trim($line['pj_status']);
					$total = $line['total'];
					if ($sta == '@') { $stp[0] = $stp[0] + $total; }
					if ($sta == '!') { $stp[0] = $stp[0] + $total; }
					if ($sta == 'B') { $stp[3] = $stp[3] + $total; }
					if ($sta == 'A') { $stp[0] = $stp[0] + $total; }
					if ($sta == 'X') { $stp[4] = $stp[4] + $total; }
					$stp[2] = $stp[2] + $total;
				}
				
			$sql = "select doc_status, count(*) as total  
						from pibic_submit_documento
					where doc_autor_principal = '$professor'
						and doc_ano = '$ano'  
						group by doc_status
				";
			
			$rlt = db_query($sql);
			while ($line = db_read($rlt))
				{
					//print_r($line);
					//echo '<HR>';				
					$sta = trim($line['doc_status']);
					$total = $line['total'];
					if ($sta == '@') { $stp[5] = $stp[5] + $total; }
					if ($sta == 'C') { $stp[8] = $stp[8] + $total; }
					if ($sta == 'B') { $stp[8] = $stp[8] + $total; }
					if ($sta == 'A') { $stp[6] = $stp[6] + $total; }
					if ($sta == 'X') { $stp[9] = $stp[9] + $total; }
					$stp[7] = $stp[7] + $total;
				}				
				
			$sx = '<table class="tabela00" width="940">';
			$sx .= '<TR>';
			$sx .= '<TH colspan=3 class="tabela01"><font class="lt2">Projeto do professor</font>';
			$sx .= '<TH colspan=3 class="tabela01"><font class="lt2">Planos de Alunos</font>';
			$sx .= '<TR>';
			$sx .= '<TH class="tabela01" width="16%">Em Submiss�o';
			$sx .= '<TH class="tabela01" width="16%">Submetido';
			$sx .= '<TH class="tabela01" width="16%">Cancelado';

			$sx .= '<TH class="tabela01" width="16%">Em Submiss�o';
			$sx .= '<TH class="tabela01" width="16%">Submetido';
			$sx .= '<TH class="tabela01" width="16%">Cancelado';
			
			$sx .= '<TR>';
			$sx .= '<TD class="tabela01 lt5" align="center"> '.$stp[0];			
			$sx .= '<TD class="tabela01 lt5" align="center"> '.$stp[3];
			$sx .= '<TD class="tabela01 lt5" align="center"> '.$stp[4];

			$sx .= '<TD class="tabela01 lt5" align="center"> '.$stp[5];			
			$sx .= '<TD class="tabela01 lt5" align="center"> '.$stp[8];
			$sx .= '<TD class="tabela01 lt5" align="center"> '.$stp[9];
			
			$sx .= '</table>';
			return($sx);
			
		}

	function enviar_email_acao($protocolo,$ic)
		{
			$ic = new ic;
		}
	function acao_01()
		{
			global $dd, $acao, $ss;
			
			$sta = $this->status_tipos();
			$sts = $this->status;
			$sx = '';		
			
			//if (($sts != '@') and ($sts != '!') and ($sts != 'A'))
			{			
			if ((strlen($acao) > 0) and (strlen($dd[3]) > 0))
				{
					$proto = $this->protocolo;
					$ac = $dd[3];
					$std = $dd[3];
					if ($std == '@') { $std = 'Devolvido ao professor para corre��es '; $ac = 1; }
					if ($std == 'A') { $std = 'Aceito submiss�o manualmente '; $ac = 2; }					
					if ($std == 'C') { $std = 'Aceito para avalia��o '; $ac = 6; }
					if ($std == 'T') { $std = 'An�lise da TI '; $ac = 7; }
					if ($std == 'P') { $std = 'An�lise da Coordena��o '; $ac = 8; }
					
					$hist = 'A��O: '.$std.' por '.$ss->user_login;
					
					$aluno1 = '';
					$aluno2 = '';
					$motivo = '';
					
					$his = new pibic_historico;
					$his->inserir_historico($proto,$ac,$hist,$aluno1,$aluno2,$motivo);
					
					if (strlen($dd[3]) > 0)
					{
						$sql = "update pibic_projetos set pj_status = '".$dd[3]."' where pj_codigo = '$proto' ";
						$rlt = db_query($sql);
			
						$sql = "update pibic_submit_documento set doc_status = '".$dd[3]."' where (doc_protocolo_mae = '$proto') and (doc_status <> 'X') ";
						$rlt = db_query($sql);
					}	
					redirecina(page().'?dd0='.$dd[0].'&dd90='.$dd[90]);					
				}
			
			$sx .= '<table width="940" class="tabela00" align="center"><TR><TD>';
			$sx .= '<fieldset><legend>A��es sobre o protocolo</legend>';
			$sx .= '<form method="post">';
			$sx .= '<h3>Valida��o do projeto e indica��o de avalia��o</h3>';
			$sx .= '<input type="hidden" name="dd0" value="'.$dd[0].'">';
			$sx .= '<input type="hidden" name="dd90" value="'.$dd[90].'">';
			$sx .= '<font class="lt0">Coment�rios</font><BR>';
			$sx .= '<textarea name="dd2" rows=80 style="width: 100%; height: 70px;">'.$dd[2].'</textarea>';
			$sx .= '<BR><BR><font class="lt0">Informe o tipo de a��o para o projeto:</font><BR>';
			
			/* Projeto como coordenador */
			
			if ($sts == '@')
				{
					$sx .= '<input TYPE="RADIO" name="dd3" value="A">Aceitar Submiss�o manualmente<BR>';		
				} else {
					$sx .= '<input TYPE="RADIO" name="dd3" value="C">Acatar projeto para avalia��o<BR>';
					$sx .= '<input TYPE="RADIO" name="dd3" value="T">Encaminhar para TI<BR>';
					$sx .= '<input TYPE="RADIO" name="dd3" value="P">Encaminhar para an�lise da coordena��o<BR>';
					$sx .= '<input TYPE="RADIO" name="dd3" value="B">Reencaminhar para valida��o<BR>';
				}
			
			$sx .= '<BR><BR><input TYPE="submit" name="acao" value="encaminhar >>>" class="botao-geral">';	
			$sx .= '</form>';
			$sx .= '</legend>';
			$sx .= '</table>';
			}
			return($sx);
		}
		
		
	function planos_submit()
		{
		$status = $this->status;
		if (($status == '@') or ($status == '!'))
		{
		$proto = $this->protocolo;
		$this->resumo_planos();
		$editar = 1;
		$planos = round($this->plano_pibic) + round($this->plano_pibiti);
		$planost = round($this->plano_pibic) + round($this->plano_pibiti) + round($this->plano_pibic_em);
		$sx .= '<table width="100%"><TR align="left"><TD>';
		if ($planos < 2)
			{
				$linkc = "window.location.replace('submit_pos_3.php?dd0=NEW&dd89=".$proto."');";
				$sx .= '<input type="button" value="submeter novo plano de aluno (PIBIC/PIBITI)" onclick="'.$linkc.'" class="botao-geral" >';
			} else {
				$sx .= '* Limite de planos de aluno por projeto<BR>';				
			}		
		$sx .= ' &nbsp; ';
		
		if (round($this->plano_pibic_em) < 1)
			{
				$linkc = "window.location.replace('submit_pos_4.php?dd0=NEW&dd89=".$proto."');";
				$sx .= '<input type="button" value="submeter novo plano PIBIC J�nior" onclick="'.$linkc.'" class="botao-geral" >';
			} else {
				$sx .= '* Limit de planos de PIBIC Jr por projeto<BR>';			
			}
			
		if ($planos >= 1)
			{
				$sx .= '<BR><BR>';
				$linkc = "window.location.replace('submit_pos_5.php?dd89=".$proto."');";
				$sx .= '<input type="button" value="Finalizar submiss�o deste projeto e dos planos dos alunos >>> " onclick="'.$linkc.'" class="botao-confirmar" >';			
			}

		$sx .= '</table>';
		} else {
			$sx = '';
		}
		return($sx);			
		}
		
	
	function form_00()
		{
			global $dd;			
			$sx .= '
				<TR><TD rowspan=20 width="50"><img src="'.http.'/pibic/img/icone_projeto_professor.png" width="50">
				<TR><TD class="lt0">Informe o t�tulo do projeto do professor
				<TR><TD><textarea name="dd2" style="width: 100%; height: 80px;">'.$dd[2].'</textarea>
				<TR><TD>'.$this->erro.'
				<TR><TD><input type="submit" class="botao-geral" value="gravar >>>">
			';
			return($sx);			
		}
	function form_01()
		{
			global $dd;			
			$sx .= '
				<TR valign="top"><TD rowspan=20 width="50"><img src="'.http.'/pibic/img/icone_projeto_professor.png" width="50">
				<TR><TD class="lt0">Protocolo: '.$this->protocolo.'
				<TR><TD class="lt0">Informe o t�tulo do projeto do professor
				<TR><TD><h2>'.$dd[2].'</h2></textarea>
			';
			return($sx);			
		}
	function form_02a()
		{
			
		}
	function form_02b()
		{
			global $dd;
			$sx .= '<TR><TD>�rea do conhecimento';
			$sx .= '<TR>'.sget("dd20",'$Q descricao:a_cnpq:select a_cnpq || \' \' || a_descricao as descricao,* from ajax_areadoconhecimento where a_semic = 1 order by a_cnpq','�rea',1,1);
			return($sx);
		}
	function form_02c()
		{
			global $dd;
			$sx .= '<TR><TD>�rea estrat�gica';
			$sx .= '<TR>'.sget("dd21",'$Q descricao:a_cnpq:select a_cnpq || \' \' || a_descricao as descricao,* from ajax_areadoconhecimento where a_cnpq like \'9%\' order by a_cnpq','�rea',1,1);
			return($sx);			
		}
	function form_03a()
		{
			global $dd,$acao;
			if ((strlen($acao) > 0) and (strlen(trim($dd[25]))==0)) 
				{ $cor = '<img src="'.http.'/img/icone_alert.jpg" width="30"><font color="red" >'; }
			$sx .= '<TR><TD>'.$cor.'Projeto aprovado externamente por uma ag�ncia de fomento?  (obrigat�rio, anexar o documento comprobat�rio se pertinente)';
			$sx .= '<TR>'.sget("dd25",'$R S:SIM&N:N�O','',1,1);
			return($sx);			
			
		}
	function form_03b()
		{
			global $dd,$acao;
			if ((strlen($acao) > 0) and (strlen(trim($dd[35]))==0)) 
				{ $cor = '<img src="'.http.'/img/icone_alert.jpg" width="30"><font color="red" >'; }
			$sx .= '<TR><TD>'.$cor.'Grupo 2 - Financiamento por empresa?  (obrigat�rio, anexar o documento comprobat�rio se pertinente)';
			$sx .= '<TR>'.sget("dd35",'$R S:SIM&N:N�O','',1,1);
			return($sx);			
			 
		}
	function form_04a()
		{
			global $dd;
			$sx .= '<TR><TD>Comit� de �tica em Pesquisa';
			$sx .= sget("dd30",'$O N:--N�o aplic�vel--&A:Em submiss�o&B:em avalia��o&C:aprovado','',1,1);
			$sx .= sget("dd31",'$S10',False);
			return($sx);			
		}
	function form_04b()
		{
			global $dd;
			$sx .= '<TR><TD>Comit� de �tica no Uso de Animais';
			$sx .= sget("dd32",'$O N:--N�o aplic�vel--&A:Em submiss�o&B:em avalia��o&C:aprovado','',1,1);
			$sx .= sget("dd33",'$S10','',1,1);
			return($sx);						
		}
	function valida_post()
		{
			global $dd;
			$protocolo = $_SESSION['protocolo'];
			
			$valid = 1;
			$err = array();
			if (strlen($dd[30]) ==0 ) { $valid = 0; array_push($err,'Status do CEP n�o informado.'); }
			if (strlen($dd[32]) ==0 ) { $valid = 0; array_push($err,'Status do CEUA n�o informado.'); }

			if (strlen($dd[25]) ==0 ) { $valid = 0; array_push($err,'Aprova��o por org�o de fomento n�o informado.'); }
			if (strlen($dd[35]) ==0 ) { $valid = 0; array_push($err,'Aprova��o por empresa n�o informado.'); }
			
			/* arquivo */
			if ($this->valida_arquivo('PROJ',$protocolo)==0)
			{ $valid = 0; array_push($err,'Projeto ou Plano n�o foi anexado.'); }	
			
			$this->erro = $err;
			return($valid);
		}
	function valida_arquivo_plano($tipo='',$protocolo='')
		{
			$sql = "select count(*) as total from pibic_ged_documento 
					where doc_dd0 = '".$protocolo."' 
					and doc_tipo = 'PLANO'
					and doc_ativo = 1
					";
			$rrlt = db_query($sql);
			$rline = db_read($rrlt);
			$total = $rline['total'];
			if ($total > 0) { return(1); } else { return(0); }
		}		
	function valida_arquivo($tipo='',$protocolo='')
		{
			$sql = "select count(*) as total from pibic_submit_ged 
					where doc_dd0 = '".$protocolo."' 
					and doc_tipo = '$tipo'
					and doc_ativo = 1
					";
			
			$rrlt = db_query($sql);
			$rline = db_read($rrlt);
			$total = $rline['total'];
			if ($total > 0) { return(1); } else { return(0); }
		}
	function mostra_erros_post()
		{
			$erro = '';
			for ($r=0;$r < count($err);$r++)
				{
					if (strlen($err) > 0) { $err .= '<BR>'; }
					$err = '<font color="red">'.$err[$r].'</font>';
				}
			return($erro);
		}
	function project_professor_dados()
		{
			global $dd,$acao,$ged;
			$proto = $_SESSION['protocolo'];
			$this->le($proto);
			$dd[0] = $this->id;
			$dd[2] = $this->titulo; 
						
			/* */
			if (strlen($acao)==0)
				{
					
					$dd[20] = $this->area;
					$dd[21] = $this->area_estrategica;
					$dd[30] = trim($this->line['pj_cep_status']);
					$dd[31] = trim($this->line['pj_cep']);
					$dd[32] = trim($this->line['pj_ceua_status']);
					$dd[33] = trim($this->line['pj_ceua']);
					/* */
					$dd[25] = trim($this->line['pj_ext_sn']);
					
					$dd[35] = trim($this->line['pj_gr2_sn']);					
				} else {
					$sql = "update ".$this->tabela." 
							set pj_area = '".trim($dd[20])."', 
							pj_area_estra = '".trim($dd[21])."',
							pj_update = ".date("Ymd").",
							pj_cep_status = '".$dd[30]."',
							pj_cep = '".trim($dd[31])."',
							pj_ceua_status = '".$dd[32]."',
							pj_ceua = '".trim($dd[33])."',
							
							pj_ext_sn = '".$dd[25]."',
							pj_gr2_sn = '".$dd[35]."'
							where 
							pj_codigo = '".$proto."' 					
					";
					
					if (strlen($proto) > 0)
						{
							$rlt = db_query($sql);
						}					
					$valida = $this->valida_post(); 
					if ($valida==1)
						{
							redirecina('submit_project.php');
						}
					}

			/* formulario */
			$sx = '
			<form action="'.page().'">
			<input type="hidden" name="dd1" value="'.$dd[1].'">
			<input type="hidden" name="dd89" value="'.$proto.'">
			<fieldset><legend>Projeto do professor</legend>
			<table width="100%">
			';
			$sx .= '<TR><TD colspan=2>'.$this->mostra_erros_post();
			
			$sx .= $this->form_01();

			$sx .= '<TR><TD>';
			$sx .= '<fieldset><legend>�rea do conhecimento</legend>';
			$sx .= '<table width="100%">';
			$sx .= $this->form_02a(); /* banco de projetos */
			$sx .= $this->form_02b(); /* area do conhecimento */
			$sx .= $this->form_02c(); /* area estrat�gica */
			$sx .= '</table>';
			$sx .= '</fieldset>';
			
			$sx .= '<TR><TD>';
			$sx .= '<fieldset><legend>Aprova��o & Financiamento Externo</legend>';
			$sx .= '<table width="100%">';
			$sx .= $this->form_03a(); /* aprovado externamente */
			$sx .= $this->form_03b(); /* grupo 2 */
			$sx .= '</table>';
			$sx .= '</fieldset>';
			
			$sx .= '<TR><TD>';
			$sx .= '<fieldset><legend>Comit�s de �tica</legend>';
			$sx .= '<table width="100%">';
			$sx .= '<TR align="left"><TH>Comit�<TH>Status<TH>N� Parecer';
			$sx .= $this->form_04a(); /* Comit� de �tica em pesquisa */
			$sx .= $this->form_04b(); /* Comit� de �tica no uso de animais */
			$sx .= '</table>';
			$sx .= '</fieldset>';

			$sx .= '<TR><TD>';
			$sx .= '<fieldset><legend>Arquivos do professor</legend>';
			
			/** Arquivos */
			$sx .= '<fieldset><legend>Arquivos submetidos</legend>';
			$sx .= '<iframe src="submit_pibic_arquivos.php?dd1='.$proto.'" 
					width=100%
					height=150 style="border: 0px solid #FFFFFF;"></iframe>';
			$sx .= '</fieldset>';
					
			$sx .= '<TR><TD>';			
			$sx .= '<input type="submit" value="salvar e continuar >>>" name="acao" class="botao-geral">';
			$sx .= '</form>';
			
			
			$sx .= '</table>';
			
			return($sx);
		}

	function exist_titulo($titulo,$professor)
		{
			global $ss;
			$professor = $ss->user_cracha;	
			$ano = date("Y");
			$sql = "select * from ".$this->tabela." 
					where (pj_titulo = '".$titulo."' or pj_search = '".UpperCaseSql($titulo)."') 
					and pj_professor = '$professor'
					and pj_ano = '$ano' and pj_status <> 'X'
					";
			$rlt = db_query($sql);
			if ($line = db_read($rlt))
				{
					$this->protocolo = trim($line['pj_codigo']);
					return(1);
				} else {
					return(0);
				}
			return(0);
		}
	function grava_titulo($titulo,$professor)
		{
			global $ss;
			$professor = $ss->user_cracha;	
			/* RN: Insere projeto se n�o existe */
			$data = date("Ymd");
			$proto = '';
			$ano = date("Y");
			$sql = "insert into ".$this->tabela."
					(pj_titulo, pj_codigo, pj_professor,pj_update, pj_data, pj_status, pj_ano) values
					('".$titulo."','$proto','$professor',$data,$data,'!','$ano')";
			$rlt = db_query($sql);
									
			/*** Atualiza c�digos */
			$sql = "select * from ".$this->tabela." 
					where pj_codigo = ''
					and pj_professor = '$professor' 
					and pj_status = '!' ";
			$xrlt = db_query($sql);			
			if ($xline = db_read($xrlt))
				{
					$proto = '1'.strzero($xline['id_pj'],6);
					$sql = "update ".$this->tabela." 
					set pj_codigo = '".$proto."'
					where id_pj = ".$xline['id_pj'];
					$yrlt = db_query($sql);			
					$_SESSION['protocolo'] = $proto;
					$this->protocolo = $proto;
				}								
			return($proto);			
			
		}
	function salva_novo_titulo($titulo,$professor)
		{
			global $dd,$professor;
			if ($this->exist_titulo($titulo,$professor) == 1)
				{
					$this->erro = 'J� existe um projeto com este t�tulo';
					return(0);	
				} else {
					$this->grava_titulo($dd[2],$professor);
				}
			return(0);
		}
	function project_new_form()
		{
			global $dd,$ss;			
			$professor = $ss->user_cracha;
			$sx = '
			<form action="'.page().'">
			<input type="hidden" name="dd1" value="'.$dd[1].'">
			<fieldset><legend>Projeto do professor</legend>
			<table width="100%">
			';
			
			/* RN: Salva novo titulo se n�o existe */
			if ((strlen($dd[0])==0) and (strlen($dd[2]) > 0))
				{
					$this->salva_novo_titulo($dd[2],$professor);
					$_SESSION['protocolo'] = $this->protocolo;
					redirecina('submit_pos_1.php');
				} else {
					$sx .= $this->form_00();
				}			
			$sx .= '
			</table>
			</fieldset>
			</form>
			';
			return($sx);
		}
	function mostra_dados_projeto($prj)
		{
				$cp = 'a1.a_descricao as area1, a2.a_descricao as area2 ';								
				$sql = "select $cp,* from ".$this->tabela." 
						left join ajax_areadoconhecimento as a1 on pj_area = a1.a_cnpq
						left join ajax_areadoconhecimento as a2 on pj_area_estra = a2.a_cnpq
						where pj_codigo = '$prj'
						order by pj_ano desc, pj_status, pj_codigo
						limit 20 ";
				$yrlt = db_query($sql);	
				$yline = db_read($yrlt);
				$sx .= $this->projeto_mostra_mini($yline);
				return($sx);		
		}
		
	function button_new_project()
		{
			$sx .= '
			<center>
			<form method="get" action="submit_new_project.php">
			<input type="submit" value="Submeter Novo Projeto >>>" class="botao-confirmar">
			</form>
			';
			return($sx);
		}

	function resumo_projetos()
		{
			global $dd,$ss;
			$professor = $ss->user_cracha;
			
			$ano = date("Y");
			$cp = 'a1.a_descricao as area1, a2.a_descricao as area2 ';								
			$sql = "select $cp,* from ".$this->tabela." 
					left join ajax_areadoconhecimento as a1 on pj_area = a1.a_cnpq
					left join ajax_areadoconhecimento as a2 on pj_area_estra = a2.a_cnpq
					where pj_professor = '$professor' 
					and pj_status <> 'X'
					and pj_ano = '$ano'
					order by pj_ano desc, pj_status, pj_codigo
					limit 20 ";
			$yrlt = db_query($sql);
			
			$sx = '<fieldset><legend>Projetos</legend>';
			$sx .= '<table width="98%" border=1 cellpadding=0 cellspacing=0 class="tabela00">';
			while ($yline = db_read($yrlt))
			{
				$sx .= $this->projeto_mostra_mini($yline);
				
				$sx .= $this->planos_submit();
			}
			$sx .= '</table>';
			$sx .= '</fieldset>';
			return($sx);
		}

	function cp_00()
		{
			global $dd,$ss;
			$cp = array();
			array_push($cp,array('$H8','id_pj','',False,True));
			array_push($cp,array('${','','dados do projeto',False,True));
			array_push($cp,array('$T80:5','pj_titulo',msg('titulo_projeto'),True,True));
			array_push($cp,array('$HV','pj_search',UpperCaseSql($dd[2]),False,True));
			array_push($cp,array('$H8','','',True,True));
			array_push($cp,array('$HV','pj_ano',date("Y"),True,True));
			array_push($cp,array('$U8','pj_update','',False,True));
			array_push($cp,array('$HV','pj_data',date("Ymd"),False,True));
			array_push($cp,array('$HV','pj_status','!',False,True));
			array_push($cp,array('$HV','pj_professor',$ss->user_cracha,False,True));
			array_push($cp,array('$}','','',False,True));			
			array_push($cp,array('$H8','pj_codigo','',False,True));							
			return($cp);
		}
	function edital_perfil($ano='')
		{
			if (strlen($ano)==0) { $ano = date("Y"); }
			$sql = "select pb_professor, count(*) as total from pibic_bolsa 
					where pp_ano = '$ano' and pb_ativo = 1
					group by pb_professor
			";
			$rlt = db_query($sql);
			while ($line = db_read($rlt))
				{
					print_r($line);
					exit;
				}
		}
	function areas_mostra($c)
		{
			if ($c=='E') { $sx = '<font style="color: #006b9f; font-size: 30px;">Ci�ncias Exatas</font>'; }
			if ($c=='H') { $sx = '<font style="color: #ff0000; font-size: 30px;">Ci�ncias Humanas</font>'; }
			if ($c=='S') { $sx = '<font style="color: #ff0000; font-size: 30px;">Ci�ncias Sociais Aplicadas</font>'; }
			if ($c=='V') { $sx = '<font style="color: #00A000; font-size: 30px;">Ci�ncias da Vida</font>'; }
			if ($c=='A') { $sx = '<font style="color: #009000; font-size: 30px;">Ci�ncias Agr�rias</font>'; }
			return($sx);
		}
		
	function mostra_edital($ano,$bolsa,$modalidade)
		{	
			$sql = "select * from pibic_submit_documento where doc_edital = 'PIBICE' ";
//			$rlt = db_query($sql);
//			while ($line = db_read($rlt))
//				{
//					print_r($line);
//					exit;
//				}
			
			
			$cps = 'doc_1_titulo, doc_ava_estrategico, id_pj, pj_codigo, doc_doutorando, doc_area, ap_tit_titulo, pp_nome, pp_centro, pp_ss, doc_icv, doc_estrategica, doc_nota, doc_protocolo_mae, doc_protocolo ';
			$cps .= ', pp_prod, pp_cracha, doc_aluno, doc_avaliacoes ';
			if ($modalidade!='PIBICE') { $cps .= ', pb1.pb_tipo as pb_tipo, pa_nome '; }
			//$cps = '*';
			$sql = "select ".$cps." from pibic_submit_documento ";
			$sql .= " inner join pibic_professor on pp_cracha = doc_autor_principal ";
			$sql .= " inner join apoio_titulacao on pp_titulacao = ap_tit_codigo ";
			if ($modalidade!='PIBICE')
				{
				$sql .= " inner join pibic_aluno on pa_cracha = doc_aluno ";
				$sql .= " left join pibic_bolsa as pb1 on (doc_protocolo = pb1.pb_protocolo) ";
				
				}
			$sql .= " left join pibic_projetos on pj_codigo = doc_protocolo_mae ";
			
			
			
			$sql .= " where doc_ano = '".$ano."' ";
			$sql .= " and doc_edital = '".$modalidade."' ";
			$sql .= " and (doc_protocolo <> doc_protocolo_mae) ";
			if (strlen($area) > 0) { $sql .= " and doc_area = '".$area."' "; }
			$sql .= " and (doc_status <> 'X' and doc_status <> '@' ) ";
			//$sql .= " and (doc_aluno <> '') ";
			//$sql .= " and doc_nota > 10 ";
			$sql .= " order by doc_edital, doc_area, pp_nome ";
			$rlt = db_query($sql);
		
			$sx .= '<table class="lt0">';
			$tot = 0;
			$sh .= '<TR><TH>bolsa';
			$sh .= '<TH>tit';
			$sh .= '<TH>professor';
			$sh .= '<TH>aluno';
			$sh .= '<TH>t�tulo do plano de trabalho';
			
			$xarea = '-';
			$id = 0;
			while ($line = db_read($rlt))
				{
					$idr = $line['id_pj'];
					$nota = round($line['doc_nota']);
					$link = '<A HREF="pibic_projetos_detalhes.php?dd0='.$idr.'&dd90='.checkpost($idr).'" class="lt1a" target="new'.$id.'">';
					$cp = 'ap_tit_titulo, pp_nome, pa_nome, doc_1_titulo';
					$area = $line['doc_area'];
					if ($area != $xarea)
						{
							$edital = trim($line['doc_edital']);
							if ($edital == 'PIBICE') { $edital = 'PIBIC_EM'; }
							$sx .= '<TR><TD class="lt4" colspan=6><center>'.$this->areas_mostra($area);
							$sx .= '<BR>'.$edital ;
							$sx .= $sh.chr(13);
							$xarea = $area;
						}
					$tot++;
					$bolsa = trim($line['pb_tipo']);
					if ($nota < 60) { $bolsa = 'D'; }
					if ($bolsa == 'R') { $bolsa = 'D'; }
					if ($bolsa != 'D')
					{
						$id++;
						$sx .= '<TR '.coluna().' class="lt1a">';
						$sx .= '<TD><img src="img/logo_bolsa_'.$bolsa.'.png">';
						$sx .= '<TD>';
						$sx .= $link;
						$sx .= $line['ap_tit_titulo'];
						$sx .= '<TD width="20%">';
						$sx .= $link;
						$sx .= nbr_autor($line['pp_nome'],7);
						$sx .= '<TD width="20%">';
						$sx .= $link;
						$aluno = trim($line['pa_nome']);
					if (strlen($aluno)==0) 
						{ $aluno = ':: Sem Defini��o de Aluno ::'; } 
					else 
						{ $aluno = trim(nbr_autor($line['pa_nome'],7)); }
					if (strlen($aluno)==0) 
						{ $aluno = ':: Sem Defini��o de Aluno ::'; }
					$sx .= $aluno;
					$sx .= '<TD>';
					$sx .= $link;
					$sx .= nbr_autor($line['doc_1_titulo'],7);
					$sx .= '</tr>'.chr(13).chr(10);
					$sx .= '<tr><td colspan="6"><img src="img/nada_black.gif" alt="" width="100%" border="0" height="1"></td></tr>'.chr(13).chr(10);
					}
										
				}
			$sx .= '<TR><TD colspan=5>Total de '.$tot.' projetos nesta modalidade';
			$sx .= '</table>';
			return($sx);
		}
		
	function protocolo_diferenciar($p1,$p2)
		{
			$sql .= "select * from ".$this->tabela." where pj_codigo = '$p1' ";
			$sql .= " and pj_status = 'T' ";
			$rlt = db_query($sql);
			if ($line = db_read($rlt))
			{
				$titulo = trim($line['pj_titulo']). ' ('.$line['pj_professor'].')';
				$sql = "update ".$this->tabela." set pj_titulo = '$titulo' 
					where pj_codigo = '$p1'
				";
				$rlt = db_query($sql);
				$this->protocolo_altera_status($p1,'A');
				$this->protocolo_altera_status($p2,'A');
			}
			return("Diferenciado protocolos $p1 e $p2");
		}

	function plano_troca_protocolo_mae($de,$para)
		{
			$sql = "select * from ".$this->tabela." 
				left join docentes on pp_cracha = pj_professor
				where pj_codigo = '$de' ";
			$rlt = db_query($sql);
			if ($line = db_read($rlt))
			{
				$sx .= '<TR><TD><HR>DE<HR>';
				$sx .= '<TR><TD>'.$line['pp_nome'];
				$sx .= '<TR><TD>'.$line['pj_titulo'];
				$sx .= '<TR><TD>Status: '.$line['pj_status'];
				$prof1=$line['pp_cracha'];
				$tit1 =uppercasesql($line['pj_titulo']);
				$tit1 = troca($tit1,'.','');
				$tit1 = troca($tit1,'?','');
				$tit1 = troca($tit1,',','');
				$status1 =uppercasesql($line['pj_status']);
			}

			$sql = "select * from ".$this->tabela." 
				left join docentes on pp_cracha = pj_professor
				where pj_codigo = '$para' ";
			$rlt = db_query($sql);
			if ($line = db_read($rlt))
			{
				$sx .= '<TR><TD><HR>PARA<HR>';
				$sx .= '<TR><TD>'.$line['pp_nome'];
				$sx .= '<TR><TD>'.$line['pj_titulo'];
				$sx .= '<TR><TD>Status: '.$line['pj_status'];
				$prof2=$line['pp_cracha'];
				$tit2 =uppercasesql($line['pj_titulo']);
				$tit2 = troca($tit2,'.','');
				$tit2 = troca($tit2,'?','');
				$tit2 = troca($tit2,',','');				
				$status2 =uppercasesql($line['pj_status']);
			}
			$ok = 1;
			$sx .= '<TR><TD><HR>';
			if ($prof1 == $prof2)
				{ $sx .= '<TR><TD>Nome do professor: <font color="green">OK</font>'; }
				else 
				{ $sx .= '<TR><TD>Nome do professor: <font color="red">ERRO</font>'; $ok = 0; }

			if ($tit1 == $tit2)
				{ $sx .= '<TR><TD>T�tulo do trabalho: <font color="green">OK</font>'; }
				else 
				{ $sx .= '<TR><TD>T�tulo do trabalho: <font color="red">ERRO</font>'; $ok = 0; }
	
			if ($status1 == 'X')
				{ $sx .= '<TR><TD>Protocolo ativo: <font color="red">ERRO, protocolo est� cancelado</font>'; $ok = 0; }

			if ($status2 == 'X')
				{ $sx .= '<TR><TD>Protocolo ativo: <font color="red">ERRO, protocolo est� cancelado</font>'; $ok = 0; }

			echo '<table width="800" class="lt1">';
			echo "<TR><TD align=center ><h3>Agrupar Protocolos: de $de para $para</H3>";
			echo $sx;
			echo '</table>';
			
			if ($ok==1)
				{
					echo 'Troca de protocolo M�e ('.$this->plano_troca_protocolo($de,$para).')';
					echo 'Cancela protocolo vazio ('.$this->protocolo_cancela_sem_plano($de).')';
					echo 'Devolve para indica��o ('.$this->protocolo_altera_status($de,'A').')';
				}
		}

	function plano_troca_protocolo($proto_de,$proto_para)
		{
			$sql = "update pibic_submit_documento set 
					doc_protocolo_mae = '$proto_para'
					where doc_protocolo_mae = '$proto_de'
					and doc_status <> 'X' 
					";
			$rlt = db_query($sql);
			return('ok');
		}
	function protocolo_cancela_sem_plano($proto)
		{
			$this->protocolo_altera_status($proto,'X');
			return('ok');
		}
	function protocolo_altera_status($proto,$status)
		{
			$sql = "update ".$this->tabela." set
				pj_status = '$status' where
				pj_codigo = '$proto'
			";
			$rlt = db_query($sql);
			return('ok');			
		}
	function projetos_sumetidos_campus($campus,$ano,$edital)
		{
			$sql = "select * from ".$this->tabela."
				inner join docentes on pj_professor = pp_cracha
				inner join pibic_submit_documento on (pj_codigo = doc_protocolo_mae) and (doc_status <> 'X' and doc_status <> '@')
				where (pj_status <> 'X' and pj_status <> '@') 
				and pp_centro = '$campus'
				and pj_ano = '$ano'
				order by pp_nome, pj_codigo
			";
			$rlt = db_query($sql);
			$prof = 'x';
			$tot = 0;
			$prj = 0;
			$xproj = 'x';
			while ($line = db_read($rlt))
			{
				$tot++;
				$professor = trim($line['pp_nome']);
				$proj = trim($line['pj_titulo']);
				if ($professor != $prof)
					{
						$sx .= '<TR><TD colspan=4 class="lt3"><B>'.$professor;
						$sx .= '</B> ('.$line['pp_curso'].')';
						$prof = $professor;
					}
				$edital = trim($line['doc_edital']);
				$img = http.'pibic/img/icone_plano_aluno.png';
				
				if ($edital == 'PIBIC_E') { $img = 'pibic/img/icone_plano_aluno_jr.png'; }
				if ($edital == 'PIBITI') { $img = 'pibic/img/icone_plano_aluno_pibiti.png'; }
				
				if ($proj != $xproj)
					{
					$sx .= '<TR>';
					$sx .= '<TD width="30" class="lt0" colspan=4>';
					$sx .= 'Proj. Professor: <B><I>'.$line['pj_titulo'];
					$xproj = $proj;
					}
				$sx .= '<TR><TD width=30><TD width="30" colspan=1 class="lt0">';
				$sx .= '<img src="/reol/pibicpr2/img/'.$img.'" height=50>';
				$sx .= '<TD>';
				$sx .= $line['doc_1_titulo'];
				$sx .= '('.$edital.')';	
				$sx .= '<TR><TD colspan=4 align="center"><HR width=400 size=1>';
				$xl = $line;
			}
			$sx .= '<TR><TD colspan=4>Total de '.$tot.' planos de alunos';
			$sa .= '<Font class="lt4">'.$campus.'</font>';
			$sa .= '<BR>'.$edital.' - '.$ano;
			$sa .= '<table width="98%" border=0 class="lt1" >';
			$sa .= $sx;
			$sa .= '</table>';
			return($sa);
		}		
		
		function acao_enviar_email_avaliacao($avaliador)
			{
				global $email_adm, $admin_nome;
				$sql = "select * from pareceristas where us_codigo = '".$avaliador."' ";
				$rlt = db_query($sql);
				if ($line = db_read($rlt))
					{
						$nome = trim($line['us_nome']);
						$email = trim($line['us_email']);
						$email2 = trim($line['us_email_alternativo']);
					}
				
				$sql = "select * from ic_noticia where nw_ref = 'PAR_AVAL_2' ";
				$rlt = db_query($sql);
				
				if ($line = db_read($rlt))
					{
						$texto = $line['nw_descricao'];	
						$texto = troca($texto,chr(13),'<BR>');
						$texto = troca($texto,'$parecerista',$nome);
						
						$chk = substr(md5('pibic'.date("Y").$avaliador),0,10);
						$linkx = 'http://www2.pucpr.br/reol/avaliador/';
						$linkx .= 'acesso.php?dd0='.$avaliador.'&dd90='.$chk;
						$link = '<A HREF="'.$linkx.'" target="new">';
						$link .= $linkx;
						$link .= '</A>';
						$texto = troca($texto,'$parecer_link',$link);

						//$email_adm = 'pibicpr@pucpr.br';
						//$admin_nome = 'PIBIC (PUCPR)';
						enviaremail('renefgj@gmail.com','','Indica��o de avalia��o PIBIC/PIBITI',$texto);
						
						if (strlen($email) > 0) { enviaremail($email,'','Indica��o de avalia��o PIBIC/PIBITI',$texto); }
						if (strlen($email2) > 0) { enviaremail($email2,'','Indica��o de avalia��o PIBIC/PIBITI (copia)',$texto); }
						
					}
				return(true);
			}


		function acao_indicar_avaliaca($protocolo,$avaliador,$obj,$tipo,$data=20130612)
			{
				$sql = "select * from ".$obj->tabela." 
					where pp_protocolo = '".$protocolo."' 
					and pp_avaliador = '".$avaliador."'
					and pp_tipo = '$tipo'
					";
				$rlt = db_query($sql);
				if ($line = db_read($rlt))
				{
					$sta = trim($line['pp_status']);
					//if (($sta != 'X') and ($sta != '@'))
						{
							$sql = "update ".$obj->tabela." set
								pp_data = $data, 
								pp_status = '@',
								pp_tipo = '$tipo'
								where (id_pp = ".$line['id_pp'].")
								or (pp_protocolo_mae = '".$line['pp_protocolo']."' 
								and pp_avaliador = '".$avaliador."')";
							$rlt = db_query($sql);
							echo '<BR><font color=green>Reenviar e-mail</font><BR> ';
							$this->acao_enviar_email_avaliacao($avaliador);								
						}
				} else {
					$sql = "insert into ".$obj->tabela."
						(pp_tipo, pp_protocolo, pp_protocolo_mae, 
						pp_avaliador, pp_revisor, pp_status, 
						pp_pontos, pp_pontos_pp, pp_data, 
						pp_data_leitura, pp_hora, pp_parecer_data, 
						pp_parecer_hora, 
						pp_p01, pp_p02, pp_p03, pp_p04, pp_p05,
						pp_p06, pp_p07, pp_p08, pp_p09, pp_p10,
						pp_p11, pp_p12, pp_p13, pp_p14, pp_p15,
						pp_p16, pp_p17, pp_p18, pp_p19, 
						pp_abe_01, pp_abe_02, pp_abe_03, pp_abe_04, pp_abe_05,
						pp_abe_06, pp_abe_07, pp_abe_08, pp_abe_09, pp_abe_10 
						) values (
						'$tipo','$protocolo','',
						'$avaliador','','@',
						0,0,$data,
						0,'',0,
						'',
						0,0,0,0,0,
						0,0,0,0,0,
						0,0,0,0,0,
						0,0,0,0,
						'','','','','',
						'','','','',''
						)";
					$rlt = db_query($sql);
					$this->acao_enviar_email_avaliacao($avaliador);
				}
			}
		
		
		function acao_indicar_avaliadores()
			{
				global $dd,$acao,$professor,$pj;
				echo 'Area:'.$this->area;
				require_once("_class_pareceristas.php");
				require_once("_class_parecer_pibic.php");
				$par = new parecerista;
				$pp = new parecer_pibic;
				$pp->tabela = 'pibic_parecer_'.date("Y");
				//$pp->structure();
				$bb1 = 'enviar indica��o da avalia��o >>>'; 
				$acao2 = $_POST["acao2"];
				$professor = $pj->professor;
				if ($bb1==$acao2)
					{
						$avaliadores = array();
						for ($r=0;$r < 1000;$r++)
							{
								$vlr = $_POST['ddp'.$r];
								if (strlen($vlr) > 0)
									{ array_push($avaliadores,$vlr); }								
							}
						
						for ($rx=0;$rx < count($avaliadores);$rx++)
						{
							$aval = $avaliadores[$rx];
							if (strlen($aval) > 0) { $this->acao_indicar_avaliaca($this->protocolo,$aval,$pp,'SUBMI'); }
						}
						if (count($avaliadores) > 0)
							{
							$sql = "update pibic_submit_documento set doc_status='D' ";
							$sql .= "where doc_protocolo_mae = '".$this->protocolo."') 
									and doc_status='C' ";
								
							$sql = "update ".$this->tabela." set pj_status = 'D' where pj_codigo = '".$this->protocolo."'";
							$wrlt = db_query($sql);
							}					
						echo '<BR><BR>Indicado e enviado';
						exit;
					}
					
				
				$externo = $par->parecerista_lista('E','pibic_parecer',$this->area,'pibic_parecer_'.date("Y"),'SUBMI');
				$interno = $par->parecerista_lista('L','pibic_parecer',$this->area,'pibic_parecer_'.date("Y"),'SUBMI');
				$gestor = $par->parecerista_lista('G','pibic_parecer',$this->area,'pibic_parecer_'.date("Y"),'SUBMI');

				$professor = trim($pj->professor);
				
				$sx .= '<form method="post" action="'.page().'">';
				$sx .= '<input type="hidden" name="dd0" value="'.$dd[0].'">'.chr(13);
				$sx .= '<input type="hidden" name="dd1" value="'.$dd[1].'">'.chr(13);
				$sx .= '<input type="hidden" name="acao" value="'.$acao.'">'.chr(13);
				$sx .= '<input type="hidden" name="dd90" value="'.$dd[90].'">'.chr(13);
				
				$sx .= '<table width="100%" border=1 class="lt1" >';
				$sx .= '<TR valign="top">';
				$sx .= '<TD width="33%">';

				$sx .= '<fieldset><legend>Avaliadores Ad Hoc</legend>';
				$sx .= '<table>';
				$ax = 'x';
				$in = 0;
				for ($r=0;$r < count($externo);$r++)
					{
						$in++;
						if ($ax != $externo[$r][2])
							{
							$sx .= '<BR>';
							$sx .= '<B>'.$externo[$r][2].' - '.$externo[$r][3].'</b><BR>'; 
							$ax = $externo[$r][2]; 
							}
						$sx .= '<input type="checkbox" name="ddp'.$in.'" value="'.$externo[$r][0].'">';
						$sx .= trim($externo[$r][1]);
						$sx .= '<BR>';
					}
				$sx .= '</table>';
				$sx .= '</fieldset>';

				$sx .= '<TD width="33%">';

				$sx .= '<fieldset><legend>Avaliadores Locais</legend>';
				$sx .= '<table>';
				$ax = '';
				for ($r=0;$r < count($interno);$r++)
					{
						if ($professor != trim($interno[$r][0]))
						{						
						$in++;
						if ($ax != $interno[$r][2])
							{
							$sx .= '<BR>';
							$sx .= '<B>'.$interno[$r][2].' - '.$interno[$r][3].'</b><BR>'; 
							$ax = $interno[$r][2]; 
							}

						$sx .= '<input type="checkbox" name="ddp'.$in.'" value="'.$interno[$r][0].'">';
						$sx .= trim($interno[$r][1]);
						$sx .= '<BR>';
						}
					}
				$sx .= '</table>';
				$sx .= '</fieldset>';

				$sx .= '<TD width="33%">';
				/* Comite Gestor */
				$sx .= '<fieldset><legend>Comit� Gestor</legend>';
				$sx .= '<table>';
				$ax = '';
				
				for ($r=0;$r < count($gestor);$r++)
					{
						if ($professor != trim($gestor[$r][0]))
						{
						$in++;
						if ($ax != $gestor[$r][2])
							{
							$sx .= '<BR>';
							$sx .= '<B>'.$gestor[$r][2].' - '.$gestor[$r][3].'</b><BR>'; 
							$ax = $gestor[$r][2]; 
							}
						 
						$sx .= '<input type="checkbox" name="ddp'.$in.'" value="'.$gestor[$r][0].'">';
						$sx .= trim($gestor[$r][1]);
						$sx .= '</FONT><BR>';
						}
					}
				$sx .= '</table>';
				$sx .= '</fieldset>';
				$sx .= '<TR><TD colspan=3>';
				$sx .= '<input type="submit" name="acao2" value="'.$bb1.'">';
				$sx .= '</table>';
				$sx .= '</form>';
				echo $sx;
				return($sx);				
			}


		function le($id='')
			{
				$id = round($id);
				$sql = "select * from ".$this->tabela."
					where id_pj = $id or pj_codigo = '$id'";
				$rlt = db_query($sql);
				if ($line = db_read($rlt))
					{
						$this->id = $line['id_pj'];
						$this->protocolo = trim($line['pj_codigo']);
						$this->titulo = trim($line['pj_titulo']);
						$this->ano = trim($line['pj_ano']);
						$this->resumo = trim($line['pj_resumo']);
						$this->objetivo = trim($line['pj_objetivo']);
						$this->keywords = trim($line['pj_keywords']);
						$this->area = trim($line['pj_area']);
						$this->area_estrategica = trim($line['pj_area_estra']);
						$this->update = trim($line['pj_update']);
						$this->data = trim($line['pj_data']);
						$this->ss_programa = trim($line['pj_ss_programa']);
						$this->ss_linha = trim($line['pj_ss_linha']);
						$this->search = trim($line['pj_search']);
						$this->cep = trim($line['pj_cep']);
						$this->ceua = trim($line['pj_ceua']);
						$this->cep_status = trim($line['pj_cep_status']);
						$this->ceua_status = trim($line['pj_ceua_status']);
						$this->status = trim($line['pj_status']);
						$this->professor = trim($line['pj_professor']);
						$this->line = $line;
					}
				
			}

		function convert()
			{
				$sql = "select * from ".$this->tabela." 
						inner join pibic_submit_documento on doc_protocolo_mae = pj_codigo where pj_status <> doc_status
						and doc_status <> 'X'
						limit 5
				";
				$rlt = db_query($sql);
				$tot = 0;
				$xsql = "";
				while ($line = db_read($rlt))
					{
						$tot++;
						$pj_status = $line['pj_status'];
						$pl_status = $line['doc_status'];
						$xsql .= "<BR>update pibic_submit_documento set doc_status = '".$pl_status."' where id_doc = ".$line['id_doc'];	
						$sql = "update pibic_submit_documento set doc_status = '".$pj_status."' where id_doc = ".$line['id_doc'];
						$xrlt = db_query($sql);
					}
				return(1);
			}

		function status()
			{
				$sta = $this->status;
				$sa = $this->status_tipos();
				$sc = $sa[1];
				$sn = $sa[0];
				$sx = '<font color="'.$sc[$sta].'">';
				$sx .= $sn[$sta];
				$sx .= '</font>';
				return($sx);
			}

		function projetos_cancelar_sem_titulo()
			{
				$sql = "select count(*) as total from pibic_submit_documento 
						where doc_1_titulo = 'sem t�tulo' 
						and doc_status = 'B' and doc_ano = '".date("Y")."' ";
				$rlt = db_query($sql);
				$line = db_read($rlt);
				echo '--->Total de:'.$line['total'];
		
				$sql = "update pibic_submit_documento set doc_status = 'X'
						, doc_2_titulo = 'cancelado automaticamente ' 
						where doc_1_titulo = 'sem t�tulo' 
						and doc_status = 'B' and doc_ano = '".date("Y")."' ";
				$rlt = db_query($sql);
			}
		function status_tipos()
			{
				$st = array('@' => 'Em submiss�o (in�cio)',
							'A' => 'Submiss�o',
							'B' => 'Enviado',
							'X' => 'Cancelado',
							'T' => 'Pend�ncia para TI',
							'U' => 'Pend�ncia para o Gestor',
							'!' => 'Devolver ao professor para corre��es');
				$cr = array('@' => 'orange',
							'A' => 'orange',
							'B' => 'Green',
							'X' => 'Red',
							'U' => 'Red',
							'T' => 'Red',
							'@' => 'orange'
							);
				return(array($st,$cr));
			}
		function mostra_erros()
			{
				if (strlen($this->erros) > 0)
				{
				$sx = '<center><div style="background-color: #FFc0c0; height: 50px; width: 80%; padding: 10px 10px 10px 10px; ">';
				$sx .= '<img src="'.http.'pibic/img/icone_error.png" align="left" height="50">';
				$sx .= '<font class="lt2">';
				$sx .= $this->erros;
				$sx .= '</div>';
				}
				return($sx);
			}
		function row()
			{
				global $cdf,$cdm,$masc;
				$cdf = array('id_pj','pj_codigo','pj_titulo','pj_ano','pj_status','pj_professor');
				$cdm = array('cod',msg('codigo'),msg('titulo'),msg('ano'),msg('status'),msg('professor'));
				$masc = array('','','','','','','');
				return(1);				
			}		
		function cp_ti()
			{
				$cp = array();
				array_push($cp,array('$H8','id_doc','',False,TRUE));
				array_push($cp,array('$M8','','<B>T�tulo do plano do aluno',False,TRUE));
				array_push($cp,array('$T60:5','doc_1_titulo','T�tulo',TRUE,TRUE));
				return($cp);
			}	
		function cp_pj_ti()
			{
				$cp = array();
				array_push($cp,array('$H8','id_pj','',False,TRUE));
				array_push($cp,array('$M8','','<B>T�tulo do projeto do professor',False,TRUE));
				array_push($cp,array('$T60:5','pj_titulo','T�tulo',TRUE,TRUE));
				return($cp);
			}	

		function cp()
			{
				$cp = array();
				array_push($cp,array('$H8','id_pj','',False,TRUE));
				array_push($cp,array('$H8','','',False,TRUE));
				array_push($cp,array('$S8','pj_codigo','Protocolo',True,True));
				array_push($cp,array('${','','Dados do projeto do professor',False,True));
				array_push($cp,array('$M8','','<B>T�tulo do projeto do professor',False,TRUE));
				array_push($cp,array('$T60:5','pj_titulo','T�tulo',TRUE,TRUE));

//				array_push($cp,array('$M8','','<B>Breve resumo (at� 250 palavaras)',False,TRUE));
//				array_push($cp,array('$T60:5','pj_resumo','Resumo',False,TRUE));

//				array_push($cp,array('$M8','','<B>Palavras-chave (at� 5 termos)',False,TRUE));
//				array_push($cp,array('$S255','pj_keyword','Palavras-chave',False,TRUE));

//				array_push($cp,array('$}','','Dados do projeto do professor',False,True));
				
				array_push($cp,array('${','','�rea de conhecimento',False,True));
				array_push($cp,array('$S14 ','pj_area','�rea',TRUE,TRUE));
				//array_push($cp,array('$S14','pj_area_estrategica','�rea estrat�gica',False,True));
				array_push($cp,array('$}','','Dados do projeto do professor',False,True));
				
				array_push($cp,array('$S1','pj_status','Status',True,True));
				array_push($cp,array('$S8','pj_professor','Professor',TRUE,TRUE));
				return($cp);
			}

		function resumo_professores()
			{
				$sql .= "select * from pibic_professor
						left join (";
				$sql .= "select sum(pibic) as pibic, 
								sum(pibiti) as pibiti,
								sum(pibice) as pibice,
								doc_autor_principal from (";
				$sql .= "select count(*) as pibic,0 as pibiti,0 as pibice,doc_autor_principal from pibic_submit_documento where (doc_edital = 'PIBIC' and doc_status = 'B') group by doc_autor_principal, doc_edital ";
				$sql .= " union ";
				$sql .= "select 0 as pibic,count(*) as pibiti,0 as pibice,doc_autor_principal from pibic_submit_documento where (doc_edital = 'PIBITI' and doc_status = 'B') group by doc_autor_principal, doc_edital ";
				$sql .= " union ";
				$sql .= "select 0 as pibic,0 as pibiti, count(*) as pibice,doc_autor_principal from pibic_submit_documento where (doc_edital = 'PIBICE' and doc_status = 'B') group by doc_autor_principal, doc_edital ";
				
				$sql .= ") as projetos 
							group by doc_autor_principal ";
				$sql .= ") as projes 
						 on pp_cracha = doc_autor_principal 
						 left join centro on pp_escola = centro_codigo
						 
						 order by centro_nome, pp_curso, pp_nome
						 ";
				$rlt = db_query($sql);
				$t1 = 0; 
				$t2 = 0;
				$t3 = 0;
				$tt = 0;
				$px = 'x';
				$py = 'y';
				while ($line = db_read($rlt))
					{
						$ativo = trim($line['pp_ativo']);
						$centron = trim($line['centro_nome']);
						$curso = trim($line['pp_curso']);
						$centro = trim($line['pp_centro']);
						$escola = trim($line['pp_escola']);
												
						if ($centron != $px)
							{ $sx .= '<TR class="lt2"><TD colspan=7><B>'.$centron; $px = $centron; }
						if ($curso != $py)
							{ $sx .= '<TR class="lt2"><TD colspan=7><B>'.$curso; $py = $curso; }
							
						$p1 = ($line['pibic']+$line['pibiti']+$line['pibice']);
						
						if (($ativo==1) or ($p1 > 0))
						{
							$ft = '<font color="black">';
							if ($ativo == 0) { $ft = '<font color="red">'; }						
							$sx .= '<TR>';
							$sx .= '<TD>';
							$sx .= $ft. $line['pp_cracha'];
							$sx .= '<TD>';
							$sx .= $ft. $line['pp_nome'];
	
							$sx .= '<TD align="center">';
							$sx .= $ft. $line['pp_ss'];
	
							$sx .= '<TD align="center">';
							$sx .= $ft. $line['pp_prod'];
	
							$sx .= '<TD align="center">';
							$sx .= $ft. $line['pibic'];
							$sx .= '<TD align="center">';
							$sx .= $ft. $line['pibiti'];
							$sx .= '<TD align="center">';
							$sx .= $ft. $line['pibice'];
							$t1 = $t1 + $line['pibic'];
							$t2 = $t2 + $line['pibiti'];
							$t3 = $t3 + $line['pibice'];
						}
					}
				$sa = '<table class="lt1" width="'.$tab_max.'">';
				$sa .= '<TR><TH>Cod.Funcional<TH>Nome<TH>SS<TH>Prod.<TH>PIBIC<TH>PIBITI<TH>PIBIC_EM(Jr)';
				$sa .= $sx;
				$sa .= '<TR><TD><TD><TD>'.$t1.'<TD>'.$t2.'<TD>'.$t3;
				$sa .= '<TR><TD>'.($t1+$t2+$t3);
				$sa .= '</table>';
				return($sa);
			}
		function submit_plano_jr_valida($protocolo)
			{
				$sql = "select * from pibic_submit_documento where doc_protocolo = '".$protocolo."' ";
				$rlt = db_query($sql);
				if ($line = db_read($rlt))
					{
						$ok = 1;
						if (strlen(trim($line['doc_1_titulo'])) < 10) { $ok = -1;}
						$sql = "select count(*) as total from pibic_ged_documento 
								where doc_dd0 = '".$protocolo."' 
								and doc_tipo = 'PLANO'
								and doc_ativo = 1
								";
						$rrlt = db_query($sql);
						$rline = db_read($rrlt);
						$total = $rline['total'];
						if ($total <= 0) { $ok = -3; }
					} else {
						$ok = 0;
					}
				return($ok);
				
			}
		function submit_plano_valida($protocolo)
			{									
				$sql = "select * from pibic_submit_documento where doc_protocolo = '".$protocolo."' ";
				$rlt = db_query($sql);
				if ($line = db_read($rlt))
					{
						$ok = 1;
						$aluno = trim($line['doc_aluno']);
						if (strlen(trim($line['doc_1_titulo'])) < 10) 
							{
								$ok = -1;
								echo '<BR><font color="red">T�tulo do trabalho muito curto</font>';
							}
						if (strlen(trim($line['doc_aluno'])) != 8) { $ok = -2;}
						$sql = "select count(*) as total from pibic_ged_documento 
								where doc_dd0 = '".$protocolo."' 
								and doc_tipo = 'PLANO'
								and doc_ativo = 1
								";
						$rrlt = db_query($sql);
						$rline = db_read($rrlt);
						$total = $rline['total'];
						if ($total <= 0) { $ok = -3; }
					} else {
						$ok = 0;
					}
				
				/* RN: Verifica se o aluno n�o est� na BlackList */
				if (strlen($aluno) != 8)
					{
						echo '<font color="red">C�digo do aluno � necess�rio</font>';
					}
				if (($aluno != '00000000') and (strlen($aluno) == 8))
					{
					$ix = $this->aluno_em_outros_planos($aluno,$protocolo); 
					if ( $ix > 0)
						{
							echo '<font color="red">ALUNO J� INCLU�DO EM OUTROS PROTOCOLOS ()</font>';
							$ok = 0;;							
						}
					}
					
				/* RN: Verifica se o aluno n�o esta em outro plano */				
				return($ok);
			}
			
		/** Submiss�o de projetos */
		
		function submit_projeto_valida_new($protocolo)
			{
				$sql = "select * from ".$this->tabela." where pj_codigo = '".$protocolo."' ";
				$rlt = db_query($sql);
				if ($line = db_read($rlt))
					{
						$ok = 1;
						$this->erros = '';
						if (strlen(trim($line['pj_titulo'])) < 5) { $ok = -1; $this->erros .= 'T�tulo inv�lido ou muito curto<BR>'; }
						//if (strlen(trim($line['pj_area'])) < 8) { $ok = -2; $this->erros .= '�rea do conhecimento n�o definida<BR>'; }						
					} else {
						$ok = 0;
					}
				return($ok);
			}		
			
		function submit_projeto_valida($protocolo)
			{
				$sql = "select * from ".$this->tabela." where pj_codigo = '".$protocolo."' ";
				$rlt = db_query($sql);
				if ($line = db_read($rlt))
					{
						$ok = 1;
						$this->erros = '';
						if (strlen(trim($line['pj_titulo'])) < 5) { $ok = -1; $this->erros .= 'T�tulo inv�lido<BR>'; }
						if (strlen(trim($line['pj_area'])) < 8) { $ok = -2; $this->erros .= '�rea do conhecimento n�o definida<BR>'; }
						if (strlen(trim($line['pj_ext_sn'])) ==0 ) { $ok = -2; $this->erros .= 'Exist�ncia de financiamento externo n�o informado<BR>'; }
						if (strlen(trim($line['pj_gr2_sn'])) ==0 ) { $ok = -2; $this->erros .= 'Exist�ncia de financiamento por empresas n�o informado<BR>'; }
						/** */
						if ($line['pr_ext_sn']=='S')
							{
							if (strlen(trim($line['pj_ext_local'])) ==0 ) { $ok = -2; $this->erros .= 'Financiador externo n�o informado<BR>'; }		
							if (strlen(trim($line['pj_ext_edital'])) ==0 ) { $ok = -2; $this->erros .= 'Edital do financiador externo n�o informado<BR>'; }		
							if (strlen(trim($line['pj_ext_valor'])) ==0 ) { $ok = -2; $this->erros .= 'Valor do financiador externo n�o informado<BR>'; }		
							}
						
						$sql = "select count(*) as total from pibic_submit_ged 
								where doc_dd0 = '".$protocolo."' 
								and doc_tipo = 'PROJ'
								and doc_ativo = 1
								";
						$rrlt = db_query($sql);
						$rline = db_read($rrlt);
						$total = $rline['total'];
						if ($total <= 0) { $ok = -3; $this->erros .= 'Arquivo com o projeto do professor n�o postado.'; }
					} else {
						$ok = 0;
					}
				return($ok);
			}			

		function submit_plano_total()
			{
				$proto_mae = $this->protocolo;
				$sql = "select count(*) as total from pibic_submit_documento 
						where (doc_edital = 'PIBIC' or doc_edital = 'PIBITI')
						and doc_status <> 'X' and doc_protocolo_mae = '$proto_mae' ";
				$yrlt = db_query($sql);
				if ($yline = db_read($yrlt))
						{
							$tot = $yline['total'];
						} else {
							$tot = 0;
						}
				return($tot);
			}
		function submit_plano_new()
			{
				global $dd,$user,$ss;
					$data = date("Ymd");
					$hora = date("H:i");
					$proto_mae = $this->protocolo;
					$professor = $ss->user_cracha;
					$tipo = 'PIBIC';
					$edital = 'PIBIC';
					$ano = date("Y");
				
					$proto_mae = $this->protocolo;
					$qsql = "select * from pibic_submit_documento
							where doc_protocolo_mae = '$proto_mae'
							and doc_status = '@' and doc_1_titulo = 'sem t�tulo'";
					$rlt = db_query($qsql);
					if (!($line = db_read($rlt)))
						{
						$tot = $this->submit_plano_total();
						
						if ($tot >= 2)
							{
								echo 'Limite de planos de alunos por projeto';
								exit;
							}

						$sql = "insert into pibic_submit_documento 
							(doc_1_titulo, doc_1_idioma, doc_protocolo,
							doc_protocolo_mae, doc_aluno, doc_data, 
							doc_hora, doc_dt_atualizado, doc_autor_principal, 
							doc_status, doc_tipo, doc_journal_id, 
							doc_update, doc_icv, doc_ano, 
							doc_edital, doc_nota, doc_avaliacoes)
							values
							('sem t�tulo','pt_BR','',
							'$proto_mae','$aluno','$data',
							'$hora',$data,'$professor',
							'@','$tipo',20,
							$data,'$icv','$ano',
							'$edital',0,0)";
							$rlt = db_query($sql);
						}
							
					/*** Atualiza c�digos */
					$sql = "select * from pibic_submit_documento where doc_protocolo = '' and doc_status = '@'; ";
					$xrlt = db_query($sql);
							
					while ($xline = db_read($xrlt))
						{
							$sql = "update pibic_submit_documento 
									set doc_protocolo = '".strzero($xline['id_doc'],7)."'
									where id_doc = ".$xline['id_doc'];
							$yrlt = db_query($sql);			
						}
						
					/* Recupera protocolo */
					$rlt = db_query($qsql);
					$line = db_read($rlt);
						$proto = $line['doc_protocolo'];
						$_SESSION["proto_aluno"] = $proto;
					redirecina(page());									
			}
		function aluno_em_outros_planos($aluno,$protocolo='')
			{
				$ano = date("Y");
				$sql = "select * from pibic_submit_documento where  
				 		doc_aluno = '$aluno' and doc_ano = '$ano' 
				 		and doc_protocolo <> '".$protocolo."' 
				 		and doc_status <> 'X'
				 		";
				$rlt = db_query($sql);
				$id = 0;
				while ($line = db_read($rlt))
				{
					$ppp = $line['doc_protocolo'];
					// ALUNO J� INCLU�DO EM OUTROS PROTOCOLOSecho '<HR>';
					$id++;
					$status = $line['doc_status'];
				}
				if ($aluno=='00000000') { $id = 0; }
				return($id);
			}
		function submit_plano()
			{
				global $dd,$acao,$user,$ss;

				require_once('../_class/_class_discentes.php');
				$estu = new discentes;				
				/** Grava **/
				$data = date("Ymd");
				$hora = date("H:i");
				$proto_mae = $this->protocolo;
				$professor = $ss->user_cracha;
				$tipo = 'PLANO';
				$ano = date("Y");
				$edital = $dd[10]; 
				$aluno = substr($dd[8],0,8);
				$titulo = substr($dd[2],0,200);
				$icv = $dd[9];
				$ok = 0;
				
				$id = $_SESSION["proto_aluno"];
				
				if (strlen($acao)==0)
					{
						$sql = "select * from pibic_submit_documento
								where doc_protocolo = '$id'
									and doc_autor_principal  = '$professor' ";
								
							$rlt = db_query($sql);
							$line = db_read($rlt);
							$id = $line['doc_protocolo'];
							$_SESSION["proto_aluno"] = $id;
							$dd[8] = trim($line['doc_aluno']);
							$aluno = substr($dd[8],0,8);
							$dd[2] = trim($line['doc_1_titulo']);
							$dd[10] = trim($line['doc_edital']);
							$dd[9] = $line['doc_icv'];
							$proto_mae = $line['doc_protocolo_mae'];
					}


				/** Consulta **/
				$valid = '';
				if (strlen($aluno) > 0)
					{ $aluno = strzero(round($aluno),8); }
				
				if (strlen($aluno)==8)
					{
					if ($estu->le('',$aluno)==0)
						{
							$estu->consulta($aluno);
							$estu->le('',$aluno);
						}
					}

				$proto = $_SESSION['proto_aluno'];
				$_SESSION["proto_aluno"] = $proto;
				
				if ($dd[10]=='PIBIC') { $sel10a = 'selected'; }
				if ($dd[10]=='PIBITI') { $sel10b = 'selected'; }
				if ($dd[9] == '1') { $chk9 = 'checked'; }

				$sx .= '<form method="post">';
				$sx .= '<input type="hidden" name="dd1" value="'.$dd[1].'">
						<input type="hidden" name="dd0" value="'.$dd[0].'">
						';
				$sx .= '<fieldset><legend>T�tulo do plano do aluno</legend>
						<table width="100%">
						<TR class="lt0"><TD align="right">PROTOCOLO:<B>'.$proto.'</B>/'.$proto_mae.'
						<tr><TD class="lt0">'.$msg1.'T�TULO DO PLANO DO ALUNO '.$obr.'
						<tr><td><textarea name="dd2" cols="80" rows="3">'.$dd[2].'</textarea>
				
						<tr><TD class="lt0">'.$msg1.'Modalidade '.$obr.'
						<tr><td>
							<select name="dd10">
							<option value="">::Modalidade::</option>
							<option value="PIBIC" '.$sel10a.'>PIBIC</option>
							<option value="PIBITI" '.$sel10b.'>PIBITI</option>
							</select>
						</table>
						';

				$sx .= '</fieldset>';
				
				/** Estudante */
				$sx .= '<fieldset><legend>Dados do estudante</legend>
						<table>
						<tr><TD class="lt0">'.$msg1.'IDENTIFICA��O DO ALUNO '.$obr.'
						<TR><TD>C�digo do aluno: <input type="text" name="dd8" size=8 maxlength=8 value="'.$aluno.'"> (8 digitos)
						<BR><font class="lt1">Ex: 101<font color="blue">12345678</font>1
						';						
	
						$sx .= '<table width="100%"><TR><TD>';
						
						$estu->le('',$aluno);						
						if (strlen($estu->pa_nome) ==0)
							{
								$this->erros = 'C�digo do aluno inv�lido<BR>';
							} else {
								$sx .= $estu->mostra_dados_pessoais();	
								$valid = '1';
							}										
						$sx .= '</table>';

				$sx .= '<tr><TD class="lt2"><BR><BR>';
				$sx .= '<B>O estudante tem vinculo empregat�cio?';
				$sx .= '<tr><TD class="lt2">
							<input type="checkbox" value="1" name="dd9" '.$chk9.'> SIM. O estudante com v�nculo empregat�cio poder� concorrer somente a Bolsa PUCPR 
							<input type="hidden" name="dd12" value="'.$valid.'">
						</table>
						';
				$sx .= '</fieldset>';				
				
				/** Arquivos */
				$sx .= '<fieldset><legend>Arquivos submetidos</legend>';
				$sx .= '<iframe src="submit_pibic_plano_arquivos.php" 
						width=100%
						height=150 style="border: 0px solid #FFFFFF;"></iframe>';
				$sx .= '</fieldset>';
				
				/*** SALVAR **/
				
				$sx .= '<BR><BR><center>
					<input type="submit" name="acao" value="Gravar e avan�ar >>>" style="width: 300px; height: 50px;">
					';					
								
				$sx .= '</form>';
				/*** Checagems **/
				$icv = $dd[9];
				$ok = 1;
				if (strlen($dd[2]) < 10) { $ok=-1; $this->erros .= 'T�tulo muito curto<BR>'; }
				/*** Checar dados do plano */
				$sql = "select * from pibic_submit_documento 
						where doc_1_titulo = '".$titulo."' 
						and doc_protocolo <> '".$proto."' 
						and doc_status <> 'X' ";
				$yrlt = db_query($sql);
				if ($yline = db_read($yrlt))
					{
						$ok=-2; $this->erros .= 'T�tulo j� lan�ado no sistema<BR>';
					}
				/*** Salva Dados */
				if ((strlen($acao) > 0) and ($proto != ''))
					{
						$valida = $this->submit_plano_valida($proto);
						$sta = '@';
						$ok = 0;
						$aluno = substr($aluno,0,8);
						if ($valida > 0) { $sta = 'A'; $ok = 1; } 									
						$sql = "update pibic_submit_documento set 
							doc_status = '$sta',
							doc_1_titulo = '$titulo',
							doc_aluno = '$aluno',
							doc_dt_atualizado = '$data',
							doc_tipo = '$tipo',
							doc_edital = '$edital',	
							doc_icv = '$icv'						
							where doc_protocolo = '$proto' and doc_autor_principal = '$professor'
						";
						$rlt = db_query($sql);						
					}				
				if (strlen(trim($dd[10])) == 0) { $ok=-5; $this->erros .= 'Modalidade do edital n�o selecionada<BR>'; }
				if ($valida == -3) { $ok=-3; $this->erros .= 'Falta arquivo do plano dos alunos<BR>'; }
				if (($ok==1) and (strlen($acao) > 0) and ($valid==1) and (strlen($aluno)==8))
					{
						redirecina('submit_project.php');
					}
				//echo "ok=$ok, acao=$acao, valid=$valid, aluno=$aluno ";
				if (strlen($acao) > 0 ) 
				{ $sa = $this->mostra_erros(); }
				return($sa. $sx);
			}

		function submit_plano_jr()
			{
				global $dd,$acao,$user;
				/** Grava **/
				$proto = $_SESSION["proto_aluno"];
				$data = date("Ymd");
				$hora = date("H:i");
				$proto_mae = $this->protocolo;
				$professor = $user->cracha;
				$tipo = 'PLANO';
				$ano = date("Y");
				$edital = 'PIBICE'; 
				$aluno = $dd[8];
				$titulo = $dd[2];
				$ok = 0;
				$id = $_SESSION['proto_aluno'];
				if (strlen($id)==0) { redirecina('submit_project.php'); }
				if (strlen($acao)==0) 
					{
						
						$sql = "select * from pibic_submit_documento
								where doc_protocolo = '$id'
									and doc_autor_principal = '$professor' 
									and doc_status <> 'X' 
									";
							$rlt = db_query($sql);
							$line = db_read($rlt);
							$proto = $line['doc_protocolo'];
							$_SESSION["proto_aluno"] = $proto;
							$dd[8] = trim($line['doc_aluno']);
							$aluno = $dd[8];
							$dd[2] = trim($line['doc_1_titulo']);
							$dd[10] = trim($line['doc_edital']);
							$proto_mae = $line['doc_protocolo_mae'];
					}
				
				if ((strlen($acao) > 0) and ($proto != ''))
					{
						$valida = $this->submit_plano_jr_valida($proto);
						$sta = '@';
						$ok = 0;
						$aluno = substr($aluno,0,8);
						if ($valida > 0) { $sta = 'A'; $ok = 1; } 									
						$sql = "update pibic_submit_documento set 
							doc_status = '$sta',
							doc_1_titulo = '$titulo',
							doc_aluno = '$aluno',
							doc_dt_atualizado = '$data',
							doc_tipo = '$tipo',
							doc_edital = '$edital'							
							where doc_protocolo = '$proto'
							and doc_autor_principal = '$professor'
						";
						$rlt = db_query($sql);						
					}
				$proto = $_SESSION['proto_aluno'];
				$_SESSION["proto_aluno"] = $proto;
				
				if ($dd[10]=='PIBICE') { $sel10a = 'selected'; }
				if ($dd[9] == '1') { $chk9 = 'checked'; }

				$sx .= '<form method="post">';
				$sx .= '<input type="hidden" name="dd1" value="'.$dd[1].'">
						<input type="hidden" name="dd0" value="'.$dd[0].'">
						';
				$sx .= '<fieldset><legend>T�tulo do plano do aluno do PIBIC_EM (PIBICjr)</legend>
						<table width="100%">
						<TR class="lt0"><TD align="right">PROTOCOLO:<B>'.$proto.'</B>/'.$proto_mae.'
						<tr><TD class="lt0">'.$msg1.'T�TULO DO PLANO DO ALUNO '.$obr.'
						<tr><td><textarea name="dd2" cols="80" rows="3">'.$dd[2].'</textarea>
				
						<tr><TD class="lt0">'.$msg1.'Modalidade '.$obr.'
						<tr><td>
							<select name="dd10">
							<option value="PIBICE" '.$sel10a.'>PIBIC_EM (Pibic Jr)</option>
							</select>
						</table>
						';

				$sx .= '</fieldset>';
						
				/** Arquivos */
				$sx .= '<fieldset><legend>Arquivos submetidos</legend>';
				$sx .= '<iframe src="submit_pibic_plano_arquivos.php" 
						width=100%
						height=150 style="border: 0px solid #FFFFFF;"></iframe>';
				$sx .= '</fieldset>';
				
				/*** SALVAR **/
				
				$sx .= '<BR><BR><center>
					<input type="submit" name="acao" value="Gravar e avan�ar >>>" style="width: 300px; height: 50px;">
					';					
								
				$sx .= '</form>';
				
				if (($ok==1) and (strlen($acao) > 0))
					{
						redirecina('submit_project.php');
					}
				$sa = $this->mostra_erros();
				return($sa. $sx);
			}

		function submit_plano_jr_new()
			{
				global $dd,$acao,$user;
				/** Grava **/
				$data = date("Ymd");
				$hora = date("H:i");
				$proto_mae = $this->protocolo;
				$professor = $user->cracha;
				$tipo = 'PLANO';
				$ano = date("Y");
				$edital = 'PIBICE'; 
				$aluno = $dd[8];
				$titulo = $dd[2];
				$ok = 0;
				if ($dd[0] == 'NEW')
					{
						$proto_mae = $this->protocolo;
						
						$sql = "select * from pibic_submit_documento
								where doc_protocolo_mae = '$proto_mae'
								and doc_status = '@' and doc_edital = 'PIBICE'";
						$rlt = db_query($sql);
						
						if (!($line = db_read($rlt)))
							{						
							$sql = "insert into pibic_submit_documento
								(doc_1_titulo, doc_1_idioma, doc_protocolo,
								doc_protocolo_mae, doc_aluno, doc_data, 
								doc_hora, doc_dt_atualizado, doc_autor_principal, 
								doc_status, doc_tipo, doc_journal_id, 
								doc_update, doc_icv, doc_ano, 
								doc_edital, doc_nota, doc_avaliacoes)
								values
								('sem t�tulo','pt_BR','',
								'$proto_mae','$aluno','$data',
								'$hora','$data','$professor',
								'@','$tipo',20,
								$data,'$icv','$ano',
								'$edital',0,0)";
								$rlt = db_query($sql);
							}

						/*** Atualiza c�digos */
						$sql = "select * from pibic_submit_documento where doc_protocolo = '' and doc_status = '@'; ";
						$xrlt = db_query($sql);
						
						while ($xline = db_read($xrlt))
							{
								$sql = "update pibic_submit_documento 
										set doc_protocolo = '".strzero($xline['id_doc'],7)."'
										where id_doc = ".$xline['id_doc'];
								$yrlt = db_query($sql);			
							}		
					
						$sql = "select * from pibic_submit_documento
								where doc_protocolo_mae = '$proto_mae'
								and doc_status = '@' and doc_edital = 'PIBICE'";
						$rlt = db_query($sql);
						$line = db_read($rlt);
						$proto = $line['doc_protocolo'];
						$_SESSION["proto_aluno"] = $proto;	
						redirecina('submit_phase_4.php');					
					}
				return(1);
			}

		function acao_finalizar_avaliacao()
			{
				$sql = "update ".$this->tabela." set pj_status = 'F' where pj_codigo = '".$this->protocolo."'";
				$wrlt = db_query($sql);
								
			}
			
		function acao_pendecia_avaliacao_ti()
			{
				$sql = "update ".$this->tabela." set pj_status = 'T' where pj_codigo = '".$this->protocolo."'";
				$wrlt = db_query($sql);
				
			}
		
		function acao_pendecia_avaliacao_gestor()
			{
				$sql = "update ".$this->tabela." set pj_status = 'U' where pj_codigo = '".$this->protocolo."'";
				$wrlt = db_query($sql);
			}
		function acao_cancelar_protocolo()
			{
				$sql = "update pibic_submit_documento set doc_status = 'X' where doc_protocolo_mae = '".$this->protocolo."'";
				$wrlt = db_query($sql);

				$sql = "update ".$this->tabela." set pj_status = 'X' where pj_codigo = '".$this->protocolo."'";
				$wrlt = db_query($sql);
				return(True);
			}
		function acao_devolver_avaliacao()
			{
				$sql = "update ".$this->tabela." set pj_status = 'B' where pj_codigo = '".$this->protocolo."'";
				$wrlt = db_query($sql);
			}

		function projetos_acoes()
			{
				global $dd,$acao;
				$sta = $this->status;
				$action = array();
				$cmd = array();
				if ($sta == '@')
					{
						array_push($action,'Aceitar para avalia��o');
						array_push($action,'Cancelar projeto');
						array_push($cmd,'001');
						array_push($cmd,'900');
					}				
				if ($sta == 'B')
					{
						array_push($action,'Indicar para avaliador');
						array_push($action,'Marcar como Pend�ncia TI');
						array_push($action,'Marcar como Pend�ncia Gestor');
						array_push($cmd,'001');
						array_push($cmd,'003');
						array_push($cmd,'004'); 
					}
				if ($sta == 'D')
					{
						array_push($action,'Reindicar para avaliador');
						array_push($cmd,'001');
					}
				if ($sta == 'F')
					{
						array_push($action,'Reindicar para avaliador');
						array_push($cmd,'001');
					}					

				if ($sta == 'C')
					{
						array_push($action,'Indicar para avaliador');
						array_push($cmd,'001');
					}

				if ($sta == 'T')
					{
						array_push($action,'Devolver para Indica��o');
						array_push($action,'Cancelar protocolo');
						array_push($cmd,'005');
						array_push($cmd,'900');  
					}

				if ($sta == 'U')
					{
						array_push($action,'Devolver para Indica��o');
						array_push($cmd,'005'); 
					}
					
				if ($sta == 'C')
					{
						array_push($action,'Indicar para avaliador');
						array_push($action,'Finalizar avalia��o');
						array_push($cmd,'001','002'); 
					}
										
				if (strlen($acao) > 0)
					{
						$ccc='';
						for ($r=0;$r < count($action);$r++)
							{					
								if ($action[$r] == $acao) { $ccc = $cmd[$r]; }
							}
			
						if ($ccc == '001') { $this->acao_indicar_avaliadores(); }
						if ($ccc == '002') { $this->acao_finalizar_avaliacao(); }
						if ($ccc == '003') { $this->acao_pendecia_avaliacao_ti(); }
						if ($ccc == '004') { $this->acao_pendecia_avaliacao_gestor(); }
						if ($ccc == '005') { $this->acao_devolver_avaliacao(); }
						if ($ccc == '900') { $this->acao_cancelar_protocolo(); }
					}				
				if ((count($action) > 0) and (strlen($acao) == 0))
					{
						$sx .= '<form action="'.page().'" method="get"">';
						$sx .= '<input type="hidden" name="dd0" value="'.$dd[0].'">';
						$sx .= '<input type="hidden" name="dd90" value="'.$dd[90].'">';
						$sx .= '<table width="100%">';
						$sx .= '<TR>';
						for ($r=0;$r < count($action);$r++)
							{
								$sx .= '<TD align="center">';
								$sx .= '<input type="submit" name="acao" value="'.$action[$r].'">';
							}
						$sx .= '</table>';
						$sx .= '</form>';
					}
				return($sx);
			}



		function mostra_plano_line($line)
			{
						$sx .= '<table width="100%" class="tabela00" border=0>';
						$edital = trim($line['doc_edital']);
						$icv = round($line['doc_icv']);
						if ($icv == 1) { $icv = 'SIM'; } else { $icv = 'N�O'; } 
						if ($edital == 'PIBICE') { $edital = "PIBIC_EM"; }
						
						$sx .= '<TR><TD class="lt0">t�tulo do plano de trabalho do aluno';
						
						$sx .= '<tr><td valign="top" class="tabela01"><H4>'.$line['doc_1_titulo'].'</H4>';
						$sx .= '<TD class="tabela01" valign="top" ><font class="lt0">Protocolo</font><br><b>'.$line['doc_protocolo'].'</b>';
					
						
						$aluno = trim($line['doc_aluno']);
						if (strlen($aluno) > 0)
							{
							$sx .= '<TR><TD class="lt0">Aluno';
							$sx .= '<TD class="lt0">Modalidade';
							$sx .= '<TR><TD class="tabela01" colspan=1>'.$line['doc_aluno'].' '.$line['pa_nome'];
							$sx .= '<TD class="tabela01">'.$edital.'/'.$line['doc_ano'];							
							}
						$sx .= '<TR><TD>Concorrer somente a bolsas PUCPR e ICV (pois o aluno tem vinculo empregat�cio): '.$icv;
													
						$sx .= '<TR><TD><HR>';
						$sx .= '</table>';
				return($sx);
			}
		function mostra_plano()
			{
				$sql = "select * from pibic_submit_documento
						left join pibic_aluno on pa_cracha = doc_aluno 
						where doc_protocolo_mae = '".$this->protocolo."' 
						and doc_status <> 'X' ";
				$rlt = db_query($sql);
				
				while ($line = db_read($rlt))
					{
						$sx .= $this->mostra_plano_line($line);
					}
				
				return($sx);
			}

		function mostra_projeto()
			{
				$sql = "select geral.a_descricao as a_descricao_geral,
								estra.a_descricao as a_descricao_estra,
						* from ".$this->tabela." ";
				$sql .= " left join docentes on pj_professor = pp_cracha ";
				$sql .= " left join ajax_areadoconhecimento as geral on pj_area = geral.a_cnpq ";
				$sql .= " left join ajax_areadoconhecimento as estra on pj_area_estra = estra.a_cnpq ";
				$sql .= " where pj_codigo = '".$this->protocolo."' ";
				$rlt = db_query($sql);
				$line = db_read($rlt);
				
				$sn = array('N�O','SIM');
				$ap1 = $sn[$line['pj_ext_sn']];
				$ap2 = $sn[$line['pj_gr2_sn']];
				$lattes = trim($line['pp_lattes']);
				$lattes = troca($lattes,".jsp",".do");
				$professor = trim($line['pp_cracha']);
				
				if (strlen($lattes) >0)
					{
						$lattes = '&nbsp;&nbsp;<A HREF="'.$lattes.'" target="_NEW">lattes</a>';
					}
				
				/** Banco de Projetos */
				$bp = $line['pj_bp'];
				if ($bp == 'S')
					{
						$sa .= '<B><Font color="green">SIM</font></B> Integrar com o banco de projetos';
					} else {
						$sa .= '<B><Font color="red">N�O</font></B> Integrar com o banco de projetos';
					}
				
				$sx .= '<table width="100%" class="lt0">
						<TR><TD colspan=2>Protocolo:<B><font class="lt3"><BR>'.$line['pj_codigo'].'
				
						<TR><TD colspan=2>Nome do professor
						<TR><TD class="lt3" colspan=2><B>'.$line['pp_nome'].'</B> '.$lattes.'
						<TR><TD colspan=2>Projeto do Professor
						<TR><TD colspan=2 class="lt3"><B>'.$line['pj_titulo'].'

						<TR><TD>�rea do conhecimento
							<TD>�rea estrat�gica do conhecimento
						<TR><TD class="lt3"><B>'.trim($line['pj_area']).'-'.trim($line['a_descricao_geral']).'
						    <TD class="lt3"><B>'.$line['pj_area_estra'].'-'.trim($line['a_descricao_estra']).'
						
						<TR><TD>Aprovado Externamente: <B>'.$ap1.' 
						    <TD>Aprovado por Empresa: <B>'.$ap2.'

						<TR><TD>Banco de Projetos PUCPR
						<TR><TD class="lt2" colspan=2>'.$sa; 
				$sx .= '<TR><TD colspan=2>LISTA DE ARQUIVOS';
				$sx .= $this->projeto_file_lista($line['pj_codigo']);
				
				$sx .= '</table>';
				
				return($sx);
			}

		function projetos_lista($tp='')
			{
				$sql = "select * from ".$this->tabela."
					left join pibic_professor on pp_cracha = pj_professor
					where pj_status = 'B' ";
				if ($tp == 'D' ) { $sql .= " and pp_centro = 'DOUTORANDO' ";}					
				$sql .= "order by pj_codigo ";
				
				if ($tp=='2')
					{
						$sql = "select * from ".$this->tabela."
							left join docentes on pp_cracha = pj_professor
							left join (select count(*) as total, doc_protocolo_mae from pibic_submit_documento where doc_status <> 'X' and doc_status <> '@' group by doc_protocolo_mae ) as tabela on doc_protocolo_mae = pj_codigo 
							where pj_status = 'B' and total >= 2";					
						$sql .= "order by pj_codigo ";
						
					}
				if ($tp=='B')
					{
						$sql = "select * from ".$this->tabela."
							left join docentes on pp_cracha = pj_professor
							left join (select count(*) as total, doc_protocolo_mae from pibic_submit_documento where doc_status <> 'X' and doc_status <> '@' group by doc_protocolo_mae ) as tabela on doc_protocolo_mae = pj_codigo 
							where pj_status = 'B' and total >= 0";					
						$sql .= "order by pj_titulo, pj_codigo ";
						
					}					
				if ($tp=='T')
					{
						$sql = "select * from ".$this->tabela."
							left join pibic_professor on pp_cracha = pj_professor
							left join (select count(*) as total, doc_protocolo_mae from pibic_submit_documento where doc_status <> 'X' and doc_status <> '@' group by doc_protocolo_mae ) as tabela on doc_protocolo_mae = pj_codigo 
							where pj_status = 'T' and total >= 0";					
						$sql .= "order by pj_titulo, pj_codigo ";
						
					}
				if ($tp=='U')
					{
						$sql = "select * from ".$this->tabela."
							left join pibic_professor on pp_cracha = pj_professor
							left join (select count(*) as total, doc_protocolo_mae from pibic_submit_documento where doc_status <> 'X' and doc_status <> '@' group by doc_protocolo_mae ) as tabela on doc_protocolo_mae = pj_codigo 
							where pj_status = 'U' and total >= 0";					
						$sql .= "order by pj_titulo, pj_codigo ";
						
					}
				$rlt = db_query($sql);
				$sx = '<table width=98% border=1 cellpadding=4 cellspacing=0 class="lt2" align="center">';
				$sx .= '<TR>';
				$sx .= '<TH>Protocolo.<TH>T�tulo do trabalho<TH>�rea';
				$tot = 0;
				$tit = 'X';
				$pro = '';
				$profx = 'x';
				while ($line = db_read($rlt))
					{
						$prof2 = $line['pj_professor'];
						$tit2 = uppercasesql($line['pj_titulo']);
						$tit2 = troca($tit2,'.','');
						$tit2 = troca($tit2,'?','');
						$tit2 = troca($tit2,',','');
						$pro2 = trim($line['pj_codigo']);
						$cor = '';
						if (strlen($prof2)==0) { $cor = '<font color="orange">'; 	}
												
						if ($tit == $tit2)
							{
								if ($profx == $prof2)
									{
									if (strlen($pro) > 0)
										{
										$sx .= '<BR>';
										$sx .= '<center>';
										$sx .= '<A HREF="projetos_agrupar.php?dd5=AGR&dd1='.$pro.'&dd2='.$pro2.'" target="_new">';
										$sx .= 'Agrupar';
										$cor = '<font color="red">';
										}
									} else {
										$sx .= '<BR>';
										$sx .= '<center>';
										$sx .= '<A HREF="projetos_agrupar.php?dd5=DIF&dd1='.$pro.'&dd2='.$pro2.'" target="_new">';
										$sx .= 'Diferenciar';
										if (strlen($cor) == 0) { $cor = '<font color="green">'; }
									}
							}
						$profx = $prof2;
						$tit = $tit2;
						$pro = $pro2;
						$tot++;
						$link = '<A HREF="pibic_projetos_detalhes.php?dd0='.$line['id_pj'].'&dd90='.checkpost($line['id_pj']).'">';
						$sx .= '<TR '.coluna().' valign="top">';
						$sx .= '<TD>'.$link.trim($line['pj_codigo']).'</A>';
						$sx .= '<TD>'.$link.$cor.'<B>'.trim($line['pj_titulo']).'</B></A>';
						$sx .= '<TD>'.trim($line['pj_area']);
						$sx .= '<TR><TD><TD>'.$line['pp_nome'];
						$sx .= '<TD>'.$line['total'].' pls';
					}
				$sx .= '<TR><TD colspan=5><I>Total de projetos: '.$tot;
				$sx .= '</table>';
				return($sx);	
			}			

		function mostra($line)
			{
				global $user;
					/* status */
					if (($line['pj_status'] == '@') or ($line['pj_status']=='A'))
						{ $link = '<A HREF="submit_phase_sel.php?dd0='.$line['id_pj'].'&dd90='.checkpost($line['id_pj']).'">'; }

					$sta .= $line['pj_status'];
					if ($sta == '@') { $sx .= '<font color="orange"><B>Em submiss�o</B><font>'; }
					if ($sta == 'A') { $sx .= '<font color="green"><B>Em submiss�o</B><font>'; }
					if ($sta == 'B') { $sx .= '<font color="green"><B>Submetido em '.stodbr($line['pj_data']).'</B><font>'; }
					if ($sta == 'B') { $sx .= '<font color="green"><B>Submetido em '.stodbr($line['pj_data']).'</B><font>'; }
					if ($sta == 'X') { $sx .= '<font color="red"><B>Cancelado</B><font>'; }

					$sx .= '<table border=0 class="tabela00" width="100%">';
					
					$sx .= '<TR valign="top"><TD rowspan=10 width="20">';
					$sx .= '<img src="'.http.'pibic/img/icone_projeto_professor.png" width=50>';
					
					$sx .= '<TR><TD colspan=2>';
					$sx .= '<font class="lt0">t�tulo do projeto do professor</font>';
					
					$sx .= '<TR><TD class="tabela01">';
					$sx .= '<h3>';
					$sx .= trim($line['pj_titulo']);
					$sx .= '</h3>';
					
					$sx .= '<TD width="15%" class="tabela01" align="center">';
					$sx .= '<nobr>Protocolo: <B>'.trim($line['pj_codigo']).'</B>';
		
					/* Comentarios */			
					$comment = trim($line['pj_coment']);
					if ((strlen($comment) > 0) and ($line['pj_status']=='@'))
						{
							$sx .= '<TR><TD class="tabela01" colspan=2>';
							$sx .= '<img src="'.http.'/img/icone_alert.png" align="left">';
							$sx .= '<font color="red">';
							$sx .= $comment;
						}
					
					/* dados complementares */
					$sx .= '<TR><TD colspan=2>';
					$sx .= '<table class="tabela00" width="100%">';
					
						/* area */
						$sx .= '<TR><TD colspan=1 align="right" width=35% >';
						$sx .= '<font class="lt0" align="right">�rea do conhecimento: </font>';
						$sx .= '<TD class="tabela01"><font class="lt3"><B>'.trim($line['pj_area']).' - '.trim($line['area1']).'</B></font>';
	
						$sx .= '<TR><TD align="right">';
						$sx .= '<font class="lt0" align="right">�rea estrat�gica: </font>';
						$sx .= '<TD class="tabela01"><font class="lt3"><B>'.trim($line['pj_area_estra']).' - '.trim($line['area2']).'</B></font>';
						
						if ($sta != 'X' and $sta != 'A' and $sta != '@' and $sta != 'T')
							{
							require("../pibic/_ged_config_submit_pibic.php");
							$ged->protocol = trim($line['pj_codigo']);
							$sx .= '<TR><td colspan=2 class="tabela01">Arquivos:';
							$sx .= $ged->filelist();							
							}
						if ($sta == 'T')
							{
							require("../pibic/_ged_config_submit_pibic.php");
							$ged->protocol = trim($line['pj_codigo']);
							$sx .= '<TR><td colspan=2 class="tabela01">Arquivos:';
							$sx .= $ged->file_list();							
							}
					
						/* Aprova��o & Financiamento Externo */
						/*
						$sx .= '<TR valign"top"><TD align="right">';
						$sx .= '<font class="lt0" align="right">Projeto aprovado externamente por uma ag�ncia de fomento: </font>';
						$sx .= '<TD class="tabela01"><font class="lt3"><B>'.trim($line['pj_ext_sn']).'</B></font>';
						
						$sx .= '<TR valign"top"><TD align="right">';
						$sx .= '<font class="lt0" align="right">Grupo 2 - Financiamento por empresa: </font>';
						$sx .= '<TD class="tabela01"><font class="lt3"><B>'.trim($line['pj_gr2_sn']).'</B></font>';
						*/
						/* Comit� de �tica em Pesquisa */
						/*
						$cep = trim($line['pj_cep']);
						if ($cep == '')  { $cep = 'N�o aplic�vel'; }
						if ($cep == 'A')  { $cep = 'Aprovado'; }
						if ($cep == 'S')  { $cep = 'Em submiss�o'; }
						if ($cep == 'E')  { $cep = 'Em aprecia��o'; }
						$cep = '['.$cep.']';

						$sx .= '<TR><TD align="right">';
						$sx .= '<font class="lt0" align="right">Comit� de �tica em Pesquisa: </font>';
						$sx .= '<TD class="tabela01"><font class="lt3"><B>'.$cep.'</B></font>';
						

						$ceua = trim($line['pj_ceua']);
						if ($ceua == '')  { $ceua = 'N�o aplic�vel'; }
						if ($ceua == 'A')  { $ceua = 'Aprovado'; }
						if ($ceua == 'S')  { $ceua = 'Em submiss�o'; }
						if ($ceua == 'E')  { $ceua = 'Em aprecia��o'; }
						$ceua = '['.$ceua.']';

						$sx .= '<TR><TD align="right">';
						$sx .= '<font class="lt0" align="right">Comit� de �tica no Uso de Animais: </font>';
						$sx .= '<TD class="tabela01"><font class="lt3"><B>'.$ceua.'</B></font>';
						*/
						
					$sx .= '</table>';
					return($sx);
				
			}
		function projeto_mostra_mini($line)
			{
				global $user;
				
					$sx .= $this->mostra($line);
					$bgx = ' bgcolor="#E0E0FF" ';
					
	
					/* Botoes */					
					$sx .= '<TR><TD ALIGN="RIGHT" colspan=2>';
					
					$sb = '';
					if ($sta == '@' or $sta == 'A' or $sta == '!')
							{
								$sx .= '<A HREF="submit_pos_1.php?dd89='.trim($line['pj_codigo']).'" class="link">';
								$sx .= 'editar projeto do professor</A>';
								$sx .= '&nbsp;|&nbsp;';
								$sx .= '<A HREF="#" onclick="newxy('.chr(39).'main_submit_cancel.php?dd0='.$line['pj_codigo'].'&dd90='.checkpost($line['pj_codigo']).chr(39).',500,300);"  title="cancelar plano de aluno" class="link">';
								$sx .= 'cancelar projeto do professor</A>';
								$sx .= '</form>';
								//$sb .= '<img src="img/icone_error.png" height=16" title="cancelar projeto do professor" border=0>';
								$sx .= '<TR><TD>';
							}				
					if ($sta == 'T')
							{
								$sx .= '<A HREF="#" onclick="newxy2(\'submit_editf.php?dd0='.trim($line['id_pj']).'\',600,400);" class="link">';
								$sx .= 'editar t�tulo do projeto</A>';
								//$sb .= '<img src="img/icone_error.png" height=16" title="cancelar projeto do professor" border=0>';
								$sx .= '<TR><TD>';
							}				

					/** Planos de Alunos **/
					$this->protocolo = trim($line['pj_codigo']);
					$this->status = trim($line['pj_status']);
					$proto = trim($this->protocolo);
					
					if (strlen($proto) > 	0)
						{					
						$sx .= '<TR><TD colspan=2>';
						$sx .= $this->resumo_planos_row();
						}	
					
					$sx .= '</table>';		

					/** Habilita bot�o de submiss�o */
					return($sx);				
			}
		function plano_cancelar($id='')
			{
				$sql = "update pibic_submit_documento set doc_status = 'X' where id_doc = ".round($id);
				$rlt = db_query($sql);
				return(1);
			}
			
			
		function projeto_file_lista($protocolo='')
			{
				global $ged,$user_nivel;
				$ged->tabela = 'pibic_submit_ged';
				$ged->protocol = $protocolo;
				$ged->file_type = '';
				if ($user_nivel >= 9)
					{
						$sx = $ged->file_list();
						$sx .= '<a href="javascript:newxy2(\'../pibic/ged_upload_pibic.php?dd1='.$protocolo.'\',400,300)">upload</A>';
					} else {
						$sx = $ged->filelist();
					}				
				return($sx);				
			}
						
		function plano_file_lista($protocolo='')
			{
				global $ged,$user_nivel;
				$ged->tabela = 'pibic_ged_documento';
				$ged->protocol = $protocolo;
				$ged->file_type = '';
				if ($user_nivel >= 9)
					{
						$sx = $ged->file_list();
						$sx .= '<a href="javascript:newxy2(\'ged_upload_plano.php?dd1='.$protocolo.'\',400,300)">upload</A>';
					} else {
						$sx = $ged->filelist();
					}
				
				return($sx);				
			}
		function resumo_planos_list_line($line)
			{
				global $editar;
				$tipo = trim($line['doc_edital']);
							if ($tipo == '') { $tipo = 'PIBIC'; }
							
								$img = http.'pibic/img/icone_plano_aluno.png';
								if ($tipo == 'PIBITI') { $img = 'img/icone_plano_aluno_pibiti.png'; }
								if ($tipo == 'PIBICE') { $img = 'img/icone_plano_aluno_jr.png'; }
							
							
							if ((($tp == '') or ($tp == '1') or ($tp == '3')) and ($tipo == 'PIBIC' or $tipo == 'PIBITI'))
								{
								$link_editar = '<form action="submit_phase_3_sel.php"><TD>';
								$link_editar .= '<input type="hidden" name="dd0" value="'.$line['doc_protocolo'].'">';
								$link_editar .= '<input type="submit" value="editar" class="botao-geral">';
																
								$link_cancelar = '<input class="botao-geral" type="button" onclick="newxy2(\'main_submit_cancel.php?dd0='.$line['doc_protocolo'].'&dd90='.checkpost($line['doc_protocolo']).'\',400,400);" value="cancelar">';												
								
								if ($tp == '3')
								{
									$link_editar = '<a href="#" onclick="newxy2(\'pibic_plano_editar.php?dd0='.$line['doc_protocolo'].'&dd90='.checkpost($line['doc_protocolo']).'\',400,400);">';																				
									$link_cancelar = '<a href="#" onclick="newxy2(\'pibic_plano_cancel.php?dd0='.$line['doc_protocolo'].'&dd90='.checkpost($line['doc_protocolo']).'\',400,400);">';																				
								}
								
								$sx .= '<TR valign="top">';
								$sx .= '<TD rowspan=6><img src="'.$img.'" width="50">';
								$sx .= '<TD>PROTOCOLO:<BR><b>'.$line['doc_protocolo'];
								$sx .= '<TR>';
								$sx .= '<TD>T�TULO DO PLANO DO ALUNO:<BR><font class="lt3"><b>'.$line['doc_1_titulo'];
								$sx .= '<TR>';
								$sx .= '<TD>MODALIDADE:<BR><font class="lt3"><b>'.$tipo;
								$sx .= '<TR>';
								$sx .= '<TD>ESTUDANTE:<BR><font class="lt3"><b>'.$line['pa_nome'].'&nbsp;';
								
								$sx .= '<TR>';
								$sx .= '<TD>LISTA DE ARQUIVOS';
								$sx .= $this->plano_file_lista($line['doc_protocolo']);
								
								if ($editar == 1)
									{
									$sx .= '<TR><TD>';
									$sx .= '<table><TR><TD>';
									$sx .= $link_editar.'</form>';
									$sx .= '<TD> | <TD>'.$link_cancelar.'</table>';
																	
									$sx .= '<TR><TD colspan=2><HR>';
									}
								}
								
							if ((($tp == '2') or ($tp == '3') or ($tp =='1') or ($tp =='')) and ($tipo == 'PIBICE'))
								{
								$link_editar = '<a href="submit_phase_4_sel.php?dd0='.$line['doc_protocolo'].'&dd90='.checkpost($line['doc_protocolo']).'">';
								$link_cancelar = '<a href="#" onclick="newxy2(\'main_submit_cancel.php?dd0='.$line['doc_protocolo'].'&dd90='.checkpost($line['doc_protocolo']).'\',400,400);">';
								
								$sx .= '<TR valign="top">';
								$sx .= '<TD rowspan=4><img src="'.$img.'" width="50">';

								$sx .= '<TD>PROTOCOLO:<BR><b>'.$line['doc_protocolo'];
								$sx .= '<TR>';
								$sx .= '<TD>T�TULO DO PLANO DO ALUNO:<BR><font class="lt3"><b>'.$line['doc_1_titulo'];
								$sx .= '<TR>';
								$sx .= '<TD>MODALIDADE:<BR><font class="lt3"><b>'.$tipo;
								$sx .= '<TR>';
								$sx .= '<TD>LISTA DE ARQUIVOS';
								$sx .= $this->plano_file_lista($line['doc_protocolo']);								
								if ($editar == 1)
									{								
									$sx .= '<TR><TD>';
									$sx .= $link_editar.'EDITAR</A> | '.$link_cancelar.'CANCELAR</A>';
									$sx .= '<TR><TD colspan=2><HR>';
									}
								}
						return($sx);				
			}
		function resumo_planos_list($tp='')
			{
					$proto = $this->protocolo;
					/** PIBIC, PIBITI e PIBIC_EM*/
					$sql = "select * from pibic_submit_documento
							left join pibic_aluno on doc_aluno = pa_cracha 
							where doc_protocolo_mae = '$proto' and  doc_status <> 'X'
							order by doc_protocolo";
		
					$rlt = db_query($sql);
					$sx .= '<table width="100%" class="lt0" border=0>';
					$xproto = 'X';
					while ($line = db_read($rlt))
						{
							$proto = $line['doc_protocolo'];
							if ($xproto != $proto)
							{
							$sx .= $this->resumo_planos_list_line($line);
							$sx .= '<TR><TD><HR>';
							$xproto = $proto;
							}
						}
					$sx .= '</table>';
					return($sx);				
			}
			


		function planos_mostra_mini($line)
			{
				$tipo = trim($line['doc_edital']);
				$img = http.'pibic/img/icone_plano_aluno.png';
				
				if ($tipo == '') { $tipo = 'PIBIC'; }
			
				if ($tipo == 'PIBITI') { $img = http.'pibic/img/icone_plano_aluno_pibiti.png'; }
				if ($tipo == 'PIBICE') { $img = http.'pibic/img/icone_plano_aluno_jr.png'; }
				
				
					$sx .= '<TR valign="top">';
					$sx .= '<TD rowspan=4><img src="'.$img.'" width="50">';
					$sx .= '<TD class="lt0">PROTOCOLO:<BR><b>'.$line['doc_protocolo'];
					$sx .= '/';
					$sx .= '<A HREF="'.http.'pibicpr/pibic_projetos_detalhes.php?dd0='.$line['id_pj'].'&dd90='.checkpost($line['id_pj']).'">';
					$sx .= $line['doc_protocolo_mae'];
					$sx .= '</A>';
					$sx .= '<TD class="lt0">MODALIDADE:<BR><font class="lt2"><b>'.$tipo;
					
					$sx .= '<TR>';
					$sx .= '<TD class="lt0" colspan=2>T�TULO DO PLANO DO ALUNO:<BR><font class="lt2"><b>'.$line['doc_1_titulo'];
					$sx .= '<TR>';
					$sx .= '<TD class="lt0">PROFESSOR:<BR><font class="lt2"><b>'.$line['pp_nome'].'('.trim($line['pp_cracha']).')&nbsp;';
					$sx .= '<TD class="lt0">ESTUDANTE:<BR><font class="lt2"><b>'.$line['pa_nome'].'('.trim($line['pa_cracha']).')&nbsp;';
					
					$sx .= '<TR><TD colspan=5>&nbsp;';
				return($sx);				
			}

		function resumo_projeto_campus($ss='',$centro=0,$escola=1)
			{
					$proto = $this->protocolo;
					$cp = "*";
					if ($escola==1)
						{
						$cp = 'pp_centro, doc_edital';
						$sql = "select count(*) as total, $cp from ".$this->tabela.' ';
						if ($ss == 'SS') { $sql .= "left join pibic_professor on (pj_professor = pp_cracha)  "; }
						if ($ss == 'NS') { $sql .= "left join pibic_professor on (pj_professor = pp_cracha)  "; }
						if ($ss == '') { $sql .= "left join pibic_professor on pj_professor = pp_cracha "; }

						$sql .= "inner join pibic_submit_documento on pj_codigo = doc_protocolo_mae
								left join centro on pp_escola = centro_codigo
								where pj_ano = '".date("Y")."'
									and (doc_status = 'B' or doc_status = 'C' or doc_status = 'D') 
									and (pj_status = 'B' or pj_status = 'C' or pj_status = 'D') ";
								
						if ($ss == 'SS') { $sql .= "and (pp_ss = 'S')  "; }
						if ($ss == 'NS') { $sql .= "and (pp_ss = 'N')  "; }
								
						$sql .= "group by $cp
								order by pp_centro, doc_edital ";
					}
						
					$rlt = db_query($sql);
					$totalp = 0;
					$totalt = 0;
					$totale = 0;
					
					$ttotalp = 0;
					$ttotalt = 0;
					$ttotale = 0;
										
					$cap = "--";
					$sx .= '<center><h2>';
					$sx .= 'N�MERO DE PLANOS DE TRABALHO ALUNOS SUBMETIDOS<br>';
					$sx .= 'NO EDITAL DA INICIA��O CIENT�FICA - '.date("Y").' - CAMPI</h2>';
					$sx .= '<table width="704" align="center" class="lt1">';
					$sx .= '<TR><TH>Escola<TH>PIBIC<TH>PIBITI<TH>PIBIC_EM<TH>Sub-total';
					$rs = array();
					while ($line = db_read($rlt))
						{
							$xcap = trim($line['pp_centro']);
							if ($cap != $xcap)
								{
								$sx .= $this->resumo_mostra_painel($cap,$totalp,$totalt,$totale);
								array_push($rs,array($cap,$totalp,$totalt,$totoale,$centro_meta_01,$centro_meta_02,$centro_meta_04));
								$cap = $xcap;																

								$totalp = 0;
								$totalt = 0;
								$totale = 0;
								}
							$centro_meta_01 = $line['centro_meta_01'];
							$centro_meta_02 = $line['centro_meta_02'];
							$centro_meta_03 = $line['centro_meta_03'];
							
							$total = $line['total'];
							$edital = trim($line['doc_edital']);
							if ($edital == '') { $totalp = $totalp + $total; }
							if ($edital == 'PIBIC') { $totalp = $totalp + $total; }
							if ($edital == 'PIBITI') { $totalt = $totalt + $total; }
							if ($edital == 'PIBICE') { $totale = $totale + $total; } 							

							if ($edital == 'PIBIC') { $ttotalp = $ttotalp + $total; }
							if ($edital == 'PIBITI') { $ttotalt = $ttotalt + $total; }
							if ($edital == 'PIBICE') { $ttotale = $ttotale + $total; } 														
							}
					$sx .= $this->resumo_mostra_painel($cap,$totalp,$totalt,$totale);
					array_push($rs,array($cap,$totalp,$totalt,$totoale,$centro_meta_01,$centro_meta_02,$centro_meta_04));
					
					$sx .= $this->resumo_mostra_painel('<B>Total',$ttotalp,$ttotalt,$ttotale);
					$sx .= '</table>';
					$this->plano_pibic = $totalp;						
					$this->plano_pibiti = $totalt;
					$this->plano_pibic_em = $totale;
					$this->rst = $rs;
				
					return($sx);				
			}

		function resumo_planos_centro($ss='',$centro=0,$escola=1)
			{
					$proto = $this->protocolo;
					$ano = '2013';
					$cp = "*";
					if ($escola==1)
						{
						$cp = 'centro_nome, centro_codigo, doc_edital, centro_meta_01, centro_meta_02, centro_meta_03';
						$sql = "select count(*) as total, $cp from ".$this->tabela.' ';
						if ($ss == 'SS') { $sql .= "left join pibic_professor on (pj_professor = pp_cracha)  "; }
						if ($ss == 'NS') { $sql .= "left join pibic_professor on (pj_professor = pp_cracha)  "; }
						if ($ss == '') { $sql .= "left join pibic_professor on pj_professor = pp_cracha "; }

						$sql .= "inner join pibic_submit_documento on pj_codigo = doc_protocolo_mae
								left join centro on pp_escola = centro_codigo
								where pj_ano = '".date("Y")."'
										and (doc_status = 'B' or doc_status = 'C' or doc_status = 'D') 
										and (pj_status = 'B' or pj_status = 'C' or pj_status = 'D')
								";
								
						if ($ss == 'SS') { $sql .= "and (pp_ss = 'S')  "; }
						if ($ss == 'NS') { $sql .= "and (pp_ss = 'N')  "; }
								
						$sql .= "group by $cp
								order by centro_codigo ";
					}
						
					$rlt = db_query($sql);
					$totalp = 0;
					$totalt = 0;
					$totale = 0;
					
					$ttotalp = 0;
					$ttotalt = 0;
					$ttotale = 0;
										
					$cap = "--";
					$sx .= '<center><h2>';
					$sx .= 'N�MERO DE PLANOS DE TRABALHO ALUNOS SUBMETIDOS<br>';
					$sx .= 'NO EDITAL DA INICIA��O CIENT�FICA - '.$ano.'</h2>';
					$sx .= '<table width="704" align="center" class="lt1">';
					$sx .= '<TR><TH>Escola<TH>PIBIC<TH>PIBITI<TH>PIBIC_EM<TH>Sub-total';
					$rs = array();
					while ($line = db_read($rlt))
						{
							$xcap = trim($line['centro_nome']);
							if ($cap != $xcap)
								{
								$sx .= $this->resumo_mostra_painel($cap,$totalp,$totalt,$totale);
								array_push($rs,array($cap,$totalp,$totalt,$totoale,$centro_meta_01,$centro_meta_02,$centro_meta_04));
								$cap = $xcap;																

								$totalp = 0;
								$totalt = 0;
								$totale = 0;
								}
							$centro_meta_01 = $line['centro_meta_01'];
							$centro_meta_02 = $line['centro_meta_02'];
							$centro_meta_03 = $line['centro_meta_03'];
							
							$total = $line['total'];
							$edital = trim($line['doc_edital']);
							if ($edital == '') { $totalp = $totalp + $total; }
							if ($edital == 'PIBIC') { $totalp = $totalp + $total; }
							if ($edital == 'PIBITI') { $totalt = $totalt + $total; }
							if ($edital == 'PIBICE') { $totale = $totale + $total; } 							

							if ($edital == 'PIBIC') { $ttotalp = $ttotalp + $total; }
							if ($edital == 'PIBITI') { $ttotalt = $ttotalt + $total; }
							if ($edital == 'PIBICE') { $ttotale = $ttotale + $total; } 														
							}
					$sx .= $this->resumo_mostra_painel($cap,$totalp,$totalt,$totale);
					array_push($rs,array($cap,$totalp,$totalt,$totoale,$centro_meta_01,$centro_meta_02,$centro_meta_04));
					
					$sx .= $this->resumo_mostra_painel('<B>Total',$ttotalp,$ttotalt,$ttotale);
					$sx .= '</table>';
					$this->plano_pibic = $totalp;						
					$this->plano_pibiti = $totalt;
					$this->plano_pibic_em = $totale;
					$this->rst = $rs;
				
					return($sx);
			}

		function resumo_projeto_centro($ss='',$centro=0,$escola=1)
			{
					$proto = $this->protocolo;
					$cp = "*";
					if ($escola==1)
						{
						$cp = 'centro_nome, centro_codigo, doc_edital, centro_meta_01, centro_meta_02, centro_meta_03';
						$sql = "select count(*) as total, $cp from ".$this->tabela.' ';

						$sql .= "inner join 
								(select doc_edital,doc_autor_principal from pibic_submit_documento group by doc_edital,doc_autor_principal ) 
								as tabela on pj_professor = doc_autor_principal
								";
						$sql .= " left join pibic_professor on doc_autor_principal = pp_cracha ";				
																
						$sql .= " left join centro on pp_escola = centro_codigo
								where (pj_status <> 'X' and pj_status <> '@')";
								
						if ($ss == 'SS') { $sql .= "and (pp_ss = 'S')  "; }
						if ($ss == 'NS') { $sql .= "and (pp_ss = 'N')  "; }
								
						$sql .= " group by $cp
								order by centro_codigo ";
					}

					$rlt = db_query($sql);
					$totalp = 0;
					$totalt = 0;
					$totale = 0;
					
					$ttotalp = 0;
					$ttotalt = 0;
					$ttotale = 0;
										
					$cap = "xxxx";
					$sx .= '<table width="704" align="center" class="lt1">';
					$sx .= '<TR><TH>Escola<TH>PIBIC<TH>PIBITI<TH>PIBIC_EM';
					while ($line = db_read($rlt))
						{
							$xcap = trim($line['centro_nome']);
							if ($cap != $xcap)
								{
								$sx .= $this->resumo_mostra_painel($cap,$totalp,$totalt,$totale);
								$cap = $xcap;																

								$totalp = 0;
								$totalt = 0;
								$totale = 0;
								}
							$total = $line['total'];
							$edital = trim($line['doc_edital']);
							if ($edital == '') { $totalp = $total; }
							if ($edital == 'PIBIC') { $totalp = $total; }
							if ($edital == 'PIBITI') { $totalt = $total; }
							if ($edital == 'PIBICE') { $totale = $total; } 							

							if ($edital == 'PIBIC') { $ttotalp = $ttotalp + $total; }
							if ($edital == 'PIBITI') { $ttotalt = $ttotalt + $total; }
							if ($edital == 'PIBICE') { $ttotale = $ttotale + $total; } 														
							}
					$sx .= $this->resumo_mostra_painel($cap,$totalp,$totalt,$totale);
					$sx .= $this->resumo_mostra_painel('<B>Total',$ttotalp,$ttotalt,$ttotale);
					$sx .= '</table>';
					$this->plano_pibic = $totalp;						
					$this->plano_pibiti = $totalt;
					$this->plano_pibic_em = $totale;
					
				
					return($sx);
			}

		function resumo_mostra_painel($titulo,$pibic,$pibiti,$pibicem)
			{
				if (($pibic+$pibiti+$pibicem) > 0)
					{
						if (strlen(trim($titulo))==0) { $titulo = '--sem categoriza��o--'; }
						$sx .= '<TR><TD>'.$titulo;
						$sx .= '<TD align="center">';
						$sx .= $pibic;
						$sx .= '<TD align="center">';
						$sx .= $pibiti;
						$sx .= '<TD align="center">';
						$sx .= $pibicem;
						$sx .= '<TD align="center">';
						$sx .= ($pibicem+$pibiti+$pibic);
						}
					return($sx);				
			}
			
		function resumo_planos_row()
			{
					require("../pibic/_ged_config_submit_pibic.php");
					$sql = "update ".$this->tabela." set pj_status = '@' where pj_codigo = '1001117' ";
					//	$rlt = db_query($sql);
					
					$proto = $this->protocolo;
					/** PIBIC, PIBITI e PIBIC_EM*/
					$sql = "select * from pibic_submit_documento 
					left join pibic_aluno on doc_aluno = pa_cracha
							where doc_protocolo_mae = '$proto' and  doc_status <> 'X'
							";
					$rlt = db_query($sql);
					$totalp = 0;
					$totalt = 0;
					$totale = 0;
					$sx .= '<table width="100%" border=0 class="tabela00">';
					$sx .= '<TR><TH colspan=2>Planos de alunos cadastrados';
					$id=0;

					while ($line = db_read($rlt))
						{
							$proto = trim($line['doc_protocolo']);
							$linkc = "newxy2('main_submit_cancel.php?dd0=".$line['doc_protocolo']."&dd90=".checkpost($line['doc_protocolo'])."',400,400);";							$id++;
							$linkc = 'onclick="'.$linkc.'"';
							$total = $line['total'];
							$edital = trim($line['doc_edital']);
							$sx .= '<TR>';
							$sx .= '<TD width="80" class="tabela01" align="center" rowspan=2>';
							$sx .= trim($line['doc_protocolo']);
							$sx .= '<BR>';
							$sx .= '<B>'.trim($line['doc_edital']).'</B>';
												
							$sx .= '<TD class="tabela01">';
							$sx .= '<B>'.trim($line['doc_1_titulo']).'</B>';
														
							
							$sx .= '<BR>';
							$edital = trim($line['doc_edital']);
							$sts = $this->status;
							
							if (($sts == 'A') or ($sts == '@') or ($sts == '!'))
							{
								if ($edital == 'PIBICE')
									{
										$sx .= '<A HREF="submit_pos_4.php?dd89='.trim($line['doc_protocolo_mae']).'&dd90='.trim($line['doc_protocolo']).'" class="link">editar plano do aluno</A>';
									} else {
										$sx .= '<A HREF="submit_pos_2.php?dd89='.trim($line['doc_protocolo_mae']).'&dd90='.trim($line['doc_protocolo']).'" class="link">editar plano do aluno</A>';
									}
								$sx .= ' | ';
								$sx .= '<A HREF="#" class="link" '.$linkc.'>cancelar plano</A>';
							}
							
							if (($sts == 'T'))
							{
								$sx .= '<A HREF="#" onclick="newxy2(\'submit_edite.php?dd0='.$line['id_doc'].'&dd89='.trim($line['doc_protocolo_mae']).'&dd90='.trim($line['doc_protocolo']).'\',600,400);" class="link">editar t�tulo</A>';
							}

							$sx .= '<TR>';
							$sx .= '<TD class="tabela01">';
							$sx .= trim($line['pa_nome']).' ('.trim($line['pa_cracha']).')';
							$status = trim($line['doc_status']);
							
							$ged->protocol = $proto;
							$ged->tabela = 'pibic_ged_documento';
							if (($sts == 'T'))
							{
								$sx .= $ged->file_list();
							} else {
								$sx .= $ged->filelist();
							}
							
							
						}
					if ($id==0)
						{
							$sx .= '<TR><TD colspan=4><font color="red">Nenhum plano cadastrado';
						}
					$sx .= '</table>';
					return($sx);
			}

			
		function resumo_planos()
			{
					$proto = $this->protocolo;
					/** PIBIC, PIBITI e PIBIC_EM*/
					$sql = "select count(*) as total, doc_edital from pibic_submit_documento 
							where doc_protocolo_mae = '$proto' and  doc_status <> 'X'
							group by doc_edital";
					
					$rlt = db_query($sql);
					$totalp = 0;
					$totalt = 0;
					$totale = 0;
					while ($line = db_read($rlt))
						{
							//print_r($line);
							//echo '<HR>';
							$total = $line['total'];
							$edital = trim($line['doc_edital']);
							if ($edital == '') { $totalp = $total; }
							if ($edital == 'PIBIC') { $totalp = $total; }
							if ($edital == 'PIBITI') { $totalt = $total; }
							if ($edital == 'PIBICE') { $totale = $total; } 
						}
					
					$this->plano_pibic = $totalp;						
					$this->plano_pibiti = $totalt;
					$this->plano_pibic_em = $totale;
					
					$sx .= '<table width="100%" class="l2">';
					$sx .= '<TR><TH colspan=3 bgcolor="#F0F0FF">Planos de alunos';
					$sx .= '<TR align="center">';
					$sx .= '<TD width="33%">PIBIC<font class="lt4"><BR><B>'.$totalp;
					$sx .= '<TD width="33%">PIBITI<font class="lt4"><BR><B>'.$totalt;
					$sx .= '<TD width="33%">PIBIC_EM (Jr)<font class="lt4"><BR><B>'.$totale;
					$sx .= '</table>';					
					return($sx);
			}
	
		function plano_aluno($ln)
			{
				$proto_mae = $this->protocolo;
				$sta = trim($ln['doc_status']);
				$bgc = '#FFC0C0';
				$id = $ln['id_doc'];
				
				if ($sta == 'A') { $bgc = '#C0FFC0'; }
				if ($sta == 'B') { $bgc = '#C0C0C0'; }
				if ($this->status == 'B') { $bgc = '#C0C0C0'; }
				
				$sx .= '<div style="background-color: '.$bgc.'; height: 90px; margin: 5px 5px 5px 5px;">';
				$sx .= '<center>';
				if ($sta == '')
					{	if ($this->status != 'B')
						{
						$id = "NEW";
						$sx .= '<font class="lt2"><B><font color=red>Nenhum plano PIBIC/PIBITIsubmetido</font></font><B>';
						$sx .= '<BR><BR>';			
						$sx .= '<A HREF="submit_phase_3.php?dd0='.$id.'&dd1='.$proto_mae.'&dd90='.checkpost($id.$proto_mae).'">';
						$sx .= 'Clique aqui para submeter';
						$sx .= '</A><BR><BR>';
						}
					} else {
						$sb = '';
						$sts = $this->protocolo;
						if (($sts == '@') or ($sts == 'A'))
							{
								$id = $ln['doc_protocolo'];
								$link .= '<A HREF="submit_phase_3.php?dd0='.$id.'&dd1='.$proto_mae.'&dd90='.checkpost($id.$proto_mae).'">';
								$sb .= $link;
								$sb .= '<font class="lt0">EDITAR</font></A>';
								$sb .= '&nbsp;&nbsp';
								$sb .= '<A HREF="#" onclick="newxy('.chr(39).'main_submit_cancel.php?dd0='.$ln['doc_protocolo'].'&dd90='.checkpost($ln['doc_protocolo']).chr(39).',500,300);"  title="cancelar plano de aluno">';
								//$sb .= '<img src="img/icone_error.png" height=16" title="cancelar plano de aluno" border=0>';
								$sb .= '<font class="lt0">CANCELAR PLANO</font>';
								$sb .= '<A HREF="submit_phase_3.php?dd0='.$id.'&dd1='.$proto_mae.'&dd90='.checkpost($id.$proto_mae).'">'; 
							}						
						$sx .= trim($ln['doc_1_titulo']).'('.$sta.')</A>';
						$sx .= '<BR><BR>';
						$sx .= '<B>'.$ln['pa_nome'].'</B>';
						$sx .= '<BR>';
						$sx .= trim($ln['doc_edital']).'/'.$ln['doc_ano'];
						$sx .= '<div style="text-align: right">'.$sb.'</div>';
					}
				$sx .= '</div>';
				return($sx);
			}

		function plano_aluno_jr($ln)
			{
				$proto_mae = $this->protocolo;
				$sta = trim($ln['doc_status']);
				$bgc = '#FFC0C0';
				if ($sta == 'B') { $bgc = '#C0C0C0'; }
				if ($this->status == 'B') { $bgc = '#C0C0C0'; }
				$id = $ln['id_doc'];
				
				if ($sta == 'A')
					{
						$bgc = '#C0FFC0';
					}
				$sx .= '<div style="background-color: '.$bgc.'; height: 65px; margin: 5px 5px 5px 5px;">';
				$sx .= '<center>';
					
				if ($sta == '')
					{
						if ($this->status != 'B')
						{
						$id = "NEW";
						$sx .= '<font class="lt2"><B><font color=red>Nenhum plano PIBIC Jr submetido</font></font><B>';
						$sx .= '<BR><BR>';
						$sx .= '<A HREF="submit_phase_4.php?dd0='.$id.'&dd1='.$proto_mae.'&dd90='.checkpost($id.$proto_mae).'">';
						$sx .= 'Clique aqui para submeter';
						$sx .= '</A><BR><BR>';
						}
					} else {
						$sb = '';
						if ($sta == '@' or $sta == 'A')
							{
									
								$sb .= '<A HREF="#" onclick="newxy('.chr(39).'main_submit_cancel.php?dd0='.$ln['doc_protocolo'].'&dd90='.checkpost($ln['doc_protocolo']).chr(39).',500,300);"  title="cancelar plano de aluno">';
								$sb .= '<img src="'.http.'pibic/img/icone_error.png" height=16" title="cancelar plano de aluno" border=0>';
								$sb .= '<A HREF="submit_phase_4.php?dd0='.$id.'&dd1='.$proto_mae.'&dd90='.checkpost($id.$proto_mae).'">'; 
							}						
						$sx .= trim($ln['doc_1_titulo']).'</A>';
						$sx .= '<BR>';
						$sx .= 'PIBIC_EM/'.$ln['doc_ano'];
						$sx .= '<div style="background-color: '.$bgc.'; height: 65px; margin: 5px 5px 5px 5px;">';
					}
				$sx .= '</div>';
				return($sx);
			}

		
		function submit_projeto()
			{
				global $dd,$user,$acao,$ss;
				$professor = $ss->user_cracha;
				require_once('../_class/_class_ajax_areadoconhecimento.php');
				$ar = new areadoconhecimento;
				//$this->structure();
				$proto = $_SESSION['protocolo'];
				/** Valida **/
				$ok = 1;
				$alert = '<font color="red">';
				
				/* Leitura dos dados caso edi��o */
				if (strlen($acao) == 0)
				{
				if (strlen($this->protocolo) > 0)
					{
						$sql = "select * from ".$this->tabela." 
							where pj_codigo = '".$this->protocolo."'";
							
						$rlt = db_query($sql);
						$line = db_read($rlt);
						$proto = $line['pj_codigo'];
						$_SESSION['protocolo'] = $proto;
						$dd[1] = trim($line['pj_titulo']);
						$dd[2] = trim($line['pj_resumo']);
						$dd[3] = trim($line['pj_keywords']);
						$dd[80] = trim($line['pj_bp']);
						$dd[10] = trim($line['pj_area']);
						$dd[11] = trim($line['pj_area_estra']);
						
						$dd[20] = trim($line['pj_ext_sn']);
						$dd[21] = trim($line['pj_ext_local']);
						$dd[23] = trim($line['pj_ext_edital']);
						$dd[24] = trim($line['pj_ext_chamada']);
						$dd[26] = trim($line['pj_ext_valor']);
						$dd[28] = trim($line['pj_ext_vjini']);
						$dd[29] = trim($line['pj_ext_vjfim']);
						
						$dd[30] = trim($line['pj_gr2_sn']);
						$dd[31] = trim($line['pj_gr2_local']);
						$dd[32] = trim($line['pj_gr2_cnpj']);						
						$dd[33] = trim($line['pj_gr2_edital']);
						$dd[34] = trim($line['pj_gr2_chamada']);
						$dd[36] = trim($line['pj_gr2_valor']);
						$dd[38] = trim($line['pj_gr2_vjini']);
						$dd[39] = trim($line['pj_gr2_vjfim']);	
						
						$dd[50] = trim($line['pj_cep_status']);	
						$dd[51] = trim($line['pj_cep']);	
						$dd[52] = trim($line['pj_ceua_status']);	
						$dd[53] = trim($line['pj_ceua']);			

					} else {
						redirecina('main.php');
					}
				}
				
				if (strlen($dd[1]) ==0 ) { $ok = 0; $msg1 = $alert; }
				if (strlen($dd[10]) ==0 ) { $ok = 0; $msg10 = $alert; }
				if (strlen($dd[20]) ==0 ) { $ok = 0; $msg20 = $alert; }
				if (strlen($dd[30]) ==0 ) { $ok = 0; $msg30 = $alert; }
				
				/** Checa arquivos **/
				$ok == 0;
				
				if ((strlen($dd[1]) > 0 ) and (strlen($acao) > 0))
					{
						/** Dados **/
						$titulo = $dd[1];
						$resumo = $dd[2];
						$keys = $dd[3];
						$objetivo = '';
						$area = $dd[10];
						$area_estra = $dd[11];
						$data = date("Ymd");
						$banco_projetos = $dd[80];
						
						$cep = $dd[50];
						$cep_nr = $dd[51];
						
						$ceua = $dd[52];
						$ceua_nr = $dd[53];
						
						$ano = date("Y");
						
						/** Fomento **/
						$ext_sn = $dd[20];
						$ext_local = $dd[21];
						$ext_edital = substr($dd[23],0,20);
						$ext_chamada = substr($dd[24],0,20);
						$ext_valor = $dd[26];
						$ext_vjini = $dd[28];
						$ext_vjfim = $dd[29];
						
						/** gr2 **/
						$gr2_sn = $dd[30];
						$gr2_local = $dd[31];
						$gr2_cnpj = $dd[32];
						$gr2_valor = $dd[36];
						$gr2_vjini = $dd[38];
						$gr2_vjfim = $dd[39];
						
						/** Salvar **/						
						$sql = "update ".$this->tabela." set 
								pj_titulo = '$titulo',
								pj_search = '$txt',
								
								pj_ext_sn = '$ext_sn',
								pj_ext_local = '$ext_local',
								pj_ext_edital = '$ext_edital',
								pj_ext_chamada = '$ext_chamada',
								pj_ext_valor = '$ext_valor',
								pj_ext_vjini = '$ext_vjini',
								pj_est_vjfim = '$ext_vjfim',
								
								pj_gr2_sn = '$gr2_sn',
								pj_gr2_local ='$gr2_local',
								pj_gr2_cnpj = '$gr2_cnpj',
								pj_gr2_valor = '$gr2_valor',
								pj_gr2_vjini = '$gr2_vjini',
								pj_gr2_vjfim = '$gr2_vjfim',
								
								pj_ano = '$ano',
								pj_resumo = '$resumo',
								pj_objetivo = '$objetivo',
								pj_keywords = '$keys',
								pj_grupo_pesquisa ='',
								pj_linha_pesquisa ='',
								
								pj_area ='$area',
								pj_area_estra ='$area_estra',
								
								pj_update = $data,
								pj_data = $data,
								pj_ss_programa = '',
								pj_ss_linha = '',
								pj_cep = '$cep_nr',
								pj_ceua = '$ceua_nr',
								pj_cep_status = '$cep',
								pj_ceua_status = '$ceua',
								pj_status = '@',
								pj_professor = '$professor',
								pj_bp = '$banco_projetos'
							where pj_codigo ='$proto'
							and pj_professor = '$professor'
						";
						echo $sql;
						$rlt = db_query($sql);
						
						$okx = $this->submit_projeto_valida($proto);
						
						if (($ok==1) and ($okx==1))
							{
								redirecina('submit_project.php');
								exit; 
							}
					}
				
				$obr = '&nbsp;<font color="red">(obrigat�rio)</font>';
				$sx .= '<style>
						.it0 { font-size: 16px; color: #000000; font-weight: bolder; }
						.it1 { font-size: 14px; color: #202020; font-weight: bolder; margin-left: 5px; }
						.it2 { font-size: 13px; color: #202020; margin-left: 10px; }
						</style>
						';
				$dd80a = ''; if ($dd[80]=='S') { $dd80a = 'selected'; }
				$dd80b = ''; if ($dd[80]=='N') { $dd80b = 'selected'; }
				$sx .= '
				<form method="post" action="'.page().'">
				<table width=100%>
				<TR><TD colspan=2 class=lt5 align=center >
				Submiss�o de projeto do professor 
				<fieldset><legend>Dados do projeto</legend>
					<table width=98%>
					<tr><TD class="lt0">'.$msg1.'T�TULO DO PROJETO PRINCIPAL
					<TD><NOBR>Protocolo '.$proto.'
					<tr><td><input type="hidden" name="dd1" value="'.$dd[1].'">';
				$sx .= '<h2>'.$dd[1].'</h2>';

//					<tr><TD class="lt0">RESUMO (at� 250 palavras)
//					<tr><td><textarea name="dd2" cols="80" rows="4">'.$dd[2].'</textarea>

//					<tr><TD class="lt0">Palavras-chave (at� 5 palavras)
//**
  				 $sx .= '
 					<tr><TD class="lt2">Banco de projetos
					<TR><TD class="lt0">O Banco de Projetos, rec�m implantado na PUCPR, abriga em seu banco de dados todos os projetos desenvolvidos na PUCPR, em �mbito acad�mico.
						Desta forma voc� pode cadastrar automaticamente seu projeto somente confirmando a informa��o abaixo:
					<tr><td><select name="dd80">
							<option value="S" '.$dd80a.'>SIM, autorizado a inser��o deste projeto no banco de projetos da PUCPR</option>
							<option value="N" '.$dd80b.'>N�O, n�o quero inserir meu projeto no banco de projetos</option>
							</select>
					</table>
				</fieldset>
				
				<fieldset><legend>�rea do conhecimento</legend>
					<table width=98%>
					<tr><TD class="lt0">'.$msg10.'�rea do conhecimento (seja o mais espec�fico poss�vel) '.$obr.'
					<tr><td><select name="dd10">';
				$sx .= $ar->forma_area_especifica($dd[10]);
				$sx .= '</select>	

					<tr><TD class="lt0">�rea estrat�gica?
					<tr><td><select name="dd11">';
				$sx .= $ar->forma_area_estrategica($dd[11]);
				$sx .= '</select>	
					</table>
				</fieldset>';
				
				
				/** Aprova��o externa e Financiamento **/
				$dd20a = ''; $dd20b= ''; $apro20 = 'display: none; ';
				$op28 = '';
				
				for ($r=(date("Y")-5);$r < date("Y")+5;$r++)
					{ for ($y=1;$y <= 12;$y++)
						{
							$vl = strzero($y,2).'/'.$r;
	
							$sel = ''; if ($dd[28]==$vl ) { $sel = 'selected'; }
							$op28 .= '<option value="'.$vl.'" '.$sel.'>'.$vl.'</option>';
							$op28 .= chr(13);
							
							$sel = ''; if ($dd[29]==$vl ) { $sel = 'selected'; }
							$op29 .= '<option value="'.$vl.'"'.$sel.'>'.$vl.'</option>';
							$op29 .= chr(13);
						}
					}
				if ($dd[20] == '0') { $dd20a = 'checked'; }
				if ($dd[20] == '1') { $dd20b = 'checked'; $apro20 = ''; }
				$sx .= '
				<fieldset><legend>Aprova��o & Financiamento Externo</legend>
					<table width=98%>
					
					<tr><TD class="lt2"><B>'.$msg20.'Projeto aprovado externamente por uma ag�ncia de fomento?</B> '.$obr.'
					<TR><TD class="lt1">
						<input type="radio" value="0" name="dd20" '.$dd20a.' onclick="dd20h();"> N�o
						<input type="radio" value="1" name="dd20" '.$dd20b.' onclick="dd20v();"> Sim
					<TR><TD>
						<div id="apro20" style="'.$apro20.'" class="lt0" >
							<fieldset><legend>dados do edital</legend>
							Especificar org�o de fomento '.$obr.'<BR>
							<textarea name="dd21" cols=60 rows=3>'.$dd[21].'</textarea>

							<table width=98% class="lt1">
								<TR><TD align="right">N�mero do Edital '.$obr.'
									<TD><Input type="text" name="dd23" size=20 lengthmax=20 value="'.$dd[23].'">
								<TR><TD align="right">N�mero da chamada '.$obr.'
									<TD><Input type="text" name="dd24" size=20 lengthmax=20 value="'.$dd[24].'">

								<TR><TD align="right">Valor aprovado R$ '.$obr.'
									<TD><Input type="text" name="dd26" size=20 lengthmax=20 value="'.$dd[26].'">

								<TR><TD align="right">Per�odo de vig�ncia (�nicio)
									<TD><select name="dd28">'.$op28.'</select>
								<TR><TD align="right">Per�odo de vig�ncia (t�rmino)
									<TD><select name="dd29">'.$op29.'</select>

							</table>
							</fieldset>
						</div>';
						
				/** Financiamento de empresa **/
				$dd30a = ''; $dd30b= ''; $apro30 = 'display: none; ';
				$op38 = '';
				if ($dd[30] == '0') { $dd30a = 'checked'; }
				if ($dd[30] == '1') { $dd30b = 'checked'; $apro30 = ''; }
				
				for ($r=(date("Y")-5);$r < date("Y")+5;$r++)
					{ for ($y=1;$y <= 12;$y++)
						{
							$vl = strzero($y,2).'/'.$r;
	
							$sel = ''; if ($dd[38]==$vl ) { $sel = 'selected'; }
							$op38 .= '<option value="'.$vl.'" '.$sel.'>'.$vl.'</option>';
							$op38 .= chr(13);
							
							$sel = ''; if ($dd[39]==$vl ) { $sel = 'selected'; }
							$op39 .= '<option value="'.$vl.'"'.$sel.'>'.$vl.'</option>';
							$op39 .= chr(13);
						}
					}
						
					$sx .= '
					<tr><TD class="lt2"><B>'.$msg30.'Grupo 2 - Financiamento por empresa?</B> '.$obr.'
					<TR><TD class="lt1">
						<input type="radio" value="0" name="dd30" '.$dd30a.' onclick="dd30h();"> N�o
						<input type="radio" value="1" name="dd30" '.$dd30b.' onclick="dd30v();"> Sim
					<TR><TD>
						<div id="apro30" style="'.$apro30.'" class="lt0" >
							<fieldset><legend>dados do financiamento</legend>
							Informe o nome da empresa financiadora<BR>
							<textarea name="dd31" cols=60 rows=3>'.$dd[31].'</textarea>

							<BR><BR>
							Especificar o CNPJ da empresa financiadora (CNPJ)<BR>
							<input type="text" name="dd32" size=20 lenghtmax=100 value="'.$dd[32].'">

							
							<table width=98% class="lt1">
								<TR><TD align="right">Valor aprovado R$
									<TD><Input type="text" name="dd36" size=20 lengthmax=20 value="'.$dd[36].'">

								<TR><TD align="right">Per�odo de vig�ncia (�nicio)
									<TD><select name="dd38">'.$op38.'</select>
								<TR><TD align="right">Per�odo de vig�ncia (t�rmino)
									<TD><select name="dd39">'.$op39.'</select>

							</table>
							</fieldset>
						</div>


					</table>
				</fieldset>';
					
				/** Comit� de �tica **/
				$ops = array('::n�o aplic�vel','em submiss�o','em avalia��o','aprovado');
				$opt = array('N','A','B','F');
				$opa = '';
				$opb = '';
				for ($r=0;$r < count($ops);$r++)
					{
					$sel = ''; if ($dd[50] == $opt[$r]) { $sel = 'selected'; }
					$opa .= '<option value="'.$opt[$r].'" '.$sel.'>'.$ops[$r].'</option>'.chr(13);
					
					$sel = ''; if ($dd[52] == $opt[$r]) { $sel = 'selected'; }
					$opb .= '<option value="'.$opt[$r].'" '.$sel.'>'.$ops[$r].'</option>'.chr(13);
					}
				

				$sx .= '
				<fieldset><legend>Comit�s de �tica</legend>
					<table width="98%" class="lt1">
					<TR><TH>Comit�
						<TH><I>Status</I>
						<TH>N� Parecer
					<TR><TD>Comit� de �tica em Pesquisa
						<TD><select name="dd50">
							'.$opa.'
							</select>
						<TD align="center"><input type="text" name="dd51" size=15 maxlength=15 value="'.$dd[51].'">
					<TR><TD>Comit� de �tica no Uso de Animais
						<TD><select name="dd52">
							'.$opb.'
							</select>
						<TD align="center"><input type="text" name="dd53" size=15 maxlength=15 value="'.$dd[53].'">
					</table>
				</fieldset>';	
				
				
				/** Arquivos */
				$sx .= '<fieldset><legend>Arquivos submetidos</legend>';
				$sx .= '<iframe src="submit_pibic_arquivos.php" 
						width=100%
						height=150 style="border: 0px solid #FFFFFF;"></iframe>';
				$sx .= '</fieldset>';
				
				/*** SALVAR **/
				$sx .= '<BR><BR>
					<input type="submit" name="acao" value="Gravar e avan�ar >>>" style="width: 300px; height: 50px;">
					';			
				
				$sx .= '
				<script>
					function dd20v()
						{ tela = $("#apro20").fadeIn("slow"); }
					function dd20h()
						{ tela = $("#apro20").fadeOut("slow"); }

					function dd30v()
						{ tela = $("#apro30").fadeIn("slow"); }
					function dd30h()
						{ tela = $("#apro30").fadeOut("slow"); }
				</script>			
				</form>';
				
				if (strlen($acao) > 0) { $sa = $this->mostra_erros(); }
				
				return($sa. $sx);
				
			}

		function submit_projeto_00()
			{
				global $dd,$user,$acao,$ss,$tabela,$cp;
				$professor = $ss->user_cracha;
				
				$cp = $this->cp_00();
				echo '<h3>Projeto do professor</h3>';
				$tabela = $this->tabela;
				
				if ((strlen($dd[2]) > 0) and (strlen($dd[0])==0))
					{
						$ano = date("Y");
						$sql = "select * from ".$this->tabela." where 
								(pj_search = '".UpperCaseSql($dd[2])."' or 
								pj_titulo = '".$dd[2]."') 
								and pj_professor = '$professor' 
								and pj_ano = '$ano' ";
						
						$rlt = db_query($sql);
						if ($line = db_read($rlt))
							{
								$err = 'Um projeto com este t�tulo j� existe, s� � poss�vel submeter projeto com t�tulos diferentes';
								$dd[4]='';				
							} else {
								$dd[4] = '1';
							}
					} else {
						$dd[4] = '1';
					}
				echo '<table>';
				echo '<tr><TD colspan=2><font color="red">'.$err;
				editar();
				echo '</table>';
			}

		function submit_projeto_new2()
			{
				//$this->structure();
				$proto = $_SESSION['protocolo'];
				/** Valida **/
				//print_r($dd);
		
				$ok = 1;
				$alert = '<font color="red">';
				
				/* Leitura dos dados caso edi��o */
				if (strlen($dd[0]) > 0)
					{
						$sql = "select * from ".$this->tabela." 
							where id_pj = ".round($dd[0]);
							
						$rlt = db_query($sql);
						$line = db_read($rlt);
						$proto = $line['pj_codigo'];
						$_SESSION['protocolo'] = $proto;
						$dd[1] = trim($line['pj_titulo']);
						$dd[2] = trim($line['pj_resumo']);
						$dd[3] = trim($line['pj_keywords']);
						$dd[80] = trim($line['pj_bp']);
						$dd[10] = trim($line['pj_area']);
						$dd[11] = trim($line['pj_area_estra']);
						
						$dd[20] = trim($line['pj_ext_sn']);
						$dd[21] = trim($line['pj_ext_local']);
						$dd[23] = trim($line['pj_ext_edital']);
						$dd[24] = trim($line['pj_ext_chamada']);
						$dd[26] = trim($line['pj_ext_valor']);
						$dd[28] = trim($line['pj_ext_vjini']);
						$dd[29] = trim($line['pj_ext_vjfim']);
						
						$dd[30] = trim($line['pj_gr2_sn']);
						$dd[31] = trim($line['pj_gr2_local']);
						$dd[32] = trim($line['pj_gr2_cnpj']);						
						$dd[33] = trim($line['pj_gr2_edital']);
						$dd[34] = trim($line['pj_gr2_chamada']);
						$dd[36] = trim($line['pj_gr2_valor']);
						$dd[38] = trim($line['pj_gr2_vjini']);
						$dd[39] = trim($line['pj_gr2_vjfim']);	
						
						$dd[50] = trim($line['pj_cep_status']);	
						$dd[51] = trim($line['pj_cep']);	
						$dd[52] = trim($line['pj_ceua_status']);	
						$dd[53] = trim($line['pj_ceua']);			

					}
				
				if (strlen($dd[1]) ==0 ) { $ok = 0; $msg1 = $alert; }
				if (strlen($dd[10]) ==0 ) { $ok = 0; $msg10 = $alert; }
				
				/** Checa arquivos **/
				$ok == 0;
				
				if ((strlen($dd[1]) > 0 ) and (strlen($acao) > 0))
					{
						/** Dados **/
						$titulo = $dd[1];
						$resumo = $dd[2];
						$keys = $dd[3];
						$objetivo = '';
						$area = $dd[10];
						$area_estra = $dd[11];
						$data = date("Ymd");
						$banco_projetos = $dd[80];
						
						$cep = $dd[50];
						$cep_nr = $dd[51];
						
						$ceua = $dd[52];
						$ceua_nr = $dd[53];
						
						$professor = $user->cracha;
						$ano = date("Y");
						
						/** Fomento **/
						$ext_sn = $dd[20];
						$ext_local = $dd[21];
						$ext_edital = $dd[23];
						$ext_chamada = $dd[24];
						$ext_valor = $dd[26];
						$ext_vjini = $dd[28];
						$ext_vjfim = $dd[29];
						
						/** gr2 **/
						$gr2_sn = $dd[30];
						$gr2_local = $dd[31];
						$gr2_cnpj = $dd[32];
						$gr2_valor = $dd[36];
						$gr2_vjini = $dd[38];
						$gr2_vjfim = $dd[39];
						
						/** Salvar **/					
						if (strlen($proto)==0)
							{
								$professor = $ss->user_cracha;
								$ano = date("Y");
								/* RN: Verifica se n�o existe este t�tulo */
								$sql = "select * from ".$this->tabela."
 										where pj_professor = '$professor'
 										and pj_ano = '$ano'
									";
								$rlt = db_query($sql);
								$tit = 0;
								if ($line = db_read($rlt))
									{
										if (UpperCaseSql($line['pj_titulo'])==UpperCaseSql($titulo))
											{
												$tit = 1;
												$proto = trim($line['pj_codigo']);
											}
									}
								
								
								if ($tit == 0)
								{
									/* RN: Insere projeto se n�o existe */
									$sql = "insert into ".$this->tabela."
										(pj_titulo, pj_codigo, pj_professor,pj_update, pj_data, pj_status) values
										('sem t�tulo','$proto','$professor',$data,$data,'!')";
									$rlt = db_query($sql);
									
									/*** Atualiza c�digos */
									$sql = "select * from ".$this->tabela." where pj_codigo = '' and pj_status = '!'; ";
									$xrlt = db_query($sql);
									
									while ($xline = db_read($xrlt))
										{
											$sql = "update ".$this->tabela." 
													set pj_codigo = '1".strzero($xline['id_pj'],6)."'
													where id_pj = ".$xline['id_pj'];
											$yrlt = db_query($sql);			
										}								
									
									$sql = "select * from ".$this->tabela."
										where pj_professor = '$professor' and pj_status = '!' ";
									$rlt = db_query($sql);
									$line = db_read($rlt);
									$proto = trim($line['pj_codigo']);						
									$_SESSION['protocolo'] = $proto;
									if (strlen($proto)==0)
										{ echo 'Erro na gera��o do protocolo'; exit; }
	
									$sql = "update ".$this->tabela." set pj_status = '@'
										 	where pj_codigo = '$proto' and pj_status = '!';";
									$rlt = db_query($sql);
									}
							}
						$sql = "select * from ".$this->tabela." where pj_codigo ='$proto' ";
						$rlt = db_query($sql);
						if (!($line = db_read($rlt)))
							{
								$sql = "insert into ".$this->tabela."
									(pj_codigo, pj_professor,pj_update, pj_data, pj_status) values
									('$proto','$professor',$data,$data,'@')";
								$rlt = db_query($sql);
							}
						
						//$sql = "delete from ".$this->tabela;
						//$rlt = db_query($sql);
						$sql = "update ".$this->tabela." set 
								pj_titulo = '$titulo',
								pj_search = '$txt',
								
								pj_ext_sn = '$ext_sn',
								pj_ext_local = '$ext_local',
								pj_ext_edital = '$ext_edital',
								pj_ext_chamada = '$ext_chamada',
								pj_ext_valor = '$ext_valor',
								pj_ext_vjini = '$ext_vjini',
								pj_est_vjfim = '$ext_vjfim',
								
								pj_gr2_sn = '$gr2_sn',
								pj_gr2_local ='$gr2_local',
								pj_gr2_cnpj = '$gr2_cnpj',
								pj_gr2_valor = '$gr2_valor',
								pj_gr2_vjini = '$gr2_vjini',
								pj_gr2_vjfim = '$gr2_vjfim',
								
								pj_ano = '$ano',
								pj_resumo = '$resumo',
								pj_objetivo = '$objetivo',
								pj_keywords = '$keys',
								pj_grupo_pesquisa ='',
								pj_linha_pesquisa ='',
								
								pj_area ='$area',
								pj_area_estra ='$area_estra',
								
								pj_update = $data,
								pj_data = $data,
								pj_ss_programa = '',
								pj_ss_linha = '',
								pj_cep = '$cep_nr',
								pj_ceua = '$ceua_nr',
								pj_cep_status = '$cep',
								pj_ceua_status = '$ceua',
								pj_status = '@',
								pj_professor = '$professor',
								pj_bp = '$banco_projetos'
							where pj_codigo ='$proto'
							and pj_professor = '$professor'
						";
						$rlt = db_query($sql);
						
						$okx = $this->submit_projeto_valida_new($proto);
						
						if (($ok==1) and ($okx==1))
							{
								redirecina('submit_phase_1.php');
								exit; 
							}
					}
				
				$obr = '&nbsp;<font color="red">(obrigat�rio)</font>';
				$sx .= '<style>
						.it0 { font-size: 16px; color: #000000; font-weight: bolder; }
						.it1 { font-size: 14px; color: #202020; font-weight: bolder; margin-left: 5px; }
						.it2 { font-size: 13px; color: #202020; margin-left: 10px; }
						</style>
						';
				$dd80a = ''; if ($dd[80]=='S') { $dd80a = 'selected'; }
				$dd80b = ''; if ($dd[80]=='N') { $dd80b = 'selected'; }
				$sx .= '
				<form method="post" action="'.page().'">
				<table width=100%>
				<TR><TD colspan=2 class=lt5 align=center >
				<h3>Submiss�o de projeto do professor</h3> 
				<fieldset><legend>Dados do projeto</legend>
					<table width=98%>
					<tr><TD class="lt0">'.$msg1.'T�TULO DO PROJETO PRINCIPAL '.$obr.'
					<tr><td><textarea name="dd1" cols="80" rows="3">'.$dd[1].'</textarea>';

//					<tr><TD class="lt0">RESUMO (at� 250 palavras)
//					<tr><td><textarea name="dd2" cols="80" rows="4">'.$dd[2].'</textarea>

//					<tr><TD class="lt0">Palavras-chave (at� 5 palavras)
//**
  				 $sx .= '
 					<tr><TD class="lt2">Banco de projetos
					<TR><TD class="lt0">O Banco de Projetos, rec�m implantado na PUCPR, abriga em seu banco de dados todos os projetos desenvolvidos na PUCPR, em �mbito acad�mico.
						Desta forma voc� pode cadastrar automaticamente seu projeto somente confirmando a informa��o abaixo:
					<tr><td><select name="dd80">
							<option value="S" '.$dd80a.'>SIM, autorizado a inser��o deste projeto no banco de projetos da PUCPR</option>
							<option value="N" '.$dd80b.'>N�O, n�o quero inserir meu projeto no banco de projetos</option>
							</select>
					</table>
				</fieldset>
				
				<fieldset><legend>�rea do conhecimento</legend>
					<table width=98%>
					<tr><TD class="lt0">'.$msg10.'�rea do conhecimento (seja o mais espec�fico poss�vel) '.$obr.'
					<tr><td><select name="dd10">';
				$sx .= $ar->forma_area_especifica($dd[10]);
				$sx .= '</select>	

					<tr><TD class="lt0">�rea estrat�gica?
					<tr><td><select name="dd11">';
				$sx .= $ar->forma_area_estrategica($dd[11]);
				$sx .= '</select>	
					</table>
				</fieldset>';
				
				/*** SALVAR **/
				$sx .= '<BR><BR>
					<input type="submit" name="acao" value="Gravar e avan�ar >>>" style="width: 300px; height: 50px;">
					';			

								
				if (strlen($acao) > 0) { $sa = $this->mostra_erros(); }
				
				return($sa. $sx);
				
			}

		function updatex()
			{
				global $base;
				$c = 'pj';
				$c1 = 'id_'.$c;
				$c2 = $c.'_codigo';
				$c3 = 7;
				$sql = "update ".$this->tabela." set $c2 = lpad(1000000+$c1,$c3,0) where $c2='01075' ";
				if ($base=='pgsql') { $sql = "update ".$this->tabela." set $c2 = '1' || trim(to_char(id_".$c.",'000000')) where $c2 = '' "; }
				$rlt = db_query($sql);				
			}

		function structure()
			{
			$sql = "CREATE TABLE pibic_metas (
				id_pm SERIAL NOT NULL,
				pm_centro char(5),
				pm_tipo char(3),
				pm_data int8,
				pm_descricao char(50),
				
				pm_v1 int,
				pm_v2 int,
				pm_v3 int,
				pm_v4 int,
				pm_v5 int,
				pm_v6 int,

				pm_m1 int,
				pm_m2 int,
				pm_m3 int,
				pm_m4 int,
				pm_m5 int,
				pm_m6 int
				
				) ";
			$rlt = db_query($sql);
								
			$sql = "DROP TABLE ".$this->tabela;
			//$rlt = db_query($sql);
				
			$sql = "CREATE TABLE ".$this->tabela." (
				id_pj SERIAL NOT NULL,
				pj_titulo TEXT,
				pj_search TEXT,
				pj_codigo CHAR( 10 ),
				pj_ano CHAR( 4 ),
				pj_resumo TEXT,
				pj_objetivo TEXT,
				pj_keywords CHAR( 255 ),
				pj_grupo_pesquisa CHAR( 7 ),
				pj_linha_pesquisa CHAR( 7 ),
				pj_area CHAR( 15 ),
				pj_area_estra CHAR(15),
				pj_update INT,
				pj_data INT,
				pj_ss_programa CHAR( 7 ),
				pj_ss_linha CHAR( 7 ),
				pj_cep CHAR( 15 ),
				pj_ceua CHAR( 15 ),
				pj_cep_status CHAR( 1 ),
				pj_ceua_status CHAR( 1 ),
				pj_status CHAR( 1 ),
				
				pj_ext_sn CHAR( 1 ),
				pj_ext_local text,
				pj_ext_edital char(20),
				pj_ext_chamada char(20),
				pj_ext_valor char(20),
				pj_ext_vjini char(10),
				pj_est_vjfim char(10),
					
				pj_gr2_sn CHAR( 1 ),
				pj_gr2_local text,
				pj_gr2_cnpj char(20),
				pj_gr2_valor char(20),
				pj_gr2_vjini char(10),
				pj_gr2_vjfim char(10),
				
				pj_bp char(1),
								
				pj_professor CHAR( 8 )
			);";
			//$rlt = db_query($sql);				
			}		
	}
