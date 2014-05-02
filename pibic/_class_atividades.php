<?php
class atividades
	{
	var $docente;
	var $discente;
	
	var $tabela = 'atividade';
	
	function total_captacoes_validar($professor='')
		{
			global $cap;
			$cap = new captacao;
			
			$sql = "select * from captacao
					inner join 
						( 
						select pdce_programa, pdce_docente from programa_pos_docentes group by pdce_programa, pdce_docente
						) as tabela on ca_professor = pdce_docente
					inner join programa_pos on pdce_programa = pos_codigo
					inner join pibic_professor on pp_cracha = ca_professor
					where pos_coordenador = '$professor'
					and ca_status = 10
			 ";
			 
			$rlt = db_query($sql);
			$id = 0;
			$sx = '<table>';
			while ($line = db_read($rlt))
				{
					$id++;
					$sx .= $cap->mostra_captacao_row($line);
					$ln = $line;					
				}
			$sx = '</table>';				
			return($id);
		}
	
	function total_isencoes($professor='')
		{
			$this->remover_atividade_professor('ise',$professor);
			
			$sql = "
				select * from bonificacao
				inner join captacao on bn_original_protocolo = ca_protocolo
				where bn_professor = '$professor'
				and bn_original_tipo = 'IPR' ";
			$sql .= " and bn_status = '!' ";
			//echo $sql;
			$rlt = db_query($sql);
			$total = 0;			
			while ($line = db_read($rlt))
			{
				
				$professor = $line['bn_professor'];
				$discente = '';				 
				$total++;
				$protocolo=$line['bn_original_protocolo'];
				$limite = 20990101;
				$this->inserir_atividade('ise','Isenção de Alunos / Ato. Normativo 001/2012 - '.$protocolo,$professor,$discente,$limite,$protocolo);	
			}			
			return($total);
		}
	function remover_atividade_professor($tipo='',$professor)
		{
			$proto = trim($proto);
			$tipo = trim($tipo);
			$sql = "delete from ".$this->tabela." 
					where act_docente = '$professor'					
					";
			if (strlen($tipo) > 0)
				{
					$sql .= " and act_codigo = '$tipo' ";
				}
			$rlt = db_query($sql);
			return(0);
			
		}
	function remover_artividade($proto,$tipo)
		{
			$proto = trim($proto);
			$tipo = trim($tipo);
			$sql = "delete from ".$this->tabela." 
					where act_protocolo = '$proto'
					and act_codigo = '$tipo'
					";
			$rlt = db_query($sql);
			return(0);
			
		}
	function remover_atividade_tipo($tipo)
		{
			$proto = trim($proto);
			$tipo = trim($tipo);
			$sql = "delete from ".$this->tabela." 
					where act_codigo = '$tipo'
					";
			$rlt = db_query($sql);
			return(0);
			
		}		
	function tipos($tp='')
		{
			$ar = '(???)'.$tp;
			if ($tp=='rr') { $ar = 'SEMIC - IC'; }
			if ($tp=='ic') { $ar = 'Iniciação Científica'; }
			if ($tp=='pq') { $ar = 'Diretoria de Pesquisa'; }
			if ($tp=='is') { $ar = 'Diretoria de Pesquisa'; }
			return($ar);
		}
	function total_atividades($codigo='')
		{			
			if (strlen($codigo)==0) { return(''); }
			$sql = "select count(*) as total from ".$this->tabela." 
					where act_docente = '$codigo'
					or act_discente = 'codigo' ";;
			// $sql .= " and act_status = '@' ";
			$rlt = db_query($sql);
			$line = db_read($rlt);
			$total = $line['total'];
			return($total);	
		}
		
	function lista_atividades($codigo='')
		{
			global $tab_max;
			
			//$this->inserir_atividade('IC3','Avaialiação de relatório parcial',$codigo,'',20130228);
			//$this->inserir_atividade('PQ4','Senso da pesquisa (diretoria de pesquisa)',$codigo,'',20130211);
			if (strlen($codigo)==0) { return(''); }
			$sql = "select * from ".$this->tabela." 
					where act_docente = '$codigo'
					or act_discente = 'codigo'
					order by act_limite 
					";
		
			$rlt = db_query($sql);
			$id = 0;			
			$sx = '
			<div>
				<h1>Lista de alunos</h1>
				<p>Você precisa realizar a tarefa descritas <span class="palavra-destaque">"Abaixo"</span>. Clique na atividade ou no botão para visualizar.</p>
			
			<table width="88%" align="center">				
				<tr>
					<td class="tabela-titulo">Origem</td>
					<td class="tabela-titulo">Atividade</td>
					<td class="tabela-titulo">Prazo</td>
				</tr>
						
			';
			$tipos = $this->tipos();
			$tot = 0;
			while ($line = db_read($rlt))
				{
					$tot++;
					$css = lowercase(substr($line['act_codigo'],0,2));
					$id++;
					$post = 'dd0='.$codigo.'&dd1='.trim($line['act_codigo']).'&dd2='.$line['id_act'].'&dd5='.$codigo.'&dd90='.checkpost($codigo.$line['id_act'].trim($line['act_codigo']));
					$link = '<A class="lt1" HREF="atividade_detalhes.php?'.$post.'">';
					$sx .= '<TR>';
					$sx .= '<td class="id-atividade-'.$css.'">';
					$sx .= $this->tipos($css).'</td>';
					$sx .= '<TD class="lt1">';
					$sx .= $link;
					$sx .= $line['act_descricao'];
					$sx .= '<TD>';
					$limite = $line['act_limite'];
					if ($limite == date("Ymd")) { $limite_c = 'Hoje'; }
					if ($limite < date("Ymd")) { $limite_c = '<font color="red">Atrasado</A>'; }
					if ($limite > date("Ymd")) { $limite_c = stodbr($limite); }
					$acao = 'Entregar';
					$tp = trim($line['act_codigo']);
					if ($tp == 'ise') { $acao = 'solicitar isenção';}
					
					$sx .= $limite_c;
					$sx .= '<td>';
					$sx .= '<form action="atividade_detalhes.php" method="get">
							<input type="hidden" name="dd0" value="'.$codigo.'">
							<input type="hidden" name="dd1" value="'.trim($line['act_codigo']).'">
							<input type="hidden" name="dd2" value="'.$line['id_act'].'">
							<input type="hidden" name="dd5" value="'.$codigo.'">
							<input type="hidden" name="dd90" value="'.checkpost($codigo.$line['id_act'].trim($line['act_codigo'])).'">
							<input type="submit" value="'.$acao.'" class="botao-geral">
							</form></button>';
					$sx .= '</td>';
				}
			if ($tot == 0)
				{
					$sx .= '<TR><TD colspan=5>';
					$sx .= '<h3>'.msg('nenhuma_atividade');
				}
	
			$sx .= '
					</table>
				</div>
				
			';
			//if ($id==0) { $sx = '<h2>nenhuma atividade pendente</h2>'; }
			return($sx);
		}
	function inserir_atividade($cod='',$descricao='',$docente='',$discente='',$limite=19000101,$protocolo)
		{
			$data = date("Ymd");
			if (strlen($cod) == 3)
			{
			$sql = "select * from ".$this->tabela."
				where act_codigo = '$cod' and act_docente = '$docente' 
						and act_discente = '$discente' 
						and act_protocolo = '$protocolo'";
			$rlt = db_query($sql);
			if ($line = db_read($rlt))
			{
				$id = $line['id_act'];
				$sql = "update ".$this->tabela."
						set act_limite = $limite,
						act_status = '@',
						act_data = $data
						where id_act = $id
						";
				$rlt = db_query($sql);
			} else {
				
				$sql = "insert into ".$this->tabela." 
					(act_descricao, act_codigo, act_limite,
					act_data, act_ativo, act_status,
					act_docente, act_discente, act_protocolo
					) values (
					'$descricao','$cod',$limite,
					$data,1,'@',
					'$docente','$discente','$protocolo'
					)					
				";			
				$rlt = db_query($sql);
				}
			}		
		}
	function strucuture()
		{
			$sql = "CREATE TABLE atividade
					(
					id_act serial not null,
					act_descricao char(60),
					act_codigo char(5),
					act_limite int,
					act_data int,
					act_ativo int,
					act_status char(1),
					act_docente char(8),
					act_discente char(8)
					)
			";
			$rlt = db_query($sql);
		}
	}
?>
