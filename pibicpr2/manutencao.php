<?
require("cab.php");
$estilo_admin = 'style="width: 230; height: 40; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';
$path = "cadastro.php";
require($include."sisdoc_menus.php");
$menu = array();

	array_push($menu,array('Bolsas','Bolsas','')); 
	array_push($menu,array('Bolsas','__Cadastro das Bolsas Contempladas','ed_pibic_bolsas_contempladas.php')); 
	array_push($menu,array('Bolsas','__Cadastro dos tipos de bolsas','ed_pibic_bolsa_tipo.php')); 
	array_push($menu,array('Bolsas','__Implementar bolsa ICV/ICT','bolsa_ativar_icv.php')); 
	
	array_push($menu,array('Submiss�es','Submiss�es','')); 
	array_push($menu,array('Submiss�es','__Cadastro das Submiss�es','ed_pibic_submit_documento.php'));
	array_push($menu,array('Submiss�es','__Cancelar sem t�tulo','ed_pibic_cancelar_sem_titulo.php')); 

	array_push($menu,array('Professores','Importa��o de professores (PUCPR)','ed_pibic_professor_import.php'));
	array_push($menu,array('Professores','Nome dos Cursos','ed_pibic_professor_cursos.php'));
	array_push($menu,array('Professores','Desativar professores n�o atualizados (Importa��o)','ed_pibic_professor_inativo.php')); 
	
	array_push($menu,array('Relat�rio Parcial','Aprova��o dos pareceres','manu_rparcial_parecer.php')); 
	array_push($menu,array('Relat�rio Parcial','Converter relat�rio parcial n�o entregues em pend�ncias','manu_rparcial_converter.php'));
	
	if ($user_nivel >= 9)
		{
		array_push($menu,array('Avalia��o','Declinar todas as avalia��es ativas','manu_aval_cancelar.php'));
		}

	array_push($menu,array('Integra��o PUCPR','Verifica��o de login de rede','pucpr_login_de_rede.php'));
	
	array_push($menu,array('Banco de Pareceristas','Consolida��o - Parecerista / Professores / Local','manutencao_consolidacao_professores.php'));	 

	array_push($menu,array('Banco de dados','__Zerar Editais','manutencao_zerar_editais.php'));
	array_push($menu,array('Banco de dados','__Vaccum','manutencao_vaccum.php'));
	//array_push($menu,array('Banco de dados','__Select_Tabble','select.php'));	
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