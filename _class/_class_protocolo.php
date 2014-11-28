<?php

class protocolo
	{
		var $tabela = 'protocolo_servicos';
		var $tabela_protocolo = 'protocolo';
		function editar_protocolo($proto,$tipo)
			{
				global $dd,$acao;
				$form = new form;
				$cp = $this->cp_editar();
				if ($dd[1]=='GPCOM') { $cp = $this->cp_gpcom(); }
				$tela = $form->editar($cp,$tabela_protocolo);
				echo $tela;
			}
			
/*
 * 					id_pr serial NOT NULL,
  					pr_protocolo char(7) ,
  					pr_ano char(4) ,
  					pr_tipo char(3) ,
  					pr_solicitante char(8) ,
  					pr_beneficiador char(8) ,
  					pr_descricao text ,
  					pr_status char(1) ,
  					pr_data int(11) ,
  					pr_hora char(5) ,
  					pr_solucao_data int(11) ,
  					pr_solucao_hora int(11) ,
  					pr_atual char(8) 
 */			
			
		function cp_editar()
			{
				global $dd,$acao;
				$cp = array();
				array_push($cp,array('$H8','id_pr','',False,False));
				array_push($cp,array('$H8','pr_protocolo','',False,False));
				array_push($cp,array('$H8','pr_ano','',False,False));
				array_push($cp,array('$H8','pr_tipo','',False,False));
				array_push($cp,array('$H8','pr_solicitante','',False,False));
				array_push($cp,array('$H8','pr_beneficiador','',False,False));
				array_push($cp,array('$T80:6','pr_descricao','Descrição das alterações',True,True));
				array_push($cp,array('$H8','pr_status','',False,False));
				array_push($cp,array('$H8','pr_data','',False,False));
				array_push($cp,array('$H8','pr_hora','',False,False));
				array_push($cp,array('$H8','pr_solucao_data','',False,False));
				array_push($cp,array('$H8','pr_solucao_hora','',False,False));
				array_push($cp,array('$H8','pr_atual','',False,False));
				return($cp);
			}
		function cp_gpcom()
			{
				global $dd,$acao;
				$cp = array();
				array_push($cp,array('$H8','id_pr','',False,False));
				array_push($cp,array('$H8','pr_protocolo','',False,False));
				array_push($cp,array('$H8','pr_ano','',False,False));
				array_push($cp,array('$H8','pr_tipo','',False,False));
				array_push($cp,array('$H8','pr_solicitante','',False,False));
				array_push($cp,array('$H8','pr_beneficiador','',False,False));
				array_push($cp,array('$T80:6','pr_descricao','Descrição das alterações',True,True));
				array_push($cp,array('$H8','pr_status','',False,False));
				array_push($cp,array('$H8','pr_data','',False,False));
				array_push($cp,array('$H8','pr_hora','',False,False));
				array_push($cp,array('$H8','pr_solucao_data','',False,False));
				array_push($cp,array('$H8','pr_solucao_hora','',False,False));
				array_push($cp,array('$H8','pr_atual','',False,False));
				return($cp);
			}
									
		function mostra_tipo_pai($id)
			{
				$sql = "select * from ".$this->tabela." where sv_codigo = '$id' ";
				$rlt = db_query($sql);
				$line = db_read($rlt);
				$pai = $line['sv_pai'];
				
				$sql = "select * from ".$this->tabela." where sv_codigo = '$pai' ";
				$rlt = db_query($sql);
				if ($line = db_read($rlt))
					{
						return($line['sv_nome']);
					}
				return('não localizado');
			}			
		
		function mostra_tipo($id)
			{
				$sql = "select * from ".$this->tabela." where sv_codigo = '$id' ";
				$rlt = db_query($sql);
				
				if ($line = db_read($rlt))
					{
						return($line['sv_nome']);
					}
				return('não localizado');
			}
		function cp()
			{
				global $dd;		
//$sql = "delete from protocolo_servicos  ";
//$rlt = db_query($sql);

				$cp = array();
				array_push($cp,array('$H8','id_sv','',False,True));
				array_push($cp,array('$S100','sv_nome','Curso',True,True));
				array_push($cp,array('$S5','sv_codigo','Codigo',False,True));
				array_push($cp,array('$Q sv_nome:sv_codigo:select * from protocolo_servicos where sv_ativo = 1 ','sv_pai','Pai',False,True));
				array_push($cp,array('$O 1:Ativo&0:Inativo','sv_ativo','Ativo',False,True));
				array_push($cp,array('$T80:5','sv_descricao','Descricao',False,True));
				
				array_push($cp,array('$S8','sv_resp_1','Descricao',False,True));
				array_push($cp,array('$S8','sv_resp_2','Descricao',False,True));
				array_push($cp,array('$S8','sv_resp_3','Descricao',False,True));
				
				
//				array_push($cp,array('$Q curso_nome:curso_codigo:select * from curso where curso_ativo=1 order by curso_nome_asc','curso_codigo_use',msg('remissiva'),False,True));
				return($cp);
			}
		function row()
			{
				global $cdf,$cdm,$masc;
				$cdf = array('id_sv','sv_nome','sv_pai','sv_codigo');
				$cdm = array('cod',msg('nome'),msg('pai'),msg('codigo'));
				$masc = array('','','','','SN','','','');
				return(1);				
			}		
		function show_action($pai='')
			{
				$sx = '';
				$this->structure();
				if (strlen($pai) > 0)
				{
					$sql = "select * from protocolo_servicos where sv_codigo = '$pai' ";
					$rlt = db_query($sql);
					if ($line = db_read($rlt))
						{
							$sx .= '<h3>'.trim($line['sv_nome']).'</h3>';
						}
				}
				$sql = "select * from protocolo_servicos 
							where sv_pai = '$pai' 
							and sv_ativo=1 
							order by sv_codigo ";
				$rlt = db_query($sql);
				$sx .= '<UL>';
				while($line = db_read($rlt))
					{
						$sx .= $this->mostra_botao($line);
					}
				$sx .= '</UL>';
				return($sx);
			}
		function mostra_botao($line)
			{
				$sx = '';
				$link .= '<A HREF="'.page().'?dd1='.$line['sv_codigo'].'" border=0>';
				if (strlen(trim($line['sv_pai'])) > 0)
					{
						$link .= '<A HREF="index_solicitacao.php?dd1='.$line['sv_codigo'].'" border=0>';		
					}
				$sx .= $link;
				$sx .= '<LI class="botao_protocolo">';
				$sx .= trim($line['sv_nome']);
				$sx .= '</li></A>';
				return($sx);
			}
		function structure()
			{
				return("");
				$sql = "
					CREATE TABLE protocolo (
					id_pr serial NOT NULL,
  					pr_protocolo char(7) ,
  					pr_ano char(4) ,
  					pr_tipo char(3) ,
  					pr_solicitante char(8) ,
  					pr_beneficiador char(8) ,
  					pr_descricao text ,
  					pr_status char(1) ,
  					pr_data int(11) ,
  					pr_hora char(5) ,
  					pr_solucao_data int(11) ,
  					pr_solucao_hora int(11) ,
  					pr_atual char(8) 
					)				
				";
				$rlt = db_query($sql);
				

				$sql = "
				CREATE TABLE protocolo_servicos (
					id_sv serial NOT NULL,
  					sv_nome char(100) NOT NULL,
  					sv_descricao text NOT NULL,
  					sv_ativo int8 NOT NULL,
  					sv_pai char(5) NOT NULL,
  					sv_codigo char(5) NOT NULL,
  					sv_resp_1 char(8) NOT NULL,
  					sv_resp_2 char(8) NOT NULL,
  					sv_resp_3 char(8) NOT NULL
					)	
				";
				$rlt = db_query($sql);
				$sql = "INSERT INTO protocolo_servicos (id_sv, sv_nome, sv_descricao, sv_ativo, sv_pai, sv_codigo, sv_resp_1, sv_resp_2, sv_resp_3) 
						VALUES
							(1, 'Grupo de Pesquisa', 'Solicitação de Criação, Alteração, Atualização ou cancelamento de Grupos de Pesquisa', 1, '', 'GRUPO', '', '', '');";
				$rlt = db_query($sql);
							

				
			}
	}

?>