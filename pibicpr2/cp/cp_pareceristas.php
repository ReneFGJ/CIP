<?
//$sql = "ALTER TABLE apoio_titulacao  ADD COLUMN ap_ordem integer DEFAULT 0; ";
//$rlt = db_query($sql);

$tabela = "pareceristas";
$cp = array();
//$dd[4] = '19000101';
if (strlen($dd[5])==0)
	{ $dd[5] = '0000455'; }

array_push($cp,array('$H4','id_us','id_us',False,False,''));
array_push($cp,array('$A4','','Dados pessoais',False,True,''));
array_push($cp,array('$H8','us_cracha','Usu�rio do n�cleo',False,True,''));
array_push($cp,array('$S120','us_nome','Nome completo',True,True,''));
array_push($cp,array('$Q ap_tit_titulo:ap_tit_titulo:select * from apoio_titulacao where at_tit_ativo=1 order by ap_ordem, ap_tit_titulo','us_titulacao','Titulacao',True,True,''));
array_push($cp,array('$Q inst_nome:inst_codigo:select * from instituicao order by inst_ordem, inst_nome','us_instituicao','Institui��o',True,True,''));
array_push($cp,array('$S100','us_lattes','Lattes (link) <img src="img/icone_lattes.gif" width="20" height="20" alt="" border="0">',False,True,''));
array_push($cp,array('$HV','us_niver','19000101',False,True,''));
array_push($cp,array('$H4','','Filia��o',False,True,''));
array_push($cp,array('$H100','us_nome_pai','Nome pai',False,True,''));
array_push($cp,array('$H100','us_nome_mae','Nome mae',False,True,''));
array_push($cp,array('$A4','','Dados para o sistema',False,True,''));
array_push($cp,array('$HV','us_login','Login',True,True,''));
array_push($cp,array('$HV','us_senha','senha',True,True,''));
array_push($cp,array('$O -1:N�o informado&1:SIM&0:N�O&9:Enviar convite&2:Aguardando aceite do convite&3:inativo temporariamente&10:Aceito Novo&19:Enviado novo convite','us_aceito','Aceito com parecerista',False,True,''));
array_push($cp,array('$U8','us_lastupdate','us_lastupdate',False,True,''));
array_push($cp,array('$S100','us_lembrete','Lembrete da senha',False,True,''));
array_push($cp,array('$H4','','Documentos pessoais',False,True,''));
array_push($cp,array('$H20','us_cpf','CPF',False,True,''));
array_push($cp,array('$H20','us_rg','RG',False,True,''));
array_push($cp,array('$A4','','Formas de contato para contato',False,True,''));
array_push($cp,array('$T60:5','us_endereco','Endere�o',False,True,''));
array_push($cp,array('$S30','us_fone_1','Fone ',False,True,''));
array_push($cp,array('$S30','us_fone_2','Fone (cel)',False,True,''));
array_push($cp,array('$S30','us_fone_3','Fone (fax/rec)',False,True,''));
array_push($cp,array('$S100','us_email','e-mail',True,True,''));
array_push($cp,array('$S100','us_email_alternativo','e-mail (alternativo)',False,True,''));
array_push($cp,array('$O 1:SIM&0:N�O','us_email_ativo','Enviar e-mail',False,True,''));
array_push($cp,array('$H4','','Dados trabalistas',False,True,''));
array_push($cp,array('$O 1:SIM&0:N�O','us_ativo','Ativo',False,True,''));
array_push($cp,array('$U8','us_dt_admissao','Dt admiss�o',False,True,''));
array_push($cp,array('$U8','us_dt_demissao','Dt demiss�o',False,True,''));
array_push($cp,array('$H20','us_vt','Cart�o de VT',False,True,''));
array_push($cp,array('$H20','us_vr','Cart�o de VR',False,True,''));
array_push($cp,array('$O 1:Pareceristas','us_nivel','Tipo',False,True,''));
$nv = 'N�O:N�O&N�vel 1A:N�vel 1A&N�vel 1B:N�vel 1B&N�vel 1C:N�vel 1C&N�vel 1D:N�vel 1D&N�vel 2:N�vel 2';
$nv .= '&N�vel DT1A:N�vel DT1A&N�vel DT1B:N�vel DT1B&N�vel DT1C:N�vel DT1C&N�vel DT1D:N�vel DT1D&N�vel DT2:N�vel DT2';
array_push($cp,array('$O '.$nv,'us_bolsista','Bolsista de produtividade',False,True,''));
array_push($cp,array('$HV','us_journal_id',$jid,False,True,''));
array_push($cp,array('$U8','us_aceito_resp',$jid,False,True,''));
array_push($cp,array('$O : &1:SIM','us_cnpq','Avaliador CNPq',False,True,''));

/// Gerado pelo sistem "base.php" versao 1.0.2
?>