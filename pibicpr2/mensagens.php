<?
require("cab.php");
$estilo_admin = 'style="width: 230; height: 40; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';
$path = "cadastro.php";
require($include."sisdoc_menus.php");
$menu = array();

if ($user_nivel >= 9)
	{	
	array_push($menu,array('Comunica��o','Submiss�o','')); 
	array_push($menu,array('Comunica��o','__mensagens do portal do professor (site IC)','mensagens_portal_ver.php')); 
	array_push($menu,array('Comunica��o','__mensagens (Todas)','mensagens_ver.php')); 

	array_push($menu,array('P�gina do PIBIC / PIBITI / PIBIC_EM','P�gina do PIBIC / PIBITI','')); 
	array_push($menu,array('P�gina do PIBIC / PIBITI / PIBIC_EM','__conte�do PIBIC' ,'ed_frases_pibic.php')); 
	array_push($menu,array('P�gina do PIBIC / PIBITI / PIBIC_EM','__conte�do PIBITI','ed_frases_pibiti.php')); 
	array_push($menu,array('P�gina do PIBIC / PIBITI / PIBIC_EM','__conte�do PIBIC_EM','ed_frases_pibic_em.php')); 

	array_push($menu,array('Comunica��o','Enviar e-mail de comunica��o','mensagens_email_comunicacao.php'));
	
	array_push($menu,array('Comunica��o','Contrato PIBIC/PIBITI (minutas)','mensagens_minutas.php')); 

//	array_push($menu,array('Comunica��o','__mensagens da submissao (comunica��o)','mensagens_submissao_autor_ver.php')); 
//	array_push($menu,array('Comunica��o','__editar mensagens da submissao','mensagens_submissao.php')); 
	}
///////////////////////////////////////////////////// redirecionamento
$tab_max = "98%";
?>
<TABLE width="98%" align="center" border="0">
<TR>
<?
menus($menu,'3');
?>
</TABLE>
<? require("foot.php");	?>