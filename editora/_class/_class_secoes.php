<?php
class secoes {
	var $tabela = "sections";

	var $abbrev;
	var $nome;
	var $id;
	/* Duplicar seção */

	function duplicar_section($jid1, $jid2, $del) {

		if ($del == 1) {
			$sql = "delete from " . $this -> tabela . "  
				where journal_id = $jid2 			
			";
			$rlt = db_query($sql);

		}
		$sql = "select * from " . $this -> tabela . "  
				where journal_id = $jid1 			
			";
		$rlt = db_query($sql);
		while ($line = db_read($rlt)) {
			$title = $line['title'];
			$abbrev = $line['abbrev'];
			$seq = $line['seq'];
			$identify_type = $line['identify_type'];
			$seq_area = $line['seq_area'];
			$section_area = $line['section_area'];
			$hide_title = $line['hide_title'];
			$sql = "
					insert into " . $this -> tabela . " (
						journal_id, title, abbrev, 
						seq, editor_restricted, meta_indexed,
						abstracts_disabled, identify_type, hide_title,
						policy, seq_area, section_area	
					) values (
						$jid2, '$title','$abbrev',
						'$seq',0,1,
						0,'$identify_type','$hide_title',
						'0','$seq_area','$section_area'
					)";
			$xrlt = db_query($sql);
		}
	}

	function copia_sessao_anterior($secao, $jid) {
		$sql = "select * from " . $this -> tabela . "  
				where (title like '" . $secao . "%' or abbrev = '" . $secao . "' or identify_type = '" . $secao . "')			
			";
		$rlt = db_query($sql);
		if ($line = db_read($rlt)) {
			$title = $line['title'];
			$abbrev = $line['abbrev'];
			$seq = $line['seq'];
			$identify_type = $line['identify_type'];
			$seq_area = $line['seq_area'];
			$section_area = $line['section_area'];
			$hide_title = $line['hide_title'];
			$sql = "
					insert into " . $this -> tabela . " (
						journal_id, title, abbrev, 
						seq, editor_restricted, meta_indexed,
						abstracts_disabled, identify_type, hide_title,
						policy, seq_area, section_area	
					) values (
						$jid, '$title','$abbrev',
						'$seq',0,1,
						0,'$identify_type','$hide_title',
						'0','$seq_area','$section_area'
					)";
			$rlt = db_query($sql);
		}
	}

	function busca_secao($secao, $jid) {
		if (strlen($secao) == 0) {
			return ('');
		}
		$sql = "select * from " . $this -> tabela . " 
						where (title like '" . $secao . "%' or abbrev = '" . $secao . "' or identify_type = '" . $secao . "')
						and journal_id = $jid;
						";
		$rlt = db_query($sql);

		if ($line = db_read($rlt)) {
			$this -> abbrev = trim($line['abbrev']);
			$this -> nome = trim($line['title']);
			$this -> id = trim($line['section_id']);
			return ($line['section_id']);
			exit ;
		} else {
			$this -> copia_sessao_anterior($secao, $jid);
			echo '<HR>Erro de seção - ' . $secao . '<HR>';
			exit ;
			return ('');
		}
	}

	function ordenar_sessoes($jid) {
		$sql = "select * from " . $this -> tabela . " 
				where journal_id = " . round('0' . $jid) . "
				order by section_area, identify_type
			";
		$rlt = db_query($sql);
		$seq = 10;
		while ($line = db_read($rlt)) {
			$id = $line['section_id'];
			$sql = "update " . $this -> tabela . " set seq = $seq where section_id = $id";
			//echo '<BR>'.$sql;
			$rrlt = db_query($sql);
			$seq = $seq + 2;
		}
	}

	function row() {
		global $cdf, $cdm, $masc;
		$cdf = array('section_id', 'title', 'abbrev', 'identify_type', 'seq', 'section_area');
		$cdm = array('Código', 'descricao', 'Abreviado', 'Ref', 'Seq.', 'Área');
		$masc = array('', '', '', '', '', '', '', '', '', '', '');
		return (1);

	}

	function cp() {
		global $jid;

		$jid = round($jid);
		$cp = array();
		array_push($cp, array('$H8', 'section_id', 'id_ed', False, True, ''));
		array_push($cp, array('$Q title:journal_id:select * from journals where journal_id = ' . $jid, 'journal_id', 'Publicação', True, True, ''));
		array_push($cp, array('$S120', 'title', 'Titulo da seção', True, True, ''));
		array_push($cp, array('$S20', 'abbrev', 'Abreviatura', False, True, ''));
		array_push($cp, array('$[I-199]', 'seq', 'Ordem para mostrar', False, True, ''));
		array_push($cp, array('$O 0:NÃO&1:SIM', 'editor_restricted', 'Nome Abreviado', False, True, ''));
		array_push($cp, array('$O 1:SIM&0:NÂO', 'meta_indexed', 'Indexado', False, True, ''));
		array_push($cp, array('$O 1:NÃO&0:SIM', 'hide_title', 'Habilitado para submissão', False, True, ''));
		array_push($cp, array('$O 1:SIM&0:NÂO', 'abstracts_disabled', 'Resumo', False, True, ''));
		array_push($cp, array('$T60:5', 'policy', 'Politica', False, True, ''));
		array_push($cp, array('$S60', 'identify_type', 'Identificação', False, True, ''));
		array_push($cp, array('$S5', 'section_area', 'Area', False, True, ''));
		return ($cp);
	}

	function import_from_other_journal($id) {
		global $jid;

		$sql = "select count(*) as total from " . $this -> tabela . " where journal_id = " . $jid;
		$rlt = db_query($sql);
		$line = db_read($rlt);
		$total = round($line['total']);

		if ($total == 0) {
			$sql = "select * from " . $this -> tabela . " where journal_id = " . $id;
			$rlt = db_query($sql);

			$sqli = '';
			while ($line = db_read($rlt)) {
				$sqli .= "insert into " . $this -> tabela . " 
							(
							journal_id, title,
							abbrev, seq, editor_restricted, 
							meta_indexed, abstracts_disabled, identify_type,
							hide_title, policy, seq_area, 
							section_area
							) values (
							$jid, '" . $line['title'] . "',
							'" . $line['abbrev'] . "','" . $line['seq'] . "','" . $line['editor_restricted'] . "',
							'" . $line['meta_indexed'] . "','" . $line['abstracts_disabled'] . "','" . $line['identify_type'] . "',
							'" . $line['hide_title'] . "','" . $line['policy'] . "','" . $line['seq_area'] . "',
							'" . $line['section_area'] . "'
							); " . chr(13);
			}
			$rlt = db_query($sqli);
		} else {
			echo 'Dados já importados';
		}
	}

}
?>