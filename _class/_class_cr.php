<?php
class cr
	{
		var $tabela = "centro_resultado";
		var $recupera_ordenador_necessidade_funcao;
		var $recupera_ordenador_gasto_funcao;
		
		function sql()
			{
				$sql = "insert into centro_resultado (cr_ncr, cr_descricao, cr_ordenador_necessidade, cr_ordenador_gasto )
						values ('101122','Convênio Educação','70004750','88888951')
				";
				$rlt = db_query($sql);				
			}
		
		function row()
			{
				global $cdf,$cdm,$masc;
				$cdf = array('id_cr','cr_ncr','cr_descricao','cr_ordenador_necessidade','cr_ordenador_gasto');
				$cdm = array('cod',msg('CR'),msg('DESCRICAO'),'Ordenador Necessidade','Ordenador Gasto');
				$masc = array('','','','','','','');
				return(1);								
			}
	
		function cp()
			{
				$cp = array();
				array_push($cp,array('$H8','id_cr','',False,True));
				array_push($cp,array('$S8','cr_ncr','Número do CR',True,True));
				array_push($cp,array('$S30','cr_descricao','Nome do CR',True,True));
				
				array_push($cp,array('$Q pp_nome:pp_cracha:select * from pibic_professor where pp_ativo = 1 order by pp_nome','cr_ordenador_necessidade','Ordenador da necessidade',True,True));
				array_push($cp,array('$Q pp_nome:pp_cracha:select * from pibic_professor where pp_ativo = 1 order by pp_nome','cr_ordenador_gasto','Ordenador do CR',True,True));
				//array_push($cp,array('$S8','cr_ordenador_gasto','',True,True));
				return($cp);		
			}
		function recupera_ordenador_necessidade($cr)
			{
				$sql = "select * from ".$this->tabela."
						inner join pibic_professor on cr_ordenador_necessidade = pp_cracha 
						where cr_ncr = '".$cr."' ";
				$rlt = db_query($sql);
				$line = db_read($rlt);
				$nome = trim($line['pp_nome']).' ('.trim($line['pp_cracha']).')';
				$this->recupera_ordenador_necessidade_funcao = trim($line['pp_funcao']);
				return($nome);
			}
		function recupera_ordenador_gasto($cr)
			{
				$sql = "select * from ".$this->tabela."
						inner join pibic_professor on cr_ordenador_gasto = pp_cracha 
						where cr_ncr = '".$cr."' ";
				$rlt = db_query($sql);
				$line = db_read($rlt);
				$nome = trim($line['pp_nome']).' ('.trim($line['pp_cracha']).')';
				$this->recupera_ordenador_gasto_funcao = trim($line['pp_funcao']);
				return($nome);
			}
		function structure()
			{
				$sql = "create table centro_resultado
					(
					id_cr serial not null,
					cr_ncr char(6),
					cr_descricao char(100),
					cr_ordenador_necessidade char(8),
					cr_ordenador_gasto char(8)
					)
				";
				//$rlt = db_query($sql);		
			}
		function updatex()
			{
				global $base;
				return('');
				$c = 'ec';
				$dx2 = 'id_'.$c;
				$dx1 = $c.'_codigo';
				$dx3 = 7;
				$sql = "update ".$this->tabela." set ".$dx1." = lpad(".$dx2.",".$dx3.",0) where ".$dx1." = '' ";
				if ($base="pgsql")
					{ $sql = "update ".$this->tabela." set ".$dx1."=trim(to_char(".$dx2.",'".strzero(0,$dx3)."')) where (length(trim(".$dx1.")) < ".$dx3.") or (".$dx1." isnull);";}
				
				$rlt = db_query($sql);	
			return(1); 
			}
			
	}
