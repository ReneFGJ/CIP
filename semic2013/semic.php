<?php
require("db.php");
/*
 * Incluir Classes para a página
 */
require("_class/_class_semic_layout.php");
$site = new layout;

/* 
 * BBM - Header Site 
 */
echo $site->header_site();

echo $site->banner_vermelho();
echo '<BR><BR>';
$title = 'O que é SEMIC?';
if ($LANG=='en')
	{ $title = 'What is SEMIC?';}
echo $site->abre_secao($title);

$sx = '
<P>
O Seminário de Iniciação Científica (SEMIC) e a Mostra de Pesquisa da Pós-Graduação da PUCPR são eventos abertos à comunidade, em que são exibidos os trabalhos de Iniciação Científica desenvolvidos pelos alunos ao longo do ano.
<BR><BR>No evento são apresentados os resultados das pesquisas científicas desenvolvidas na graduação por meio dos programas PIBITI (Programa Institucional de Bolsas de Iniciação em Desenvolvimento Tecnológico e Inovação) e PIBIC (Programa Institucional de Bolsas de Iniciação Científica), além da participação do ensino médio por meio do PIBIC Jr (Programa Institucional de Bolsas de Iniciação Científica Júnior) e da pós-graduação stricto sensu (mestrado e doutorado). 
<BR><BR>Para o Pró-Reitor de Pesquisa e Pós-Graduação, Waldemiro Gremski, a apresentação de pesquisas à comunidade é fundamental: “Não há ciência se ela não for exposta”. “Para a formação dos alunos a avaliação é um passo indispensável, pois pesquisadores mais experientes fazem as suas considerações sobre o trabalho", complementa.
<BR><BR>A Iniciação Científica é uma atividade voltada para a formação de recursos humanos para a pesquisa. A PUCPR é a instituição de ensino privada que mais investe em pesquisa no Paraná, concentrando 20% de toda a produção científica do Estado. "Na vigência 2012/2013, temos aproximadamente 1100 alunos envolvidos nos programas de iniciação científica da Universidade", informa a profa. Cleybe Vieira, coordenadora da Iniciação Científica da PUCPR. Sem dúvida alguma, adentrar o universo científico é um grande diferencial na formação de nossos alunos, complementa.
</P>
';

if ($LANG=='en')
	{
		$sx = '

<P>
In the event, it is presented the results of the Scientific Initiation developed on the undergraduation by the programs PIBITI (Scholarship Institutional Program in Innovation and Technologic Development) and PIBIC (Scholarship Institutional Program in Scientific Initiation), besides the participation of the high school by PIBIC Jr (Scholarship Institutional Program in Scientific Initiation Junior) and the post graduation stricto sensu (master and doctor degree).
<BR><BR>To Research and Graduate Pro-Rector, Waldemiro Gremski,  the researches presentation to the community is fundamental: “There is no science if it is not exposed”. “To the students formation the evaluation is an indispensable step, because more experienced researches make their considerations about the work”, he says.
<BR><BR>The Scientific Initiation is one activity focused on the research to the human resources formation. PUCPR is a private education institution that invests in researches in Parana, concentrating 20% of all the Scientific Initiation in the State. “Nowadays 2012/2013, we have approximately 1100 students involved in the University Scientific Initiation programs”, says Professor Cleybe Vieira, PUCPR Scientific Initiation Coordinator. With no doubts, enter in the scientific universe is a big difference on our students formation, she says.  
	';
	}
echo $sx;
echo $site->fecha_secao();

/*
 * BBM - Foot Site
 */
echo $site->foot_site();
?>
