<?
require("cab.php");
require($include."sisdoc_menus.php");

$menu = array();
array_push($menu,array("Mensagens","Avisos Gerais","parametro.php"));
array_push($menu,array("Mensagens","Of�cios","parametro.php"));
array_push($menu,array("Mensagens","Comunica��o","parametro.php"));
array_push($menu,array("Mensagens","Conovaca��o","parametro.php"));
array_push($menu,array("Calend�rio","Calend�rio","parametro.php"));
array_push($menu,array("Status","Fluxo do sistema","ed_status.php"));
array_push($menu,array("Usu�rios","Perfis","ed_perfis.php"));
array_push($menu,array("Usu�rios","Relatores / Revisores","relatores.php"));

array_push($menu,array("Protocolos de Pesquisa","alterar status do protocolos","ajuste_pp.php"));

$sql = "CREATE TABLE usuario_perfis 
(
  id_up serial NOT NULL,
  up_perfil char(3),
  up_usuario char(7),
  up_data int8
) ";
$sql = "ALTER TABLE perfis ADD COLUMN pf_icone char(20);";
//$rlt = db_query($sql);
echo menus($menu,3);

require("foot.php");
?>