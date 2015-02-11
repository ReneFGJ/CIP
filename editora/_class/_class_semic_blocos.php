<?php
class blocos {
	var $tabela = "semic_blocos";
	var $tabela_local = "semic_local";
	
	var $jid = 85;
		
	/*
	 		CREATE TABLE semic_trabalhos (
  				id_st serial NOT NULL,
  				st_codigo char(20),
    			st_bloco char(7),
    			st_avaliador_1 char(8),
    			st_avaliador_2 char(8),
    			st_avaliador_3 char(8),
    			st_avaliador_4 char(8),
    			st_status char(1),
    			st_ano char(4),
    			st_tipo char(1)
	 */
	
	function vincula_bloco_trabalho_inserir($cod,$bloco)
		{
			if ((strlen($cod)==0) or ($bloco == 0)) { return(0); }
			
			$bloco = strzero($bloco,5);
			$sql = "select * from semic_trabalhos 
						where st_ano = '".date("Y")."' 
						and st_codigo = '$cod'
						and st_bloco = '$bloco'
						";
			$rlt = db_query($sql);
			if ($line = db_read($rlt))
				{
					
				} else {
					$ano = date("Y");
					$sql = "insert into semic_trabalhos 
							(
								st_codigo, st_bloco, st_status, 
								st_ano, st_tipo
							) values (
								'$cod','$bloco','A',
								'$ano','O'
							)
					";
					$rlt = db_query($sql);
				}
		}
	function desvincula_bloco_trabalho_inserir($cod,$bloco)
		{
			if ((strlen($cod)==0) or ($bloco == 0)) { return(0); }
			
			$bloco = strzero($bloco,5);
			$sql = "delete from semic_trabalhos 
						where st_ano = '".date("Y")."' 
						and st_codigo = '$cod'
						and st_bloco = '$bloco'
						";
			$rlt = db_query($sql);
			if ($line = db_read($rlt))
				{
				print_r($line);	
				}
		}
	
	function vincular_bloco_trabalho($o=0)
		{
			global $dd, $acao;
			

			//$sql = "drop table semic_trabalhos";
			//$rlt = db_query($sql);
			
			//$this->structure();			
			$bb1 = "Programar >>>";
			$bb2 = "Desprogramar";
			
			if ((strlen($dd[2]) > 0) and (trim($acao) == $bb1))
				{
					$this->vincula_bloco_trabalho_inserir($dd[2],$dd[0]);
				}
			
			if ((strlen($dd[3]) > 0) and (trim($acao) == $bb2))
				{
					$this->desvincula_bloco_trabalho_inserir($dd[3],$dd[0]);
				}			
			if (strlen($dd[5]) > 0)
				{
					$whf = " and article_ref like '%".$dd[5]."%' ";
				}
			if ($o==0)
			{			
			$sql = "select * from articles 
						left join semic_trabalhos on st_codigo = article_ref
						where journal_id = 85 
						and article_publicado = 'S'	
						and article_ref like '%*%'
						$whf
						order by article_ref				
						";
			} else {
			$sql = "select * from articles 
						left join semic_trabalhos on st_codigo = article_ref
						where journal_id = 85 
						and article_publicado = 'S'	
						and not (article_ref like '%*%')
						$whf
						order by article_ref			
				";				
			}
			$rlt = db_query($sql);
			$so = '';
			while ($line = db_read($rlt))
				{
					if (strlen(trim($line['st_codigo']))==0)
						{
						$ref = trim($line['article_ref']);
						$so .= '<option value="'.$ref.'">'.$ref.' ('.$line['id_article'].')</option>';
						}
				}
			/* SELECTED */
			$sql = "select * from articles 
						left join semic_trabalhos on st_codigo = article_ref
						where journal_id = 85 
						and article_publicado = 'S'	
						and st_bloco = '".strzero($dd[0],5)."'
						order by article_ref				
						";
			$rlt = db_query($sql);
			$sa = '';
			$total = 0;
			
			while ($line = db_read($rlt))
				{
					$total++;
					if (strlen(trim($line['st_codigo']))!=0)
						{
						$ref = trim($line['article_ref']);
						$sa .= '<option value="'.$ref.'">'.$ref.'</option>';
						}
				}
						
			
			$sx = '<form>';
			$sx .= 'Filtro: <input type="string" name="dd5" value="'.$dd[5].'">';
			$sx .= '<input type="hidden" name="dd0" value="'.$dd[0].'">';
			$sx .= '<table width=550">';
			$sx .= '<TR valign="top"><TD>';
			$sx .= '<select name="dd2" style="width:200px;" size=10>';
			$sx .= $so;
			$sx .= '</select>';
			$sx .= '<TD width="150">';
			$sx .= '<input type="submit" value="'.$bb1.'" name="acao"><BR>';
			$sx .= '<input type="submit" value="'.$bb2.'" name="acao">';
			$sx .= '<TD>';
			$sx .= '<select name="dd3" style="width:200px;" size=10>';
			$sx .= $sa;
			$sx .= '</select>';
			
			$sx .= '<TD><font style="font-size: 40px">'.$total;
			$sx .= '</font><BR>Trabalhos';
			$sx .= '</table>';
			$sx .= '<form>';
			return($sx);
		}
	
