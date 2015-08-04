<?
$tabela = "pibic_aluno";
$cp = array();
array_push($cp,array('$H4','id_pa','id_pa',False,False,''));
array_push($cp,array('$A','','Dados sobre o aluno',False,True,''));
array_push($cp,array('$S100','pa_nome','Nome completo do aluno*',False,False,''));
array_push($cp,array('$H8','pp_nome_asc','Nome ASC',False,False,''));

array_push($cp,array('$S15','pa_cpf','CPF',True,True,''));
array_push($cp,array('$S15','pa_rg','R.G.',True,True,''));
array_push($cp,array('$D8','pa_nasc','Data de nascimento*',True,True,''));

array_push($cp,array('$[1-12]','pa_periodo','Período (Cursando)',True,True,''));
array_push($cp,array('$S30','pa_curso','Curso',True,True,''));

array_push($cp,array('$A','','Filiação',False,True,''));
array_push($cp,array('$S100','pa_pai','Nome da Pai*',True,True,''));
array_push($cp,array('$S100','pa_mae','Nome do Mae*',True,True,''));

array_push($cp,array('$A','','Formas de contato',False,True,''));
array_push($cp,array('$S20','pa_tel1','Telefone*<BR><font class="lt0">(xx)0000.0000',True,True,''));
array_push($cp,array('$S20','pa_tel2','Telefone (alt)<font class="lt0"><BR>(xx)0000.0000',False,True,''));

array_push($cp,array('$A','','Endereço',False,True,''));
array_push($cp,array('$S100','pa_endereco','Endereço*',True,True,''));
array_push($cp,array('$S20','pa_bairro','Bairro*',True,True,''));
array_push($cp,array('$S20','pa_cidade','Cidade*',True,True,''));
array_push($cp,array('$O PR:PR','pa_estado','UF',True,True,''));
array_push($cp,array('$CEP','pa_cep','CEP*',True,True,''));

array_push($cp,array('$S100','pa_email','e-mail*',True,True,''));
array_push($cp,array('$S100','pa_email_1','e-mail (alternativo)',False,True,''));

array_push($cp,array('$A','','Dados Bancários',False,True,''));
array_push($cp,array('$S3','pa_cc_banco','Banco (código)',False,True,''));
array_push($cp,array('$S6','pa_cc_agencia','Agência',False,True,''));
array_push($cp,array('$S15','pa_cc_conta','Conta corrente',False,True,''));


array_push($cp,array('$A','','Lattes',False,True,''));
array_push($cp,array('$S100','pa_lattes','Link para Lattes',True,True,''));

$dd[3] = UpperCaseSQL($dd[2]);
if (trim($dd[8]) == '//') { $dd[8] = ''; }

/// Gerado pelo sistem "base.php" versao 1.0.2
$tab_max = '98%';
?>