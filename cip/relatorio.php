<?
$breadcrumbs=array();
array_push($breadcrumbs, array('main.php','principal'));
array_push($breadcrumbs, array('relatorio.php','relat�rios'));

require("cab_cip.php");
require($include."sisdoc_menus.php");
$estilo_admin = 'style="width: 200; height: 30; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';
$menu = array();

array_push($menu,array('Capta��o','Relat�rio de capta��es','rel_captacao_detalhes.php'));

/////////////////////////////////////////////////// MANAGERS
array_push($menu,array('Grupos e Linhas de pesquisa','Estados dos grupos de pesquisa','grupo_de_pesquisa_rel_status.php')); 
array_push($menu,array('Grupos e Linhas de pesquisa','Atualiza��es dos grupos no CNPq','grupo_de_pesquisa_rel_atualizacaoes.php')); 


array_push($menu,array('Docentes','Docentes','')); 
array_push($menu,array('Docentes','__Todos Docentes','docentes_rel.php'));
array_push($menu,array('Docentes','__Docentes Produtividade','docentes_rel.php?dd2=1'));
array_push($menu,array('Docentes','__Docentes Stricto Sensu','docentes_rel.php?dd1=S'));
array_push($menu,array('Docentes','__Docentes SS X Programas P�s-Gradua��o SS','docentes_rel.php?dd1=P'));
array_push($menu,array('Docentes','__Docentes Gradua��o','docentes_rel.php?dd1=N')); 

array_push($menu,array('Docentes','__Sobre o corpo docente','rel_docente_about.php'));

array_push($menu,array('Pareceristas','Pareceristas (Comit� Local)','docentes_avaliador_rel.php?dd0=1')); 
array_push($menu,array('Pareceristas','Pareceristas (Comit� Gestor)','docentes_avaliador_rel.php?dd0=2'));

array_push($menu,array('Capta��o','Editais de Fomento','captacao_rel_docentes.php'));

array_push($menu,array('Produ��o Cient�fica','Docentes Stricto Sensu','producao_docentes.php?dd1=S'));

array_push($menu,array('Inicia��o Cient�fica','Docentes Stricto Sensu','iniciacao_cientifica_docentes.php?dd1=S'));

array_push($menu,array('Bonifica��o - Processos','Relat�rio de bonifica��o','bonificacao_rel.php'));
array_push($menu,array('Bonifica��o - Processos','Relat�rio de isen��o','bonificacao_rel_isencao.php'));
?>
<TABLE width="710" align="center" border="0">
<TR>
<?
	$tela = menus($menu,"3");
?>
<? require("../foot.php");	?>