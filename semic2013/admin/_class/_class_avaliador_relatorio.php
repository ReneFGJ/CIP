<?php
class avaliador_relatorio
	{
		function lista_avaliadores($nome = '')
			{
				//$sql = "alter table pareceristas add column us_cnpq char(1)";
				//$rlt = db_query($sql);
				
				$sql = "select * from pareceristas 
						where us_journal_id = 20 and us_ativo <> 0
						and Upper(ASC7(us_nome)) like '%".UpperCaseSql($nome)."%'
						order by us_nome
						";
				$rlt = db_query($sql);
				
				$sx .= '<table width="100%" class="letra" border=0>';
				while ($line = db_read($rlt))
					{
						$cod = strzero($line['id_us'],7);
						$link = '<a href="avaliador.php?dd1='.$cod.'">';
						$sx .= '<TR>';

						$sx .= '<TD width="7%">';
						$sx .= strzero($line['id_us'],7);
						
						$sx .= '<TD>';
						$sx .= trim($line['us_cnpq']);					

						$sx .= '<TD>';
						$sx .= $link;
						$sx .= trim($line['us_nome']);
						$sx .= '</A>';
					}
				$sx .= '</table>';
				
				return($sx);
			}
	}
?>
