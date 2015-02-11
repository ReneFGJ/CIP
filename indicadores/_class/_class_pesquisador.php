<?php
class pesquisador {
	var $tabela = 'pesquisador';
	function structure() {
		$sql = "
			CREATE TABLE pesquisador
				(
					id_pe serial not null,
					pe_nome char(100),
					pe_nome_ASC char(100),
					pe_nome_lattes char(100),
					pe_codigo char(8),
					pe_cpf char(15),
					pe_cracha char(8),
					pe_use char(8),
					pe_ativo int8,
					pe_instituicao char(7)
				);";
	}

	function pesquisador($nome = '',$cod_in='') {
		if (strlen($nome)==0) { return(''); }
		$id_asc = UpperCaseSql($nome);
		$sql = "select * from " . $this -> tabela . " where 
					pe_nome_ASC = '$id_asc'
			";
		$rlt = db_query($sql);
		if ($line = db_read($rlt)) {
			return ($line['pe_codigo']);
		} else {
			$xsql = "insert into " . $this -> tabela . "
						(pe_nome, pe_nome_ASC, pe_nome_lattes,
						pe_codigo, pe_cpf, pe_cracha,
						pe_use, pe_ativo, pe_instituicao )
						values
						('$nome','$id_asc','$nome',
						'','','',
						'',1,'$cod_in')
					";
			$rlt = db_query($xsql);
			$this -> updatex();
			$rlt = db_query($sql);
			$line = db_read($rlt);
			return ($line['pe_codigo']);
		}
	}

	function updatex() {
		$c = 'pe';
		$c1 = 'id_' . $c;
		$c2 = $c . '_codigo';
		$c3 = 7;
		$sql = "update " . $this -> tabela . " set $c2 = lpad($c1,$c3,0) where $c2='' ";
		$rlt = db_query($sql);
	}

}
?>
