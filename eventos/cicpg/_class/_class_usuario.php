<?php
/*
 * 				$sql = "insert into apoio_titulacao 
						(ap_tit_codigo, ap_tit_titulo, ap_tit_idioma, at_tit_ativo, ap_ordem)
						values
						('009','Graduando','pt_BR',1,1)
				";
				$rlt = db_query($sql);
 */
class user
	{
		var $tabela = "evento_usuario";
		
		var $nome;
		var $cpf;
		var $titulacao;
		var $instituicao;
		var $email;
		var $line;
		
		function mostra($editar=0)
			{
				$abrev = trim($this->instituicao_sigla);
				if (strlen($abrev) > 0)
					{ $abrev .= ' ('.$abrev.')'; }
				if ($editar == 1)
					{
						$ed = '<A HREF="page_user_cadastro.php" class="link_bt">editar dados</A>';
					}
				$sx .= '
				<table width="98%" cellspacing="0" cellpadding="0" align="center">
				<TR><TD colspan=2 style="padding: 10px; border-bottom: 1px solid #000000;" class="lt4">
				'.$this->nome.'
				<BR>
				<TR valign="top"><TD class="lt0" width="33%">CPF
					<TD class="lt0" width="66%">Instituição
				<TR valign="top"><TD class="lt2" width="33%">'.$this->cpf.'
					<TD class="lt2" width="66%">'.$this->instituicao.$abrev.'	
					
				<TR valign="top"><TD class="lt0" width="33%">Títulação
					<TD class="lt0" width="66%">e-mail
				<TR valign="top"><TD class="lt2" width="33%">'.$this->titulacao.'
					<TD class="lt2" width="66%">'.
							$this->line['us_email'].'<BR>'.
							$this->line['us_email_alt'].'
				<TR><TD colspan=2 style="padding: 10px; border-top: 1px solid #000000;">'.$ed.'							
				</table>				
				';
				return($sx);
				
			}
		
		function cp()
			{
				global $dd;

				$dd[1] = UpperCase($dd[1]);
				$cp = array();
				$sqla = "select * from apoio_titulacao where at_tit_ativo = 1 order by ap_ordem";
				$sqli = "select * from instituicao order by inst_ordem, inst_nome";
				array_push($cp,array('$H8','id_us','',False,True));
				array_push($cp,array('$S15','us_cpf','CPF',False,False));
				array_push($cp,array('$S80','us_nome','Nome',True,True));
				array_push($cp,array('$Q ap_tit_titulo:ap_tit_codigo:'.$sqla,'us_titulacao','Máxima titulação',False,True));
				array_push($cp,array('$Q inst_nome:inst_codigo:'.$sqli,'us_uniservidade','Vinculo Institucional',False,True));
				array_push($cp,array('$S80','us_email','e-mail',True,True));
				array_push($cp,array('$S80','us_email_alt','e-mail alternativo',False,True));
				array_push($cp,array('$P20','us_senha','Senha',True,True));
				return($cp);
				
			}
		
		function valida_cadastro()
			{
				if (strlen($this->nome) == 0)
					{
						return(0);
					} else {
						return(1);
					}
			}
		
		function le($id)
			{
				$sql = "select * from ".$this->tabela." 
						left join apoio_titulacao on ap_tit_codigo = us_titulacao
						left join instituicao on us_uniservidade = inst_codigo
						where id_us = '".$id."' ";
				$rlt = db_query($sql);
				
				if ($line = db_read($rlt))
					{
						$this->id = trim($line['id_us']);
						$this->cpf = trim($line['us_cpf']);
						$this->nome = trim($line['us_nome']);
						$this->univ = trim($line['us_uniservidade']);
						$this->titulacao = trim($line['ap_tit_titulo']);
						$this->instituicao = trim($line['inst_nome']);
						$this->instituicao_sigla = trim($line['inst_abreviatura']);
						
						$this->line = $line;						
					}

			}
		
		function cadastra_usuario($cpf='')
			{
				$cpf = sonumero($cpf);
				$sql = "select * from ".$this->tabela." where us_cpf = '".$cpf."' ";
				$rlt = db_query($sql);
				if (!($line = db_read($rlt)))
					{
					$sql = "insert into ".$this->tabela." 
							(
							us_cpf, us_nome, us_titulacao,
							us_email, us_email_alt,
							us_uniservidade, us_senha
							) values (
							'$cpf','','',
							'','',
							'',''
							)
						";
					$rlt = db_query($sql);
					}
				return(1);
			}
		
		function existe_cpf($cpf='')
			{
				$cpf = sonumero($cpf);
				$sql = "select * from ".$this->tabela." where us_cpf = '".$cpf."' ";
				$rlt = db_query($sql);
				if ($line = db_read($rlt))
					{
						$this->line = $line;
						return(1);
					} else {
						return(0);
					}
			}
		
		function strucuture()
			{
				$sql = "create table ".$this->tabela." 
						(
						id_us serial not null,
						us_cpf char(14),
						us_nome char(80),
						us_titulacao char(3),
						us_update integer,
						us_email char(80),
						us_email_alt char(80),
						us_uniservidade char(7),
						us_senha char(20)
						)				
				";
				$rlt = db_query($sql);
				echo 'ok';
			}
	}
	
function validaCPF($cpf = null) {

	// Verifica se um número foi informado
	if(empty($cpf)) {
		return false;
	}

	// Elimina possivel mascara
	$cpf = ereg_replace('[^0-9]', '', $cpf);
	$cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);
	
	// Verifica se o numero de digitos informados é igual a 11 
	if (strlen($cpf) != 11) {
		return false;
	}
	// Verifica se nenhuma das sequências invalidas abaixo 
	// foi digitada. Caso afirmativo, retorna falso
	else if ($cpf == '00000000000' || 
		$cpf == '11111111111' || 
		$cpf == '22222222222' || 
		$cpf == '33333333333' || 
		$cpf == '44444444444' || 
		$cpf == '55555555555' || 
		$cpf == '66666666666' || 
		$cpf == '77777777777' || 
		$cpf == '88888888888' || 
		$cpf == '99999999999') {
		return false;
	 // Calcula os digitos verificadores para verificar se o
	 // CPF é válido
	 } else {   
		
		for ($t = 9; $t < 11; $t++) {
			
			for ($d = 0, $c = 0; $c < $t; $c++) {
				$d += $cpf{$c} * (($t + 1) - $c);
			}
			$d = ((10 * $d) % 11) % 10;
			if ($cpf{$c} != $d) {
				return false;
			}
		}
		return true;
	}
}	
?>