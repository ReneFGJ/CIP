<?
global $estilo;
// ************* dolar
$tt = "Mr.:Mr.&Mrs.:Mrs.&Dr.:Dr.&Dra.:Dra&PHd:PHd&Mst:Mst";
$cp = array();
array_push($cp,array('dd0',$dd[0],'$H8','User ID',$estilo,False,'user_id',True));
array_push($cp,array('dd1',UpperCaseSQL($dd[1]),'$S32','Login',$estilo,True,'username',True));
array_push($cp,array('dd2',$dd[2],'$S40','Primeiro nome',$estilo,True,'first_name',False));
array_push($cp,array('dd3',$dd[3],'$S40','Nome do meio',$estilo,False,'middle_name',False));
array_push($cp,array('dd4',$dd[4],'$S90','Ultimo nome',$estilo,True,'last_name',False));
array_push($cp,array('dd5',$dd[5],'$S255','Afiliação (Instituição)',$estilo,False,'affiliation',False));
array_push($cp,array('dd6',$dd[6],'$O '.$tt,'Titulo',$estilo,True,'initials',False));
array_push($cp,array('dd7',strtolower($dd[7]),'$S90','e-mail',$estilo,True,'email',False));
array_push($cp,array('dd8','0','$H8','Ativo',$estilo,True,'disabled',False));
array_push($cp,array('dd9',$dd[9],'$P8','Senha',$estilo,True,'senha',True));
array_push($cp,array('dd10',dtosql(),'$H8','DataCadastro',$estilo,False,'date_registered',True));
array_push($cp,array('dd11',dtosql(),'$H8','Acesso em',$estilo,False,'date_last_login',True));
array_push($cp,array('dd12',$jid,'$H8','Jornal',$estilo,False,'journal_id',True));
$fieldini=0;
?>


