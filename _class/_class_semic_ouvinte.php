<?php
class ouvinte
	{
	var $tabela = 'semic_ouvinte_cadastro';
	function row()
		{
			global $tabela,$http_edit,$http_edit_para,$cdf,$cdm,$masc,$offset,$order;
		
			$cdf = array('id_sc','sc_nome','sc_cpf','sc_instituicao');
			$cdm = array('ID','Nome','CPF','Instituicao');
			$masc = array('','','','','','','','','');
			return(True);
		}	
		
	function cp()
		{
			$cp = array();
			array_push($cp,array('$H8','id_sc','',False,True));
			array_push($cp,array('$S80','sc_nome','',True,True));
			array_push($cp,array('$S12','sc_cpf','',False,True));
			array_push($cp,array('$S20','sc_instituicao','',False,True));
			return($cp);
		}
	}
?>
