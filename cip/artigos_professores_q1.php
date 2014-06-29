<?php
require("cab_cip.php");
require($include.'sisdoc_debug.php');
require($include.'sisdoc_data.php');
require($include.'sisdoc_colunas.php');

require($include."sisdoc_menus.php");
$estilo_admin = 'style="width: 200; height: 30; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';
$menu = array();
/////////////////////////////////////////////////// MANAGERS
//array_push($menu,array('Isenção','Gerar Bonificações','artigos_gerar.php'));

echo '<H3>Professores com Q1</h3>';

$sql = "select * from artigo
			inner join pibic_professor on ar_professor = pp_cracha
		where ar_v3 > 0
		order by pp_nome
";
$rlt = db_query($sql);
while ($line = db_read($rlt))
	{
		echo '<BR>'.$line['pp_nome'];
		print_r($line);
		echo '<HR>';
	}
	//$tela = menus($menu,"3");
require("../foot.php");
?>
