<?
$cp = array();
array_push($cp,array('dd0',$dd[0],'$H2','Codigo',$estilo,False,'user_id',False));
array_push($cp,array('dd1',$dd[5],'$H5','Login de acesso',$estilo,True,'username',True));
array_push($cp,array('dd2',$dd[2],'$S40','Primeiro nome',$estilo,True,'first_name',False));
array_push($cp,array('dd3',$dd[3],'$S40','Nome do meio',$estilo,True,'middle_name',False));
array_push($cp,array('dd4',$dd[4],'$S40','Ultimo nome',$estilo,True,'last_name',False));
array_push($cp,array('dd5',$dd[5],'$S90','e-mail',$estilo,True,'email',False));
array_push($cp,array('dd6','','$H10','Senha',$estilo,False,'senha',False));
array_push($cp,array('dd7',$dd[7],'$S90','Afiliaчуo (Instituiчуo)',$estilo,True,'affiliation',False));
array_push($cp,array('dd8',date('Y-m-d H:i'),'$H8','datacriacao',$estilo,False,'date_registered',False));
array_push($cp,array('dd9',date('Y-m-d H:i'),'$H8','datacriacao',$estilo,False,'date_last_login',False));
array_push($cp,array('dd10',$jid,'$H8','journal_id',$estilo,False,'journal_id',False));
//$cp = array();
//array_push($cp,array('$H2','user_id','Codigo',False,True));
//array_push($cp,array('$H2','username','Codigo',False,True));
//array_push($cp,array('$S40','first_name','Primeiro nome',True,True));
//array_push($cp,array('$S40','middle_name','Nome do meio',False,True));
//array_push($cp,array('$S40','last_name','Ultimo nome',True,True));


if ($idioma == "2")
	{
	$cp = array();
	array_push($cp,array('dd0',$dd[0],'$H2','Codigo',$estilo,False,'user_id',False));
	array_push($cp,array('dd1',$dd[5],'$H5','Access Login',$estilo,False,'username',False));
	array_push($cp,array('dd2',$dd[2],'$S40','First Name',$estilo,True,'first_name',False));
	array_push($cp,array('dd3',$dd[3],'$S40','Middel Name',$estilo,False,'middle_name',False));
	array_push($cp,array('dd4',$dd[4],'$S40','Last Name',$estilo,True,'last_name',False));
	array_push($cp,array('dd5',$dd[5],'$S90','e-mail',$estilo,True,'email',False));
	array_push($cp,array('dd6','','$H10','Password',$estilo,False,'senha',False));
	array_push($cp,array('dd7',$dd[7],'$S90','Afiliation (Instituition)',$estilo,False,'affiliation',False));
	array_push($cp,array('dd8',date('Y-m-d H:i'),'$H8','datacriacao',$estilo,False,'date_registered',False));
	array_push($cp,array('dd9',date('Y-m-d H:i'),'$H8','datacriacao',$estilo,False,'date_last_login',False));
	array_push($cp,array('dd10',$jid,'$H8','journal_id',$estilo,True,'journal_id',False));
	}
?>