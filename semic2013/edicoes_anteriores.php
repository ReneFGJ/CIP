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


$tema = array();
//array_push($tema,array(
//	'XX SEMIC - 2012','capa_semic20.jpg',
//	'As Ci&ecirc;ncias Sociais Aplicadas correspondem aos campos de Direito, Administra&ccedil;&atilde;o, Comunica&ccedil;&atilde;o, Marketing, Economia, entre outros. Esse ramo de estudo pode ser diretamente ligado a temas que causam impacto na atualidade, como mostra o estudo &quot;Bullying e ass&eacute;dio moral: aspectos e implica&ccedil;&otilde;es jur&iacute;dicas&quot;, que mostra que tais pr&aacute;ticas merecem mais aten&ccedil;&atilde;o da sociedade e podem causar danos ps&iacute;quicos e f&iacute;sicos &agrave;s v&iacute;timas.',
//	'#','1'
//	));
array_push($tema,array(
	'XIV Semin�rio de Inicia��o Cient�fica e a VIII Mostra de Pesquisa (24 e 25 de outubro de 2006)','capa_semic14.jpg',
	'O modelo de apoio governamental � inicia��o cient�fica, atrav�s do Programa Institucional de Bolsas de Inicia��o Cient�fica (PIBIC), criado pelo CNPq, � um caso de sucesso na instrumentaliza��o do jovem para participar na gera��o de conhecimento. Atrav�s da intera��o do aluno de maneira pr�xima com um professor orientador, o aluno de gradua��o tem a oportunidade de conhecer a aplicar o m�todo cient�fico � sua �rea de conhecimento. Como consequ�ncia, passa por um processo de verdadeira emancipa��o educacional para a cidadania, enquanto interage com os atores do processo (professores, alunos de p�s-gradua��o e t�cnicos) e com o objeto da pesquisa, desenvolvendo habilidades como a racioc�nio l�gico, iniciativa, resolu��o de conflitos e perseveran�a.',
	'http://www2.pucpr.br/reol/index.php/PIBIC2006','4'
	));	

array_push($tema,array(
	'XV Semin�rio de Inicia��o Cient�fica e a IX Mostra de Pesquisa da PUCPR (30 e 31 de outubro de 2007)
','capa_semic15.jpg',
	'A Pontif�cia Universidade Cat�lica do Paran� tem na Inicia��o Cient�fica uma substancial contribui��o para a forma��o do ser humano em todas as suas dimens�es, n�o somente nas intelectuais. Assim, como resultado da sua prioriza��o institucional, o PIBIC tem sido consolidado e expandido, neste ano temos a primeira edi��o do Semin�rio de Pesquisa J�nior, com a participa��o de alunos do ensino m�dio da rede p�blica e privada. O XV Semin�rio de Inicia��o Cient�fica e a IX Mostra de Pesquisa s�o uma demonstra��o da maturidade cient�fica da PUCPR, � qual se soma seus 12 cursos de mestrado stricto sensu e sete de doutorado, envolvendo todas as �reas do conhecimento.',
	'http://www2.pucpr.br/reol/index.php/PIBIC2007','4'
	));
	
array_push($tema,array(
	'XVI Semin�rio de Inicia��o Cient�fica e a X Mostra de Pesquisa (11 e 12 de novembro de 2008)','capa_semic16.jpg',
	'O XVI Semin�rio de Inicia��o Cient�fica e a X Mostra de Pesquisa da PUCPR representam um resumo de toda a gera��o de conhecimento t�cnico e cient�fico da universidade, realizada por alunos de Inicia��o Cient�fica, oportunizando a eles, um desenvolvimento pessoal e maturidade profissional que certamente representar�o grande diferencial de competitividade na acirrada disputa pelo espa�o profissional.',
	'http://www2.pucpr.br/reol/index.php/PIBIC2008','4'
	));	

