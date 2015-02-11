<?php
class painel
	{
		function mostra_resumo($id='')
			{
				return('ola');
				$sql = "select * from articles where article_ref = '".$id."' ";
				echo $sql;
				$rlt = db_query($sql);
				
				if ($line = db_read($rlt))
					{
						print_r($line);
					}
			}

		function mostra_painel($id='')
			{
				if (strlen($id) > 0)
				{
				$sql = "
						select * from (
						select trim(upper(asc7(spl_trabalho))) as trb, spl_painel, spl_trabalho from semic_paineis 
						) as tabela 
						left join semic_trabalhos on st_codigo = spl_trabalho
						left join semic_blocos on st_bloco = blk_codigo	";
						
//						where trb like '".UpperCaseSql($id)."' or trb like '".UpperCaseSql($id)."*' ";
				$rlt = db_query($sql);
				$idf = uppercasesql($id);
				$id = '';
				while ($line = db_read($rlt))
					{
						if (trim($line['trb']) == $idf)
							{
									echo '<h1>'.$line['spl_trabalho'].' - Painel :'.$line['spl_painel'];
									echo stodbr($line['blk_data']).' '.$line['blk_hora'];
									echo '<h1>';
									$id = ($line['spl_painel']);							 
							}
					}
				}
				if (strlen($id) == 0)
					{
						echo '<H1><font color="red">Código Inválido</font></h1>';
						exit;					
					}
				$sx = '<div id="painel">';
				if (strlen($id) > 0)
					{
						$sx .= $this->mostra_local_painel($id);
					}
				$sx .= '</div>';
				$sx .= '
				<style>
					#painel
						{
							border: 1px solid #000000;
							width: 800px;
							height: 540px;
							background-image: url("/reol/eventos/cicpg/img/paineis/bloco_azul_2013.png");
						}
					#painel_local
						{
							position: absolute;
							width: 35px;
							height: 30px;
							border: 1px solid #FF8080;
							background-color: #FF8800;
							Opacity: 0.5;
						}
				</style>
				';
				return($sx);
			}	
		function mostra_local_painel($p)
			{
				$p = round(sonumero($p));
				if ($p > 0)
				{
				$ps = $this->busca_xy($p);
				$sx = '<div id="painel_local" style="'.$ps.'">';
				$sx .= '</div>';
				}
				return($sx);
				
			}
		function busca_xy($id)
			{
				$x = 10; $y = 20;
				if ($id==1) { $x = 155; $y = 750; }
				if ($id==2) { $x = 95; $y =  750; }
				if ($id==3) { $x = 245; $y = 20; }
				if ($id > 3)
					{
						$x = 245;
						$idx = (int)(($id -3)/12);
						if ($idx == 0) { $x = 245; }
						if ($idx == 1) { $x = 155; }
						if ($idx == 2) { $x = 95; }
						if ($idx == 3) { $x = 30; }
						/* Y */
						$idy = $id - $idx * 12 - 3;
						if (($idx == 1) or ($idx == 3))
							{
								$y = 57 * (12-$idy) + 15;
							} else {
								$y = 57 * $idy + 67;
							}
						if ($id==50) { $x = 30; $y = 20; }
						if ($id==26) { $x = 155; $y = 20; }
						if ($id==3) { $x = 245; $y = 20; }
					}
				$sx = 'margin-top: '.$x.'px; margin-left: '.$y.'px;';
				return($sx);
			}
	}
?>
