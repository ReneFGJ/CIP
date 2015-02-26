<?
$tabela = "pibic_aluno";
$cp = array();
if (strlen($dd[4])==0) { $dd[4] = UpperCaseSql($dd[3]); }
array_push($cp,array('$H4','id_pa','id_pa',False,True,''));
array_push($cp,array('$S8','pa_cracha','Cracha',True,True,''));
array_push($cp,array('$A','','Dados do Aluno',False,True,''));
array_push($cp,array('$S100','pa_nome','Nome completo do aluno',True,True,''));
array_push($cp,array('$S100','pa_nome_lattes','Nome no lattes',True,True,''));

//array_push($cp,array('$H8','pa_nome_asc','Nome ASC',False,False,''));
//array_push($cp,array('$Q ap_tit_titulo:ap_tit_codigo:select * from apoio_titulacao order by ap_tit_titulo','pa_titulacao','Titulacao',True,True,''));

//array_push($cp,array('$O N:NÃO&S:SIM','pa_ss','Ativo',True,True,''));

array_push($cp,array('$S18','pa_cpf','CPF',True,True,''));
array_push($cp,array('$S18','pa_rg','RG',True,True,''));
array_push($cp,array('$S40','pa_escolaridade','Escolaridade',True,True,''));
array_push($cp,array('$S80','pa_curso','Curso',True,True,''));
array_push($cp,array('$S80','pa_centro','Centro',True,True,''));

//array_push($cp,array('$I8','pa_carga_semanal','Carga horaria',True,True,''));

array_push($cp,array('$A','','Filiação',False,True,''));
array_push($cp,array('$S100','pa_pai','Nome do pai',False,True,''));
array_push($cp,array('$S100','pa_mae','Nome da mae',False,True,''));


array_push($cp,array('$D8','pa_nasc','Data Nascimento',True,True,''));

array_push($cp,array('$A','','Formas de contato',False,True,''));
array_push($cp,array('$S20','pa_telefone','Telefone<BR><font class="lt0">(xx)0000.0000',False,True,''));
array_push($cp,array('$S20','pa_celular','Celular<font class="lt0"><BR>(xx)0000.0000',False,True,''));

array_push($cp,array('$A','','Endereço',False,True,''));
array_push($cp,array('$T60:5','pa_endereco','Endereço',False,True,''));

array_push($cp,array('$S100','pa_email','e-mail',False,True,''));
array_push($cp,array('$S100','pa_email_1','e-mail (alternativo)',False,True,''));

array_push($cp,array('$A','','Dados bancários',False,True,''));
array_push($cp,array('$S3','pa_cc_banco','N. banco',False,True,''));
array_push($cp,array('$O : &001:001&021:021&023:023','pa_cc_mod','Mod (p/Caixa)',False,True,''));
array_push($cp,array('$S6','pa_cc_agencia','Agência',False,True,''));
array_push($cp,array('$S15','pa_cc_conta','N. Conta',False,True,''));
array_push($cp,array('$O N:Conta corrente Individual&P:Conta Poupança','pa_cc_tipo','Tipo de conta',False,True,''));

array_push($cp,array('$A','','Lattes',False,True,''));
array_push($cp,array('$S100','pa_lattes','Link para Lattes',False,True,''));

array_push($cp,array('$A','','Bolsa Anterior',False,True,''));
array_push($cp,array('$O  : - Nada&C:CNPq&F:Fundação Araucária&P:PUCPR&I:ICV','pa_bolsa_anterior','Bolsa (anterior)',False,True,''));
array_push($cp,array('$O  : - Nada&C:CNPq&F:Fundação Araucária&P:PUCPR&I:ICV','pa_bolsa','Bolsa atual',False,True,''));

array_push($cp,array('$Q ci_nome:ci_codigo:select * from ca_instituicao where ci_ativo=1 and ci_codigo = '.chr(39).'0000002'.chr(39).' order by ci_nome','pa_afiliacao','Afiliação Institucional',True,True,''));

array_push($cp,array('$HV','pa_nome_asc',UpperCaseSQL($dd[3]),False,True,''));

			array_push($cp,array('$A','','Informações complementares',False,True,''));
			array_push($cp,array('$C1','pa_blacklist','Blacklist',False,True,''));
			array_push($cp,array('$T60:5','pa_obs','Observações',False,True,''));
			

/// Gerado pelo sistem "base.php" versao 1.0.2
?>