array_push($tema,array(
	'XVII Semin�rio de Inicia��o Cient�fica e a XI Mostra de Pesquisa (27 e 28 de outubro de 2009)','capa_semic17.jpg',
	'O objetivo maior dos Programas de Inicia��o Cient�fica - PIBIC e <NOBR>PIBIC Jr</nobr> - � a forma��o de recursos humanos por meio do aprendizado e desenvolvimento de atividades de pesquisa sob a orienta��o de um professor pesquisador.
	A Pontif�cia Universidade Cat�lica do Paran� tem dado grande aten��o � forma��o do jovem pesquisador e j� possui uma longa tradi��o na Inicia��o Cient�fica, participando do PIBIC h�18 anos, do <NOBR>PIBIC Jr</nobr> h� 3 anos. Al�m disso, � a �nica IES que oferece o <NOBR>PIBIC Jr</nobr> para col�gios privados como contrapartida �s bolsas recebidas do CNPq. 
	',
	'http://www2.pucpr.br/reol/index.php/semic17','4'
	));

array_push($tema,array(
	'XVIII Semin�rio de Inicia��o Cient�fica e a XII Mostra de Pesquisa (26 e 27 de outubro de 2010)','capa_semic18.jpg',
	'O XVIII Semin�rio de Inicia��o Cient�fica e a XII Mostra de Pesquisa da Pontif�cia Universidade Cat�lica do Paran� � o maior evento de pesquisa da universidade, que congrega a pesquisa nos diversos n�veis, desde o ensino m�dio at� o doutorado. Neste ano, o evento totaliza 524 trabalhos em todas as �reas do conhecimento, sendo 28 <NOBR>PIBIC Jr</nobr>, 360 PIBIC e 136 pesquisas de mestrado e doutorado.  O excelente desempenho dos alunos, alicer�ado na qualidade do corpo de orientadores, garante o sucesso desta conquista!',
	'http://www2.pucpr.br/reol/index.php/semic18','3'
	));
	
array_push($tema,array(
	'XIX Semin�rio de Inicia��o Cient�fica, XIII Mostra de Pesquisa, I PIBITI (25, 26 e 27 de outubro de 2011)','capa_semic19.jpg',
	'A novidade desta edi��o � o I Semin�rio de Inicia��o em Desenvolvimento Tecnol�gico e Inova��o (PIBITI) com 54 trabalhos. Somados a estes contamos com 461 pesquisas do PIBIC e 218 pesquisas de mestrado e doutorados dos diversos programas de p�s-gradua��o stricto sensu da PUCPR, totalizando 679 trabalhos apresentados durante o evento. Este � sem d�vida, o ambiente adequado para a discuss�es de ideias inovadoras, para o compartilhar dos resultados das pesquisas com seus pares e, ainda, o espa�o para os jovens pesquisadores receberem o feedback de pesquisadores experientes que atuam na qualidade de avaliadores.
	Anualmente a PUCPR premia os melhores trabalhos, oportunizando que os alunos do PIBIC participem da Reuni�o Anual da Sociedade Brasileira para o Progresso da Ci�ncia (SBPC) para a apresenta��o de suas pesquisas.! 
	',
	'http://www2.pucpr.br/reol/index.php/semic19','2'
	));

array_push($tema,array(
	'XX Semin�rio de Inicia��o Cient�fica, XIV Mostra de Pesquisa, I PIBITI (6, 7 e 8 de novembro de 2012)','capa_semic20.jpg',
	'Nesta edi��o estamos com novidades alinhadas com os temas da internacionaliza��o da Universidade e do desenvolvimento tecnol�gico e inova��o. 
	',
	'http://www2.pucpr.br/reol/semic2012','1'
	));


