<?php

/*
 * Incluir Classes para a página
 */
require("_class/_class_semic_layout.php");
$site = new layout;

$LANG = $_SESSION['idioma'];
$idioma = $_GET['idioma'];
if (strlen($idioma) > 0)
{ $LANG = $idioma; }
if (strlen($LANG) == 0) { $LANG = 'pt_BR'; }
$_SESSION['idioma'] = $LANG;

/* 
 * BBM - Header Site 
 */
echo $site->header_site();

echo $site->coluna_esquerda();
echo '<div class="txt_conteudo">';
?>
	<BR>
	<div class="box_vermelho_home">
	<div class="titulo_amarelo">Redes Sociais</div>
	<div class="saiba_mais"><a href="programacao.php#NORMAS2">+ <?=$read_more;?></a></div>
	</div>
<?	


echo '<TABLE>';
	echo '<TR><TD><center>';
	echo '<img src="img/xxsemic_eu_faco_pesquisa.jpg" height="150">';	
	echo '<TR><TD><center>';
	echo '<img src="img/xxsemic_convite_professor.jpg" height="150">';
	echo '<TR><TD><center>';
	echo '<img src="img/xx_semic_eu_acredito_na_pesquisa.jpg" height="150">';
	echo '<TR><TD><center>';
	echo '<img src="img/banner_espaco_aluno.jpg" height="150">';
	echo '<TR><TD><center>';
	echo '<img src="img/banner_espaco_pesquisador.jpg" height="150">';
	echo '<TR><TD><center>';
	echo '<img src="img/xx_semic_face_01.jpg" width="400">';
	echo '<TR><TD><center>';
	echo '<img src="img/xx_semic_face_02.jpg" width="400>';
	echo '</table>';

echo '</div>';
//echo $site->coluna_esquerda_fecha();
/*
 * BBM - Foot Site
 */
echo $site->foot_site();
?>
