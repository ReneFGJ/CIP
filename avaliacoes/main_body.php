<?
require($include."sisdoc_menus.php");

$menu = array();

array_push($menu,array("Avaliaчуo","Lanчar avaliaчѕes","semic_avaliacoes.php"));
if ($user_nivel == 9) 
{
	array_push($menu,array("Avaliaчуo","Lista de avaliadores","ed_pareceristas.php"));
	array_push($menu,array("Avaliaчуo","Fichas de avaliaчуo (SEMIC)","semic_fichas_avaliadores.php?dd1=SEMIC20"));
	array_push($menu,array("Avaliaчуo","Fichas de avaliaчуo (MOSTRA)","semic_fichas_avaliadores.php?dd1=MP"));

	array_push($menu,array("Avaliaчуo","Lista de trabalhos X Avaliadores","semic_fichas_avaliadores_row_1.php"));
	array_push($menu,array("Avaliaчуo","Avaliadores X Lista de trabalhos","semic_fichas_avaliadores_row_2.php"));

	array_push($menu,array("Programaчуo","Programaчуo","programacao.php"));
	array_push($menu,array("Programaчуo","Listas de trabalhos","trabalhos.php"));
	array_push($menu,array("Declaraчуo (Avaliador)","Declaraчуo de avaliador","semic_declaracao_tp_1.php"));
	array_push($menu,array("Declaraчуo (Avaliador)","Declaraчуo do avaliador CNPq","semic_declaracao_tp_1.php"));
	array_push($menu,array("Declaraчуo (Estudante)","Declaraчуo de apresentaчуo de trabalhos","declaracao_tp_3.php"));
	array_push($menu,array("Declaraчуo (Estudante)","Declaraчуo de ouvinte","declaracao_tp_4.php"));
	
	array_push($menu,array("Indicadores","Avaliadores","indicares_avaliadores.php"));


	array_push($menu,array("Premiaчуo","Fichas de avaliaчуo (MOSTRA)","semic_fichas_avaliadas.php"));
	array_push($menu,array("Premiaчуo","Ver fichas","semic_avaliacoes_2.php"));
	array_push($menu,array("Premiaчуo","Ver fichas (row)","semic_avaliacoes_3.php"));

	array_push($menu,array("Premiaчуo","TOP 50 - PIBIC/PIBITI","semic_avaliacoes_4a.php"));
	array_push($menu,array("Premiaчуo","TOP 50 - iPIBIC/iPIBITI","semic_avaliacoes_4b.php"));
	array_push($menu,array("Premiaчуo","TOP 50 - MOSTRA","semic_avaliacoes_4c.php"));
	array_push($menu,array("Premiaчуo","TOP 50 - Junior","semic_avaliacoes_4d.php"));
}
echo menus($menu,3);
?>