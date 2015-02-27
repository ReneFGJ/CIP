<?php
class blocos
	{
	var $tabela = "semic_blocos";
	var $tabela_local = "semic_local";
	
	function mostra_blocos($dia=0)
		{
			$sql = "select * from ".$this->tabela." 
					inner join ".$this->tabela_local." on blk_sala = sl_codigo
					order by blk_data, blk_hora 
					";
			$rlt = db_query($sql);
			while ($line = db_read($rlt))
			{
				$sx .= '<div class="semic_bloco">';
				$sx .= '<div class="semic_bloco_data">'.stodbr($line['blk_data']).'</div>';
				$sx .= '<div class="semic_bloco_hora">'.$line['blk_hora'].'</div>';
				$sx .= '<div class="semic_bloco_titulo">'.trim($line['blk_titulo']).'</div>';
				$sx .= '<div class="semic_bloco_local">'.trim($line['sl_nome']).'</div>';
				$sx .= '</div>';
			}
			return($sx);
					
		}
	
	function cp()
		{
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
			
			$cp = array();
			array_push($cp,array('$H8','id_blk','',False,True));
			array_push($cp,array('$H8','blk_codigo','',False,True));
			array_push($cp,array('$[2014-'.date("Y").']D','blk_ano','Ano',True,True));
			
			array_push($cp,array('$S100','blk_titulo','Nome do bloco',True,True));
			array_push($cp,array('$T80:3','blk_descricao','Descricao do bloco',False,True));
			array_push($cp,array('$Q sl_nome:sl_codigo:select * from semic_local where sl_ativa = 1 order by sl_nome','blk_sala','Sala',False,True));
			array_push($cp,array('$O '.$opa,'blk_tipo','Tipo',False,True));
			
			array_push($cp,array('$D8','blk_data','Data',True,True));
			array_push($cp,array('$S5','blk_hora','Hora',False,True));
			array_push($cp,array('$O '.$ops,'blk_status','Status',True,True));
			array_push($cp,array('$H8','blk_avaliador_1','',False,True));
			array_push($cp,array('$H8','blk_avaliador_2','',False,True));
			return($cp);
		}	
	}
?>
