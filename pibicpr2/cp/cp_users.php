<?
$tabela = "users";
$cp = array();
$nc = $nucleo.":".$nucleo;
array_push($cp,array('$H4','user_id','user_id',False,False,''));
array_push($cp,array('$A4','','Dados pessoais',False,True,''));
array_push($cp,array('$S100','username','Login do usuсrio',False,True,''));
array_push($cp,array('$P30','senha','senha',False,True,''));
array_push($cp,array('$S40','first_name ','Primeiro nome',False,True,''));
array_push($cp,array('$S40','middle_name ','nome do meio',False,True,''));
array_push($cp,array('$S40','last_name ','sobrenome',False,True,''));
array_push($cp,array('$H8','initials ','Iniciar',False,True,''));
array_push($cp,array('$S100','affiliation ','Afiliaчуo',False,True,''));
array_push($cp,array('$A4','','Dados para o sistema',False,True,''));
array_push($cp,array('$S100','email','email',False,True,''));
array_push($cp,array('$H100','mailing_address ','senha',False,True,''));
array_push($cp,array('$O 1:SIM&0:NУO','disabled','Inativo',False,True,''));


/// Gerado pelo sistem "base.php" versao 1.0.2
?>