<?php
class submissao
	{
		var $protocolo;
		var $titulo;
		var $auto_principal;
		var $status;
		
		var $tabela = "submit_documento";
		
		
		function set_protocolo($id)
			{
				$this->protocolo = $id;
				return(1);
			}
		function submissao_finalizar()
			{
				
			}
		function submissao_session_zerar()
			{
				$_SESSION['']='';
				$_SESSION['']='';
				$_SESSION['']='';
				return(1);
			}
		function submissao_session_set()
			{
				$_SESSION['']='';
				$_SESSION['']='';
				$_SESSION['']='';
				return(1);
			}
		function form_new_project($link)
			{
				$sx = '<form method="get" action="'.$link.'">
						<input type="hidden" name="pag" value="0">
						<input type="hidden" name="dd99" value="submit2">
						<input type="submit" value="'.msg('subm_new_project').'" style="width: 500px; height: 50px;">
						</form>';
				return($sx);
			}
			
/*
 * Relatórios
 */			
	function resumo()
		{
			global $http;
			$sql = "select count(*) as total, doc_status from ".$this->tabela."
					where doc_journal_id = '".round($this->journal)."'
					or doc_journal_id = '".strzero($this->journal,7)."'
					group by doc_status
					order by doc_status
					";
			$rlt = db_query($sql);
			$op = array(0,0,0,0,0,0,0,0,0,0);
			while ($line = db_read($rlt))
				{
					$sta = trim($line['doc_status']);
					$tot = $line['total'];
					switch ($sta)
						{
						case '@': $op[0] = $op[0] + $tot; break;
						case 'A': $op[1] = $op[1] + $tot; break;
						case 'B': $op[2] = $op[2] + $tot; break;
						case 'X': $op[3] = $op[3] + $tot; break;
						default: $op[4] = $op[4] + $tot; break;
						}
				}
			$wd = round(100/5);
			$sx = '<h1>'.msg('submissoes_resumo').'</h1>';
			$sx .= '<table width="100%" class="tabela00">';
			$sx .= '<TR align="center">';
			$sx .= '<TD>Em submissão';
			$sx .= '<TD>Em recebimento';
			$sx .= '<TD>Em análise';
			$sx .= '<TD>Cancelados';
			$sx .= '<TD>Outros';
			
			$link = array('','','','','');
			$link[0] = '<A HREF="'.$http.'editora/submit_works.php?dd1=@">';
			$link[1] = '<A HREF="'.$http.'editora/submit_works.php?dd1=A">';
			$link[2] = '<A HREF="'.$http.'editora/submit_works.php?dd1=B">';
			$link[3] = '<A HREF="'.$http.'editora/submit_works.php?dd1=C">';
			$link[4] = '<A HREF="'.$http.'editora/submit_works.php?dd1=D">';
			
			$sx .= '<TR align="center" class="lt4"> ';
			$sx .= '<TD width="'.$wd.'">'.$link[0].$op[0];
			$sx .= '<TD width="'.$wd.'">'.$link[1].$op[1];
			$sx .= '<TD width="'.$wd.'">'.$link[2].$op[2];
			$sx .= '<TD width="'.$wd.'">'.$link[3].$op[3];
			$sx .= '<TD width="'.$wd.'">'.$link[4].$op[4];
			$sx .= '</table>';
			return($sx);
		}		
	}
?>
