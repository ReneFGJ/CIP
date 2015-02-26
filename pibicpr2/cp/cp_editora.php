<?
$tabela = "editora";
$cp = array();
array_push($cp,array('$H8','id_ed','id_ed',False,True,''));
array_push($cp,array('$H7','ed_codigo','ed_codigo',False,True,''));
array_push($cp,array('$S80','ed_nome','Nome da editora',True,True,''));
array_push($cp,array('$T70:7','ed_dados','Dados',False,True,''));
array_push($cp,array('$S7','ed_use','Remissiva',False,True,''));
array_push($cp,array('$S20','ed_nome_abreviado','Nome Abreviado',False,True,''));
array_push($cp,array('$O 1:SIM&0:NÂO','ed_ativo','ed_ativo',False,True,''));
array_push($cp,array('$S40','ed_cidade','Cidade',False,True,''));

array_push($cp,array('$S200','ed_bn_link','Link da BN',False,True,''));
array_push($cp,array('$S120','ed_site','Site editora',False,True,''));
array_push($cp,array('$S60','ed_email','e-mail',False,True,''));
array_push($cp,array('$CPF','ed_cnpj','CNPJ',False,True,''));
array_push($cp,array('$T60:5','ed_endereco','Endreco',False,True,''));
array_push($cp,array('$S80','ed_razao','Razão social',False,True,''));
array_push($cp,array('$O 0:Não&1:Sim','ed_checked','Revisado',False,True,''));
array_push($cp,array('$O 0:Não&1:Sim','ed_locked','Travado',False,True,''));
array_push($cp,array('$T60:8','ed_marc','MARC da BN',False,False,''));

array_push($cp,array('$U8','lastupdate','lastupdate',False,True,''));


/// Gerado pelo sistem "base.php" versao 1.0.5
?>