if ($LANG=='en')
	{
		$tema[0][0] = 'XIV Scientific Initiation Seminar and VIII Research Show (October 24th and 25th , 2006)';
		$tema[0][2] = 'The model of the governmental support to the Scientific Initiation, through the Scholarship Institutional Program in Scientific Initiation (PIBIC), created by CNPq, is a case of success on the young instrumentalization to participate on the knowledge generation. Through the student?s interaction with his/her advisor, the undergraduate student has the opportunity to know and apply the scientific method to his/her knowledge area. As a result, there is a process of educational emancipation to the citizenship, while he interacts with the process authors (professors, post-graduate students and technical) and with the research object, creating abilities like logical thought, initiative, conflicts solve and determination.';

		$tema[1][0] = 'XV Scientific Initiation Seminar and IX PUCPR Research Show (October 30th and 31st, 2007)';
		$tema[1][2] = 'The Pontif�cia Universidade Cat�lica do Paran� has on the Scientific Initiation a solid contribution to the human being formation in all the dimensions, not only on the intellectual ones. This way, as a result of the institutional priorization, PIBIC has been consolidated and expanded, this year we have the first edition of the Junior Research Seminar, with the participation of high school students from private and public schools. The XV Scientific Initiation Seminar and the IX PUCPR Research Show are demonstrations of scientific maturity from PUCPR, which has 12 master degree courses stricto sensu and 7 doctorates, involving all the knowledge areas.';

		$tema[2][0] = 'XVI Scientific Initiation Seminar and IX Research Show (November 11th and 12th, 2008)';
		$tema[2][2] = 'The XVI Scientific Initiation Seminar and the IX PUCPR Research Show represent a summary from all the technical and scientific knowledge generation from the university, realized by Scientific Initiation students, giving them opportunity, personal development and professional maturity that certainly will represent a big difference on the cutthroat competition for the professional place.';

		$tema[3][0] = 'XVII Scientific Initiation Seminar and XI Research Show (October 27th and 28th, 2009)';
		$tema[3][2] = 'The biggest objective from Scientific Initiation Programs - PIBIC and PIBIC Jr � is the formation of human resources by the learning and development of the research activities by the orientation of a researcher professor. The Pontif�cia Universidade Cat�lica do Paran� has given a special attention to the young researcher formation and it already has a long tradition on the Scientific Initiation, participating on the PIBIC for 18 years and on the PIBIC Jr for 3 years. Besides that, it is the only IES that offers the PIBIC Jr to private schools as a counterpart to the received scholarship from CNPq.';

		$tema[4][0] = 'XVIII Scientific Initiation Seminar and XII Research Show (October 26th and 27th, 2010)';
		$tema[4][2] = 'The XVIII Scientific Initiation Seminar and the XII PUCPR Research Show is the biggest research event from the university, which assembles the research on different levels, since high school to doctorate. This year, the event has 524 researches in all the knowledge areas, being 28 PIBIC Jr, 360 PIBIC and 136 from master and doctorate degree. The excellent student�s performance, based on the quality of the advisors, guarantee the success of this achievement.';

		$tema[5][0] = 'XIX Scientific Initiation Seminar and XIII Research Show (October 25th, 26th and 27th, 2011)';
		$tema[5][2] = 'The news on this edition is the Initiation Seminar in Technological and Innovation Development (PIBITI) with 54 researches. Added to these, we have more 461 researches from PIBIC and 218 researches from master and doctorate degree from different post-graduation strict sensu programs from PUCPR, summing up 679 researches presented during the event. This is, with no doubt, the correct environment to discuss new ideas, to share the results and yet, a place for young researchers to receive the feedback from experienced researchers that act as evaluators. Every year, PUCPR awards the best work, giving the opportunity to PIBIC students to participate on the Annual Reunion from Brazilian Society to the Science Progress (SBPC) for the presentation of their researches.';
		
		$tema[6][0] = 'XX Scientific Initiation Seminar and XIV Research Show (November 6th, 7th and 8th, 2012)';
		$tema[6][2] = 'The news on this edition is the Initiation Seminar in Technological and Innovation Development (PIBITI) with 54 researches. Added to these, we have more 461 researches from PIBIC and 218 researches from master and doctorate degree from different post-graduation strict sensu programs from PUCPR, summing up 679 researches presented during the event. This is, with no doubt, the correct environment to discuss new ideas, to share the results and yet, a place for young researchers to receive the feedback from experienced researchers that act as evaluators. Every year, PUCPR awards the best work, giving the opportunity to PIBIC students to participate on the Annual Reunion from Brazilian Society to the Science Progress (SBPC) for the presentation of their researches.';

		echo $site->abre_secao('Back Editions');
	} else {
		echo $site->abre_secao('Edi��es Anteriores');
	}


	
	
for ($r=0;$r < count($tema);$r++)				
	{ echo $site->box_materia_home($tema[$r][0],$tema[$r][1],$tema[$r][2],$tema[$r][3],$tema[$r][4]); }
echo '</DIV>';
/*
 * BBM - Foot Site
 */
echo $site->foot_site();
?>