	function le($id)
		{
			$sql = "select * from ".$this->tabela." 
					inner join " . $this -> tabela_local . " on blk_sala = sl_codigo
					where id_blk = ".round($id);
			$rlt = db_query($sql);
			if ($line = db_read($rlt))
				{
					$this->line = $line;
				}
			return(1);
		}

	function row() {
		global $cdf, $cdm, $masc;
		$cdf = array('id_blk', 'blk_titulo', 'blk_data', 'blk_hora');
		$cdm = array('cod', 'titulo', 'data', 'hora');
		$masc = array('', '', '', '', '', '', '', '');
		return (1);
	}
	function mostra_bloco()
		{
			$line = $this->line;
			$sx .= '<div class="semic_bloco">';
			$sx .= '<div class="semic_bloco_data">' . stodbr($line['blk_data']) . '</div>';
			$sx .= '<div class="semic_bloco_hora">' . $line['blk_hora'] . '</div>';
			$sx .= '<div class="semic_bloco_titulo">' . trim($line['blk_titulo']) . '</div>';
			$sx .= '<div class="semic_bloco_local">' . trim($line['sl_nome']) . '</div>';
			$sx .= '</div>';
			return($sx);
		}
	function array_avaliadores()
		{		
			$jid = $this->jid;
			$sql = "select * from  pareceristas  ";
			$sql .= " inner join instituicao on us_instituicao = inst_codigo ";
			$sql .= " where us_journal_id = ".$jid;
			$sql .= " and us_ativo = 1 ";
			$sql .= " order by us_nome ";
			$rlt = db_query($sql);
			$ava = array();
			while ($line = db_read($rlt))
				{
					$cod = trim($line['us_codigo']);
					$nome = trim($line['us_nome']);
					$inst = trim($line['inst_abreviatura']);
					$nome_inst = $nome.' ('.$inst.')';
					$av = array($cod, $nome_inst);
					array_push($ava,$av);
				}
			$this->avaliadores = $ava;
			return(0);
		}
	function busca_avaliador($ida)
		{
			$ida = trim($ida);
			$a = $this->avaliadores;
			$ava = 'Não definido';		
			for ($r=0;$r < count($a);$r++)
				{
					//echo '<BR>=>'.$a[$r][0].'=='.$a[$r][1].'=='.($a[$r][0] == $ida);
					if ($a[$r][0] == $ida)
						{
							$ava = trim($a[$r][1]);
						}
				}
			return($ava);
			
		}
	function mostra_blocos($dia = 0,$poster=0) {
		$this->array_avaliadores();
		// st_bloco
		if ($dia != 0) { $wh = ' blk_data = '.$dia; }
		$sql = "select * from " . $this -> tabela . "
					left join " . $this -> tabela_local . " on blk_sala = sl_codigo 
					left join semic_trabalhos on st_bloco = blk_codigo					
					$wh
					order by blk_data, blk_hora, blk_titulo , st_codigo
					";
		$rlt = db_query($sql);
		$xst = '';
		while ($line = db_read($rlt)) {
			//print_r($line);
			//exit;
			$st = $line['id_blk'];
			if ($xst != $st)
				{
					$avaliador_1 = $this->busca_avaliador($line['blk_avaliador_1']);
					$avaliador_2 = $this->busca_avaliador($line['blk_avaliador_2']);
					$avaliador_3 = $this->busca_avaliador($line['blk_avaliador_3']);
					$avaliador_4 = $this->busca_avaliador($line['blk_avaliador_4']);
					
					$link = '<A HREF="semic_blocos_mostra.php?dd0='.$line['id_blk'].'">';
					$sx .= '<div class="semic_bloco" style="width: 100%;">';
					$sx .= '<div class="semic_avaliador" style="float: right;">';
					$sx .= 'Avaliador 1: '.$avaliador_1;
					$sx .= '<BR>Avaliador 2: '.$avaliador_2;
					$sx .= '<BR>Suplente 1: '.$avaliador_3;
					$sx .= '<BR>Suplente 2: '.$avaliador_4;
					$sx .= '</div>';
					$sx .= '<div class="semic_bloco_data">' . stodbr($line['blk_data']) . '</div>';
					$sx .= '<div class="semic_bloco_hora">' . $line['blk_hora'] . '</div>';
					$sx .= '<div class="semic_bloco_titulo">' . $link.trim($line['blk_titulo']) . '</A></div>';
					$sx .= '<div class="semic_bloco_local">' . trim($line['sl_nome']) . '</div>';
					$sx .= '</div>';
					$xst = $st;
				}
			$sx .= '==>'.$line['st_codigo'].'<BR>';
		}
		return ($sx);

	}

