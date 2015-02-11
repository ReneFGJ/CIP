<?php
class cnpq_editais {
	var $tabela = 'icip_editais';
	var $tabela_autor = 'icip_editais_autores';

	/* Graficos */
	var $xAxis = '';
	/* Relatorios */
	function projetos_por_instituicao($inst = '',$tipo='1') {
		$sql = "select ied_ano, count(*) as total, 
						sum(ied_valor_concessao) as valor,
						ied_tipo
					from icip_editais_autores
						inner join icip_editais on ied_codigo = iea_edital
					where iea_instituicao = '$inst'
					group by ied_descricao, ied_ano
					order by ied_ano, ied_tipo desc
			";
			
		$rlt = db_query($sql);
		$aano = array();
		$aprh = array();
		$vprh = array();
		$xano = '';
		$pprh = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

		while ($line = db_read($rlt)) {
			$ano = trim($line['ied_ano']);
			if ($tipo == '2')
				{
					$valor = $line['valor'];
				} else {
					$valor = $line['total'];
				}

			if ($ano != $xano) {
				array_push($aano, $ano);
				$xano = $ano;
				$idx = count($aano) - 1;
			}
			$prh = trim($line['ied_tipo']);

			if (!(in_array($prh, $aprh))) {
				array_push($aprh, $prh);
				array_push($vprh, $pprh);
			}
			$id = array_search($prh, $aprh);

			$vprh[$id][$idx] = $vprh[$id][$idx] + $valor;
		}
		$xAxis = '';
		$xData = '';
		for ($y = 0; $y < count($vprh); $y++) {
			$dados = '';
			$vd = $vprh[$y];

			for ($r = 0; $r < count($aano); $r++) {
				if (strlen($dados) > 0) { $dados .= ', ';
				}
				$dados .= $vd[$r];
			}
			if (strlen($xData) > 0) { $xData .= ', '; }
			$xData .= '{
				name : \''.$aprh[$y].'\',
				data : [' . $dados . ']
			}'.chr(13).chr(10);
		}
		for ($r = 0; $r < count($aano); $r++) {
			if (strlen($xAxis) > 0) { $xAxis .= ', ';
			}
			$xAxis .= "'" . $aano[$r] . "'";
		}
		$this -> xAxis = $xAxis;
		$this -> xData = $xData;
	}

	function insere_autor_edital($autor = '', $edital = '', $comite = '', $inst = '') {
		$sql = "select * from " . $this -> tabela_autor . " 
					where iea_autor = '$autor'
						and iea_edital = '$edital'
						and iea_comite = '$comite'
						and iea_instituicao = '$inst'			
			";
		$rlt = db_query($sql);
		if ($line = db_read($rlt)) {
			/* Ja cadastrado */
		} else {
			$sql = "insert into " . $this -> tabela_autor . " 
							(iea_autor, iea_edital, iea_comite, iea_instituicao)
							values
							('$autor','$edital','$comite','$inst');
					";
			$rlt = db_query($sql);
		}
	}

	function edital($id) {
		$sql = "select * from " . $this -> tabela . " where 
					ied_descricao = '$id'
			";
		$rlt = db_query($sql);
		if ($line = db_read($rlt)) {
			return ($line['ied_codigo']);
		} else {
			$xsql = "insert into icip_editais 
						(ied_codigo, ied_descricao, ied_ativo,
						ied_ano)
						values
						('','$id',1,'')
					";
			$rlt = db_query($xsql);
			$this -> updatex();
			$rlt = db_query($sql);
			$line = db_read($rlt);
			return ($line['ied_codigo']);
		}
	}

	function updatex() {
		$c = 'ied';
		$c1 = 'id_' . $c;
		$c2 = $c . '_codigo';
		$c3 = 5;
		$sql = "update " . $this -> tabela . " set $c2 = lpad($c1,$c3,0) where $c2='' ";
		$rlt = db_query($sql);
	}

	function structure() {
		$sql = "
			CREATE TABLE icip_editais (
			id_ied serial NOT NULL,
  			ied_codigo char(5) NOT NULL,
  			ied_descricao char(200) NOT NULL,
  			ied_ativo int(11) NOT NULL,
  			ied_ano char(4) NOT NULL,
  			ied_valor_concessao float,
			) ";
		$rlt = db_query($sql);

	}

}
?>
