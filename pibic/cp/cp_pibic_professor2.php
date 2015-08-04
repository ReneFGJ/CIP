<?
$tabela = "pibic_professor";
$cp = array();
array_push($cp,array('$H4','id_pp','id_pp',True,False,''));
array_push($cp,array('$A','','Dados sobre o estudante',False,True,''));
array_push($cp,array('$S100','pp_nome','Nome completo do autor',True,True,''));
array_push($cp,array('$H8','pp_nome_asc','Nome ASC',False,False,''));
//array_push($cp,array('$Q ap_tit_titulo:ap_tit_titulo:select * from apoio_titulacao order by ap_tit_titulo','pp_titulacao','Titulacao',False,False,''));

array_push($cp,array('$S12','pp_cracha','Cod.do Aluno (12 digitos)',True,True,''));
array_push($cp,array('$D8','pp_nasc','Data nascimento',True,True,''));

array_push($cp,array('$S18','pp_cpf','CPF',True,True,''));
array_push($cp,array('$O Doutorando:Doutorando','pp_escolaridade','Escolaridade',True,True,''));
array_push($cp,array('$Q pos_nome:pos_codigo:select * from programa_pos where pos_corrente = \'1\' order by pos_nome','pp_curso','Programa',True,True,''));
array_push($cp,array('$HV','pp_centro','DOUTORANDO',True,True,''));

array_push($cp,array('$A','','Formas de contato',False,True,''));
array_push($cp,array('$S20','pp_telefone','Telefone (xx)0000.0000',True,True,''));
array_push($cp,array('$S20','pp_celular','Celular (xx)0000.0000',False,True,''));

array_push($cp,array('$S100','pp_email','e-mail',True,True,''));
array_push($cp,array('$S100','pp_email_1','e-mail (alternativo)',False,True,''));

array_push($cp,array('$A','','Lattes',False,True,''));
array_push($cp,array('$S100','pp_lattes','Link para Lattes',True,True,''));
//array_push($cp,array('$T60:5','pp_grestudo','Nome do grupo de pesquisa a que pertence',False,True,''));

array_push($cp,array('$Q ci_nome:ci_codigo:select * from ca_instituicao where ci_ativo=1 and ci_codigo = '.chr(39).'0000002'.chr(39).' order by ci_nome','pp_afiliacao','Afiliaчуo Institucional',True,True,''));

$dd[3] = UpperCaseSQL($dd[2]);
array_push($cp,array('$HV','pp_ass','Doutorando',False,False,''));
array_push($cp,array('$Q pp_nome:pp_cracha:select * from pibic_professor where pp_ativo=1 order by pp_nome','pp_login','Professor Orientador',False,False,''));

/// Gerado pelo sistem "base.php" versao 1.0.2
?>