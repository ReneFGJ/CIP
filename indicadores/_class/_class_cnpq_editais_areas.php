<?php
class cnpq_editais_areas {
	var $tabela = 'icip_editais_areas';
	function edital($id) {
		if (strlen(trim($id))==0) { return('00000'); }
		$sql = "select * from " . $this -> tabela . " where 
					ieda_descricao = '$id'
			";
		$rlt = db_query($sql);
		if ($line = db_read($rlt)) {
			return ($line['ieda_codigo']);
		} else {
			$xsql = "insert into ".$this->tabela."
						(ieda_codigo, ieda_descricao, ieda_ativo)
						values
						('','$id',1)
					";
			$rlt = db_query($xsql);
			$this -> updatex();
			$rlt = db_query($sql);
			$line = db_read($rlt);
			return ($line['ieda_codigo']);
		}
	}

	function updatex() {
		$c = 'ieda';
		$c1 = 'id_' . $c;
		$c2 = $c . '_codigo';
		$c3 = 5;
		$sql = "update " . $this -> tabela . " set $c2 = lpad($c1,$c3,0) where $c2='' ";
		$rlt = db_query($sql);
	}

	function structure() {
		$sql = "
			CREATE TABLE icip_editais_areas (
			id_ieda serial NOT NULL,
  			ieda_codigo char(5) NOT NULL,
  			ieda_descricao char(200) NOT NULL,
  			ieda_ativo int(11) NOT NULL
			) ";
		$rlt = db_query($sql);

	}

}
?>
