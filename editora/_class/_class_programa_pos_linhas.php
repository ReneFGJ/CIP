<?php
class pos_linha
	{
		var $tabela = 'programa_pos_linhas';
		var $line;
		var $id;
		var $programa;
		var $codigo;
		
		function mostra()
			{
				$sx .= '<div class="topic_header">';
				$sx .= msg('Linha de Pesquisa').': <B>'.$this->line['posln_descricao'].'</B>';
				$sx .= '</div>';				
				
				return($sx);
			}
		function mostra_docentes()
			{
				$sql = "select * from programa_pos_docentes 
						inner join pibic_professor on pdce_docente = pp_cracha and pdce_ativo = 1
						where pdce_programa_linha = '".$this->codigo."' 
						order by pp_nome
						";
				$rlt = db_query($sql);
				
				$sx .= '<table width="100%" class="tabela00">';
				$sx .= '<TR><TH>Docente
							<TH>Ano Entrada
							<TH align="right">Tipo';
				$id = 0;
				while ($line = db_read($rlt))
					{
						$link = '<A HREF="docente.php?dd0='.$line['pp_cracha'].'">';
						$id++;
						$sx .= '<TR>';
						$sx .= '<TD>';
						$sx .= $link;
						$sx .= $line['pp_nome'];
						$sx .= '</A>';
						$sx .= '<TD align="center">';
						$sno = round($line['pdce_ano_entrada']);
						if ($ano == 0) { $ano = '-'; }
						$sx .= $ano;
						$sx .= '<TD align="right">';
						$sx .= $this->mostra_tipo($line['pdce_tipo']);
					}
				$sx .= '<tr><TD colspan=5><i>Total de '.$id.' docentes vinculados ao programa</I>';
				$sx .= '</table>';
				return($sx);
				
			}
		function mostra_tipo($tipo)
			{
				$tipo = trim($tipo);
				switch ($tipo)
					{
					case 'P': $tipo = 'Permanente'; break;
					case 'V': $tipo = 'Visitante'; break;
					case 'C': $tipo = 'Colaborador'; break;
					}
				return($tipo);
			}
		function le($id)
			{
				$sql = "select * from ".$this->tabela." where id_posln = ".round('0'.$id);
				$rlt = db_query($sql);
				if ($line = db_read($rlt))
					{
						$this->id = $line['id_posln'];
						$this->nome = trim($line['posln_descricao']);
						$this->programa = $line['posln_programa'];
						$this->codigo = $line['posln_codigo'];
						$this->line = $line;
					}
				return(1);
			}
			
		
		function mostra_resumo_pos($pos)
			{
				$sqlq = "
						select sum(docentes) as docentes, sum(visitante) as visitante, sum(colaborador) as colaborador, pdce_programa_linha 
						from (
							select count(*) as docentes , 0 as visitante, 0 as colaborador, pdce_programa_linha
							from programa_pos_docentes 
							where pdce_programa = '$pos' and pdce_tipo = 'P' and pdce_ativo = 1
							group by pdce_programa_linha
						union
							select 0 as docentes, count(*) as visitante, 0 as colaborador, pdce_programa_linha
							from programa_pos_docentes 
							where pdce_programa = '$pos' and pdce_tipo = 'V' and pdce_ativo = 1
							group by pdce_programa_linha 
						union
							select 0 as docentes, 0 as visitante, count(*) as colaborador, pdce_programa_linha
							from programa_pos_docentes 
							where pdce_programa = '$pos' and pdce_tipo = 'C' and pdce_ativo = 1
							group by pdce_programa_linha 
						) as tabela group by pdce_programa_linha
						";				
				
				$sql = "select * from programa_pos_linhas
						left join (".$sqlq.") as tabela001 on pdce_programa_linha = posln_codigo 
						where posln_programa = '$pos' and posln_ativo = 1
				";
				$rlt = db_query($sql);
				$sx .= '<table class="tabela00" width="100%">';
				$sx .= '<TR><TH>Linha de pesquisa<TH>Docentes<TH>Visitantes<TH>Colaboradores';
				while ($line = db_read($rlt))
					{
						$link = '<A HREF="pos_graduacao_linha_detalhe.php?dd0='.$line['id_posln'].'">';
						$sx .= '<TR>';
						$sx .= '<td class="tabela01">';
						$sx .= $link.$line['posln_descricao'].'</A>';
						$sx .= '<td class="tabela01" align="center" clsas="lt4" width="100">';
						$sx .= $line['docentes'];						
						$sx .= '<td class="tabela01" align="center" clsas="lt4" width="100">';
						$sx .= $line['visitante'];
						$sx .= '<td class="tabela01" align="center" clsas="lt4" width="100">';
						$sx .= $line['colaborador'];
					}
				$sx .= '</table>';

				return($sx);
			}
		
		function cp()
			{
				$cp = array();
						
				$opa = '&1:ano indefinido';
				for ($r=1950;$r<=date("Y");$r++)
					{$opa .= '&'.$r.':'.$r; }
				array_push($cp,array('$H8','id_posln','id',False,true));
				array_push($cp,array('$H5','posln_codigo',msg('codigo'),False,true));
				array_push($cp,array('$S100','posln_descricao',msg('nome'),true,true));
				
				array_push($cp,array('$Q pos_nome:pos_codigo:select * from programa_pos order by pos_nome','posln_programa',msg('Programa'),True,True,''));
				
				array_push($cp,array('$O 1:SIM&0:NÃO','posln_ativo',msg('ativo'),true,true));

				array_push($cp,array('$O : '.$opa,'posln_ano_entrada',msg('abertura_ano'),true,true));
				array_push($cp,array('$O : '.$opa,'posln_ano_saida',msg('encerramento_ano'),true,true));
				
				array_push($cp,array('$T80:5','posln_tema',msg('tema_de_pesquisa'),true,true));
				
				return($cp);
			}
			
		function row()
			{
				global $cdf,$cdm,$masc;
				$cdf = array('id_posln','posln_descricao','posln_ano_entrada','posln_ano_saida','posln_ativo');
				$cdm = array('cod',msg('nome'),msg('ano_start'),msg('ano_end'),msg('ativo'));
				$masc = array('','','','','SN','');
				return(1);				
			}
						
		function structure()
			{
			$sql = "CREATE TABLE ".$this->tabela." (
				id_posln SERIAL NOT NULL ,
				posln_codigo CHAR( 7 ) ,
				posln_programa CHAR( 7 ) ,
				posln_descricao CHAR( 100 ) NOT NULL ,
				posln_ano_entrada INT NOT NULL ,
				posln_ano_saida INT NOT NULL ,
				posln_tema text,
				posln_ativo INT NOT NULL )";
			//	$rlt = db_query($sql);
			return(1);			
			}
			
		function updatex()
			{
					global $base;
				$c = 'posln';
				$c1 = 'id_'.$c;
				$c2 = $c.'_codigo';
				$c3 = 5;
				$sql = "update ".$this->tabela." set $c2 = lpad($c1,$c3,0) where $c2='' ";
				if ($base=='pgsql') { $sql = "update ".$this->tabela." set $c2 = trim(to_char(id_".$c.",'".strzero(0,$c3)."')) where $c2='' "; }
				$rlt = db_query($sql);
			}	
	}
?>
