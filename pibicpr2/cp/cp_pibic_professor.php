<?
$tabela = "pibic_professor";
$cp = array();
array_push($cp,array('$H4','id_pp','id_pp',False,True,''));
array_push($cp,array('$S8','pp_cracha','Cracha',True,True,''));
array_push($cp,array('$A','','Dados sobre o professor',False,True,''));
array_push($cp,array('$S100','pp_nome','Nome completo do autor',True,True,''));
//array_push($cp,array('$H8','pp_nome_asc','Nome ASC',False,False,''));
array_push($cp,array('$Q ap_tit_titulo:ap_tit_codigo:select * from apoio_titulacao order by ap_tit_titulo','pp_titulacao','Titulacao',True,True,''));

array_push($cp,array('$O N:NÃO&S:SIM','pp_ss','Stricto sensu',True,True,''));
array_push($cp,array('$O 0:NÃO&2:Nível 1A&3:Nível 1B&4:Nível 1C&5:Nível 1D&6:Nível 2&9:Nível ??','pp_prod','Bolsista de produtividade',False,True,''));

array_push($cp,array('$S18','pp_cpf','CPF',True,True,''));
array_push($cp,array('$S40','pp_escolaridade','Escolaridade',True,True,''));
array_push($cp,array('$S30','pp_curso','Curso',True,True,''));
array_push($cp,array('$I8','pp_carga_semanal','Carga horaria',True,True,''));

array_push($cp,array('$A','','Formas de contato',False,True,''));
array_push($cp,array('$S20','pp_telefone','Telefone<BR><font class="lt0">(xx)0000.0000',False,True,''));
array_push($cp,array('$S20','pp_celular','Celular<font class="lt0"><BR>(xx)0000.0000',False,True,''));

array_push($cp,array('$S40','pp_centro','Centro',False,True,''));

array_push($cp,array('$S100','pp_email','e-mail',False,True,''));
array_push($cp,array('$S100','pp_email_1','e-mail (alternativo)',False,True,''));

array_push($cp,array('$A','','Lattes',False,True,''));
array_push($cp,array('$S100','pp_lattes','Link para Lattes',False,True,''));
array_push($cp,array('$T60:5','pp_grestudo','Nome do grupo de pesquisa a que pertence',False,True,''));

array_push($cp,array('$Q ci_nome:ci_codigo:select * from ca_instituicao where ci_ativo=1 and ci_codigo = '.chr(39).'0000002'.chr(39).' order by ci_nome','pp_afiliacao','Afiliação Institucional',True,True,''));

array_push($cp,array('$HV','pp_nome_asc',UpperCaseSQL($dd[3]),False,True,''));

/// Gerado pelo sistem "base.php" versao 1.0.2
?>