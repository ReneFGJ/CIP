<?
require("cab.php");
$estilo_admin = 'style="width: 230; height: 40; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';
$path = "comunicacao.php";
require($include."sisdoc_menus.php");
$menu = array();

	array_push($menu,array('Pesquisadores/Professores (Bolsas ativas)','Pesquisadores','')); 
	array_push($menu,array('Pesquisadores/Professores (Bolsas ativas)','__e-mail dos professores (todos)',	'comunicacao_email_professores.php?dd3=9999')); 
	array_push($menu,array('Pesquisadores/Professores (Bolsas ativas)','__e-mail dos professores (por bolsas)',	'comunicacao_email_professores.php')); 

	array_push($menu,array('Pesquisadores/Professores (Submissão)','Pesquisadores','')); 
	array_push($menu,array('Pesquisadores/Professores (Submissão)','__e-mail dos professores (todos)',	'comunicacao_email_professores_sub.php?dd3=9999')); 
	array_push($menu,array('Pesquisadores/Professores (Submissão)','__e-mail dos professores (por bolsas)',	'comunicacao_email_professores_sub.php')); 

	array_push($menu,array('Estudantes (Bolsas ativas)','Estudantes','')); 
	array_push($menu,array('Estudantes (Bolsas ativas)','__e-mail dos estudantes (todos)',	'comunicacao_email_estudantes.php?dd3=9999')); 
	array_push($menu,array('Estudantes (Bolsas ativas)','__e-mail dos estudantes (por bolsas)',	'comunicacao_email_estudantes.php')); 
	
	array_push($menu,array('Pareceristas','Pareceristas','')); 
//	array_push($menu,array('Pareceristas','__Cadastro','ed_pareceristas.php')); 
///////////////////////////////////////////////////// redirecionamento

?>
<TABLE width="710" align="center" border="0">
<TR><TD colspan="4">
<FONT class="lt3">
</FONT><FORM method="post" action="bolsa.php">
</TD></TR>
</TABLE>
<TABLE width="710" align="center" border="0">
<TR>
<?
menus($menu,'3');
?>
</TABLE>
<? require("foot.php");	?>