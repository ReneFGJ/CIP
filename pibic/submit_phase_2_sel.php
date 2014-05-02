<?
require("cab.php");
require("cab_main.php");
require($include.'sisdoc_form2.php');
require($include."sisdoc_search.php");
require($include."sisdoc_autor.php");
require($include."sisdoc_data.php");
require($include."sisdoc_windows.php");
require($include."sisdoc_colunas.php");
require($include."sisdoc_editor.php");
require($include."sisdoc_ajax.php");
require($include."sisdoc_html.php");
$ed_acao = true;
global $prj_tp;

///// Numero de erros
$nerr = 0;

if (strlen($dd[0]) > 0)
	{
	setcookie("prj_page",$dd[98],time()+60*60*60);
	setcookie("prj_nr",$dd[3],time()+60*60*60);
	setcookie("prj_proto",$dd[0],time()+60*60*60);
	setcookie("prj_tipo",$dd[5],time()+60*60*60);
	
	
	
	$prj_pg = $dd[98];
	redirecina('submit_phase_2_pibic.php');
	}
	
?>