<?php
class pibic_bolsa_tipo
	{
		var $id_pbt; 
		var $pbt_codigo;
		var $pbt_descricao;
		var $pbt_img;
		var $pbt_edital; 	
		var $pbt_auxilio;
		var $pbt_ativo;
		var $pbt_ordem;
	
		var $tabela = 'pibic_bolsa_tipo';
		
		function cp()
			{
				$cp = array();
				array_push($cp,array('$H8','id_pbt','id',False,true));
				array_push($cp,array('$S1','pbt_codigo','codigo',False,true));
				array_push($cp,array('$S100','pbt_descricao','Nome',False,true));
				array_push($cp,array('$S40','pbt_img','Link da Imagem',False,true));
				array_push($cp,array('$Q pm_nome:pm_codigo:select * from pibic_modalidade where pm_ativo=1 order by id_pm','pbt_edital',msg('pbt_edital'),True,true));
				array_push($cp,array('$N8','pbt_auxilio',msg('pbt_auxilio'),False,true));
				array_push($cp,array('$[1-30]','pbt_ordem',msg('pbt_ordem'),False,true));
				array_push($cp,array('$O 1:SIM&0:N�O','pbt_ativo','id',False,true));
				return($cp);
			}
		function row()
			{
				global $cdf,$cdm,$masc;
				$cdf = array('id_pbt','pbt_edital','pbt_descricao','pbt_codigo','pbt_ativo');
				$cdm = array('cod',msg('modalidade'),msg('nome'),msg('codigo'),msg('ativo'));
				$masc = array('','','','SN','','','');
				return(1);				
			}
		function updatex()
			{
				return(1);
			}
	}
