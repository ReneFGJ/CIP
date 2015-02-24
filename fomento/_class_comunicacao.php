<?php
class comunicacao
	{
	var $tabela='comunicacao';
	var $assunto = '';
	var $texto = '';
	var $destinatario = '';
	var $formato = '';
	
	function mostra()
		{
			$id = 'pdi';					
			
			$sx = '<fieldset>';
			$sx .= '<legend>Assunto</legend>';
			$sx .= '<h1>'.$this->assunto.'</h1>';
			$sx .= '</fieldset>';

			$sx .= '<fieldset>';
			$sx .= '<legend>Mensagem</legend>';
			$msg = ($this->texto);
			$msg = troca($msg,'<','AAAA');
			$msg = troca($msg,'>','BBBB');
			
			if ($this->formato=='HTML')
				{
					$msg = htmlspecialchars($msg);
				} else {
					$msg = htmlspecialchars(mst($msg));
				}
				
			$style = '<font style=font-family: Tahoma, Arial; font-size: 12px; line-height: 150%; >';
			$e4 = '<table width="100%" border=0 style="background-color: #4B0207;">';
			$e4 .= '<TR><TD align="center"><BR><BR>';		
			$e4 .= '<TABLE width=600 bgcolor="white" ><TR><TD><img src='.http.'img/email_'.$id.'_header.png >
					<TR><TD>
					<BR>'.$style.$msg.'</font><BR>
					<TR valign="top"><TD align="right"><BR><BR>
					55 (41) 3271.2128 - e-mail: <A href="mailto:pdi@pucpr.br">pdi@pucpr.br</A>
					<img src='.http.'img/email_'.$id.'_foot.png ></TABLE>';
			$e4 .= '<BR><BR>';
			$e4 .= '</table>';
			$sx .= $e4;
			$sx .= '</fieldset>';

			$sx = troca($sx,'AAAA','<');
			$sx = troca($sx,'BBBB','>');

			return($sx);
		}	
	
	function mostra_conteudo()
		{
			$id = 'pdi';					
			
			$msg = ($this->texto);
			$msg = troca($msg,'<','AAAA');
			$msg = troca($msg,'>','BBBB');

			if ($this->formato=='HTML')
				{
					$msg = htmlspecialchars($msg);
				} else {
					$msg = htmlspecialchars(mst($msg));
				}
				
			$style = '<font style=font-family: Tahoma, Arial; font-size: 12px; line-height: 150%; >';
			$e4 = '<div style="background-color: #4B0207;"><table width="100%" border=0 >';
			$e4 .= '<TR><TD align="center"><BR><BR>';		
			$e4 .= '<TABLE width=600 bgcolor="white" ><TR><TD><img src='.http.'img/email_'.$id.'_header.png >
					<TR><TD>
					<BR>'.$style.$msg.'</font><BR>
					<TR valign="top"><TD align="right"><BR><BR>
					55 (41) 3271.2128 - e-mail: <A href="mailto:pdi@pucpr.br">pdi@pucpr.br</A>
					<img src='.http.'img/email_'.$id.'_foot.png ></TABLE>';
			$e4 .= '<BR><BR>';
			$e4 .= '</table></div>';
			$sx .= $e4;			

			$sx = troca($sx,'AAAA','<');
			$sx = troca($sx,'BBBB','>');

			return($sx);
		}
	
	function last_id()
		{
			$sql = "select id_cm from ".$this->tabela." 
					order by id_cm desc
					limit 1
			";
			$rlt = db_query($sql);
			if ($line = db_read($rlt))
				{
					$id = $line['id_cm'];
				}
			return(round($id));
		}
		
	function le($id=0)
		{
			$sql = "select * from ".$this->tabela." 
					where id_cm = ".$id;
			$rlt = db_query($sql);
			if ($line = db_read($rlt))
				{
					$this->assunto = trim($line['cm_assunto']);
					$this->texto = trim($line['cm_texto']);
					$this->destinatario = trim($line['cm_destinatario']);
					$this->formato = trim($line['cm_formato']);
				}
			return(1);
			
		}

	function row() {
		global $cdf, $cdm, $masc;
		$sql = "alter table " . $this -> tabela . " add column ed_login char(15) ";
		//$rlt = db_query($sql);

		$cdf = array('id_cm', 'cm_assunto', 'cm_data');
		$cdm = array('cod', 'Assunto', 'Data');
		$masc = array('', '', '', 'D', '', '', 'D', '');
		return (1);
	}
	
	function structure()
		{
			$sql = "drop table ".$this->tabela;
			$rlt = db_query($sql);
			
			$sql = "create table ".$this->tabela."
				(
				id_cm serial not null,
				cm_assunto char(100),
				cm_texto text,
				cm_destinatario text,
				cm_data integer,
				cm_hora char(5),
				cm_status char(1),
				cm_formato char(4),
				cm_log char(20)
				)
			";
			$rlt = db_query($sql);
		}
		
	function enviar_email($email,$assunto,$texto,$tipo)
		{
			
		}
	
	function cp()
		{
			$cp = array();
			array_push($cp,array('$H8','id_cm','',False,True));
			
			array_push($cp,array('${','','Lista de e-mail de destino',False,True));
			array_push($cp,array('$T86:6','cm_destinatario','Lista de e-mails',True,True));
			array_push($cp,array('$M','','Os e-mail deve estar separados por ponto e virgula (;)',False,True));
			array_push($cp,array('$}','','',False,True));
			
			array_push($cp,array('$M','','<BR>',False,True));
			
			array_push($cp,array('${','','Mensagem',False,True));
			array_push($cp,array('$S100','cm_assunto','Assunto da mensagem',True,True));
			
			array_push($cp,array('$T86:6','cm_texto','Texto	',True,True));
			array_push($cp,array('$O : &HTML:HTML&TEXT:Texto','cm_formato','Formatos',True,True));
			array_push($cp,array('$}','','',False,True));
			
			array_push($cp,array('$HV','cm_data',date("Ymd"),False,True));
			array_push($cp,array('$HV','cm_hora',date("H:i"),False,True));
			array_push($cp,array('$HV','cm_log',$nw->user_log,False,True));
			
			array_push($cp,array('$B8','','Preparar envio >>>',False,True));
			
			return($cp);			
		}	
	}
?>