	function structure() {
		$sql = "
			CREATE TABLE semic_blocos (
			id_blk serial NOT NULL,
  			blk_codigo char(5),
  			blk_ano char(4),
  			blk_data int8,
  			blk_hora char(5),
  			blk_status char(1),
  			blk_tipo char(1),
  			blk_avaliador_1 char(8),
  			blk_avaliador_2 char(8),
  			blk_avaliador_3 char(8),
  			blk_avaliador_4 char(8),
  			blk_titulo text,
  			blk_descricao text,
  			blk_sala char(5)
			);
			";
		//$rlt = db_query($sql);	
		/* Local */
		$sql = "
			CREATE TABLE semic_local (
				id_sl serial NOT NULL,
  				sl_codigo char(5),
  				sl_nome char(50),
  				sl_descricao text,
  				sl_ativa int8,
				sl_ano char(4)
				)  ;				
		";
		//$rlt = db_query($sql);
		//$sql = "drop table semic_trabalhos ";
		//$rlt = db_query($sql);
		
		$sql = "
		CREATE TABLE semic_trabalhos (
  				id_st serial NOT NULL,
  				st_codigo char(20),
    			st_bloco char(7),
    			st_avaliador_1 char(8),
    			st_avaliador_2 char(8),
    			st_avaliador_3 char(8),
    			st_avaliador_4 char(8),
    			st_status char(1),
    			st_ano char(4),
    			st_tipo char(1)
  			);
		";
		$rlt = db_query($sql);
	}
		
	function updatex()
			{
				global $base;
				$c = 'blk';
				$c1 = 'id_'.$c;
				$c2 = $c.'_codigo';
				$c3 = 5;
				$sql = "update ".$this->tabela." set $c2 = lpad($c1,$c3,0) where $c2='' ";
				if ($base=='pgsql') { $sql = "update ".$this->tabela." set $c2 = trim(to_char(id_".$c.",'".strzero(0,$c3)."')) where $c2='' or $c2 is null "; }
				$rlt = db_query($sql);
			}
		
	function cp() {
		
		$jid = $this->jid;
		$opa = ' : ';
		$opa .= '&O:Apresentação Oral';
		$opa .= '&P:Sessão de Poster';
		$opa .= '&A:Palestra';
		$opa .= '&M:Mesa Redenda';
		$opa .= '&B:Abertura';
		$opa .= '&C:Encerramento';
		$opa .= '&O:Outras';

		$ops = ' : ';
		$ops .= '&1:Ativo&0:Inativo&2:Confirmado&3:A confirmar';
		
		$sql = "select us_codigo, trim(us_nome) || ' (' || trim(inst_abreviatura) || ')' as nome from  pareceristas  ";
		$sql .= " inner join instituicao on us_instituicao = inst_codigo ";
		$sql .= " where us_journal_id = ".$jid;
		$sql .= " and us_ativo = 1 ";
		$sql .= " order by us_nome ";
		$sqla = 'nome:us_codigo:'.$sql;		

		$cp = array();
		array_push($cp, array('$H8', 'id_blk', '', False, True));
		array_push($cp, array('$H8', 'blk_codigo', '', False, True));
		array_push($cp, array('$[2014-' . date("Y") . ']D', 'blk_ano', 'Ano', True, True));

		array_push($cp, array('$S100', 'blk_titulo', 'Nome do bloco', True, True));
		array_push($cp, array('$T80:3', 'blk_descricao', 'Descricao do bloco', False, True));
		array_push($cp, array('$Q sl_nome:sl_codigo:select * from semic_local where sl_ativa = 1 order by sl_nome', 'blk_sala', 'Sala', False, True));
		array_push($cp, array('$O ' . $opa, 'blk_tipo', 'Tipo', False, True));

		array_push($cp, array('$D8', 'blk_data', 'Data', True, True));
		array_push($cp, array('$S5', 'blk_hora', 'Hora', False, True));
		array_push($cp, array('$O ' . $ops, 'blk_status', 'Status', True, True));
		array_push($cp, array('$Q '.$sqla, 'blk_avaliador_1', 'Avaliador 1:', False, True));
		array_push($cp, array('$Q '.$sqla, 'blk_avaliador_2', 'Avaliador 2:', False, True));
		array_push($cp, array('$Q '.$sqla, 'blk_avaliador_3', 'Suplente 1:', False, True));
		array_push($cp, array('$Q '.$sqla, 'blk_avaliador_4', 'Suplente 2:', False, True));
		return ($cp);
	}

}
?>
