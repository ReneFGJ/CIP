<?php
class submit_historico
	{
	var $tabela = "submit_historico";
	
	function insere_historico($protocolo,$tipo,$avaliador='',$user='')
		{
			$data = date("Ymd");
			$hora = date("H:i");
			$sql = "select * from ".$this->tabela." 
					where hs_protocolo = '$protocolo' 
						and hs_tipo = '$tipo'
						and hs_data = '$data'
						and hs_avaliador = '$avaliador'
			";
			$rlt = db_query($sql);
			if ($line = db_read($rlt))
				{
					echo '<BR>Já lancado';
					return('');
				} else {
					$sql = "insert into ".$this->tabela."
						(
						hs_protocolo, hs_descricao, hs_tipo,
						hs_data, hs_hora, hs_log, hs_avaliador
						) values (
						'$protocolo','action".$tipo."','$tipo',
						$data,'$hora','$user','$avaliador'
						)
					";
					$rlt = db_query($sql);				
				} 
		}
	
	function structure()
		{
			$sql = "
			CREATE TABLE ".$this->tabela."
				( 
				id_hs serial NOT NULL, 
				hs_protocolo char(7), 
				hs_descricao char(20), 
				hs_tipo char(3), 
				hs_avaliador char(8),
				hs_data int8, 
				hs_hora char(5), 
				hs_log char(7) 
				); 
			";
			$rlt = db_query($sql);
			return(1);
		}
	
	
	function msg_historico_mostra($txt)
		{
			$txt = trim($txt);
			switch($txt)
				{
					case 'actionAPR':
						$sx = 'Aprovado para publicação'; break;
					case 'actionAVA':
						$sx = 'Indicado para avaliação por parecerista'; break;
					default:
						$sx = 'Status: '.$txt;
				}
			return($sx);
		}
	function show_historico($protocolo='')
		{
			$sx = '<h2>Histórico da avaliação</h2>';
			$sx .= '<table width="100%" class="tabela00">';
			$sx .= '<TR>
				<Th colspan=1>Data</th>
				<Th colspan=1>Descrição</th>
				<Th colspan=1>Cod. Operação</th>
				</TR>';
						
			$sql = "select * from ".$this->tabela." ";
			$sql .= " where hs_protocolo = '".$protocolo."' ";
			$sql .= " order by hs_data desc, hs_hora desc ";
			
			$trlt = db_query($sql);
			$id = 0;
			while ($tline = db_read($trlt))
				{
				$id++;
				$sx .= '<TR bgcolor="#F8F8F8">';
				$sx .= '<TD>';
				$sx .= stodbr($tline['hs_data']).' '.$tline['hs_hora'].'';
				$sx .= '<TD>'.$this->msg_historico_mostra($tline['hs_descricao']);
				$sx .= '<TD>'.$tline['hs_log'];
				}
			if ($id == 0)
				{
					$sx .= '<TR><TD class="tabela01" colspan=5><I>Sem histórico</I>';
				}
			$sx .= '</table>';
			return($sx);
		}

	}
?>
