<?
require("cab.php");
$estilo_admin = 'style="width: 230; height: 40; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';
$path = "cadastro.php";

	/* Mensagens */
	$link_msg = '../messages/msg_'.page();
	if (file_exists($link_msg)) { require($link_msg); } else { echo 'message not found'; }	
	
require($include."sisdoc_menus.php");
$menu = array();

	array_push($menu,array('SEMIC (Phase Estrat�gia)','�reas do conhecimento','semic_lista_areas.php'));

	array_push($menu,array('SEMIC (Phase I)','Aprovar resumos para publica��o','semic_resumos.php')); 
	array_push($menu,array('SEMIC (Phase I)','Planos ativos sem resumo','semic_resumos_falta.php')); 
	array_push($menu,array('SEMIC (Phase I)','Planos ativos com resumos n�o eviados','semic_resumos_falta_2.php')); 

	array_push($menu,array('SEMIC (Phase II)','Conferir ','semic_resumos_conferir.php')); 
	array_push($menu,array('SEMIC (Phase II)','Indexar trabalhos','semic_indexar.php')); 


	array_push($menu,array('SEMIC (Phase III)','Lan�ar avaliadores','parecerista_areas_avaliacao.php'));
	
	array_push($menu,array(msg('semic_dados'),msg('semic_idiomas_apre'),'semic_resumo_idioma.php'));
	array_push($menu,array(msg('semic_dados'),msg('semic_idiomas_area'),'semic_resumo_area.php'));
	 

	array_push($menu,array('SEMIC (Phase IV)','Imprimir fichas de avalia��o','semic_fichas_avaliacao.php'));
	array_push($menu,array('SEMIC (Phase IV)','Comunicar avaliadores (e-mail)','parecerista_comunicar.php'));
	
	array_push($menu,array('SEMIC (Phase V)','Cronograma de avalia��es','semic_cronograma_i.php'));
	
	array_push($menu,array('SEMIC (Phase VI)','Agradecimentos Avaliadores','semic_agradecimento_avaliadores.php'));

///////////////////////////////////////////////////// redirecionamento

?>
<TABLE width="710" align="center" border="0">
<TR>
<?
menus($menu,'3');
?>
</TABLE>
<? require("foot.php");	?>