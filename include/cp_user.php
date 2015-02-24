<?
global $estilo;
// ************* dolar
$cp = array();
array_push($cp,array('dd0',$dd[0],'$H8','User ID',$estilo,False,'user_id',True));
array_push($cp,array('dd1',strtoupper($dd[1]),'$S32','Login',$estilo,True,'username',True));
array_push($cp,array('dd2',$dd[2],'$S40','Primeiro nome',$estilo,True,'first_name',False));
array_push($cp,array('dd3',$dd[3],'$S40','Nome do meio',$estilo,False,'middle_name',False));
array_push($cp,array('dd4',$dd[4],'$S90','Ultimo nome',$estilo,True,'last_name',False));
array_push($cp,array('dd5',$dd[5],'$S255','Afiliação (Instituição)',$estilo,False,'affiliation',False));
array_push($cp,array('dd6',$dd[6],'$S5','Iniciais',$estilo,True,'initials',False));
array_push($cp,array('dd7',$dd[7],'$S90','e-mail',$estilo,True,'email',False));
array_push($cp,array('dd8',$dd[8],'$S24','Telefone',$estilo,False,'phone',False));
array_push($cp,array('dd9',$dd[9],'$S24','Fax',$estilo,False,'fax',False));
array_push($cp,array('dd10',$dd[10],'$T70:4','Endereço',$estilo,False,'mailing_address',False));
array_push($cp,array('dd11',$dd[11],'$T70:5','Biografia',$estilo,False,'biography',False));
array_push($cp,array('dd12',$dd[12],'$S255','Interesse',$estilo,False,'interests',False));
array_push($cp,array('dd13',$dd[13],'$S255','Locales',$estilo,False,'locales',False));
array_push($cp,array('dd14',$dd[14],'$O 0:Ativo&1:Inativo','Ativo',$estilo,True,'disabled',False));
array_push($cp,array('dd15',$dd[15],'$T70:3','Razão da destivação',$estilo,False,'disabled_reason',False));
array_push($cp,array('dd16',$dd[16],'$P20','Senha',$estilo,True,'senha',False));
array_push($cp,array('dd17',dtosql(),'$H8','DataCadastro',$estilo,False,'date_registered',True));
array_push($cp,array('dd18',dtosql(),'$H8','Acesso em',$estilo,False,'date_last_login',True));
array_push($cp,array('dd19',$jid,'$H8','Journal',$estilo,False,'journal_id',True));
$fieldini=0;
?>


