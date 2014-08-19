<?php
class call_of_paper
	{
		var $journal;
		var $tabela = 'pb_calls';
		function list_open()
			{
				global $LANG;
				$sx = '<h2>'.msg('call_of_papers').'</h2>';
				$sql = 'select * from '.$this->tabela." 
						where pbc_deadline >= ".date("Ymd")." and
						pbc_idioma = '$LANG'
						";
				$sx .= '<HR>'.$sql.'<HR>';
				$rlt = db_query($sql);
				while ($line = db_read($rlt))
				{
					$sx .= '<h3>';
					$sx .= msg('dossie').': ';
					$sx .= $line['pbc_title'];
					$sx .= '</h3>';
					
					$sx .= '<table class="lt1">';
					
					$sx .= '<TR valign="top"><TD>'.msg('editors');
					$sx .= '<TD>'.$line['pbc_editors'];
					
					$sx .= '<TR valign="top"><TD>'.msg('submission');
					$sx .= '<TD>'.$line['pbc_start'];
				
					$sx .= ' ';
					$sx .= $line['pbc_deadline'];
					
					$sx .= '<TR valign="top"><TD>'.msg('editors');
					$sx .= '<TD>'.$line['pbc_editors'];
					
					$sx .= '</table>';
					$sx .= '<BR>';
					
				}
				return($sx);
			}	

		function row()
			{
				global $cdf,$cdm,$masc;
				
				$cdf = array('id_pbc','pbc_title','pbc_deadline','pbc_idioma');
				$cdm = array('cod',msg('title'),msg('deadline'),msg('idioma'));
				$masc = array('','','D','','','','','');
				return(1);				
			}
			
		function cp()
			{
				//$sql = "ALTER TABLE pb_calls ADD COLUMN pbc_journal_id char(7)";
				//$rlt = db_query($sql);
				$cp = array();
				array_push($cp,array('$H8','id_pbc','',False,True));
				array_push($cp,array('$S7','pbc_journal_id',msg('journal'),False,True));
				array_push($cp,array('$S200','pbc_title',msg('title'),False,True));
				array_push($cp,array('$T60:5','pbc_description',msg('description'),False,True));
				array_push($cp,array('$D8','pbc_start',msg('start'),False,True));
				array_push($cp,array('$D8','pbc_deadline',msg('deadline'),False,True));
				array_push($cp,array('$D8','pbc_extended',msg('extended'),False,True));
				array_push($cp,array('$S20','pbc_prevision',msg('posted_forecast'),False,True));
				array_push($cp,array('$T60:5','pbc_editors',msg('editors'),False,True));
				array_push($cp,array('$S100','pbc_link',msg('link'),False,True));
				array_push($cp,array('$O pt_BR:Portugues&en_US:English','pbc_idioma',msg('idioma'),False,True));
				return($cp);
			}
		function structure()
			{
				$sql = "CREATE TABLE pb_calls
					(
					id_pbc serial NOT NULL,
					pbc_title char(200),
					pbc_description text,
					pbc_start int,
					pbc_deadline int,
					extended int,
					pbc_prevision char(20),
					pbc_editors text,
					pbc_link char(100),
					pbc_idioma char(5),
					pbc_journal int				
					)
				";
				$rlt = db_query($sql);
			}
	}
?>
