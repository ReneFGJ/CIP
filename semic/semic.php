<?php
require("db.php");
/*
 * Incluir Classes para a p�gina
 */
require("_class/_class_semic_layout.php");
$site = new layout;

/* 
 * BBM - Header Site 
 */
echo $site->header_site();

echo $site->banner_vermelho();
echo '<BR><BR>';
$title = 'O que � SEMIC?';
if ($LANG=='en')
	{ $title = 'What is SEMIC?';}
echo $site->abre_secao($title);

$sx = '
<P>
O Semin�rio de Inicia��o Cient�fica (SEMIC) e a Mostra de Pesquisa da P�s-Gradua��o da PUCPR s�o eventos abertos � comunidade, em que s�o exibidos os trabalhos de Inicia��o Cient�fica desenvolvidos pelos alunos ao longo do ano.
<BR><BR>No evento s�o apresentados os resultados das pesquisas cient�ficas desenvolvidas na gradua��o por meio dos programas PIBITI (Programa Institucional de Bolsas de Inicia��o em Desenvolvimento Tecnol�gico e Inova��o) e PIBIC (Programa Institucional de Bolsas de Inicia��o Cient�fica), al�m da participa��o do ensino m�dio por meio do PIBIC Jr (Programa Institucional de Bolsas de Inicia��o Cient�fica J�nior) e da p�s-gradua��o stricto sensu (mestrado e doutorado). 
<BR><BR>Para o Pr�-Reitor de Pesquisa e P�s-Gradua��o, Waldemiro Gremski, a apresenta��o de pesquisas � comunidade � fundamental: �N�o h� ci�ncia se ela n�o for exposta�. �Para a forma��o dos alunos a avalia��o � um passo indispens�vel, pois pesquisadores mais experientes fazem as suas considera��es sobre o trabalho", complementa.
<BR><BR>A Inicia��o Cient�fica � uma atividade voltada para a forma��o de recursos humanos para a pesquisa. A PUCPR � a institui��o de ensino privada que mais investe em pesquisa no Paran�, concentrando 20% de toda a produ��o cient�fica do Estado. "Na vig�ncia 2012/2013, temos aproximadamente 1100 alunos envolvidos nos programas de inicia��o cient�fica da Universidade", informa a profa. Cleybe Vieira, coordenadora da Inicia��o Cient�fica da PUCPR. Sem d�vida alguma, adentrar o universo cient�fico � um grande diferencial na forma��o de nossos alunos, complementa.
</P>
';

if ($LANG=='en')
	{
		$sx = '

<P>
In the event, it is presented the results of the Scientific Initiation developed on the undergraduation by the programs PIBITI (Scholarship Institutional Program in Innovation and Technologic Development) and PIBIC (Scholarship Institutional Program in Scientific Initiation), besides the participation of the high school by PIBIC Jr (Scholarship Institutional Program in Scientific Initiation Junior) and the post graduation stricto sensu (master and doctor degree).
<BR><BR>To Research and Graduate Pro-Rector, Waldemiro Gremski,  the researches presentation to the community is fundamental: �There is no science if it is not exposed�. �To the students formation the evaluation is an indispensable step, because more experienced researches make their considerations about the work�, he says.
<BR><BR>The Scientific Initiation is one activity focused on the research to the human resources formation. PUCPR is a private education institution that invests in researches in Parana, concentrating 20% of all the Scientific Initiation in the State. �Nowadays 2012/2013, we have approximately 1100 students involved in the University Scientific Initiation programs�, says Professor Cleybe Vieira, PUCPR Scientific Initiation Coordinator. With no doubts, enter in the scientific universe is a big difference on our students formation, she says.  
	';
	}
echo $sx;
echo $site->fecha_secao();

/*
 * BBM - Foot Site
 */
echo $site->foot_site();
?>
