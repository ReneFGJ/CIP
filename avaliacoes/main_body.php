<?
require($include."sisdoc_menus.php");

$menu = array();

array_push($menu,array("Avalia��o","Lan�ar avalia��es","semic_avaliacoes.php"));
if ($user_nivel == 9) 
{
	array_push($menu,array("Avalia��o","Lista de avaliadores","ed_pareceristas.php"));
	array_push($menu,array("Avalia��o","Fichas de avalia��o (SEMIC)","semic_fichas_avaliadores.php?dd1=SEMIC20"));
	array_push($menu,array("Avalia��o","Fichas de avalia��o (MOSTRA)","semic_fichas_avaliadores.php?dd1=MP"));

	array_push($menu,array("Avalia��o","Lista de trabalhos X Avaliadores","semic_fichas_avaliadores_row_1.php"));
	array_push($menu,array("Avalia��o","Avaliadores X Lista de trabalhos","semic_fichas_avaliadores_row_2.php"));

	array_push($menu,array("Programa��o","Programa��o","programacao.php"));
	array_push($menu,array("Programa��o","Listas de trabalhos","trabalhos.php"));
	array_push($menu,array("Declara��o (Avaliador)","Declara��o de avaliador","semic_declaracao_tp_1.php"));
	array_push($menu,array("Declara��o (Avaliador)","Declara��o do avaliador CNPq","semic_declaracao_tp_1.php"));
	array_push($menu,array("Declara��o (Estudante)","Declara��o de apresenta��o de trabalhos","declaracao_tp_3.php"));
	array_push($menu,array("Declara��o (Estudante)","Declara��o de ouvinte","declaracao_tp_4.php"));
	
	array_push($menu,array("Indicadores","Avaliadores","indicares_avaliadores.php"));


	array_push($menu,array("Premia��o","Fichas de avalia��o (MOSTRA)","semic_fichas_avaliadas.php"));
	array_push($menu,array("Premia��o","Ver fichas","semic_avaliacoes_2.php"));
	array_push($menu,array("Premia��o","Ver fichas (row)","semic_avaliacoes_3.php"));

	array_push($menu,array("Premia��o","TOP 50 - PIBIC/PIBITI","semic_avaliacoes_4a.php"));
	array_push($menu,array("Premia��o","TOP 50 - iPIBIC/iPIBITI","semic_avaliacoes_4b.php"));
	array_push($menu,array("Premia��o","TOP 50 - MOSTRA","semic_avaliacoes_4c.php"));
	array_push($menu,array("Premia��o","TOP 50 - Junior","semic_avaliacoes_4d.php"));
}
echo menus($menu,3);
?>