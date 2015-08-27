<?php
require("db.php");
/*
 * Incluir Classes para a p�gina
 */
require("_class/_class_semic_layout.php");
$site = new layout;

$LANG = $_SESSION['idioma'];
$idioma = $_GET['idioma'];
if (strlen($idioma) > 0)
	{ $LANG = $idioma; }
else 
	{ 
		if (strlen($LANG) == 0) { $LANG = 'pt_BR'; }
	}
$_SESSION['idioma'] = $LANG;

/* 
 * BBM - Header Site 
 */

/* varial Ingles*/
if ($LANG == 'en') {
	echo $site->header_site();
	echo $site->coluna_esquerda_en();
	echo $site->banner_vermelho();
	$read_more = 'leia mais';
} else {
	/*Portugues*/
	echo $site->header_site();
	echo $site->coluna_esquerda();
	echo $site->banner_vermelho();
	$read_more = 'leia mais';
}
?>
    <div class="box_vermelho_home">
	<a href="pesquisa_evoluir.php"><img src="imagens/banner_espaco_pesquisador.jpg" border="0"></a>
	</div>

	
	<?

if ((date("Ymd") <= 20121108) and ($LANG!='en'))
{
	$read_more = 'leia mais';
	$normas = 'NORMAS GERAIS PARA ELABORA��O DO P�STER DOS ALUNOS DA GRADUA��O E<BR> P�S-GRADUA��O';
	$normas2 = 'NORMAS GERAIS PARA APRESENTA��O ORAL PARA ALUNOS DE GRADUA��O';
	?>
	<BR>
	<div class="box_vermelho_home">		
	<table width="100%">
		<TR valign="top"><TD width="50%">
			<div class="titulo_nota_home_vermelha"><font color="white"><?=$normas;?></font></div>
			<div class="saiba_mais"><a href="programacao.php#NORMAS">+ <?=$read_more;?></a></div>
		</td><TD>
			<div class="titulo_nota_home_vermelha"><font color="white"><?=$normas2;?></font></div>
			<div class="saiba_mais"><a href="programacao.php#NORMAS2">+ <?=$read_more;?></a></div>
		</TD></TR>
		</table>
	</div>
	<BR>
	<?
	$read_more = 'leia mais';	
}
require("_tabalhos_premiados.php");

if ($LANG=='en')
	{
		require("_content_apresentacao_en.php");
	} else {
		require("_content_apresentacao.php");
	}

echo $site->coluna_esquerda_fecha();

/* Coluna da Direita */
	echo $site->coluna_direita();
	if ($LANG == 'en')
		{
			echo $site->box_amarelo('Learn how to become a PUCPR researcher');
		} else {
			echo $site->box_amarelo('Saiba como se tornar um pesquisador da PUCPR');		
		}
	
	echo $site->menu_pesquisador();
	
	/*
	 * 
	 */
	$tema = array();
	array_push($tema,array('Ci�ncias Sociais Aplicadas','As Ci�ncias Sociais Aplicadas estudam aspectos da organiza��o da sociedade humana, suas inter-rela��es e aspectos organizacionais. Seu recorte de observa��o pode ocorrer tanto no n�vel individual quanto no de grupos. Entre seus campos de atua��o est�o Administra��o, Direito, Ci�ncias Pol�ticas, Estudos da Comunica��o, Contabilidade, entre outros.','1'));
	array_push($tema,array('Ci�ncias Exatas','As ci�ncias exatas t�m no trip� Matem�tica, F�sica e Qu�mica sua por��o conhecida como �rea b�sica. No que diz respeito � �rea aplicada temos as Engenharias, Geologia, Computa��o, Estat�stica, entre outras. Suas descobertas est�o diretamente relacionadas ao avan�o das tecnologias e consequente crescimento econ�mico e social.','2'));
	array_push($tema,array('Ci�ncias Agr�rias','As Ci�ncias Agr�rias visam a melhoria no manejo e a preserva��o dos recursos naturais, o que coloca o campo como um dos mais importantes no cen�rio cient�fico atual. Com a crescente demanda por alimentos, por exemplo, � necess�rio um investimento cada vez maior em pesquisas que apontem a melhor utiliza��o dos recursos naturais. Entre as �reas de estudo est�o Agronomia, Engenharia Florestal, Engenharia de Pesca, Medicina Veterin�ria e Zootecnia.','3'));
	array_push($tema,array('Ci�ncias Sa�de','As Ci�ncias da Sa�de, como o nome j� diz, englobam diversos campos de estudo que visam melhorar e entender a sa�de. Seu avan�o � crucial para a melhoria da qualidade de vida e longevidade da popula��o. Entre seus campos de atua��o est�o a Medicina Humana, Biologia, Biomedicina, An�lises Cl�nicas, Farm�cia, Ci�ncias do Esporte, Odontologia, Psicologia, Engenharia Biom�dica, entre outras.','4'));
	array_push($tema,array('Ci�ncias Humanas','Um dos papeis das Ci�ncias Humanas � tentar desvendar a complexidade dos seres humanos como indiv�duos e seres sociais, e suas intera��es com a sociedade. Entre seus campos de estudo est�o Filosofia, Hist�ria, Antropologia, Pedagogia, Lingu�stica, Sociologia, entre outros.','5'));
	
	if ($LANG == 'en')
	{
		$tema = array();
		array_push($tema,array('Applied Social Sciences','The Applied Social Sciences study aspects of the organization of human society, their interrelationships and organizational aspects. Their observation can occur at the individual and at the group aspect. Among their fields are Administration, Law, Political Science, Communication Studies, Accounting and others.','1'));
		array_push($tema,array('Exact Sciences ','The exact sciences have on their tripod Mathematics, Physics and Chemistry as their portion known as basic area. Regarding to the area we have applied the Engineering, Geology, Computing, Statistics, and others. Their discoveries are directly related to the advancement of technologies and the economic and social growth.','2'));
		array_push($tema,array('Agricultural Sciences','The Agricultural Sciences aim to improve the management and preservation of natural resources, which makes the field as one of the most important in current scientific scenario. With the demand growing fo food, for example, investment is needed in studies that show the best use of natural resources. Among the areas of study are Agriculture, Forestry, Fishing Engineering, Veterinary Medicine and Zootechnics.','3'));
		array_push($tema,array('Health Sciences','The Health Sciences, as the name suggests, involve several fields of study to improve and understand health. Their advance is crucial to improve the quality of life and longevity of the population. Among their fields of expertise are Human Medicine, Biology, Biomedicine, Clinical Analysis, Pharmacy, Sciences of movement, Dentistry, Psychology,  Biomedical Engineering, and others.','4'));
		array_push($tema,array('Human Sciences ','The Human Sciences study the complexity of human beings as individuals and social beings, and their interactions with society. In these fields are include the study of  Philosophy, History, Anthropology, Education, Linguistic, Sociology and others.','5'));	
	}
	
	for ($r=0;$r < count($tema);$r++)				
		{ echo $site->notas_esquerda($tema[$r][0],$tema[$r][1],$tema[$r][2]); }
		
	echo $site->redes_sociais();

	echo $site->coluna_direita_fecha();

/*
 * BBM - Foot Site
 */

echo $site->foot_site();
?>
