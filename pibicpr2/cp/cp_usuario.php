<?
$tabela = "usuario";
$cp = array();
$nc = $nucleo.":".$nucleo;
array_push($cp,array('$H4','id_us','id_us',False,False,''));
array_push($cp,array('$A4','','Dados pessoais',False,True,''));
array_push($cp,array('$H8','us_cracha','Usu�rio do n�cleo',False,True,''));
array_push($cp,array('$S120','us_nome','Nome completo',True,True,''));
array_push($cp,array('$D8','us_niver','Data nascimento',True,True,''));
array_push($cp,array('$H4','','Filia��o',False,True,''));
array_push($cp,array('$H100','us_nome_pai','Nome pai',False,True,''));
array_push($cp,array('$H100','us_nome_mae','Nome mae',False,True,''));
array_push($cp,array('$A4','','Dados para o sistema',False,True,''));
array_push($cp,array('$S15','us_login','Login',True,True,''));
array_push($cp,array('$P100','us_senha','senha',True,True,''));
array_push($cp,array('$U8','us_lastupdate','us_lastupdate',False,True,''));
array_push($cp,array('$S100','us_lembrete','Lembrete da senha',False,True,''));
array_push($cp,array('$H4','','Documentos pessoais',False,True,''));
array_push($cp,array('$H20','us_cpf','CPF',False,True,''));
array_push($cp,array('$H20','us_rg','RG',False,True,''));
array_push($cp,array('$A4','','Formas de contato para contato',False,True,''));
array_push($cp,array('$T60:5','us_endereco','Endere�o',False,True,''));
array_push($cp,array('$S15','us_fone_1','Fone ',False,True,''));
array_push($cp,array('$S15','us_fone_2','Fone (cel)',False,True,''));
array_push($cp,array('$S15','us_fone_3','Fone (rec)',False,True,''));
array_push($cp,array('$S100','us_email','e-mail',True,True,''));
array_push($cp,array('$S100','us_email_alternativo','e-mail (alternativo)',False,True,''));
array_push($cp,array('$O 1:SIM&0:N�O','us_email_ativo','Enviar e-mail',False,True,''));
array_push($cp,array('$H4','','Dados trabalistas',False,True,''));
array_push($cp,array('$O 1:SIM&0:N�O','us_ativo','Ativo',False,True,''));
array_push($cp,array('$U8','us_dt_admissao','Dt admiss�o',False,True,''));
array_push($cp,array('$U8','us_dt_demissao','Dt demiss�o',False,True,''));
array_push($cp,array('$H20','us_vt','Cart�o de VT',False,True,''));
array_push($cp,array('$H20','us_vr','Cart�o de VR',False,True,''));
array_push($cp,array('$O 1:Operador&5:Gerente&0:Bloqueado&9:Master','us_nivel','Nivel do usu�rio',False,True,''));


/// Gerado pelo sistem "base.php" versao 1.0.2
?>