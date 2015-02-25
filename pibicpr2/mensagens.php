<?
require("cab.php");
$estilo_admin = 'style="width: 230; height: 40; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';
$path = "cadastro.php";
require($include."sisdoc_menus.php");
$menu = array();

if ($user_nivel >= 9)
	{	
	array_push($menu,array('Comunicação','Submissão','')); 
	array_push($menu,array('Comunicação','__mensagens do portal do professor (site IC)','mensagens_portal_ver.php')); 
	array_push($menu,array('Comunicação','__mensagens (Todas)','mensagens_ver.php')); 

	array_push($menu,array('Página do PIBIC / PIBITI / PIBIC_EM','Página do PIBIC / PIBITI','')); 
	array_push($menu,array('Página do PIBIC / PIBITI / PIBIC_EM','__conteúdo PIBIC' ,'ed_frases_pibic.php')); 
	array_push($menu,array('Página do PIBIC / PIBITI / PIBIC_EM','__conteúdo PIBITI','ed_frases_pibiti.php')); 
	array_push($menu,array('Página do PIBIC / PIBITI / PIBIC_EM','__conteúdo PIBIC_EM','ed_frases_pibic_em.php')); 

	array_push($menu,array('Comunicação','Enviar e-mail de comunicação','mensagens_email_comunicacao.php'));
	
	array_push($menu,array('Comunicação','Contrato PIBIC/PIBITI (minutas)','mensagens_minutas.php')); 

//	array_push($menu,array('Comunicação','__mensagens da submissao (comunicação)','mensagens_submissao_autor_ver.php')); 
//	array_push($menu,array('Comunicação','__editar mensagens da submissao','mensagens_submissao.php')); 
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