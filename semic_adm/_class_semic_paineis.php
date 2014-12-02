<?php
class semic_paineis
	{
		var $tabela = "semic_paineis";
		
	function exportar_paineis_localizacao()
		{
			$sql = "select * from ".$this->tabela." 
					where spl_data > ".date("Y")."0100 and spl_data < ".date("Y")."1299
					order by spl_data, spl_painel, spl_trabalho
					";
			$rlt = db_query($sql);
			$sx = '<?php'.chr(13).chr(10);
			
					
			while ($line = db_read($rlt))
				{				
					$trab = trim(UpperCase($line['spl_trabalho']));
					$painel = trim(uppercase($line['spl_painel']));
					$data = ($line['spl_data']);
					$ddi = 0;
					if ($data == 20131022) { $ddi=1; }
					if ($data == 20131023) { $ddi=2; }
					if ($data == 20131024) { $ddi=3; }
					 
					$sx .= 'if ($tb==\''.$trab.'\') { $p=\''.$painel.'\'; $layout='.$ddi.'; $d= \''.stodbr($data).'\'; }; '.chr(13).chr(10);
				}
			$sx .= '?>';
			$flt = fopen("../semic/painel_busca.php",'w');
			fwrite($flt,$sx);
			fclose($flt);
			echo 'FIM';
		}
		
	function etiquetas($data=0,$painel='')
		{
			$sql = "select * from ".$this->tabela." 
					left join articles on spl_trabalho = article_ref and journal_id = 67 and article_publicado = 'S'
					where spl_data = ".round($data)."
					order by spl_data, spl_painel, spl_trabalho
			";
			$rlt = db_query($sql);
			$xpan = 'x';
			while ($line = db_read($rlt))
				{
					$painel = trim($line['spl_painel']);
					if ($painel != $xpan)
						{
							$sx .= $painel.'<BR>';
							$sx .= '==PAINEL==<BR>';
							$xpan = $painel;
						}
					$sx .= $line['spl_trabalho'];
					$sx .= '<BR>';
					$nome = $line['article_autores'];
					if (strpos($nome,';') > 0)
						{
							$nome = substr($nome,0,strpos($nome,';'));
						} 
					$sx .= $nome;
					$sx .= '<BR>';
				}
			return($sx);
		}
	function inport_paineis($txt,$data)
		{
			//$this->structure();
			$ln = splitx(chr(10),$txt);
			for ($r=0;$r < count($ln);$r++)
				{
					echo '<HR>';
					print_r($ln[$r]);
					$this->inport_paineis_dia($ln[$r],$data);
				}
		}	
	function lista_paineis()
		{
			//$this->structure();			
			$sql = "select * from semic_blocos 
						left join ".$this->tabela." on blk_codigo = spl_block
						where blk_titulo like 'P%'
						order by blk_data, blk_hora, spl_painel
			";
			$rlt = db_query($sql);			
			$sx .= '<h1>Paineis</h1>';
			$sx .= '<table class="tabela00" width="100%">';
			$xpan = 'x';
			while ($line = db_read($rlt))
				{
					$pan = $line['blk_codigo'];
					if ($pan != $xpan)
						{
							$link = '<A HREF="semic_paineis_inserir.php?dd1='.$line['blk_codigo'].'">';
							$sx .= '<TR><TD colspan=4><h4>'.$link.$line['blk_titulo'].' '.stodbr($line['blk_data']).' '.$line['blk_hora'].'</A></h4>';
							
						}
					print_r($line);
				}
			$sx .= '</table>';
			return($sx);
		}
	function inport_paineis_dia($tt,$data)
		{
			$la = splitx(';',$tt);
			if (substr($la[0],0,1)=='P')
				{
					$painel = trim($la[0]);
					for ($r=1;$r < count($la);$r++)
						{
							$trabalho = trim($la[$r]);
							if (strlen($trabalho) > 0)
								{
									$this->save_panel($painel, $trabalho, $data);
								}
						}					
				}
		}
	function save_panel($painel,$trabalho,$data)
		{
			$ano = substr($data,0,4);
			$sql = "select * from ".$this->tabela." 
					where spl_trabalho = '$trabalho'
					and spl_ano = '$ano' ";
			$rlt = db_query($sql);
			if (!($line = db_read($rlt)))
			{
				$sql = "insert into ".$this->tabela." 
					(
					spl_trabalho, spl_painel, spl_data,
					spl_ano, spl_ativo
					) values (
					'$trabalho','$painel','$data',
					'$ano',1
					);
				";
				$rlt = db_query($sql);
			} else {
				$sql = "update ".$this->tabela." set
						spl_data = $data,
						spl_ano = '$ano',
						spl_painel = '$painel'
						where id_spl = ".$line['id_spl'];
				$rlt = db_query($sql);
						echo '<BR>'.$sql;
			}
			return(1);
		}
	function incluir_painel($pn,$tr)
		{
			$sql = "select * from ".$this->tabela." where 
					spl_trabalho = '".$tr."'			
			";
			$rlt = db_query($sql);
			if ($line = db_read($rlt))
				{
					echo 'Trabalho j� est� incluido';
					return('');
				} else {
					$ano = date("Y");
					$sql = "insert into ".$this->tabela." 
							(spl_trabalho, spl_painel,
							spl_ano, spl_ativo)
							value
							('$tr','$pn',
							'$ano',1) ";
					echo $sql;
				}
		}
	function structure()
		{
			$sql = "drop table ".$this->tabela;
			$rlt = db_query($sql);
			
			$sql = "
			create table ".$this->tabela."
				(
					id_spl serial not null,
					spl_trabalho char(15),
					spl_painel char(5),
					spl_data integer,
					spl_block char(5),
					spl_hora char(5),
					spl_ano char(4),
					spl_ativo integer
				)
			";
			$rlt = db_query($sql);
		}
	}
?>
